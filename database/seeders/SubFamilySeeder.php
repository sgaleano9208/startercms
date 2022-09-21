<?php

namespace Database\Seeders;

use App\Models\SubFamily;
use Illuminate\Database\Seeder;

class SubFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubFamily::factory()
            ->count(5)
            ->create();
    }
}
