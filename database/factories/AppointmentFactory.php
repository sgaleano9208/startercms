<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'goals' => $this->faker->text(255),
            'note' => $this->faker->text,
            'status' => 'pending',
            'zone_appointment_id' => \App\Models\ZoneAppointment::factory(),
            'client_id' => \App\Models\Client::factory(),
        ];
    }
}
