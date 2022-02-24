<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Terms;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Terms::create([
            'isi' => '<p>Syarat dan ketentuan<br></p>',
        ]);

    }
}
