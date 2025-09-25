<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::orderByDesc('id')->paginate();
        return view('plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Titre' => 'required|string|max:255',
            'Prix' => 'required|numeric',
            'Devise' => 'required|string|max:10',
            'DureeEnJours' => 'required|integer',
            'NombreDeSignaux' => 'required|integer',
            'AutresAvantages' => 'nullable|string',
            'Visibilite' => 'required|in:PUBLIQUE,PRIVEE',
            'isPopular' => 'sometimes|in:on,off',
        ]);
        $validated['AutresAvantages'] = $request->AutresAvantages
            ? array_filter(array_map('trim', preg_split('/\r?\n/', $request->AutresAvantages)))
            : [];
        $validated['isPopular'] = $request->has('isPopular') ? true : false;

        $plan = Plan::create($validated);
        return redirect()->route('plans.show', $plan)->with('success', 'Plan créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {

        $validated = $request->validate([
            'Titre' => 'required|string|max:255',
            'Prix' => 'required|numeric',
            'Devise' => 'required|string|max:10',
            'DureeEnJours' => 'required|integer',
            'NombreDeSignaux' => 'required|integer',
            'AutresAvantages' => 'nullable|string',
            'Visibilite' => 'required|in:PUBLIQUE,PRIVEE',
            'isPopular' => 'sometimes|in:on,off',
        ]);
        $validated['AutresAvantages'] = $request->AutresAvantages
            ? array_filter(array_map('trim', preg_split('/\r?\n/', $request->AutresAvantages)))
            : [];
        $validated['isPopular'] = $request->has('isPopular') ? true : false;
        $plan->update($validated);
        return redirect()->route('plans.show', $plan)->with('success', 'Plan modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plan supprimé avec succès.');
    }
}
