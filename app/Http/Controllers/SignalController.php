<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Signal;
use Illuminate\Http\Request;
use App\Models\SessionSignal;
use App\Models\Timeframe;
use App\Models\Plan;
use App\Models\Actif;
use App\Exports\SignalsExport;
use App\Imports\SignalsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class SignalController extends Controller
{
    /**
     * Page publique des signaux pour les utilisateurs abonnés
     */
    public function publicIndex(Request $request)
    {


        return view('signals.public-index', );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signals = Signal::with(['session', 'actif'])->orderBy('DateHeureEmission', 'desc')->paginate(30);
        $pendingSignals = Signal::with(['session', 'actif'])
            ->where('Resultat', 'PENDING')
            ->where('DateHeureExpire', '<=', now())
            ->orderBy('DateHeureExpire', 'asc')
            ->get();
        return view('signals.index', compact('signals', 'pendingSignals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessions = SessionSignal::all();
        $users = User::all();
        $timeframes = Timeframe::all();
        $plans = Plan::all();
        $actifs = Actif::all();
        return view('signals.create', compact('sessions', 'users', 'timeframes', 'plans', 'actifs'));
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
            'DateHeureExpire' => 'required|date|after_or_equal:DateHeureEmission',
            'DureeTrade' => 'required',
            'Actif' => 'required|exists:actifs,id',
            'timeframes' => 'nullable|array',
            'timeframes.*' => 'exists:timeframes,Nom',
            'plans' => 'nullable|array',
            'plans.*' => 'exists:plans,id',
            'PrixEntree' => 'required|numeric',
            'PrixSortieReelle' => 'nullable|numeric',
            'TakeProfit' => 'nullable|numeric',
            'StopLoss' => 'nullable|numeric',
            'Direction' => 'required|in:BUY,SELL',
            'Resultat' => 'nullable|in:WIN,LOSE,PENDING,BREAK-EVEN',
            'Pips' => 'nullable|integer',
            'Confiance' => 'nullable|integer|min:1|max:100',
            'Commentaire' => 'nullable|string',
        ]);

        $data = collect($validated)->except(['timeframes', 'plans'])->toArray();
        // Si résultat non fourni on laisse la valeur par défaut DB (PENDING)
        if (empty($data['Resultat'])) {
            unset($data['Resultat']);
        }

        DB::transaction(function () use ($validated, $data) {
            $signal = Signal::create($data);
            if (!empty($validated['timeframes'])) {
                $signal->timeframes()->sync($validated['timeframes']);
            }
            if (!empty($validated['plans'])) {
                $signal->plans()->sync($validated['plans']);
            }
        });

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
        $timeframes = Timeframe::all();
        $plans = Plan::all();
        $actifs = Actif::all();
        // Précharger relations
        $signal->load(['timeframes', 'plans']);
        return view('signals.edit', compact('signal', 'sessions', 'users', 'timeframes', 'plans', 'actifs'));
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
            'DateHeureExpire' => 'required|date|after_or_equal:DateHeureEmission',
            'DureeTrade' => 'required',
            'Actif' => 'required|exists:actifs,id',
            'timeframes' => 'nullable|array',
            'timeframes.*' => 'exists:timeframes,Nom',
            'plans' => 'nullable|array',
            'plans.*' => 'exists:plans,id',
            'PrixEntree' => 'required|numeric',
            'PrixSortieReelle' => 'nullable|numeric',
            'TakeProfit' => 'nullable|numeric',
            'StopLoss' => 'nullable|numeric',
            'Direction' => 'required|in:BUY,SELL',
            'Resultat' => 'nullable|in:WIN,LOSE,PENDING,BREAK-EVEN',
            'Pips' => 'nullable|integer',
            'Confiance' => 'nullable|integer|min:1|max:100',
            'Commentaire' => 'nullable|string',
        ]);

        $data = collect($validated)->except(['timeframes', 'plans'])->toArray();
        if (empty($data['Resultat'])) {
            unset($data['Resultat']);
        }

        DB::transaction(function () use ($signal, $validated, $data) {
            $signal->update($data);
            if (array_key_exists('timeframes', $validated)) {
                $signal->timeframes()->sync($validated['timeframes'] ?? []);
            }
            if (array_key_exists('plans', $validated)) {
                $signal->plans()->sync($validated['plans'] ?? []);
            }
        });

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

    function parametrage()
    {
        return view('signals.parametrage.index');
    }

    /**
     * Mise à jour en lot des résultats de signaux en attente.
     */
    public function bulkResultUpdate(Request $request)
    {
        $updates = $request->input('updates', []);
        if (empty($updates)) {
            return redirect()->back()->with('info', 'Aucune mise à jour.');
        }

        $count = 0;
        foreach ($updates as $id => $row) {
            $signal = Signal::find($id);
            if (!$signal)
                continue;
            if ($signal->Resultat !== 'PENDING')
                continue; // ne pas écraser déjà renseigné

            $validator = validator($row, [
                'Resultat' => 'required|in:WIN,LOSE,BREAK-EVEN',
                'PrixSortieReelle' => 'nullable|numeric',
                'Pips' => 'nullable|integer',
            ]);
            if ($validator->fails())
                continue; // ignorer lignes invalides

            $data = $validator->validated();
            // Par cohérence forcer BREAK-EVEN => Pips = 0 si non fourni
            if (($data['Resultat'] ?? '') === 'BREAK-EVEN' && empty($data['Pips'])) {
                $data['Pips'] = 0;
            }
            $signal->fill($data);
            $signal->save();
            $count++;
        }

        return redirect()->back()->with('success', "Résultats mis à jour pour $count signal(s).");
    }
}