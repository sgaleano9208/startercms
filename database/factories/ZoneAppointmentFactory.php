<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ZoneAppointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneAppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ZoneAppointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'status' => 'pending',
            'sales_person_id' => \App\Models\SalesPerson::factory(),
        ];
    }
}
