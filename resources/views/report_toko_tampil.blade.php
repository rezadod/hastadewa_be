
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