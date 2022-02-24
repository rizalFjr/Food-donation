<?php

namespace Database\Seeders;

use App\Models\Quantity;
use Illuminate\Database\Seeder;

class QuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quantity::create([
            'name' => 'pcs',
            'description' => 'Pieces',
        ]);

        Quantity::create([
            'name' => 'kg',
            'description' => 'Kilogram',
        ]);

        Quantity::create([
            'name' => 'gr',
            'description' => 'Gram',
        ]);

        Quantity::create([
            'name' => 'box',
            'description' => 'Box',
        ]);
    }
}
