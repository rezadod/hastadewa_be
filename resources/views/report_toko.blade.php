@extends('layouts.master')

<link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">

@section('content')

<!-- Responsive Table -->
<div class="card">
    <h5 class="card-header">Responsive Table</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th> NO </th>
                    <th> NAMA TOKO </th>
                    <th> NAMA PEMILIK </th>
                    <th> ALAMAT </th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($data_toko as $dd)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $dd->nama_toko }}</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/ Responsive Table -->


<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>

@endsection