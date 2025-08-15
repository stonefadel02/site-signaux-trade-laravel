<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class SignalsTemplateExport implements WithHeadings
{

    public function headings(): array
    {
        return [
            'Session',
            'Date et heure d\'émission',
            'Date et heure d\'expiration',
            'Durée du trade',
            'Timeframe',
            'Prix d\'entrée',
            'Actif'
        ];
    }
}
