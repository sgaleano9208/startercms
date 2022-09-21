<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ClientSalesDrop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientSalesDropFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientSalesDrop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            '_reported' => $this->faker->boolean,
            'client_id' => \App\Models\Client::factory(),
        ];
    }
}
