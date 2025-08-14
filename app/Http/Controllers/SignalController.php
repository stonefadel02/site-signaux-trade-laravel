<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Signal;
use Illuminate\Http\Request;
use App\Models\SessionSignal;
use App\Exports\SignalsExport;
use App\Imports\SignalsImport;
use Maatwebsite\Excel\Facades\Excel;

class SignalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signals = Signal::all();
        return view('signals.index', compact('signals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessions = SessionSignal::all();
        $users = User::all();
        return view('signals.create', compact('sessions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:session_signals,id',
            'DateHeureEmission' => 'required|date',
            'DateHeureExpire' => 'required|date',
            'DureeTrade' => 'required',
            'Actifs' => 'required|string',
            'Timeframe' => 'nullable|string',
            'PrixEntree' => 'required|numeric',
            'PrixSortieReelle' => 'nullable|numeric',
            'TakeProfit' => 'nullable|numeric',
            'StopLoss' => 'nullable|numeric',
            'Direction' => 'required|in:BUY,SELL',
            'Resultat' => 'required|in:WIN,LOSE,PENDING,BREAK-EVEN',
            'Pips' => 'nullable|integer',
            'Confiance' => 'nullable|integer',
            'Commentaire' => 'nullable|string',
            'Status' => 'required|in:EN COURS,EN ATTENTE,TERMINE,ANNULE',
        ]);
        Signal::create($validated);
        return redirect()->route('signals.index')->with('success', 'Signal créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Signal $signal)
    {
        return view('signals.show', compact('signal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Signal $signal)
    {
        $sessions = SessionSignal::all();
        $users = User::all();
        return view('signals.edit', compact('signal', 'sessions', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Signal $signal)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:session_signals,id',
            'DateHeureEmission' => 'required|date',
            'DateHeureExpire' => 'required|date',
            'DureeTrade' => 'required',
            'Actifs' => 'required|string',
            'Timeframe' => 'nullable|string',
            'PrixEntree' => 'required|numeric',
            'PrixSortieReelle' => 'nullable|numeric',
            'TakeProfit' => 'nullable|numeric',
            'StopLoss' => 'nullable|numeric',
            'Direction' => 'required|in:BUY,SELL',
            'Resultat' => 'required|in:WIN,LOSE,PENDING,BREAK-EVEN',
            'Pips' => 'nullable|integer',
            'Confiance' => 'nullable|integer',
            'Commentaire' => 'nullable|string',
            'Status' => 'required|in:EN COURS,EN ATTENTE,TERMINE,ANNULE',
        ]);
        $signal->update($validated);
        return redirect()->route('signals.index')->with('success', 'Signal modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Signal $signal)
    {
        $signal->delete();
        return redirect()->route('signals.index')->with('success', 'Signal supprimé avec succès.');
    }

    public function import(Request $request)
    {
       $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ], [
            'file.required' => 'Veuillez sélectionner un fichier.',
            'file.mimes' => 'Le fichier doit être au format XLS, XLSX ou CSV.',
        ]);

        try {
            // 2. Import des données
            Excel::import(new SignalsImport, $request->file('file'));

            // 3. Message de succès
            return redirect()
                ->route('signals.index')
                ->with('success', 'Les signaux ont été importés avec succès.');

        } catch (Exception $e) {
            // 4. Gestion des erreurs
            return redirect()
                ->route('signals.index')
                ->with('error', 'Erreur lors de l’importation : ' . $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new SignalsExport, 'signals.xlsx');
    }


}
