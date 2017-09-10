<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Pemilihan Raya UI </title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/materialize.css')}}" media="screen,projection" />
    <link rel="stylesheet" href="{{asset('css/extra-css.css')}}" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="{{asset('js/materialize.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <nav class="teal lighten-1" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" class="brand-logo">Pemira</a>
        </div>
    </nav>

    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center teal-text">Pemira UI</h1>
            <div class="row center">
                <h5 class="header col s12 light">Pemilihan Raya Universitas Indonesia</h5>
            </div>
            <div class="row center">
                @if (session('error')) {{session('error')}} @endif
                <h5>
            <form class="form" role="form" method="POST" action="{{ url('/login') }} ">
                {{csrf_field()}}
                <div class="row">
                    <div class="input-field col s6 push-s3">
                        <input type="text" class="validate" name="username">
                        <label for="username">Username</label>
                        <h6 class="red-text">{{ $errors->first('username') }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 push-s3">
                        <input type="password" class="validate" name="password">
                        <label for="password">Password</label>
                        <h6 class="red-text">{{ $errors->first('password') }}</h6>
                    </div>
                </div>
                <div class="col s6 push-s3">
                    <button type="submit" class="right btn btn-flat brown waves-effect
                        white-text" name="submit">Login</button>
              </div>
          </form>
        </div>
      <br><br>
      </div>
    </div>
  </body>
</html>
