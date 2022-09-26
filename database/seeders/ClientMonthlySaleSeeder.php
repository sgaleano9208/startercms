<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientMonthlySale;

class ClientMonthlySaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientMonthlySale::factory()
            ->count(5)
            ->create();
    }
}
