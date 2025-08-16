<?php

namespace App\Http\Controllers;

use App\Models\AccessCode;
use App\Models\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AccessCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $accessCodes = AccessCode::with('plan')->paginate();

        return view('access-code.index', compact('accessCodes'))
            ->with('i', ($request->input('page', 1) - 1) * $accessCodes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $accessCode = new AccessCode();
        $plans = Plan::where('Visibilite', true)->get();

        // Générer un code aléatoire de 10 caractères
        $generatedCode = $this->generateAccessCode();

        return view('access-code.create', compact('accessCode', 'plans', 'generatedCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'Code' => 'required|string|size:10|unique:access_codes,Code',
            'DureeEnJours' => 'required|integer|min:1',
            'CompteurMax' => 'required|integer|min:1',
            'ExpireLe' => 'required|date|after:today',
        ]);

        // Initialiser le compteur à 0
        $validated['Compteur'] = 0;

        AccessCode::create($validated);

        return Redirect::route('access-codes.index')
            ->with('success', 'Code d\'accès créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $accessCode = AccessCode::with([
            'plan',
            'souscriptions' => function ($q) {
                $q->orderBy('DateHeureDebut', 'desc');
            },
            'souscriptions.user'
        ])->findOrFail($id);

        return view('access-code.show', compact('accessCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $accessCode = AccessCode::with('plan')->findOrFail($id);
        $plans = Plan::where('Visibilite', true)->get();

        return view('access-code.edit', compact('accessCode', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccessCode $accessCode): RedirectResponse
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'Code' => 'required|string|size:10|unique:access_codes,Code,' . $accessCode->id,
            'DureeEnJours' => 'required|integer|min:1',
            'CompteurMax' => 'required|integer|min:' . $accessCode->Compteur,
            'ExpireLe' => 'required|date',
        ]);

        $accessCode->update($validated);

        return Redirect::route('access-codes.index')
            ->with('success', 'Code d\'accès mis à jour avec succès');
    }

    public function destroy($id): RedirectResponse
    {
        AccessCode::find($id)->delete();

        return Redirect::route('access-codes.index')
            ->with('success', 'Code d\'accès supprimé avec succès');
    }

    /**
     * Génère un code d'accès aléatoire de 10 caractères
     */
    private function generateAccessCode(): string
    {
        do {
            $code = Str::upper(Str::random(10));
            // Vérifier que le code n'existe pas déjà
        } while (AccessCode::where('Code', $code)->exists());

        return $code;
    }
}
