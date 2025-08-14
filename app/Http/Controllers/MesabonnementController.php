<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Souscription; // Assurez-vous que ce modèle existe

class MesabonnementController extends Controller
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
        // Assurez-vous que votre modèle 'User' a une relation 'hasMany' vers 'Souscription'.
        // J'utilise `latest()->first()` pour obtenir la plus récente.
        $subscription = Auth::user()->souscriptions()->latest()->first();

        // Récupère les paiements de l'utilisateur, en chargeant la souscription associée (eager loading).
        // Cela permet d'éviter les requêtes N+1.
        $paiements = Paiement::with('souscription')
            ->where('user_id', $userId)
            ->orderBy('DateHeurePaiement', 'desc')
            ->get();

        // Passe les paiements et la souscription à la vue.
        return view('abonnement.Mesabonnement', compact('paiements', 'subscription'));
    }
}