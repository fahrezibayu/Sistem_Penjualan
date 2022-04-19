@extends('app')

@section('title', 'Data Merk ')

@section('content')
    <div class="modal fade" role="dialog" id="levelModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Tambah Merk </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('master/save_merk') }}" class="needs-validation" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label> Nama Merk </label>
                                <input type="text" class="form-control" name="nama_merk" id="nama_merk"
                                    placeholder=" Masukan nama merk..." required oninput="check_merk(this.value)">
                                <span id="ada_merk" class="text-danger text-bold" style="display:none"> Nama Merk
                                    Sudah Ada </span>
                                <span id="belum_merk" class="text-success text-bold" style="display:none"> Nama Merk
                                    Belum Ada </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_merk" disabled> Simpan Data </button>
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
                                Di bawah ini kamu dapat menambah, merubah, menghapus data merk.
                            </p>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 text-right">
                            <br />
                            <button class="btn btn-primary" data-toggle="modal" data-target="#levelModal"><i
                                    class="fas fa-plus"></i> Tambah Merk </button>

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
                                    <th> Nama Merk </th>
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
                                @foreach ($merk as $row)
                                    @php
                                        $no++;
                                    @endphp
                                    <tr>
                                        <td> {{ $no }} </td>
                                        <td data-name="nama_merk" class="nama_merk" data-type="text" data-pk="{{ $row->id_merk }}">
                                            <a href="#"> <u> {{ $row->nama_merk }} </u></a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/master/delete_merk', $row->id_merk) }}"
                                                onclick="return confirm('Apakah anda yakin untuk menghapus data merk : {{ $row->nama_merk }} ?')"
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
