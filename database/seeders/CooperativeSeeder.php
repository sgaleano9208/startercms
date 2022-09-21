<?php

namespace Database\Seeders;

use App\Models\Cooperative;
use Illuminate\Database\Seeder;

class CooperativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cooperative::factory()
            ->count(5)
            ->create();
    }
}
