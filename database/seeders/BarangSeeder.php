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
            'stok_barang' => 11,
            'harga_barang' => 15000,
            'nama_barang' => 'Gula',
            'deskripsi_barang' => 'Gula 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/1.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 12,
            'harga_barang' => 15000,
            'nama_barang' => 'Gula1',
            'deskripsi_barang' => 'Gula 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/1.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 13,
            'harga_barang' => 15000,
            'nama_barang' => 'Gula2',
            'deskripsi_barang' => 'Gula 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/1.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 14,
            'harga_barang' => 15000,
            'nama_barang' => 'Gula3',
            'deskripsi_barang' => 'Gula 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/1.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 20,
            'harga_barang' => 7500,
            'nama_barang' => 'Garam',
            'deskripsi_barang' => 'Garam 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/3.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 20,
            'harga_barang' => 7500,
            'nama_barang' => 'Garam1',
            'deskripsi_barang' => 'Garam 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/3.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 20,
            'harga_barang' => 7500,
            'nama_barang' => 'Garam2',
            'deskripsi_barang' => 'Garam 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/3.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 20,
            'harga_barang' => 7500,
            'nama_barang' => 'Garam3',
            'deskripsi_barang' => 'Garam 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/3.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 20,
            'harga_barang' => 7500,
            'nama_barang' => 'Garam4',
            'deskripsi_barang' => 'Garam 1 kg',
            'nama_kategori' => 'Food',
            'gambar_barang' => 'images/products/3.jpg',
            'berat_barang' => 1000, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 30,
            'harga_barang' => 6000,
            'nama_barang' => 'Kecap1',
            'deskripsi_barang' => 'Garam 250 ml',
            'nama_kategori' => 'Drink',
            'gambar_barang' => 'images/products/2.jpg',
            'berat_barang' => 250, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 30,
            'harga_barang' => 6000,
            'nama_barang' => 'Kecap2',
            'deskripsi_barang' => 'Garam 250 ml',
            'nama_kategori' => 'Drink',
            'gambar_barang' => 'images/products/2.jpg',
            'berat_barang' => 250, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->addHour()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 30,
            'harga_barang' => 6000,
            'nama_barang' => 'Kecap3',
            'deskripsi_barang' => 'Garam 250 ml',
            'nama_kategori' => 'Drink',
            'gambar_barang' => 'images/products/2.jpg',
            'berat_barang' => 250, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->addHour()->addHour()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 30,
            'harga_barang' => 6000,
            'nama_barang' => 'Kecap4',
            'deskripsi_barang' => 'Garam 250 ml',
            'nama_kategori' => 'Cigar',
            'gambar_barang' => 'images/products/2.jpg',
            'berat_barang' => 250, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->addHour()->addHour()->addHour()->addHour()->toDateTimeString()
        ]);

        Barang::create([
            'stok_barang' => 30,
            'harga_barang' => 6000,
            'nama_barang' => 'Kecap5',
            'deskripsi_barang' => 'Garam 250 ml',
            'nama_kategori' => 'Cigar',
            'gambar_barang' => 'images/products/2.jpg',
            'berat_barang' => 250, // bisa dalam gram
            'updated_at' => \Carbon\Carbon::now()->addHour()->addHour()->addHour()->addHour()->addHour()->addHour()->toDateTimeString()
        ]);
    }
}