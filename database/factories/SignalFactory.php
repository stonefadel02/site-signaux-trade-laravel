<?php

namespace Database\Factories;

use App\Models\Signal;
use App\Models\User;
use App\Models\SessionSignal;
use Illuminate\Database\Eloquent\Factories\Factory;

class SignalFactory extends Factory
{
    protected $model = Signal::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'session_id' => random_int(1, 3), // Assuming session_id is an integer, adjust as necessary
            'DateHeureEmission' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'DateHeureExpire' => $this->faker->dateTimeBetween('now', '+1 month'),
            'DureeTrade' => $this->faker->time('H:i:s'),
            'Actifs' => $this->faker->randomElement(['EURUSD', 'GBPUSD', 'USDJPY', 'BTCUSD']),
            'TypeMarche' => $this->faker->randomElement(['Forex', 'Crypto', 'Stocks']),
            'Timeframe' => $this->faker->randomElement(['M1', 'M5', 'M15', 'H1', 'H4', 'D1']),
            'PrixEntree' => $this->faker->randomFloat(4, 1, 2),
            'PrixSortieReelle' => $this->faker->optional()->randomFloat(4, 1, 2),
            'TakeProfit' => $this->faker->optional()->randomFloat(4, 1, 2),
            'StopLoss' => $this->faker->optional()->randomFloat(4, 1, 2),
            'Direction' => $this->faker->randomElement(['BUY', 'SELL']),
            'Resultat' => $this->faker->randomElement(['WIN', 'LOSE', 'PENDING', 'BREAK-EVEN']),
            'Pips' => $this->faker->optional()->numberBetween(-100, 100),
            'Confiance' => $this->faker->optional()->numberBetween(1, 100),
            'Commentaire' => $this->faker->optional()->sentence(),
            'Status' => $this->faker->randomElement(['EN COURS', 'EN ATTENTE', 'TERMINE', 'ANNULE']),
        ];
    }
}
