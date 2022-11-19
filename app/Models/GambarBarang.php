<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarBarang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_gambar_barang';
    
    protected $fillable = [
        'id_barang',
        'gambar_barang',
    ];

    public function barang(){
        return $this->belongsTo(Barang::class);
    } 
}