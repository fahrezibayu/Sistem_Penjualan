@extends('app')

@section('title','Master Pengguna')

@section('content')
<div class="modal fade" role="dialog" id="userModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('/master/save_pengguna') }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-md-12 col-12">
                            <label>Nama Pengguna</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama pengguna..." required=""
                                name="nama">
                            <div class="invalid-feedback">
                                Please fill in the your name
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-12">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Masukkan username..." required=""
                                name="username">
                            <div class="invalid-feedback">
                                Please fill in the username
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Password <code> * Max 12 Digit </code></label>
                            <input type="password" class="form-control pwstrength" placeholder="Masukkan password..."
                                maxlength="12" required="" name="password" id = "password" data-indicator="pwindicator">

                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                            <div class="invalid-feedback">
                                Please fill in the password
                            </div>

                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label>Ulangi Password</label>
                            <input type="password" class="form-control" placeholder="Ulangi password..." oninput="checkPassword()"
                                maxlength="12" required="" name="password2" id = "password2">
                            <span id="error_password2" class="form-text "></span>

                            <div class="invalid-feedback">
                                Please fill in the ulangi password
                            </div>

                        </div>

                        <div class="form-group col-md-12 col-12">
                            <label>Level</label>
                            <select name="level" class="form-control select2" required="" id="level">
                                <option value=""> --- Silahkan Pilih Level --- </option>
                                <option value="Admin"> Admin </option>
                                <option value="Kasir"> Kasir </option>
                            </select>
                            <div class="invalid-feedback">
                                Please fill in the level
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-12">
                                    <label>Upload Photo </label>
                                    <input type="file" class="form-control" name = "foto">

                                    <div class="text-muted form-text">
                                        Pastikan resolusi gambar 60x60 dan size tidak lebih dari 1 MB.
                                    </div>
                                </div>

                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="simpan"> Simpan Data </button>
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
                <h2 class="section-title">Master Pengguna</h2>
                <p class="section-lead">
                    Di bawah ini kamu dapat menambah, merubah, menghapus aksess pengguna.
                </p>
            </div>
            <div class="col-12 col-md-12 col-lg-2 text-right">
            <br/>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#historyModal">
                    History Login Pengguna</button>
            </div>

            <div class="col-12 col-md-12 col-lg-2 text-right">
            <br/>
                <button class="btn btn-primary" data-toggle="modal" data-target="#userModal"><i class="fas fa-plus"></i>
                    Tambah Pengguna</button>
            </div>
            </div>
            </div>
            </div>

            <div class="col-12 col-md-12 col-lg-12">

                <div class="card">
                        <div class="card-body">
                            <table id="table_id" class="table table-striped table-bordered table-md" style = "width:100%">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Photo </th>
                                        <th> Nama </th>
                                        <th> Username </th>
                                        <th> Level </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="level_data">
                                    <@php
                                        $no = 0;
                                    @endphp
                                    @foreach ($pengguna as $key)
                                    @php
                                        $no++;
                                    @endphp
                                    <tr>
                                        <td> {{ $no }} </td>
                                        <td>
                                            @if ($key->foto == '')
                                            <img alt="image"
                                                src="https://ui-avatars.com/api?name={{ $key->name }}&color=7FCF5&background=EBF4FF"
                                                class="rounded-circle mr-1" width="50" height="50">
                                        @else
                                            <img alt="image" src="{{ asset('assets/img/profile') }}/{{ $key->foto }}"
                                                class="rounded-circle mr-1" width="50" height="50">

                                        @endif
                                        </td>
                                        <td> {{ $key->name }} </td>
                                        <td> {{ $key->username }} </td>
                                        <td> {{ $key->role }} </td>
                                        <td>

                                            <a href="{{ url('/master/pengguna/edit',$key->id) }}" <button
                                                type="button" class="btn btn-primary btn-sm btn-icon"><i class="fa fa-edit"></i>
                                                </button></a>

                                            <a href="{{ url('/master/delete_pengguna',$key->id) }}"
                                                onclick="return confirm('Apakah anda yakin untuk menghapus pengguna : ')"
                                                <button type="button" class="btn btn-icon btn-danger btn-sm"><i
                                                    class="fas fa-trash"></i></button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>

        </div>

    </div>
</section>

<div class="modal fade" role="dialog" id="historyModal">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">History Login Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div id = "search_data_session">

              <div class="row">

                <div class="col-md-4">
                <div class="form-group">
                  <label>Tanggal</label>
                    <input type="date" class="form-control" id="ctgl1" name="ctgl1" >
                </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                  <label>Sampai</label>
                    <input type="date" class="form-control" id="ctgl2" name="ctgl2" >
                </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                    (or) <label>Pengguna</label>
                    <div class="input-group">
                      <select class="form-control select2" name="cgroup" id="cgroup">
                        <option value="">-- Pilih Pengguna --</option> <!-- INI default -->
                        @foreach ($pengguna as $row2)
                            <option value="{{ $row2->id }}"> {{ $row2->username }} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                    <button type="button" name = "refresh" onclick="data_session()" class="form-control btn btn-success"> Refresh </button>
                </div>
                <div class="col-md-6">
                    <button type="button" name = "cari" onclick="cari_session()" class="form-control btn btn-primary"> Cari </button>
                </div>

              </div>

              </div>
              <br/>

              <div id = "data_session">

              </div>

              </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
        </div>
    </div>
</div>

<script>
function checkPassword() {
    $('#error_password2').text('');

    var password1 = $("#password").val();
    var password2 = $("#password2").val();

    if(password1 != password2){
        document.getElementById("simpan").disabled = true;

        error_password2 = 'Password tidak sama! Coba lagi.';
        $('#error_password2').text(error_password2);
        $('#error_password2').css('color','red');
    }else{
        document.getElementById("simpan").disabled = false;

         error_password2 = 'Berhasil! Password Sama';
         $('#error_password2').text(error_password2);
         $('#error_password2').css('color','green');
    }

}
</script>
@endsection
