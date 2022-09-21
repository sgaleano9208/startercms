<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariation;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVariation::factory()
            ->count(5)
            ->create();
    }
}
