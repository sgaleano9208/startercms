<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Country;
use App\Models\SalesPerson;
use App\Models\State;
use App\Models\Typology;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->unique->phoneNumber,
            'email' => $this->faker->unique->email,
            'vat' => $this->faker->unique->text(11),
            'no_nav' => $this->faker->unique->text(11),
            'discount' => $this->faker->randomFloat(2, 0, 9999),
            'observation' => $this->faker->sentence(15),
            'type' => 'member',
            'status' => 'active',
            'country_id' => Country::inRandomOrder()->first(),
            'state_id' => State::inRandomOrder()->first(),
            'typology_id' => Typology::inRandomOrder()->first(),
            'sales_person_id' => SalesPerson::inRandomOrder()->first(),
        ];
    }
}
