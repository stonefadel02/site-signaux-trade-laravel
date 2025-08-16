<?php

namespace Database\Seeders;

use App\Models\SessionSignal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['Titre' => "Matin", "HeureDebut" => "08:00:00", "HeureFin" => "11:00:00"],
            ['Titre' => "Après-Midi", "HeureDebut" => "13:00:00", "HeureFin" => "16:00:00"],
            ['Titre' => "Soir", "HeureDebut" => "19:00:00", "HeureFin" => "22:00:00"],
        ];
        foreach ($datas as $d) {
            SessionSignal::updateOrCreate(['Titre' => $d['Titre']], $d);
        }
    }
}
