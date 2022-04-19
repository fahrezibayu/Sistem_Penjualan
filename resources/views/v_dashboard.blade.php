@extends('app')

@section('title', 'Dashboard')

@section('content')
    @php
    function format_tanggal($tanggal)
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
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }

    @endphp

    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <span class="text-dark"><b>Ringkasan Sistem</b></span>
                        <p></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4> Data Pengguna </h4>
                                </div>
                                <div class="card-body">
                                    {{ $pengguna }}
                                    <hr />
                                    <p class="text-secondary" style="font-size: small;"> Total Pengguna </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4> Data Merk </h4>
                                </div>
                                <div class="card-body">
                                    {{ $merk }}
                                    <hr />
                                    <p class="text-secondary" style="font-size: small;"> Total Merk </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4> Data Barang </h4>
                                </div>
                                <div class="card-body">
                                    {{ $barang }}
                                    <hr />
                                    <p class="text-secondary" style="font-size: small;">Total Barang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4> Penjualan </h4>
                                </div>
                                <div class="card-body">
                                    {{ $penjualan }}
                                    <hr />
                                    <p class="text-secondary" style="font-size: small;"> Total Penjualan </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="text-dark"><b> Grafik Penjualan </b></span>
                        <p></p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card card-statistic-2">
                            <div class="card-wrap">
                                <div class="card-body">
                                    <canvas id="canvas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
