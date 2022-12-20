<?php

namespace Database\Seeders;

use App\Models\ActionPlan;
use Illuminate\Database\Seeder;

class ActionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActionPlan::factory()
            ->count(5)
            ->create();
    }
}
