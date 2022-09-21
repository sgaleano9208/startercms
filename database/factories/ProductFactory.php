<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'ref' => $this->faker->unique->text(7),
            'description' => $this->faker->sentence(15),
            'certificate' => $this->faker->text(255),
            'technical_sheet' => $this->faker->text(255),
            'type' => 'own',
            'family_id' => \App\Models\Family::factory(),
            'sub_family_id' => \App\Models\SubFamily::factory(),
            'brand_id' => \App\Models\Brand::factory(),
        ];
    }
}
