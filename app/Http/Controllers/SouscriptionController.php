<?php

namespace App\Http\Controllers;

use App\Models\Plan;
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
}
