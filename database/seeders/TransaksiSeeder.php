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
            'metode_transaksi' => 'bayar',
            'total_transaksi' => 30000,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan Surabaya',
            'id_user' => 2,
            'latitude' => -7.2930927,
            'longitude' => 112.7977454,
        ]);

        Transaksi::create([
            'id_transaksi' => 2,
            'metode_transaksi' => 'bayar',
            'total_transaksi' => 45000,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan',
            'id_user' => 3,
            'latitude' => -7.2930927,
            'longitude' => 112.7977454,
        ]);

        Transaksi::create([
            'id_transaksi' => 3,
            'metode_transaksi' => 'bayar',
            'total_transaksi' => 197000,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan',
            'id_user' => 2,
            'status_transaksi' => 2,
            'latitude' => -7.2930927,
            'longitude' => 112.7977454,
        ]);

        Transaksi::create([
            'id_transaksi' => 4,
            'metode_transaksi' => 'bayar',
            'total_transaksi' => 47000,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan',
            'id_user' => 2,
            'status_transaksi' => 2,
            'latitude' => -7.2930927,
            'longitude' => 112.7977454,
        ]);

        Transaksi::create([
            'id_transaksi' => 5,
            'metode_transaksi' => 'bayar',
            'total_transaksi' => 47000,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan',
            'id_user' => 2,
            'status_transaksi' => 2,
            'latitude' => -7.2930927,
            'longitude' => 112.7977454,
        ]);

        Transaksi::create([
            'id_transaksi' => 6,
            'metode_transaksi' => 'bayar',
            'total_transaksi' => 47000,
            'alamat_dikirim' => 'Jl Praja Mukti 2 Blok 1 C Prapatan',
            'id_user' => 2,
            'status_transaksi' => 2,
            'latitude' => -7.2930927,
            'longitude' => 112.7977454,
        ]);
    }
}