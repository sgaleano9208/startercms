<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientSalesDrop;

class ClientSalesDropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientSalesDrop::factory()
            ->count(5)
            ->create();
    }
}
