<?php

namespace Database\Seeders;

use App\Models\Pesan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pesan::create([
            'id_pengirim_pesan' => 1,
            'id_penerima_pesan' => 2,
            'isi_pesan' => 'Testing pesan antar user (pesan pertama)',
        ]);

        Pesan::create([
            'id_pengirim_pesan' => 2,
            'id_penerima_pesan' => 1,
            'isi_pesan' => 'Testing pesan antar user (pesan pertama)',
        ]);

        Pesan::create([
            'id_pengirim_pesan' => 1,
            'id_penerima_pesan' => 2,
            'isi_pesan' => 'Testing pesan antar user (pesan kedua)',
        ]);
    }
}