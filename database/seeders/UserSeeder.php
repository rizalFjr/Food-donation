<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'email' => 'admin@admin.com',
            'name' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $user1->assignRole('admin');

        $user2 = User::create([
            'email' => 'user@user.com',
            'name' => 'user',
            'password' => Hash::make('password'),
        ]);

        $user2->assignRole('user');
    }
}
