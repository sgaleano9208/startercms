<?php

namespace Database\Seeders;

use App\Models\Typology;
use Illuminate\Database\Seeder;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typology::factory()
            ->count(5)
            ->create();
    }
}
