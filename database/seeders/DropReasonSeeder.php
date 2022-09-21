<?php

namespace Database\Seeders;

use App\Models\DropReason;
use Illuminate\Database\Seeder;

class DropReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DropReason::factory()
            ->count(5)
            ->create();
    }
}
