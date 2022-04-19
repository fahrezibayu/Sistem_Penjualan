@extends('app')

@section('title', 'Laporan Penjualan')

@section('content')
    <section class="section">

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/penjualan/laporan/search') }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-12 col-md-12 col-lg-12">
                                <h2 class="section-title"> @yield('title') </h2>
                            </div>

                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label> Tanggal </label>
                                    <input type="text" name="date1" id="date1" class="form-control datepicker">
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label> Tanggal </label>
                                    <input type="text" name="date2" id="date2" class="form-control datepicker">
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <button type="submit" name="search" class="btn btn-primary btn-block"> <i
                                            class="fa fa-search"></i> Search </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card-body">
                        <table id="table_id" class="table table-hover table-bordered table-md nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Kode Transaksi </th>
                                    <th> Tanggal Transaksi </th>
                                    <th> Kasir </th>
                                    <th> Total </th>
                                    <th> Bayar </th>
                                    <th> Kembalian </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
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
                                @endphp
                                @foreach ($penjualan as $row)
                                    @php
                                        $no++;
                                    @endphp
                                    <tr>
                                        <td> {{ $no }} </td>
                                        <td> {{ $row->id_penjualan }} </td>
                                        <td> {{ tgl_indo($row->tgl_penjualan) }} </td>
                                        <td> {{ $row->tb_user->name }} </td>
                                        <td> Rp. {{ number_format($row->total, '0', ',', '.') }} </td>
                                        <td> Rp. {{ number_format($row->bayar, '0', ',', '.') }} </td>
                                        <td> Rp. {{ number_format(abs($row->kembalian), '0', ',', '.') }} </td>
                                        <td>
                                            <button
                                                type="button" class="btn btn-icon btn-info btn-sm" onclick="detail_laporan('{{ $row->id_penjualan }}')">
                                                <i class="fas fa-search"></i>
                                                </button>
                                            <a href="{{ url('/penjualan/laporan/print', $row->id_penjualan) }}" <button
                                                type="button" class="btn btn-success btn-sm">
                                                <i class="fas fa-print"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="modal fade" role="dialog" id="DetailLap">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"> Detail Transaksi <span class="title_transaksi"></span> </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="data_detail_lap"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
