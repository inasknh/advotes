@extends('layouts.header')
@section('content')
<div class="container" id="content">
	<div class="row">
    <br>
		<div class="col s10 push-s1">
			<div class="card-panel">
				<div class="row">
					<div class=" col s12 center-align hide-on-med-and-up">
						<h5>Daftar Penjaga TPS</h5>
					</div>

					<div class=" col m6 l6 left-align hide-on-small-only">
						<h5>Daftar Penjaga TPS</h5>
					</div>

					<div class=" col s12 center-align hide-on-med-and-up">
						<a class="waves-effect waves-light btn modal-trigger blue-grey darken-4 add_penjaga" href="#modal_penjaga" id="add_penjaga_small">Tambah</a>
					</div>
					<div class=" col m6 l6 right-align hide-on-small-only">
						<a class="waves-effect waves-light btn modal-trigger blue-grey darken-4 add_penjaga" href="#modal_penjaga" id="add_penjaga_medium">Tambah</a>
					</div>
				</div>
				<div class="divider"></div>
				<br>
				<div class="row">
			        <table class="responsive-table bordered" id="penjagaTPSTable">
			            <thead>
			            	<tr>
			            		<th>Nama</th>
			            		<th>NPM</th>
			            		<th>IMEI</th>
			            		<th>Edit</th>
			            		<th>Hapus</th>
			            	</tr>
			            </thead>
			            <tbody>
			            </tbody>
			        </table>
			    </div>
			</div>
		</div>
	</div>

    <div id="modal_penjaga" class="modal modal-fixed-footer">
		<form id="add_penjaga_form" enctype="multipart/form-data" method="post">
        <div class="modal-content">
          <h5 id="modal-title">Tambah Penjaga TPS</h5>
          <div class="divider"></div>
    			<div class="card-panel">

						<div class="input-field">
							<input type="text" name="nama" id="nama_penjaga" class="validate">
							<label for="nama_penjaga">Nama</label>
						</div>
						<div class="input-field">
							<input type="text" name="npm" id="npm_penjaga" class="validate">
							<label for="npm_penjaga">NPM</label>
						</div>
						<div class="input-field">
							<input type="text" name="imei" id="imei_penjaga" class="validate">
							<label for="imei">IMEI</label>
						</div>
    			</div>
        </div>
				<div class="modal-footer">
					<div class="right-align">
						<button type="submit" class="btn btn-flat blue-grey darken-4 lighten-1 waves-effect white-text" name="submit" value="add" id="sub_btn">Submit</button>
					</div>
				</div>

			</form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/penjagaTPS.js')}}"></script>
@endsection
