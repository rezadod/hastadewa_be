@extends('layouts.master')
@section('content')

<form action="{{ ('tambah_stok') }}" method="POST">
    @csrf
    <label for="nama_barang">Nama Barang</label>
    <input id="nama_barang" type="text" name="nama_barang">
    <label for="harga_beli">Harga Beli</label>
    <input type="number" name="harga_beli">
    <label for="harga_jual">Harga Jual</label>
    <input type="number" name="harga_jual">
    <label for="jumlah_stok">Jumlah Stok</label>
    <input type="number" name="jumlah_stok">
    <div>
        <button type="submit">Add Stock</button>
    </div>
</form>

@endsection