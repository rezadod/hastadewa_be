<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional extends Model
{
    use HasFactory;
    protected $table = 'optional';
    protected $fillable = [
        'nama_barang',
        'jumlah',
    ];
}
