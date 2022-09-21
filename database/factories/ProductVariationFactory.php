<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique->name,
            'price' => $this->faker->randomFloat(2, 0, 400),
            'units' => $this->faker->randomNumber(2),
            'min_qty' => $this->faker->randomNumber(2),
            'incomplete_price' => $this->faker->randomFloat(2, 0, 400),
            'to_order' => $this->faker->boolean,
            'status' => 'active',
            'product_id' => \App\Models\Product::factory(),
            'color_id' => \App\Models\Color::factory(),
            'size_id' => \App\Models\Size::factory(),
        ];
    }
}
