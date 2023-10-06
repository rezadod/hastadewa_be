<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th> NO </th>
                    <th> ID ITEMS </th>
                    <th> NAMA PRODUK </th>
                    <th> JUMLAH </th>
                    <th> JENIS PEMBELIAN </th>
                    <th> OPERATOR </th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($data_detail as $dd)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $dd->items_id }}</td>
                    <td>{{ $dd->nama_produk }}</td>
                    <td>{{ $dd->jumlah }}</td>
                    <td>{{ $dd->jenis_pembelian }}</td>
                    <td>{{ $dd->username_op }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
