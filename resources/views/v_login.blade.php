@php
    $profile = \App\Models\ProfileApp::all()->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  {{-- Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login &mdash; {{ $profile->nama_aplikasi }} </title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-social/bootstrap-social.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  <link rel="shortcut icon" href="{{ asset('assets/img/logo') }}/{{ $profile->photo }}" type="image/x-icon">

  <style>
  #lottie-image2 {
    display: none;
  }


  @media screen and (max-width: 600px) {
  #lottie-image {
    visibility: hidden;
    clear: both;
    float: left;
    margin: 10px auto 5px 20px;
    width: 28%;
    display: none;
  }
  #lottie-image2 {
    display: block;
  }
}

.left-inner-addon {
    position: relative;
}
.left-inner-addon input {
    padding-left: 35px !important;
}
.left-inner-addon i {
    position: absolute;
    padding: 15px 13px;
    pointer-events: none;
    color:lightgray;
}
  </style>
</head>

<body>
  <div id="app">
    <section class="section container">
      <div class="d-flex flex-wrap align-items-stretch">

        <div class="col-lg-4 col-md-6 col-12 order-lg-1 order-2 pt-3 mt-5 ">
          <center>
            <h4 class="text-dark font-weight-normal " style="text-transform: uppercase;"><span class="font-weight-bold">
            {{ $profile->nama_aplikasi }}
            </span>
            </h4>
            <p class="text-muted">Silahkan masuk dengan akun anda.</p>
          </center>
          <div class="card bg-white ">
            <div class="m-5">
              <form method="post" action="{{ url('/sign_in') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                  <label for="username">Username</label>
                  <div class="left-inner-addon input-container">
                  <i class="fa fa-user"></i>
                  <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                  <div class="invalid-feedback">
                    Silahkan isi username Anda.
                  </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                  </div>
                  <div class="left-inner-addon input-container">
                  <i class="fa fa-lock"></i>
                  <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                  <div class="invalid-feedback">
                    Silahkan isi password Anda.
                  </div>
                </div>
                </div>

                <div class="form-group text-right">
                  <button type="submit" name = "login" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                    Login
                  </button>
                </div>
              </form>

              <div class="text-center mt-5 text-small">
                2021 Copyright &copy; <br /> <span class="text-primary"> {{ $profile->nama_aplikasi }} </span>.
              </div>

            </div>
          </div>
        </div>



        <div class="col-lg-8 col-12 order-lg-2 order-1 mt-4 " id = "lottie-image">

            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_s72aydoa.json"
                class="img-fluid" background="transparent" speed="1" loop autoplay>
            </lottie-player>

        </div>

      </div>

            <div id = "lottie-image2">
            </div>

    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>
