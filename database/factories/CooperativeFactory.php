<?php

namespace Database\Factories;

use App\Models\Cooperative;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CooperativeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cooperative::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'rapel' => $this->faker->text(255),
        ];
    }
}
