<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Signal;
use App\Models\SessionSignal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class SignalsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $session = SessionSignal::firstOrCreate(
            ['Titre' => $row['session']],
            ['HeureDebut' => '00:00:00', 'HeureFin' => '00:00:00']
        );

        return new Signal([
            'user_id'          => Auth::id(),
            'session_id'       => $session->id,
            'DateHeureEmission'=> is_numeric($row['date_et_heure_demission'])
                ? Carbon::instance(ExcelDate::excelToDateTimeObject($row['date_et_heure_demission']))
                : Carbon::createFromFormat('d/m/Y H:i:s', $row['date_et_heure_demission']),
            'DateHeureExpire'=> is_numeric($row['date_et_heure_dexpiration'])
                ? Carbon::instance(ExcelDate::excelToDateTimeObject($row['date_et_heure_dexpiration']))
                : Carbon::createFromFormat('d/m/Y H:i:s', $row['date_et_heure_dexpiration']),
            'DureeTrade'       => is_numeric($row['duree_du_trade'])
                ? Carbon::instance(ExcelDate::excelToDateTimeObject($row['duree_du_trade']))->format('H:i:s')
                : $row['duree_du_trade'],
            'Timeframe'        => $row['timeframe'],
            'PrixEntree'       => $row['prix_dentree'],
            'Actifs'           => $row['actif'],
        ]);
    }
}
