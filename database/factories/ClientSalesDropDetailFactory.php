<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ClientSalesDropDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientSalesDropDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientSalesDropDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 'pending',
            'comments' => [],
            'drop_reason_id' => \App\Models\DropReason::factory(),
            'competitor_id' => \App\Models\Competitor::factory(),
            'user_id' => \App\Models\User::factory(),
            'family_id' => \App\Models\Family::factory(),
            'client_sales_drop_id' => \App\Models\ClientSalesDrop::factory(),
        ];
    }
}
