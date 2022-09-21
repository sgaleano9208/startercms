<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TypeOfPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeOfPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TypeOfPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
