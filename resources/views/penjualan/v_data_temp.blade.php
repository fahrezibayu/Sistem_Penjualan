<table id="table_temp" class=" table table-md table-bordered table-striped nowrap">
    <thead>
        <tr>
            <th> No </th>
            <th> Nama Barang </th>
            <th> Qty </th>
            <th> Harga Barang </th>
            <th> Total </th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody id="data_temp">
        @php
            $no = 0;
            $total = 0;
        @endphp
        @foreach ($sql as $d)
            @php
                $no++;
                $barang = DB::table('tbl_barang')
                    ->where('id_barang', $d->id_barang)
                    ->first();
                    $total+= $d->qty * $barang->harga_barang;
            @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td data-name="qty" class="qty" data-type="number" data-pk="{{ $d->id }}">
                    <a href="#"> <u> {{ $d->qty }} </u></a>
                </td>
                <td>Rp. {{ number_format($barang->harga_barang, '0', ',', '.') }}</td>
                <td>Rp. {{ number_format($d->qty * $barang->harga_barang, '0', ',', '.') }}</td>
                <td>
                    <a href="{{ url('/penjualan/delete_temp', $d->id) }}"
                        <button type="button" class="btn btn-icon btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td> GrandTotal </td>
                <td> Rp. {{ number_format($total,'0',',','.') }} </td>
                <td></td>
            </tr>
    </tbody>
</table>

<script>
    // todo edit qty temp
    $.fn.editable.defaults.mode = "inline";
    $("#data_temp").editable({
        container: "tbody",
        selector: "td.qty",
        url: "update_temp",
        title: "Edit Qty",
        type: "POST",
        dataType: "json",
        validate: function(value) {
            if ($.trim(value) == "") {
                return "This field is required";
            }
        },
        success: function(result) {
            window.location.reload();
        },
    });
    $("#table_temp").DataTable({
        scrollX: true,
        scrollY: 100,
        "paging":   false,
        "ordering": false,
        "info":     false
    });
</script>
