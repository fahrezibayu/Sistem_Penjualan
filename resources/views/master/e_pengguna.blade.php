@extends('app')

@section('title', 'Edit Pengguna')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-6">

                <h2 class="section-title">Edit Pengguna</h2>
                <p class="section-lead">
                    Di samping ini kamu dapat merubah data pengguna pada sistem.
                </p>


            </div>

            <div class="col-12 col-md-12 col-lg-6">
                <div class="card">
                    <form method="post" action="{{ url('/master/update_pengguna') }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-0">
                            <div class="row">

                                <input type="hidden" readonly class="form-control" value="{{ $pengguna->id }}"
                                    name="id" />
                                <div class="form-group col-md-12 col-12">
                                    <label>Level</label>
                                    <select name="level" class="form-control select2" required="" id="level">
                                        <option value="{{ $pengguna->role }}">{{ $pengguna->role }}</option>
                                        <option value=""> --- Silahkan Pilih Level --- </option>
                                        <option value="Admin">Admin</option>
                                        <option value="Kasir">Kasir</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please fill in the level
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right pt-0">
                            <hr />
                            <a href="{{ url('/master/pengguna') }}" type="button" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Kembali</a>
                            <input type="submit" value="Simpan Perubahan" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
