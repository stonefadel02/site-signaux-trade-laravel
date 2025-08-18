<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Flutterwave\Facades\Flutterwave; //
class PaiementController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
public function download($id, $format = 'a4')
    {
        // Récupérer le paiement avec relations utiles.
        // On charge aussi le plan de la souscription pour éviter l'erreur "N/A"
        $paiement = Paiement::with('user', 'souscription.plan')->findOrFail($id);

        // dd($paiement->user, $paiement->souscription, $paiement->souscription->plan); // Supprimez ou commentez cette ligne

        $data = compact('paiement');

        $pdf = Pdf::loadView('factures.template', $data)
            ->setPaper($format, 'portrait')
            ->setWarnings(false);

        // nom de fichier dynamique
        $filename = 'factures.template' . $paiement->id . '-' . strtoupper($format) . '.pdf';

        return $pdf->stream($filename);
    }
}


