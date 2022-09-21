<?php

namespace Database\Factories;

use App\Models\DropReason;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DropReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DropReason::class;

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
