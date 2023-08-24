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
        'alamat',
    ];
}
