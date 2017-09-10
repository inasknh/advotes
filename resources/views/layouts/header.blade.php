@extends('layouts.template')
@section('header')
    <header>
      <nav class="top-nav blue-grey darken-4">
        <div class="container" id="top-nav">
          <div class="nav-wrapper">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu material-icons">menu</i></a>
            <a class="page-title blue-grey-text text-lighten-5">{{$pageTitle}}</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a id="usernpm" >{{$userAdmin->username}}</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container">

      </div>

      <ul class="side-nav fixed"></ul>
      <ul class="side-nav fixed blue-grey darken-4 blue-grey-text text-lighten-5" id="slide-out">
        <li id="sidebar-wrapper" class="logo">
          <div class="logo-wrapper">
            <p class="center-align" id="title-logo">AdVotes</p>
          </div>
        </li>
        <li>
          <a class="sidemenu blue-grey-text text-lighten-5" href="{{url('dashboard')}}">
          <i class="material-icons blue-grey-text text-lighten-5">dashboard</i>Dashboard</a>
        </li>
        @if($userAdmin->role != 'admin pemilihan')
        <li>
          <a class="sidemenu blue-grey-text text-lighten-5" href="{{url('admin')}}">
          <i class="material-icons blue-grey-text text-lighten-5">account_box</i>Admin</a>
        </li>
        @endif
        @if($userAdmin->role != 'superuser')
        <li>
          <a class="sidemenu blue-grey-text text-lighten-5" href="{{url('pemilihan')}}">
          <i class="material-icons blue-grey-text text-lighten-5">assignment</i>Pemilihan</a>
        </li>
        <li>
          <a class="sidemenu blue-grey-text text-lighten-5" href="{{url('pemilih')}}">
          <i class="material-icons blue-grey-text text-lighten-5">group</i>Daftar Pemilih Tetap</a>
        </li>
        <li>
          <a class="sidemenu blue-grey-text text-lighten-5" href="{{url('kandidat/')}}">
          <i class="material-icons blue-grey-text text-lighten-5">contacts</i>Kandidat</a>
        </li>
        <li>
          <a class="sidemenu blue-grey-text text-lighten-5" href="{{url('penjagaTPS/')}}">
          <i class="material-icons blue-grey-text text-lighten-5">assignment_ind</i>Penjaga TPS</a>
        </li>
        <li>
          <a class="sidemenu blue-grey-text text-lighten-5" href="{{url('admin/faq')}}">
          <i class="material-icons blue-grey-text text-lighten-5">assignment_ind</i>FAQ</a>
        </li>
        @endif
        <li class="divider"></li>
        <li>
          <a class="sidemenu blue-grey-text text-lighten-5" href="{{'/logout'}}">
          <i class="material-icons blue-grey-text text-lighten-5">power_settings_new</i>Logout</a>
        </li>
      </ul>
    </header>
@yield('content')
@endsection
