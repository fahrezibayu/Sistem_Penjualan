@extends('app')

@section('title', 'Data Barang')

@section('content')
    <div class="modal fade" role="dialog" id="levelModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Tambah Barang </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('master/save_barang') }}" class="needs-validation" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group col-md-4 col-4">
                                <label> Kode Barang </label>
                                <input type="text" class="form-control" name="id_barang" id="id_barang"
                                    value="{{ $kodebarang }}" placeholder=" Masukan id barang..." required readonly>
                            </div>
                            <div class="form-group col-md-4 col-4">
                                <label> Nama Barang </label>
                                <input type="text" class="form-control" placeholder="Masukkan nama barang..." required=""
                                    name="nama_barang">
                                <div class="invalid-feedback">
                                    Please fill in the nama barang
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-4">
                                <label> Merk Baranng </label>
                                <select name="id_merk" id="id_merk" required class="form-control select2">
                                    <option value=""> Silahkan pilih merk </option>
                                    @foreach ($merk as $row)
                                        <option value="{{ $row->id_merk }}">{{ $row->nama_merk }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the merk
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label> Harga Barang </label>
                                <input type="number" class="form-control" placeholder="Masukkan harga barang..."
                                    required="" name="harga_barang">
                                <div class="invalid-feedback">
                                    Please fill in the harga barang
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label> Foto Barang </label>
                                <input type="file" class="form-control" name="file" id="file" onchange="validasi_file()">
                                <small class="text-danger">*Format file yang diperbolehkan *.JPG, *.PNG</small>
                                <div class="invalid-feedback">
                                    Please fill in the foto barang
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Simpan Data </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="section">

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-md-12 col-lg-8">
                            <h2 class="section-title"> @yield('title') </h2>
                            <p class="section-lead">
                                Di bawah ini kamu dapat menambah, merubah, menghapus data barang.
                            </p>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 text-right">
                            <br />
                            <button class="btn btn-primary" data-toggle="modal" data-target="#levelModal"><i
                                    class="fas fa-plus"></i> Tambah Barang </button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card-body">
                        <table id="table_id" class="table table-hover table-bordered table-md nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Kode Barang </th>
                                    <th> Foto Barang </th>
                                    <th> Nama Barang </th>
                                    <th> Merk Barang </th>
                                    <th> Harga Barang </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody id="data_merk">
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
                                @foreach ($barang as $row)
                                    @php
                                        $no++;
                                    @endphp
                                    <tr>
                                        <td> {{ $no }} </td>
                                        <td> {{ $row->id_barang }} </td>
                                        @if ($row->foto == null)
                                            <td>
                                                <center>
                                                    <img alt="image"
                                                    src="https://ui-avatars.com/api?name={{ $row->nama_barang }}&color=7FCF5&background=EBF4FF"
                                                    class="rounded-circle" width="120" height="120">
                                                </center>
                                            </td>
                                        @else
                                            <td>
                                                <center>
                                                    <img alt="image"
                                                    src="{{ asset('assets/img/products') }}/{{ $row->foto }}"
                                                    class="rounded-circle" width="120" height="120">
                                                </center>
                                            </td>
                                        @endif
                                        <td> {{ $row->nama_barang }} </td>
                                        <td> {{ $row->tb_merk->nama_merk }} </td>
                                        <td> Rp. {{ number_format($row->harga_barang,'0','.','.') }} </td>
                                        <td>
                                            <a href="{{ url('/master/barang/edit',$row->id_barang) }}" <button type="button"
                                                class="btn btn-icon btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{ url('/master/delete_barang', $row->id_barang) }}"
                                                onclick="return confirm('Apakah anda yakin untuk menghapus data barang : {{ $row->nama_barang }} ?')"
                                                <button type="button" class="btn btn-icon btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
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
@endsection
