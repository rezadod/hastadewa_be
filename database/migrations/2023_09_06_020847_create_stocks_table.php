<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->integer('harga_beli');
            $table->integer('kuantiti');
            $table->integer('isi_per_pack');
            $table->integer('harga_per_pcs');
            $table->integer('harga_per_pack');
            $table->integer('toko_id');
            $table->integer('username_input');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
    }
};
