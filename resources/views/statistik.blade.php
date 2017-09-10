@extends('layouts.header')
@section('content')
<div class="container" id="content">
	<br>
	<div class="row">
		<div class="col s10 push-s1">
			<div class="row">
				<div class="col s12 left-align">
					<h5>Statistik {{ $pemilihan->nama }}</h5>
				</div><br>

				<div class="col s12">
					<div class="row">
						<div class="card-panel col s12 l12">
							<p>Berikut Ringkasan Pemilihan {{ $pemilihan->nama }} yang Anda miliki :
							</p>
						</div>

						<div class="col s12 l4">
							<div class="statistik-content card-panel">
								<nav class="top-nav blue-grey darken-4">
							    <div class="nav-wrapper">
							      <a href="{{url('kandidat')}}" class="brand-logo center">Kandidat</a>
							    </div>
							  </nav>
								<div class="center-align">
									<h4>{{ $jumlahKandidat }}</h4>
								</div>
								<br>
							</div>
						</div>

						<div class="col s12 l4">
							<div class="statistik-content card-panel">
								<nav class="top-nav blue-grey darken-4">
							    <div class="nav-wrapper">
							      <a href="{{url('pemilih')}}" class="brand-logo center">Pemilih</a>
							    </div>
							  </nav>
								<div class="center-align">
									<h4>{{ $jumlahPemilih }}</h4>
								</div>
								<br>
							</div>
						</div>

						<div class="col s12 l4">
							<div class="statistik-content card-panel">
								<nav class="top-nav blue-grey darken-4">
							    <div class="nav-wrapper">
							      <a href="{{url('penjagaTPS')}}" class="brand-logo center">Penjaga TPS</a>
							    </div>
							  </nav>
								<div class="center-align">
									<h4>{{ $jumlahPenjaga }}</h4>
								</div>
								<br>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>


</div>
@endsection
