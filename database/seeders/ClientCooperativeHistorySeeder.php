<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientCooperativeHistory;

class ClientCooperativeHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientCooperativeHistory::factory()
            ->count(5)
            ->create();
    }
}
