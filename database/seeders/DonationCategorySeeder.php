<?php

namespace Database\Seeders;

use App\Models\DonationCategory;
use Illuminate\Database\Seeder;

class DonationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DonationCategory::create([
            'name' => 'Bahan Pokok',
            'description' => 'Donasi berupa bahan-bahan pokok',
        ]);
    }
}
