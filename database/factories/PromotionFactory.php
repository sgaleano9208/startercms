<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'first_order_date' => $this->faker->date,
            'observation' => $this->faker->sentence(15),
            'status' => 'active',
            'client_id' => \App\Models\Client::factory(),
        ];
    }
}
