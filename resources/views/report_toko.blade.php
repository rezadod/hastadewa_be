@extends('layouts.master')

<link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">

@section('content')

<!-- Responsive Table -->
<div class="card">
    <h5 class="card-header">Report Penjualan</h5>
    <div class="row p-2 mx-3">
        <div class="col-3">
            <div>
                <label for="tanggal_1">Tanggal 1</label>
            </div>
            <div>
                <input type="date" class="form-control" id="tanggal_1" name="tanggal_1">
            </div>
        </div>
        <div class="col-3">
            <div>
                <label for="tanggal_2">Tanggal 2</label>
            </div>
            <div>
                <input type="date" class="form-control" id="tanggal_2" name="tanggal_2">
            </div>
        </div>
        <div class="col-2">
            <div>
                <span style="color: white">-</span>
            </div>
            <div>
                <a class="btn btn-primary btn-md text-white mt-2 btn-rounded mb-4"
                    onclick="cari_data()"><i class="fas fa-search"></i></a>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th> NO </th>
                    <th> INVOICE </th>
                    <th> TANGGAL </th>
                    <th> HARGA TOTAL </th>
                    <th> ACTION </th>
                </tr>
            </thead>
            <tbody id="refresh_tampil">
                @php
                $no = 1;
                @endphp
                @foreach ($data_penjualan as $dd)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $dd->invoice }}</td>
                    <td>{{ $dd->tanggal }}</td>
                    <td>Rp {{ number_format($dd->harga_total, 0, ',', '.') }}</td>
                    <td>
                        <a onclick="detailTransaksi({{$dd->invoice}})" class="btn btn-sm btn-primary text-white"><i class="fas fa-info"></i> Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/ Responsive Table -->

{{-- modal detail tf --}}
<div class="modal fade" data-backdrop="false" id="modalDetailTransaksi" tabindex="-1" role="dialog"
    aria-labelledby="modalDetailTransaksi" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="refresh_tf">
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
<script>
    function detailTransaksi(invoice) {
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/report_penjualan_detail')}}";
        var formData = {
            '_token': token,
            'invoice': invoice
        };
        $.ajax({
            method: 'POST',
            url: my_url,
            data: formData,
            // dataType: 'json',
            success: function (resp) {
                $('#modalDetailTransaksi').modal('show')
                $('#refresh_tf').html(resp)
                // location.reload()
            },
            error: function (resp) {
                Swal.fire({
                    icon: 'error',
                    text: 'Upss ada yang error, hubungi tim IT!',
                });
            }
        });
    }

    function cari_data() {
        var tanggal_1 = $('#tanggal_1').val();
        var tanggal_2 = $('#tanggal_2').val();
        var token = '{{ csrf_token() }}';
            var my_url = "{{url('/report_penjualan_tampil')}}";
        var formData = {
            '_token': token,
            'tanggal_1': tanggal_1,
            'tanggal_2': tanggal_2
        };
        $.ajax({
            method: 'POST',
            url: my_url,
            data: formData,
            success: function (resp) {
                $('#refresh_tampil').html(resp);
            },
            error: function (resp) {
                console.log(resp);
            }
        });
    }
</script>
@endsection