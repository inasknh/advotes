@extends('layouts.signinHead')
@section('header')
<nav class="hide-on-large-only">
  <div class="nav-wrapper blue-grey darken-4">
    <a href="#" class="brand-logo">AdVotes</a>
  </div>
</nav>
<div class="row">
  <div id="left" class="col l5 hide-on-med-and-down")>
    <div id="leftCover">
      <br>
      <div class="container center-align white-text">
        <h3>AdVotes</h3>
      </div>
      <br>
      <div class="container white-text">
        <p class="flow-text">Tempat manajemen data pemilihan terpadu, dengan AdVotes
        manajemen data pemilihan akan semakin</p>
        <ul class="flow-text">
          <li><i class="material-icons">play_arrow</i> Mudah</li>
          <li><i class="material-icons">play_arrow</i> Akurat</li>
          <li><i class="material-icons">play_arrow</i> Cepat</li>
        </ul>
      </div>
    </div>
  </div>
  <div id="right" class="col s12 l7 blue-grey lighten-5">
    <br><br>
    <div class="container">
      <h5 class="blue-grey-text center-align">Sign in</h5>
      <br>
      <span class="blue-grey-text">Silakan login menggunakan akun JUITA Anda. <br> Kami tidak menyimpan password dan data pribadi Anda</span>
      <br>
      <div>
        <br>
        @if (session('error')) {{session('error')}} @endif
        <form class="" action="{{ url('/login') }}" method="post">
        {{csrf_field()}}
          <div class="row">
            <div class="input-field col s12">
              <input id="user" type="text" class="validate" name="username">
              <label for="user">Username</label>
              <h6 class="red-text">{{ $errors->first('username') }}</h6>
            </div>
            <div class="input-field col s12">
              <input id="pass" type="password" class="validate" name="password">
              <label for="pass">Password</label>
              <h6 class="red-text">{{ $errors->first('password') }}</h6>
            </div>
            <div class="center-align col s12">
              <br><br>
              <button id="signin" class="btn waves-effect waves-light blue-grey darken-4" type="submit" name="action">Sign in
                <i class="material-icons right">send</i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection