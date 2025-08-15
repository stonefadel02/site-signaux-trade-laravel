<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\AccessCode;
use App\Models\Souscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->update(['Status' => 'EXPIRED']);

        // Desactiver toutes les souscriptions actives de l'utilisateur
        Souscription::where('user_id', $user->id)
            ->where('DateHeureFin', '>=', $dateNow)
            ->where('DateHeureDebut', '<=', $dateNow)
            ->update(['Status' => 'INACTIVE', 'DateHeureFin' => $dateNow]);

        // Créer une nouvelle souscription

        Souscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'Montant' => $montant,
            'Devise' => $devise,
            'DateHeureDebut' => $dateNow,
            'DateHeureFin' => $dateFin,
            'AccessCode' => $accessCode,
            'Status' => 'ACTIVE',
        ]);

    }
}
