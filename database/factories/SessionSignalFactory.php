<?php

namespace Database\Factories;

use App\Models\SessionSignal;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionSignalFactory extends Factory
{
    protected $model = SessionSignal::class;

    public function definition(): array
    {
        return [
            // Ajoute ici les champs nécessaires pour une session de signal
            // Exemple :
            // 'name' => $this->faker->word(),
            // 'started_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
