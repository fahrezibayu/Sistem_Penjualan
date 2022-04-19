@extends('app')

@section('title', ' Pos Kasir ')

@section('content')
    <section class="section">

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <h2 class="section-title"> Data Barang </h2>
                        <div class="card-body">
                            <form action="{{ url('penjualan/save_temp') }}" method="post">
                                @csrf
                            <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label> Nama Barang </label>
                                            <select name="id_barang" required id="id_barang" class="form-control select2">
                                                <option value=""> Silahkan pilih barang </option>
                                                @foreach ($barang as $row)
                                                    <option value="{{ $row->id_barang }}"> {{ $row->id_barang }} - {{ $row->nama_barang }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label> Qty </label>
                                            <input type="number" required name="qty" id="qty" class="form-control" min="0">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-plus"></i> Tambah Keranjang </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <h2 class="section-title"> @yield('title') </h2>
                        <div class="card-body">
                            <h6> Data Keranjang <i class="fa fa-shopping-bag"></i> </h6>
                            <div class="data_temp"></div> <br>
                            <h6> Pembayaran <i class="fa fa-money-check"></i> </h6>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label> Kode Penjualan </label>
                                        <input type="text" name="id_penjualan" id="id_penjualan" readonly class="form-control" value="{{ $kodepenjualan }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label> GrandTotal </label>
                                        <input type="text" readonly class="form-control" value="Rp. {{ number_format($total,'0',',','.') }}">
                                        <input type="hidden" readonly name="total" id="total" class="form-control" value="{{ $total }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label> Bayar </label>
                                        <input type="number" value="0" required name="bayar" id="bayar" class="form-control" oninput="hitung_kembalian(this.value)">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label> Kembalian </label>
                                        <input type="text" readonly id="kembalian2" class="form-control">
                                        <input type="hidden" readonly name="kembalian" id="kembalian" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <button type="button" onclick="transaksi()" class="btn btn-primary btn-block"> <i class="fa fa-hdd"></i> Transaksi </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
