<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeframeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ["Nom" => "M1", "Description" => "1 minute, pour scalping ultra court"],
            ["Nom" => "M2", "Description" => "2 minutes, scalping court, plus fluide que M1"],
            ["Nom" => "M3", "Description" => "3 minutes, scalping et micro-intraday"],
            ["Nom" => "M5", "Description" => "5 minutes, scalping court et intraday"],
            ["Nom" => "M10", "Description" => "10 minutes, intraday et petite analyse"],
            ["Nom" => "M15", "Description" => "15 minutes, intraday standard"],
            ["Nom" => "M30", "Description" => "30 minutes, intraday et swing court"],
            ["Nom" => "H1", "Description" => "1 heure, swing court et intraday"],
            ["Nom" => "H2", "Description" => "2 heures, swing trading intermédiaire"],
            ["Nom" => "H4", "Description" => "4 heures, swing trading standard"],
            ["Nom" => "H8", "Description" => "8 heures, swing trading et tendances intermédiaires"],
            ["Nom" => "D1", "Description" => "1 jour, analyse quotidienne et swing trading long"],
            ["Nom" => "W1", "Description" => "1 semaine, position trading et tendances longues"],
            ["Nom" => "MN", "Description" => "1 mois, position trading longue durée et analyse macro"]
        ];


        foreach ($datas as $data) {
            \App\Models\Timeframe::updateOrCreate(
                ['Nom' => $data['Nom']],
                ['Description' => $data['Description']]
            );
        }

    }
}
