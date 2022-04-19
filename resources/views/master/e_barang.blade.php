@extends('app')

@section('title', 'Edit Barang')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <a href="{{ url()->previous() }}" type="button" class="btn btn-primary"> <i
                        class="fas fa-arrow-left"></i> Kembali</a>
                    <h2 class="section-title">Edit Barang</h2>
                    <p class="section-lead">
                        Di samping ini kamu dapat merubah data barang pada sistem.
                    </p>


                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                        <form method="post" action="{{ url('/master/update_barang') }}" class="needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body pb-0">
                                <div class="row">

                                    <input type="hidden" readonly class="form-control"
                                        value="{{ $barang->id_barang }}" name="id" id="id" />
                                    <div class="form-group col-md-6 col-6">
                                        <label> Nama Barang </label>
                                        <input type="text" class="form-control" placeholder="Masukkan nama barang..."
                                            required="" name="nama_barang" value="{{ $barang->nama_barang }}">
                                        <div class="invalid-feedback">
                                            Please fill in the nama barang
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-6">
                                        <label> Merk </label>
                                        <select name="id_merk" id="id_merk" required
                                            class="form-control select2">
                                            <option value="{{ $barang->id_merk }}"> {{ $barang->tb_merk->nama_merk }} </option>
                                            <option value=""> Silahkan pilih merk </option>
                                            @foreach ($merk as $row)
                                                <option value="{{ $row->id_merk }}">{{ $row->nama_merk }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please fill in the merk
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-6">
                                        <label> Harga Barang </label>
                                        <input type="number" class="form-control" placeholder="Masukkan harga barang..."
                                            required="" name="harga_barang" value="{{ $barang->harga_barang }}">
                                        <div class="invalid-feedback">
                                            Please fill in the harga barang
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-6">
                                        <label> Foto Barang </label>
                                        <input type="file" class="form-control"
                                            placeholder="Upload file atau scan gambar surat masuk..." name="file" id="file"
                                            onchange="validasi_file()">
                                        <input type="hidden" class="form-control"name="file_l" id="file_l" value="{{ $barang->foto }}">
                                        <small class="text-danger">*Format file yang diperbolehkan *.JPG, *.PNG </small>
                                        <div class="invalid-feedback">
                                            Please fill in the foto product
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right pt-0">
                                <hr />
                                <button type="submit" id="btn_sm" class="btn btn-primary"> Simpan Perubahan </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
