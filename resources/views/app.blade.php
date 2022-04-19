@php
$profile = \App\Models\ProfileApp::all()->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> @yield('title') | {{ $profile->nama_aplikasi }} </title>

    @include('layout.head')
</head>

<body class="layout-3">
    <div id="app">
        {{--  <div class="preloader">
            <div class="loading animated bounce" >
              <img src="{{asset('assets/img/logo')}}/{{$profile->photo}}" width="15%">
              <p>Harap Tunggu ...</p>
            </div>
        </div>  --}}
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>

            @include('layout.header')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            {{-- FOOTER --}}
            @include('layout.footer')
            {{-- END FOOTER --}}
        </div>
    </div>
</body>

</html>
