<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';
    use HasFactory;
    protected $fillable = [
        'nama_produk',
        'harga_beli',
        'kuantiti',
        'isi_per_pack',
        'harga_per_pcs',
        'harga_per_pack',
        'user_name_input,'
    ];
}
