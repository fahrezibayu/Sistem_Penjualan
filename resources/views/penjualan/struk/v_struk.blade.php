<!DOCTYPE html>
<html lang="en">
<style type="text/css" media="print">
    @page {
        size: auto;
        margin: 0mm;
    }

    .fontstyle {
        font-size: 11px;
        font-family: 'Consolas';

    }

    .judul {
        font-size: 10pt;
    }

    .footer {
        font-size: 11pt;
    }

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Struck</title>

</head>

<body>

    @php
        date_default_timezone_set('Asia/Jakarta');
        function tgl_indo($tanggal)
        {
            $bulan = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
            ];
            $tanggalan = explode('-', $tanggal);
            return $tanggalan[2] . ' ' . $bulan[(int) $tanggalan[1]] . ' ' . $tanggalan[0];
        }
        $profile = \App\Models\ProfileApp::all()->first();
    @endphp

    <center>
        <div class="judul">
            {{ $profile->nama_aplikasi }} <br />
        </div>
    </center>
    <br />

    <table align="center">
        <tr>
            <td width="20%"> Kode Penjualan </td>
            <td>:</td>
            <td> {{ $id_penjualan }} </td>
            <td align="right"> {{ tgl_indo($penjualan->tgl_penjualan) }} </td>
        </tr>
    </table>

    <hr style="width:50%">

    <table align="center" width="47%">
        @php
            $no = 0;
        @endphp
        @foreach ($detail_penjualan as $row)
            @php
                $totalhargabarang = $row->qty * $row->harga_barang;
                $no++;
                $barang = DB::table('tbl_barang')->where("id_barang",$row->id_barang)->first();
            @endphp
        <tr align="left">
            <td style="padding-left:3%;" width="40%" align="left">{{ $barang->nama_barang }}</td>
            <td> {{ $row->qty }} </td>
            <td width="20%" align="center"> X </td>
            <td>Rp</td>
            <td width="30%" align="right"> {{ number_format($row->harga_barang, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <hr style="width:50%">

    <table align="center">
        <tr>
            <td width="40%"></td>
            <td>Sub Total </td>
            <td>: Rp</td>
            <td align="right"> {{ number_format($penjualan->total, 0, ',', '.') }}</td>
        </tr>

        <tr>
            <td width="41%"></td>
            <td>Grand Total</td>
            <td>: Rp</td>
            <td width="30%" align="right">{{ number_format($penjualan->total, 0, ',', '.') }}</td>
        </tr>

        <tr>
            <td width="40%"></td>
            <td>
                Bayar
            <td>: Rp</td>
            <td align="right">{{ number_format($penjualan->bayar, 0, ',', '.') }}</td>
        </tr>

        <tr>
            <td width="40%"></td>
            <td>Kembalian</td>
            <td>: Rp</td>
            <td align="right"> {{ number_format(abs($penjualan->kembalian), 0, ',', '.') }}</td>
        </tr>

    </table>
    <br />

    <center>
        Terimakasih atas kunjungan anda<br />
    </center>

</body>

</html>

<?php
echo "<script>
window.print();
</script>";
?>
<script type="text/javascript">
    window.onafterprint = window.close;
    setTimeout(
        function() {
            window.location = "{{ url('/penjualan/pos') }}"
        },
        1000);
</script>
