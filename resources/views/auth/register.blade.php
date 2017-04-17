<!DOCTYPE html>
<html>


<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register .: Teknohealth :. </title>
    <link rel="icon" href="/assets/images/logo/logo-sm.png">
    <link href="assets/plugins/semantic/semantic.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
      body {
      background-color: #4D545E;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
<div class="middle-box text-center loginscreen   animated fadeInDown">
   <div class="ui middle aligned center aligned grid">
        <div class="column">
        <div class="ui stacked segment">
            <img src="assets/images/logo/logo.png" style="margin-top: 0.4px" class="image">
        <h2 class="ui teal header">
          <div class="content">
            LOGIN
          </div>
        </h2>
        <div>
        <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
            <div class="form-group">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
            </div>
            <div class="form-group">
                    <input id="password" type="password" class="form-control"  placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
            </div>
            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
            </div>
            <button type="submit"  class="ui fluid large teal button" style="background-color: #FE6860">Register</button>
            <div class="field">
                <hr>
                <p>Login?<p>Klik tombol berikut untuk melakukan login. </p>
            </div>
            <a class="ui fluid large teal button" href="{{route('login')}}">Login</a>
        </form>
        <p class="m-t"> <small>Teknoland for medical</small> </p>
    </div>
</div>
<script src="{{asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('js/icheck.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>
</html>
