<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            // Forex
            ["TypeMarche" => "Forex", "Symbole" => "EUR/USD", "Nom" => "Euro / Dollar US"],
            ["TypeMarche" => "Forex", "Symbole" => "GBP/USD", "Nom" => "Livre Sterling / Dollar US"],
            ["TypeMarche" => "Forex", "Symbole" => "USD/JPY", "Nom" => "Dollar US / Yen Japonais"],
            ["TypeMarche" => "Forex", "Symbole" => "AUD/USD", "Nom" => "Dollar Australien / Dollar US"],

            // Actions
            ["TypeMarche" => "Actions", "Symbole" => "AAPL", "Nom" => "Apple Inc."],
            ["TypeMarche" => "Actions", "Symbole" => "MSFT", "Nom" => "Microsoft Corporation"],
            ["TypeMarche" => "Actions", "Symbole" => "TSLA", "Nom" => "Tesla Inc."],

            // Indices
            ["TypeMarche" => "Indices", "Symbole" => "SPX500", "Nom" => "S&P 500"],
            ["TypeMarche" => "Indices", "Symbole" => "DJI", "Nom" => "Dow Jones Industrial Average"],
            ["TypeMarche" => "Indices", "Symbole" => "DAX", "Nom" => "DAX 30"],

            // Matières premières
            ["TypeMarche" => "Matières premières", "Symbole" => "XAU/USD", "Nom" => "Or / Dollar US"],
            ["TypeMarche" => "Matières premières", "Symbole" => "XAG/USD", "Nom" => "Argent / Dollar US"],
            ["TypeMarche" => "Matières premières", "Symbole" => "WTI", "Nom" => "Pétrole WTI"],
            ["TypeMarche" => "Matières premières", "Symbole" => "BRENT", "Nom" => "Pétrole Brent"],

            // Cryptomonnaies
            ["TypeMarche" => "Cryptomonnaies", "Symbole" => "BTC/USD", "Nom" => "Bitcoin / Dollar US"],
            ["TypeMarche" => "Cryptomonnaies", "Symbole" => "ETH/USD", "Nom" => "Ethereum / Dollar US"],
            ["TypeMarche" => "Cryptomonnaies", "Symbole" => "BNB/USD", "Nom" => "Binance Coin / Dollar US"],

            // Obligations
            ["TypeMarche" => "Obligations", "Symbole" => "US10Y", "Nom" => "Bon du Trésor US 10 ans"],
            ["TypeMarche" => "Obligations", "Symbole" => "GER10Y", "Nom" => "Obligation Allemande 10 ans"],

            // ETF
            ["TypeMarche" => "ETF", "Symbole" => "SPY", "Nom" => "SPDR S&P 500 ETF Trust"],
            ["TypeMarche" => "ETF", "Symbole" => "QQQ", "Nom" => "Invesco QQQ Trust"],

            // CFD (exemple sur actions et indices)
            ["TypeMarche" => "CFD", "Symbole" => "AAPL_CFD", "Nom" => "Apple Inc. (CFD)"],
            ["TypeMarche" => "CFD", "Symbole" => "SPX500_CFD", "Nom" => "S&P 500 (CFD)"]
        ];
        foreach ($datas as $data) {
            \App\Models\Actif::updateOrCreate(
                ['Symbole' => $data['Symbole']],
                [
                    'Nom' => $data['Nom'],
                    'TypeMarche' => $data['TypeMarche']
                ]
            );
        }
    }
}
