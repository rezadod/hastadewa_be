<!-- @extends('layouts.master')
<style>
    table {
        text-align: center;
        position: relative;
        border-collapse: collapse;
        background-color: #f6f6f6;
    }

    /* Spacing */
    td,
    th {
        border: 1px solid #999;
        padding: 20px;
    }

    th {
        background: brown;
        color: white;
        border-radius: 0;
        position: sticky;
        top: 0;
        padding: 10px;
    }
</style>
@section('content')
<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA BARANG</th>
            <th>HARGA JUAL</th>
            <th>HARGA BELI</th>
            <th>STOK</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach($stock as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama_barang }}</td>
            <td>{{ $data->harga_jual }}</td>
            <td>{{ $data->harga_beli }}</td>
            <td>{{ $data->jumlah_stock }}</td>
            <td>
                <button>
                    UPDATE
                </button>
                <button onclick="delete('{{ $data->id }}')">
                    DELETE
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script type="text/javascript">
    function delete(id) {
        console.log(id);
    }
</script>

@endsection -->