<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';
    use HasFactory;
    protected $fillable = [
        'nama_toko',
        'nama_pemilik_toko',
        'status_toko',
        'jenis_usaha',
        'alamat',
    ];
}
