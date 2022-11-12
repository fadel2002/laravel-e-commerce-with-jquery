<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nama_user' => 'admin',
            'email' => 'admin@gmail.com',
            'tipe_user' => '2',
            'password' => Hash::make("11111111"),
            'no_telp_user' => '082232319484',
        ]);
        $user = User::create([
            'nama_user' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make("11111111"),
            'no_telp_user' => '082232319485',
        ]);
        $user = User::create([
            'nama_user' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make("11111111"),
            'no_telp_user' => '082232319486',
        ]);
    }
}