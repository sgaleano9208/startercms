<?php

namespace Database\Seeders;

use App\Models\ProposalItem;
use Illuminate\Database\Seeder;

class ProposalItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProposalItem::factory()
            ->count(5)
            ->create();
    }
}
