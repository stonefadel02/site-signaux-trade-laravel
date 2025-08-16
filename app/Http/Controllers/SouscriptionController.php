<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\AccessCode;
use App\Models\Souscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SouscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Listing administrateur de toutes les souscriptions avec filtres.
     */
    public function adminIndex(Request $request)
    {
        $query = Souscription::query()->with(['user', 'plan']);

        // Recherche globale
        $search = trim($request->get('q', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($u) use ($search) {
                    $u->where('email', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%");
                })
                    ->orWhere('AccessCode', 'like', "%$search%")
                    ->orWhere('Montant', 'like', "%$search%");
            });
        }

        // Filtre période
        $from = $request->get('from');
        $to = $request->get('to');
        if ($from && $to) {
            $fromDate = Carbon::parse($from)->startOfDay();
            $toDate = Carbon::parse($to)->endOfDay();
            $query->whereBetween('DateHeureDebut', [$fromDate, $toDate]);
        } elseif ($from) {
            $fromDate = Carbon::parse($from)->startOfDay();
            $query->where('DateHeureDebut', '>=', $fromDate);
        } elseif ($to) {
            $toDate = Carbon::parse($to)->endOfDay();
            $query->where('DateHeureDebut', '<=', $toDate);
        }

        // Tri chrono (du plus récent au plus ancien)
        $souscriptions = $query->orderBy('DateHeureDebut', 'desc')->paginate(25)->withQueryString();

        // Stats simples (optionnel)
        $total = (clone $query)->count();
        $montantTotal = (clone $query)->sum('Montant');

        return view('souscription.admin-index', [
            'souscriptions' => $souscriptions,
            'search' => $search,
            'from' => $from,
            'to' => $to,
            'total' => $total,
            'montantTotal' => $montantTotal,
        ]);
    }

    /**
     * Désactiver (mettre INACTIVE) une souscription manuellement.
     */
    public function deactivate(Souscription $souscription)
    {
        if ($souscription->Status === 'ACTIVE') {
            $souscription->Status = 'INACTIVE';
            // Option: marquer fin immédiate
            if ($souscription->DateHeureFin->gt(now())) {
                $souscription->DateHeureFin = now();
            }
            $souscription->save();
            return back()->with('success', 'Souscription désactivée.');
        }
        return back()->with('info', 'Souscription déjà inactive ou expirée.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $plans = Plan::all();
        $souscription = Souscription::where('user_id', $user->id)
            ->latest()
            ->first();
        return view('souscription.create', compact('plans', 'souscription'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $user = Auth::user();
        $plan = Plan::findOrFail($request->plan_id);

        $dateDebut = now();
        $dateFin = $dateDebut->copy()->addDays($plan->DureeEnJours);

        Souscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'Montant' => $plan->Prix,
            'Devise' => $plan->Devise,
            'DateHeureDebut' => $dateDebut,
            'DateHeureFin' => $dateFin,
            'Status' => 'ACTIVE',
        ]);

        return redirect()->route('souscription.create')->with('success', 'Souscription effectuée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Souscription $souscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Souscription $souscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Souscription $souscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Souscription $souscription)
    {
        //
    }

    public function dashboard()
    {
        $souscription = Souscription::where('user_id', Auth::id())
            ->latest()
            ->first();

        return view('dashboard', compact('souscription'));
    }

    function souscrire()
    {
        $lastAbonnement = auth()->user()->getActiveSouscription() ?? auth()->user()->getLastSouscription();

        // Logique pour souscrire un utilisateur à un plan
        return view('souscription.souscrire', compact('lastAbonnement'));
    }
    function storeCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $accessCode = AccessCode::where('Code', $request->code)
            ->where('Compteur', '<', DB::raw('CompteurMax'))
            ->where('ExpireLe', '>', now())
            ->whereNotIn("Code", Souscription::where('user_id', Auth::id())->pluck('AccessCode')->toArray())
            ->first();

        if (!$accessCode) {
            return redirect()->back()->withErrors(['code' => 'Le code d\'accès est invalide.']);
        }

        // Enregistrer la souscription avec le code d'accès
        self::saveSouscription(Auth::id(), $accessCode->plan_id, $accessCode->Code);
        $accessCode->increment('Compteur'); // Incrémente le compteur d'utilisation

        return redirect()->route('mon-abonnement')->with('success', 'Souscription réussie avec le code d\'accès.');
    }


    /**
     * Save a new subscription for the user.
     *
     * @param int $user
     * @param int $plan_id
     * @param string $accessCode
     */
    public static function saveSouscription(int $user, int $plan_id, string $accessCode = '')
    {
        $user = Auth::user();

        $nbreJours = 0;
        $montant = 0;
        $devise = '';

        if ($accessCode != '') {
            $codeModel = AccessCode::where('Code', $accessCode)->firstOrFail();
            $plan = $codeModel->plan;
            $nbreJours = $codeModel->DureeEnJours;
            $montant = 0;
            $devise = $plan->Devise;

        } else {
            $plan = Plan::findOrFail($plan_id);
            $nbreJours = $plan->DureeEnJours;
            $montant = $plan->Prix;
            $devise = $plan->Devise;
        }

        $dateNow = now();
        $dateFin = $dateNow->copy()->addDays($nbreJours);

        // Mettre à jour le statut de toutes les souscriptions de l'utilisateur, tous mettre a expiré d'abord
        Souscription::where('user_id', $user->id)
            ->update(['Status' => 'EXPIRE']);

        // Desactiver toutes les souscriptions actives de l'utilisateur
        Souscription::where('user_id', $user->id)
            ->where('DateHeureFin', '>=', $dateNow)
            ->where('DateHeureDebut', '<=', $dateNow)
            ->update(['Status' => 'INACTIVE', 'DateHeureFin' => $dateNow]);

        // Créer une nouvelle souscription

        $res = Souscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'Montant' => $montant,
            'Devise' => $devise,
            'DateHeureDebut' => $dateNow,
            'DateHeureFin' => $dateFin,
            'AccessCode' => $accessCode,
            'Status' => 'ACTIVE',
        ]);
        return $res;

    }
}
