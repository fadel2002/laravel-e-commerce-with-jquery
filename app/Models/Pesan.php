<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pesan';
    
    protected $fillable = [
        'id_pengirim_pesan',
        'id_penerima_pesan',
        'isi_pesan',
    ];
}