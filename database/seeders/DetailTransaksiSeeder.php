<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailTransaksi::create([
            'id_transaksi' => 1,
            'id_barang' => 1,
            'kuantitas_barang' => 1,
        ]);

        DetailTransaksi::create([
            'id_transaksi' => 1,
            'id_barang' => 3,
            'kuantitas_barang' => 1,
        ]);

        DetailTransaksi::create([
            'id_transaksi' => 2,
            'id_barang' => 1,
            'kuantitas_barang' => 1,
        ]);

        DetailTransaksi::create([
            'id_transaksi' => 2,
            'id_barang' => 2,
            'kuantitas_barang' => 1,
        ]);

        DetailTransaksi::create([
            'id_transaksi' => 2,
            'id_barang' => 3,
            'kuantitas_barang' => 1,
        ]);
    }
}