<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Souscription; // Assurez-vous que ce modèle existe

class MesAbonnementController extends Controller
{
    /**
     * Affiche la page des abonnements avec les paiements et la souscription de l'utilisateur.
     */
    public function abonnement()
    {
        // Vérifie si l'utilisateur est authentifié. Si non, le redirige vers la page de connexion.
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();

        // Récupère la dernière souscription de l'utilisateur authentifié.

        $subscription = auth()->user()->getActiveSouscription() ?? auth()->user()->getLastSouscription();

        // Récupère les paiements de l'utilisateur, en chargeant la souscription associée (eager loading).

        $paiements = Paiement::with('souscription')
            ->where('user_id', $userId)
            ->orderBy('DateHeurePaiement', 'desc')
            ->get();

        // Passe les paiements et la souscription à la vue.
        return view('abonnement.Mesabonnement', compact('paiements', 'subscription'));
    }

    function index()
    {
        $lastSouscription = auth()->user()->getActiveSouscription() ?? auth()->user()->getLastSouscription();
        $souscriptions = Souscription::where('user_id', Auth::id())
            ->with('plan')
            ->with('paiements')
            ->orderBy('DateHeureDebut', 'desc')
            ->get();
        return view('abonnement.index', compact('lastSouscription', 'souscriptions'));
    }


}