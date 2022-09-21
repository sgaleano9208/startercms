<?php

namespace Database\Seeders;

use App\Models\PromotionItem;
use Illuminate\Database\Seeder;

class PromotionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PromotionItem::factory()
            ->count(5)
            ->create();
    }
}
