<?php

namespace Database\Seeders;

use App\Models\TypeMarch;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeMarcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ["Nom" => "Forex", "Description" => "Marché des devises, trading de paires comme EUR/USD, GBP/JPY, très liquide et actif 24h/24"],
            ["Nom" => "Actions", "Description" => "Marché des actions de sociétés cotées en bourse, volatilité variable selon les titres"],
            ["Nom" => "Indices", "Description" => "Regroupement d’actions représentant un marché ou un secteur (ex : S&P500, CAC40)"],
            ["Nom" => "Matières premières", "Description" => "Trading de matières premières comme l’or, le pétrole, le blé, souvent influencé par l’économie et la géopolitique"],
            ["Nom" => "Cryptomonnaies", "Description" => "Trading de crypto-actifs comme Bitcoin, Ethereum, actif 24/7 et très volatil"],
            ["Nom" => "Obligations", "Description" => "Titres de dette émis par des gouvernements ou entreprises, généralement moins risqués et moins volatils"],
            ["Nom" => "Futures", "Description" => "Contrats standardisés pour acheter ou vendre un actif à une date future, utilisés pour spéculation ou couverture"],
            ["Nom" => "Options", "Description" => "Contrats donnant le droit d’acheter ou de vendre un actif à un prix fixé, utilisés pour spéculation ou couverture"],
            ["Nom" => "ETF", "Description" => "Fonds indiciels cotés, permettant de trader un panier d’actifs en une seule transaction"],
            ["Nom" => "CFD", "Description" => "Contrats sur différence, permettent de spéculer sur le prix d’un actif sans posséder l’actif lui-même"]
        ];
        foreach ($datas as $data) {
            TypeMarch::updateOrCreate(
                ['Nom' => $data['Nom']],
                ['Description' => $data['Description']]
            );
        }
    }
}
