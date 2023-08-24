<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model

{
    protected $table = 'stock';
    use HasFactory;
    protected $fillable = [
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'jumlah_stock',
        'user_id',
    ];
}
