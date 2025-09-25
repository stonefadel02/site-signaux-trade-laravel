<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementController extends Controller
{
    private $secret_key;
    private $base_url;

    public function __construct()
    {
        $this->secret_key = env('MONEROO_SECRET_KEY');
        $this->base_url = rtrim(env('MONEROO_API_URL', 'https://api.moneroo.com/v1'), '/') . '/';
    }

    /**
     * Initier un paiement Moneroo
     */
    public function initierPaiement(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "email_name" => "required|email|max:255",
            "switch_mode" => "nullable|string|in:immediate,scheduled",
        ]);
        $plan = Plan::findOrFail($request->plan_id);
        $user = Auth::user();

        // Crée un paiement local en attente
        $paiement = Paiement::create([
            'user_id' => $user->id,
            'Montant' => $plan->Prix,
            'Devise' => $plan->Devise ?? 'USD',
            'ModeDePaiement' => 'MONEROO',
            'DateHeurePaiement' => now(),
            'Status' => 'PENDING',
            'plan_id' => $plan->id,
            'Details' => json_encode(['plan_id' => $plan->id]),
            'souscription_id' => null,
            "switch_mode" => $request->switch_mode ?? "scheduled",
        ]);

        // Appel API Moneroo
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->secret_key,
            'Accept' => 'application/json'
        ])
            ->post("https://api.moneroo.io/v1/payments/initialize", [
                'amount' => $plan->Prix,
                'currency' => $plan->Devise ?? 'USD',
                'description' => "Abonnement - " . $plan->Titre,
                'return_url' => route('paiement.callback'),
                'webhook_url' => route('paiement.webhook'),
                'metadata' => [
                    'local_payment_id' => $paiement->id,
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                ],
                'customer' => [
                    'email' => $request->email_name,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ],
            ]);

        if ($response->failed()) {
            Log::error('Erreur API Moneroo : ' . $response->body());
            return back()->with('error', 'Impossible d’initier le paiement.');
        }

        $data = $response->json();

        // Enregistre l'ID Moneroo dans ton paiement local
        $paiement->update(['gateway_payment_id' => $data['data']['id'] ?? null]);

        // Redirige l'utilisateur vers l’URL de paiement Moneroo
        return redirect()->away($data['data']['checkout_url']);
    }

    /**
     * Retour utilisateur après paiement (simple affichage)
     */
    public function handleCallback(Request $request)
    {
        $status = $request->get('status');
        $paymentId = $request->get('paymentId');

        $paiement = Paiement::where('gateway_payment_id', $paymentId)->firstOrFail();
        // Appel API Moneroo
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->secret_key,
            'Accept' => 'application/json'
        ])
            ->get("https://api.moneroo.io/v1/payments/{$paymentId}/verify");
        // dd($response->json());
        $resp = $response->json();
        if ($response->failed()) {
            Log::error('Erreur API Moneroo : ' . $response->body());
            return redirect()->route('mon-abonnement')->with('error', 'Impossible de vérifier le paiement.');
        } elseif (
            $response->successful()
            && $resp['data']['status'] === 'success'
            && $resp['data']['amount'] >= $paiement->Montant
            && $resp['data']['currency']["code"] === $paiement->Devise
        ) {
            $paiement->update(['Status' => 'COMPLETED', "Details" => ($resp)]);
            try {

                $paiement->activerSouscription();
                return redirect()->route('mon-abonnement')->with('success', 'Paiement réussi 🎉');
            } catch (\Throwable $th) {
                Log::error('Erreur lors de l\'activation de la souscription : ' . $th->getMessage());
                return redirect()->route('mon-abonnement')->with('error', 'Erreur lors de l\'activation de la souscription. Veuillez contacter le support.');

            }

        }
        // erreur
        Log::error('Erreur de paiement : ' . $resp['data']['status']);
        return redirect()->route('mon-abonnement')->with('error', 'Le paiement a échoué.');
    }

    /**
     * Webhook serveur → confirmation fiable
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Moneroo-Signature');

        $expected = hash_hmac('sha256', $payload, $this->secret_key);
        if (!hash_equals($expected, $signature)) {
            Log::warning('Webhook Moneroo signature invalide.');
            return response()->json(['error' => 'invalid signature'], 401);
        }

        $event = json_decode($payload, true);
        Log::info('Webhook Moneroo reçu', $event);

        $paymentId = $event['data']['id'] ?? null;
        $status = $event['data']['status'] ?? null;

        if ($paymentId && $status) {
            $paiement = Paiement::where('gateway_payment_id', $paymentId)->first();
            if ($paiement) {
                $paiement->Status = strtoupper($status);
                $paiement->save();

                if ($status === 'paid') {
                    $this->activerAbonnement($paiement);
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Active la souscription liée à un paiement validé
     */
    private function activerAbonnement(Paiement $paiement)
    {
        $details = json_decode($paiement->Details, true);
        $plan_id = $details['plan_id'] ?? null;

        if ($plan_id) {
            $souscription = \App\Http\Controllers\SouscriptionController::saveSouscription(
                $paiement->user_id,
                $plan_id
            );

            $paiement->update([
                'souscription_id' => $souscription->id,
                'Status' => 'COMPLETED'
            ]);
        }
    }

    /**
     * Générer facture PDF
     */
    public function download($id, $format = 'a4')
    {
        $paiement = Paiement::with('user', 'souscription.plan')->findOrFail($id);

        $pdf = Pdf::loadView('factures.template', compact('paiement'))
            ->setPaper($format, 'portrait')
            ->setWarnings(false);

        return $pdf->stream('facture-' . $paiement->id . '-' . strtoupper($format) . '.pdf');
    }
}
