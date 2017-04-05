<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIM Klinik</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            margin: 0;
        }

        .content {
            text-align: center;
            width: 80%;
            height: auto;
            margin: 0 auto;
            position: relative;
            z-index: 5;
            padding: 30px;
        }
        .content > p {
            color: #636b6f;
            padding:  25px;
            font-size: 16px;
            font-weight: 600;
            background: #fff;
            text-align: left;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .title {
            font-size: 84px;
            color: #ffffff;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .bg {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 1;
            float: left;
            left: 0;
            opacity:10;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<img src="assets/images/background/medical.jpg" alt="gambar" class="bg" />
<div class="flex-center position-ref full-height">
    {{--@if (Route::has('login'))--}}
        {{--<div class="top-right links">--}}
            {{--@if (Auth::check())--}}
                {{--<a href="{{ url('/home') }}">Home</a>--}}
            {{--@else--}}
                {{--<a href="{{ url('/login') }}">Login</a>--}}
                {{--<a href="{{ url('/register') }}">Register</a>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--@endif--}}

    <div class="content">
        <div class="title m-b-md">
           SIM Klinik
        </div>
            <p style="margin-left: 10%; margin-right: 10%">SIM Klinik Teknoland yang  merupakan aplikasi software berbasis web komputerisasi client server, dimana aplikasi ini fully integrated antara satu modul dengan modul lainnya yang bertujuan untuk mengelola kompleksitas proses-proses yang berlangsung  secara internal maupun eksternal. Sehingga manajemen klinik akan memiliki system yang dapat meningkatkan pelayanan secara nyata.</p>
        <a  type="button" class="btn btn-success" href="{{ url('/login') }}">Login</a>
    </div>
</div>
</body>
</html>