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
        'harga_grosir',
        'harga_ecer',
        'satuan_grosir',
        'satuan_ecer',
        'toko_id',
        'user_name_input',
    ];
}
