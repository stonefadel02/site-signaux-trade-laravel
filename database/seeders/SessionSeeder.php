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
            ['Titre' => "Matin", "HeureDebut" => "00:08:00", "HeureFin" => "00:11:00"],
            ['Titre' => "Après-Midi", "HeureDebut" => "00:13:00", "HeureFin" => "00:16:00"],
            ['Titre' => "Soir", "HeureDebut" => "00:19:00", "HeureFin" => "00:22:00"],
        ];
        foreach ($datas as $d) {
            SessionSignal::updateOrCreate(['Titre' => $d['Titre']], $d);
        }
    }
}
