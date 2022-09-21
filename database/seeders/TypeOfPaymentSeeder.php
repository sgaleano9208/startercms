<?php

namespace Database\Seeders;

use App\Models\TypeOfPayment;
use Illuminate\Database\Seeder;

class TypeOfPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOfPayment::factory()
            ->count(5)
            ->create();
    }
}
