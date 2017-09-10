@extends('layouts.header')
@section('content')
<div class="container" id="content">
	<div class="row">
    <br>
		<div class=" col s6 push-s1 left-align">
			<h5>Pemilih Tetap Pemilihan</h5>
		</div>

		<div class=" col s6 pull-s1 right-align">
			<div class="input-field col s12">
		    <select>
		      <option value="" disabled selected>--Pilih Pemilihan--</option>
		      <option value="1">Option 1</option>
		      <option value="2">Option 2</option>
		      <option value="3">Option 3</option>
		    </select>
		    <label>Pemilihan</label>
		  </div>
		</div>

		<div class="col s10 push-s1">
			<div class="card-panel">

				<div class="row">
			    <br>
					<div class=" col s6 left-align">
						<h5>Daftar Pemilih Tetap</h5>
					</div>

					<div class=" col s6 right-align">
						<a class="waves-effect waves-light btn modal-trigger blue-grey darken-4" href="#tambah">Tambah</a>
					</div>
				</div>

			</div>
		</div
	</div>
</div>

<div id="tambah" class="modal">
	<div class="modal-content">
		<h5>Tambah Pemilih Tetap</h5>
		<div class="divider"></div>
		<div class="row">
			<div class="row col s6">
				<div class=" col s12">
		      <div class="card-panel inputPemilih">
						<!-- put content here -->
		        <h5>File</h5>
		        <div class="divider"></div>
		        <form class="" action="index.html" method="post">
		          <div class="fillerExcel"></div>
		          <div class="file-field input-field">
		            <div class="blue-grey darken-4 btn">
		              <span>File</span>
		              <input type="file" name="import_file" placeholder="Excel file">
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
			</div>

			<div class="row col s6">
				<div class=" col s12">
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
</div>
@endsection
