<table id="table_detail" class=" table table-md table-bordered table-striped nowrap" style="width:100%">
    <thead>
        <tr>
            <th> No </th>
            <th> Nama Barang </th>
            <th> Qty </th>
            <th> Harga Barang </th>
            <th> Total </th>
        </tr>
    </thead>
    <tbody id="data_temp">
        @php
            $no = 0;
            $total = 0;
        @endphp
        @foreach ($penjualan as $d)
            @php
                $no++;
                $barang = DB::table('tbl_barang')
                    ->where('id_barang', $d->id_barang)
                    ->first();
                    $total+= $d->qty * $d->harga_barang;
            @endphp
            <tr>
                <td> {{ $no }} </td>
                <td> {{ $barang->nama_barang }} </td>
                <td> {{ $d->qty }} </td>
                <td> Rp. {{ number_format($d->harga_barang, '0', ',', '.') }} </td>
                <td> Rp. {{ number_format($d->qty * $d->harga_barang, '0', ',', '.') }} </td>
            </tr>
        @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td> GrandTotal </td>
                <td> Rp. {{ number_format($total,'0',',','.') }} </td>
            </tr>
    </tbody>
</table>

<script>
    $("#table_detail").DataTable({
        scrollX: true,
        scrollY: 100,
        "paging":   true,
        "ordering": false,
        "info":     true
    });
</script>
