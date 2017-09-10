@extends('layouts.header')
@section('content')
<div class="container" id="content">
	<div class="row" id="kandidat_pemilihan">
		<br>
		<div class="col s10 push-s1">
			<div class="row">
				<div class=" col s5 left-align hide-on-small-only">
					<h5 class="left">Kandidat Pemilihan</h5>
				</div>

				<div class=" col s12 center-align hide-on-med-and-up">
					<h5 class="left">Kandidat Pemilihan</h5>
				</div>

				<div class=" col s12 l7">
					<div class="input-field col s12">
				    	<select id="select_pemilihan">
				    	@if($userAdmin->role == 'admin fakultas')
					        	            
				            @foreach ($semua_pemilihan as $pemilihan)
				            <option value="{{ $pemilihan->id }}">{{ $pemilihan->nama }}</option>
				            @endforeach

				        @elseif($userAdmin->role == 'admin pemilihan')
					        
					        @foreach ($daftar_pemilihan as $pemilihan)
					        <option value="{{ $pemilihan->id }}">{{ $pemilihan->nama }}</option>
					        @endforeach
					       
				        @endif
						</select>

				    	<label>Pilih Pemilihan</label>
				    	<br>
				  	</div>
				</div>

			</div>
		</div>

		<div class="col s10 push-s1">
			<div class="card-panel">
				<div class="row">
					<div class=" col s6 left-align hide-on-small-only">
						<h5>Daftar Kandidat</h5>
					</div>

					<div class=" col s12 center-align hide-on-med-and-up">
						<h5>Daftar Kandidat</h5>
					</div>

					<div class=" col s6 right-align hide-on-small-only">
						<a id="add_kandidat" href="#modal_kandidat" class="waves-effect waves-light btn blue-grey darken-4">Tambah</a>
					</div>

					<div class=" col s12 center-align hide-on-med-and-up">
						<a id="add_kandidat" href="#modal_kandidat" class="waves-effect waves-light btn blue-grey darken-4">Tambah</a>
					</div>
				</div>
				<div class="divider"></div>
				<br>

				<div class="row" id="table_kandidat">
					
				</div>
			</div>
		</div>
	</div>
	<div id="modal_kandidat" class="modal modal-fixed-footer">
		<form id="add_kandidat_form" enctype="multipart/form-data">
			<div class="modal-content">
			<h5 id="modal-title">Tambah Kandidat</h5>	
			<div class="divider"></div>
			
				<div class="card-panel">
					<div class="input-field">
						<input type="text" class="validate" name="no_urut" value="" id="no_urut">
						<label for="no_urut">Nomor Urut Kandidat</label>
					</div>
					<div class = "row">
						<div class = "col s12 m6 l6">
							<h6>Calon Ketua</h6>
							<div class="file-field input-field">
								<div class="blue-grey darken-4 btn">
									<span>File</span>
									<input type="file" name="path_foto_ketua" id="path_foto_ketua" placeholder="Foto Calon">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload File" name="path_foto_ketua" id="path_foto_ketua">
								</div>
							</div>
							<div class="input-field">
								<input type="text" class="validate" name="nama_ketua" id="nama_ketua">
								<label for="nama_ketua">Nama Calon Ketua</label>
							</div>
							<div class="input-field">
								<input type="text" class="validate" name="npm_ketua" id="npm_ketua">
								<label for="npm_ketua">NPM Calon Ketua</label>
							</div>							
						</div>
						<hr class="hide-on-med-and-up">
						<div class = "col s12 m6 l6">
							<h6>Calon Wakil Ketua</h6>
							<div class="file-field input-field">
								<div class="blue-grey darken-4 btn">
									<span>File</span>
									<input type="file" name="path_foto_wakil" id="path_foto_wakil" placeholder="Foto Calon">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload File" name="path_foto_wakil" id="path_foto_wakil">
								</div>
							</div>
							<div class="input-field">
								<input type="text" class="validate" name="nama_wakil" id="nama_wakil">
								<label for="nama_wakil">Nama Calon Wakil Ketua</label>
							</div>
							<div class="input-field">
								<input type="text" class="validate" name="npm_wakil" id="npm_wakil">
								<label for="npm_wakil">NPM Calon Wakil Ketua</label>
							</div>
						</div>				
					</div>
				</div>
			</div>
			<div class="modal-footer right-align">
				<button type="submit" class="btn btn-flat blue-grey darken-4 lighten-1 waves-effect white-text" name="submit" value="add" id="submit_kandidat">Submit</button>
		    </div>
		</form>
	</div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{asset('js/penjagaTPS.js')}}"></script>
@endsection
