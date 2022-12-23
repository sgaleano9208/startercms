<?php

namespace Database\Factories;

use App\Models\ActionPlan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActionPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'date' => $this->faker->date,
            'note' => $this->faker->text,
            'offer' => [],
            'status' => 'started',
            'client_id' => \App\Models\Client::factory(),
            'action_planable_type' => $this->faker->randomElement([
                \App\Models\Appointment::class,
                \App\Models\ClientSalesDropDetail::class,
            ]),
            'action_planable_id' => function (array $item) {
                return app($item['action_planable_type'])->factory();
            },
        ];
    }
}
