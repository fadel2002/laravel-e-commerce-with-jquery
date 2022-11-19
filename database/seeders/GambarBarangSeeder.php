<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GambarBarang;

class GambarBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<5; $i++){
            GambarBarang::create([
                'id_barang' => 1,
                'gambar_barang' => 'images/products/' . $i%3+1 . '.jpg',
            ]);
        }
    }
}