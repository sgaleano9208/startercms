<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientSalesDropDetail;

class ClientSalesDropDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientSalesDropDetail::factory()
            ->count(5)
            ->create();
    }
}
