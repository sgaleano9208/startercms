<?php

namespace Database\Factories;

use App\Models\Proposal;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProposalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proposal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'number' => $this->faker->text(255),
            'date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'status' => 'sent',
            'observation' => $this->faker->sentence(15),
            'type_of_payment_id' => \App\Models\TypeOfPayment::factory(),
            'client_id' => \App\Models\Client::factory(),
        ];
    }
}
