<!DOCTYPE html>
<html>


<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login .: Teknohealth :. </title>
    <link rel="icon" href="{{asset('assets/images/logo/logo-sm.png')}}">
    <link href="{{asset('assets/plugins/semantic/semantic.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet">
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
    <div class="ui middle aligned center aligned grid">
        <div class="column">
        <div class="ui stacked segment">
            <img src="{{asset('assets/images/logo/logo.png')}}" style="margin-top: 0.4px" class="image">
        <h2 class="ui teal header">
          <div class="content">
            LOGIN
          </div>
        </h2>
        <div>
        <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <input id="username" type="text" class="form-control" name="username" value="{{ old('email') }}" required autofocus placeholder="username">
                @if ($errors->has('username'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password"  placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <button type="submit" class="ui fluid large teal submit button" >Login</button>
            <div class="field">
            <hr>
            <p>Tidak memiliki akun? <p>Klik tombol berikut untuk mengajukan pendaftaran.</p>
            </div>
            <a  class="ui fluid large teal button" style="background-color: #FE6860" href="{{ route('register') }}">Create an account</a>
        </form>
        <p class="m-t"> <small>Teknoland for medical</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

</body>


<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
</html>

