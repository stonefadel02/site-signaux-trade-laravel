<?php

namespace App\Exports;

use App\Models\Signal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SignalsExport implements FromCollection, WithHeadings
{
    /**
     * Retourne tous les signaux à exporter
     */
    public function collection()
    {
        return Signal::with(['user', 'session'])->get()->map(function($signal) {
            return [
                'User' => $signal->user ? $signal->user->name : null,
                'Session' => $signal->session ? $signal->session->Titre : null,
                'DateHeureEmission' => $signal->DateHeureEmission,
                'DateHeureExpire' => $signal->DateHeureExpire,
                'DureeTrade' => $signal->DureeTrade ? \Carbon\Carbon::parse($signal->DureeTrade)->format('H:i:s') : null,
                'Timeframe' => $signal->Timeframe,
                'PrixEntree' => $signal->PrixEntree,
                'Actifs' => $signal->Actifs,
                'Direction' => $signal->Direction,
                'Resultat' => $signal->Resultat,
                'Status' => $signal->Status,
            ];
        });
    }

    /**
     * Définir les en-têtes du fichier Excel
     */
    public function headings(): array
    {
        return [
            'User',
            'Session',
            'Date et heure d\'émission',
            'Date et heure d\'expiration',
            'Durée du trade',
            'Timeframe',
            'Prix d\'entrée',
            'Actif',
            'Direction',
            'Résultat',
            'Status'
        ];
    }
}
