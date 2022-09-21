<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProposalItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProposalItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProposalItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'discount' => $this->faker->randomFloat(2, 0, 9999),
            'discount2' => $this->faker->randomNumber(1),
            'quantity' => $this->faker->randomNumber,
            'net_price' => $this->faker->randomNumber(1),
            'total' => $this->faker->randomFloat(2, 0, 9999),
            'proposal_id' => \App\Models\Proposal::factory(),
            'product_variation_id' => \App\Models\ProductVariation::factory(),
        ];
    }
}
