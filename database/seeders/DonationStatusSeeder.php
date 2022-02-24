<?php

namespace Database\Seeders;

use App\Models\DonationStatus;
use Illuminate\Database\Seeder;

class DonationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DonationStatus::create([
            'name' => 'Menunggu',
            'description' => 'Transaksi masih menunggu',
        ]);

        DonationStatus::create([
            'name' => 'Diproses',
            'description' => 'Transaksi masih diproses',
        ]);

        DonationStatus::create([
            'name' => 'Berhasil',
            'description' => 'Transaksi Berhasil',
        ]);

        DonationStatus::create([
            'name' => 'Dibatalkan',
            'description' => 'Transaksi Dibatalkan',
        ]);
 
    }
}
