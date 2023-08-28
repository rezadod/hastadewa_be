<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPembelian extends Model
{
    use HasFactory;
    protected $table = 'jenis_pembelian';
    protected $fillable = [
        'deskripsi',
    ];
}
