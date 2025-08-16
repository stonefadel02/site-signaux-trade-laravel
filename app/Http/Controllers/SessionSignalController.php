<?php

namespace App\Http\Controllers;

use App\Models\SessionSignal;
use Illuminate\Http\Request;

class SessionSignalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = SessionSignal::orderByDesc('id')->paginate();
        return view('session_signals.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('session_signals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Titre' => 'required|string|max:255',
            'HeureDebut' => 'required',
            'HeureFin' => 'required',
        ]);
        $session = SessionSignal::create($validated);
        return redirect()->route('parametrage-signaux', ['tab' => 'sessions'])->with('success', 'Session créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SessionSignal $sessionSignal)
    {
        return view('session_signals.show', compact('sessionSignal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SessionSignal $sessionSignal)
    {
        return view('session_signals.edit', compact('sessionSignal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SessionSignal $sessionSignal)
    {
        $validated = $request->validate([
            'Titre' => 'required|string|max:255',
            'HeureDebut' => 'required',
            'HeureFin' => 'required',
        ]);
        $sessionSignal->update($validated);
        return redirect()->route('parametrage-signaux', ['tab' => 'sessions'])->with('success', 'Session modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SessionSignal $sessionSignal)
    {
        if ($sessionSignal->signals()->exists()) {
            return redirect()->route('parametrage-signaux', ['tab' => 'sessions'])->with('error', 'Impossible de supprimer : cette session est utilisée dans au moins un signal.');
        }
        $sessionSignal->delete();
        return redirect()->route('parametrage-signaux', ['tab' => 'sessions'])->with('success', 'Session supprimée avec succès.');
    }
}
