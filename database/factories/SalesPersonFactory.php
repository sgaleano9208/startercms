<?php

namespace Database\Factories;

use App\Models\SalesPerson;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesPersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesPerson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique->email,
            'phone' => $this->faker->unique->phoneNumber,
            'cod' => $this->faker->text(255),
            'photo' => $this->faker->imageUrl(640, 480, 'animals', true),
            'commercial_id' => \App\Models\User::factory(),
            'sales_manager_id' => \App\Models\User::factory(),
        ];
    }
}
