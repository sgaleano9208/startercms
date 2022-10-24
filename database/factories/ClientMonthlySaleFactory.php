<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ClientMonthlySale;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientMonthlySaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientMonthlySale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'client_no_nav' => \App\Models\Client::factory(),
            'cooperative_cod' => \App\Models\Cooperative::factory(),
        ];
    }
}
