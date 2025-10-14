<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $datas = [
            [
                "Titre" => "Journalier",
                "Prix" => 15.0,
                "Devise" => "USD",
                "DureeEnJours" => 1,
                "NombreDeSignaux" => 30,
                "AutresAvantages" => '["Accès immédiat après paiement", "Code unique valable 24h"]'
            ],
            [
                "Titre" => "Hebdomadaire",
                "Prix" => 84,
                "Devise" => "USD",
                "DureeEnJours" => 7,
                "NombreDeSignaux" => 210,
                "isPopular" => true,
                "AutresAvantages" => '["Accès illimité pendant 7 jours", "Support prioritaire"]'
            ],
            [
                "Titre" => "Mensuel",
                "Prix" => 315.0,
                "Devise" => "USD",
                "DureeEnJours" => 30,
                "NombreDeSignaux" => 900,
                "AutresAvantages" => '["Accès illimité + historique des signaux", "Statistiques de performance incluses"]'
            ],
        ];
        foreach ($datas as $d) {
            \App\Models\Plan::updateOrCreate(
                ['Titre' => $d['Titre']],
                $d
            );
        }
    }
}
