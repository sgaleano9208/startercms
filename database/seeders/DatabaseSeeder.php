<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

            $this->call(BrandSeeder::class);
            $this->call(ClientCooperativeHistorySeeder::class);
            $this->call(ClientMonthlySaleSeeder::class);
            $this->call(ClientSalesDropSeeder::class);
            $this->call(ClientSalesDropDetailSeeder::class);
            $this->call(ColorSeeder::class);
            $this->call(CompetitorSeeder::class);
            $this->call(ContactSeeder::class);
            $this->call(CooperativeSeeder::class);
            $this->call(CountrySeeder::class);
            $this->call(DropReasonSeeder::class);
            $this->call(FamilySeeder::class);
            $this->call(ProductSeeder::class);
            $this->call(ProductVariationSeeder::class);
            $this->call(PromotionSeeder::class);
            $this->call(PromotionItemSeeder::class);
            $this->call(ProposalSeeder::class);
            $this->call(ProposalItemSeeder::class);
            $this->call(SalesPersonSeeder::class);
            $this->call(SizeSeeder::class);
            $this->call(StateSeeder::class);
            $this->call(SubFamilySeeder::class);
            $this->call(TypeOfPaymentSeeder::class);
            $this->call(TypologySeeder::class);
            $this->call(UserSeeder::class);
            $this->call(ClientSeeder::class);
    }
}
