@extends('layouts.header')
@section('content')
<div class="container" id="content">
	<div class="row">
    <br>
		<div class=" col s6 push-s1 left-align">
			<h5>Tambah Pemilih Tetap</h5>
		</div>

		<div class=" col s6 pull-s1 right-align">
			<a class="waves-effect waves-light btn modal-trigger blue-grey darken-4" href="{{url('/pemilih')}}" id="add_penjaga">Kembali</a>
		</div>
  </div>

  <div class="row">
    <div class=" col s5 push-s1">
      <div class="card-panel inputPemilih">
				<!-- put content here -->
        <h5>File</h5>
        <div class="divider"></div>
        <form class="" action="index.html" method="post">
          <div class="fillerExcel"></div>
          <div class="file-field input-field">
            <div class="blue-grey darken-4 btn">
              <span>File</span>
              <input type="file" name="excel" placeholder="Excel file">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" name="excel">
            </div>
          </div>
          <div class="divider"></div><br>
          <div class="right-align">
            <button type="submit" class="waves-effect waves-light btn blue-grey darken-4" name="button">Submit</button>
          </div>
        </form>
        </div>
			</div>


		<div class=" col s5 push-s1">
      <div class="card-panel inputPemilih">
				<!-- put content here -->
        <h5>Manual</h5>
        <div class="divider"></div>
        <form class="" action="index.html" method="post">
          <div class="input-field">
            <input id="name" type="text" class="validate" name="name">
            <label for="name">Nama Pemilih</label>
          </div>
          <div class="input-field">
            <input id="npm" type="text" class="validate" name="npm">
            <label for="npm">NPM</label>
          </div>
          <div class="divider"></div><br>
          <div class="right-align">
            <button type="submit" class="waves-effect waves-light btn blue-grey darken-4" name="button">Submit</button>
          </div>
        </form>
        </div>
			</div>
		</div>
	</div>
</div>
@endsection
