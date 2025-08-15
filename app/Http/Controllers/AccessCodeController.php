<?php

namespace App\Http\Controllers;

use App\Models\AccessCode;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccessCodeController extends Controller
{
    public function index()
    {
        $accessCodes = AccessCode::with('plan')->latest()->paginate(10);
        return view('access_codes.index', compact('accessCodes'));
    }

    public function create()
    {
        $plans = Plan::all();
        return view('access_codes.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'DureeEnJours' => 'required|integer|min:1',
        ]);

        AccessCode::create([
            'plan_id' => $request->plan_id,
            'Code' => 'T10-' . strtoupper(Str::random(6)),
            'DureeEnJours' => $request->DureeEnJours,
            'ExpireLe' => now()->addDays($request->DureeEnJours),
        ]);

        return redirect()->route('access-codes.index')
            ->with('success', 'Code d\'accès généré avec succès.');
    }

    public function destroy(AccessCode $accessCode)
    {
        $accessCode->delete();

        return redirect()->route('access-codes.index')
            ->with('success', 'Code d\'accès supprimé avec succès.');
    }
    public function show(AccessCode $accessCode)
    {
        return view('access_codes.show', compact('accessCode'));
    }

    
    public function edit(AccessCode $accessCode)
    {
        $plans = Plan::all();
        return view('access_codes.edit', compact('accessCode', 'plans'));
    }

    
    public function update(Request $request, AccessCode $accessCode)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'DureeEnJours' => 'required|integer|min:1',
        ]);

        $accessCode->update([
            'plan_id' => $request->plan_id,
            'DureeEnJours' => $request->DureeEnJours,
            'ExpireLe' => now()->addDays($request->DureeEnJours), // Recalcule la date d'expiration
        ]);

        return redirect()->route('access-codes.index')
            ->with('success', 'Code d\'accès mis à jour avec succès.');
    }
}