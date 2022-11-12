<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'stok_barang' => 10,
            'harga_barang' => 15000,
            'nama_barang' => 'Gula',
            'deskripsi_barang' => 'Gula 1 kg',
            'nama_kategori' => 'makanan',
            'gambar_barang' => 'public/img',
            'berat_barang' => 1000, // bisa dalam gram
        ]);

        Barang::create([
            'stok_barang' => 20,
            'harga_barang' => 7500,
            'nama_barang' => 'Garam',
            'deskripsi_barang' => 'Garam 1 kg',
            'nama_kategori' => 'makanan',
            'gambar_barang' => 'public/img',
            'berat_barang' => 1000, // bisa dalam gram
        ]);

        Barang::create([
            'stok_barang' => 30,
            'harga_barang' => 7500,
            'nama_barang' => 'Kecap',
            'deskripsi_barang' => 'Garam 250 ml',
            'nama_kategori' => 'makanan',
            'gambar_barang' => 'public/img',
            'berat_barang' => 250, // bisa dalam gram
        ]);
    }
}