<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    use HasFactory;
    protected $fillable = [
        'nama_pelayan',
        'produk_items_id',
        'opsional_items_id',
        'total',
    ];
}
