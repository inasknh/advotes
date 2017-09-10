@extends('layouts.header')
@section('content')
<div class="container" id="content">
  <br>
  <div class="row">
    <div class="col s6 push-s1 left-align">
      <h5>Tambah Pemilihan</h5>
    </div>

    <div class=" col s6 pull-s1 right-align">
			<a class="waves-effect waves-light btn modal-trigger blue-grey darken-4" href="{{url('/pemilih')}}" id="add_penjaga">Kembali</a>
		</div>
  </div>

  <div class="row">
    <div class="col s10 push-s1">
      <form class="" action="index.html" method="post">
        <div class="card-panel">
          <h5>Organisasi</h5><hr>
          <div class="input-field">
            <input id="nama_pemilihan" type="text" class="validate" name="nama_pemilihan">
            <label for="nama_pemilihan">Nama Pemilihan</label>
          </div>

          <div class="row">
            <div class="input-field col s6">
              <input id="mulai" type="text" class="datepicker">
              <label for="mulai">Tanggal Mulai</label>
            </div>

            <div class="input-field col s6">
              <input id="akhir" type="text" class="datepicker">
              <label for="akhir">Tanggal Akhir</label>
            </div>
          </div>
        </div>

        <div class="card-panel">
          <h5>Admin Pemilihan</h5><hr>
          <div class="input-field">
            <input id="nama_admin" type="text" class="validate" name="nama_admin">
            <label for="nama_admin">Nama Admin</label>
          </div>

          <div class="input-field">
            <input id="npm" type="number" class="validate" name="npm">
            <label for="npm">NPM</label>
          </div>
        </div>
        <div class="right">
          <button type="submit" name="button" class="waves-effect waves-light btn blue-grey darken-4">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
