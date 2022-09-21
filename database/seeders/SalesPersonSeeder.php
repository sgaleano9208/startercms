<?php

namespace Database\Seeders;

use App\Models\SalesPerson;
use Illuminate\Database\Seeder;

class SalesPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesPerson::factory()
            ->count(5)
            ->create();
    }
}
