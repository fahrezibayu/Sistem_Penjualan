@extends('app')

@section('title', 'Edit Profile')

@section('content')
<div class="modal fade" role="dialog" id="_password">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="alert alert-success show fade" id = "alert_password">
                <div class="alert-body">
                <center>
                  Yey! Password berhasil di perbarui.
                </center>
                </div>
            </div>

             <form method="post"  class="needs-validation" novalidate="">
                <div class="modal-body">

                <input type="hidden" readonly class="form-control" value="{{ $user->id }}"
                                    name="id" id = "id" />

                    <div class="row">

                        <div class="form-group col-md-12 col-12">
                            <label>Password Baru <code> * Max 12 Digit </code></label>
                            <input type="password" class="form-control pwstrength" placeholder="Masukkan password baru..."
                                maxlength="12" required="" name="password" id = "password" data-indicator="pwindicator">

                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                            <div class="invalid-feedback">
                                Please fill in the password
                            </div>

                        </div>

                        <div class="form-group col-md-12 col-12">
                            <label>Ulangi Password</label>
                            <input type="password" class="form-control" placeholder="Ulangi password..." oninput="checkPassword()"
                                maxlength="12" required="" name="password2" id = "password2">
                            <span id="error_password2" class="form-text "></span>

                            <div class="invalid-feedback">
                                Please fill in the ulangi password
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id = "simpan" onclick="_password()" >Simpan Password </button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="section">
    <div class="section-body">
        {{-- <a href="{{ url('/pengguna') }}" type="button" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Kembali</a> --}}
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-6">

                <h2 class="section-title">Edit Profile</h2>
                <p class="section-lead">
                    Di samping ini kamu dapat merubah data pengguna pada sistem.
                    Jika anda merubah password ataupun username kamu akan ter logout da harus login terlebih dahulu.
                </p>


                <h2 class="section-title">Ganti Password</h2>
                <p class="section-lead">
                   Jika Anda ingin <b>mengganti password</b> atau <b>lupa password </b> Akun Anda Silahkan klik disini .
                   <p>
                   <button class="btn btn-primary" data-toggle="modal" data-target="#_password">
                    <i class = "fa fa-edit"></i> Password</button>
                   </p>
                </p>

            </div>

            <div class="col-12 col-md-12 col-lg-6">
                <div class="card">
                    <form method="post" action="{{ url('/setting/update_profile_user') }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-0">
                            <div class="row">

                                <input type="hidden" readonly class="form-control" value="{{ $user->id }}"
                                    name="id" />

                                <div class="form-group col-md-12 col-12">
                                    <label>Nama Pengguna</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" required=""
                                        name="nama">
                                    <div class="invalid-feedback">
                                        Please fill in the your name
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="{{ $user->username }}"
                                        required="" name="username">
                                    <div class="invalid-feedback">
                                        Please fill in the username
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Upload Photo </label>
                                    <input type="file" class="form-control" name = "foto">
                                    <input type="hidden" class="form-control" name = "foto_l" value="{{ $user->foto }}">

                                    <div class="text-muted form-text">
                                    Pastikan resolusi gambar 60x60 dan size tidak lebih dari 1 MB.
                                    </div>
                                    <div class="text-muted form-text">
                                    File Foto Sebelumnya : <code>{{ $user->foto }}</code>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right pt-0">
                            <hr />
                            <a href="{{ url('/setting/delete_foto_profile', $user->id) }}">
                                <button type="button" class="btn btn-danger"> Hapus Foto Profile </button>
                            </a>
                            <input type="submit" value="Simpan Perubahan" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>

<script>
    document.getElementById('alert_password').style.display = "none";

function _password() {
    var id = $("#id").val();
    var password1 = $("#password").val();
    var password2 = $("#password2").val();
    $.ajax({
        type: 'POST',
        url: "/setting/update_password",
        data: {password1:password1,password2:password2,id:id},
        success: function() {
            document.getElementById('alert_password').style.display = "block";
            setInterval(() => {
                window.location = "/sign_out"
            }, 3000);
       }
      });
}

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
