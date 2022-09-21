<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PromotionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PromotionItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'promo_price' => $this->faker->randomNumber(1),
            'discount' => $this->faker->randomFloat(2, 0, 9999),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'current_sales' => $this->faker->randomNumber(0),
            'past_sales' => $this->faker->randomNumber(0),
            'is_selected' => $this->faker->boolean,
            'product_variation_id' => \App\Models\ProductVariation::factory(),
            'promotion_id' => \App\Models\Promotion::factory(),
        ];
    }
}
