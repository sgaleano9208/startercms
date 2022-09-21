<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ClientCooperativeHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientCooperativeHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientCooperativeHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'observation' => $this->faker->sentence(15),
            'client_id' => \App\Models\Client::factory(),
            'cooperative_id' => \App\Models\Cooperative::factory(),
        ];
    }
}
