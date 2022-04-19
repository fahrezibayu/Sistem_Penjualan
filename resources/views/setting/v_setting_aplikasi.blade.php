@extends('app')

@section('title',"Setting Aplikasi")

@section('content')
@php
    $profile = DB::table('tbl_profile_app')->first();
@endphp
<section class="section">
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <h2 class="section-title"> @yield('title') </h2>
                <p class="section-lead">
                    Di bawah ini kamu dapat merubah setting aplikasi.
                </p>
            </div>
        </div>
        <div class="row mt-sm-4">

            <div class="col-12 col-md-12 col-lg-6">
                <div class="card p-5">
                    <center>
                        <img alt="image" src="{{ asset('assets/img/logo')}}/{{ $profile->photo }}" class="img-fluid ">
                    </center>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-6">
                <div class="card">
                    <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data" action="{{ url('/setting/update_aplikasi') }}">
                        @csrf
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" class="form-control" value = "{{ $profile->nama }}"
                                        required="" name = "nama">
                                    <div class="invalid-feedback">
                                        Please fill in the nama perusahaan
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Aplikasi</label>
                                    <input type="text" class="form-control" value = "{{ $profile->nama_aplikasi }}"
                                        required="" name = "nama_aplikasi">
                                    <div class="invalid-feedback">
                                        Please fill in the nama aplikasi
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>Upload Photo Logo</label>
                                    <input type="file" class="form-control" name = "photo">
                                    <input type="hidden" class="form-control" name = "photo_l" value="{{ $profile->photo }}">
                                    <div class="text-muted form-text">
                                        Pastikan resolusi gambar 250x250 dan tidak lebih dari 2 MB.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right pt-0">
                            <hr />
                            {{--  <input type = "submit" name = "ubah" value = "Simpan Perubahan" class="btn btn-primary" />  --}}
                            <button type="submit" class="btn btn-primary"> Simpan Perubahan </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
