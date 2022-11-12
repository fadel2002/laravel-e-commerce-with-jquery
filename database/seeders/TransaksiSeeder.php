<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaksi::create([
            'id_transaksi' => 1,
            'metode_transaksi' => 'bayar ditempat',
            'total_transaksi' => 15000,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan',
            'id_user' => 2,
        ]);

        Transaksi::create([
            'id_transaksi' => 2,
            'metode_transaksi' => 'bayar ditempat',
            'total_transaksi' => 21000,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan Surabaya',
            'id_user' => 2,
        ]);

        Transaksi::create([
            'id_transaksi' => 3,
            'metode_transaksi' => 'bayar ditempat',
            'total_transaksi' => 28500,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan',
            'id_user' => 3,
        ]);
    }
}