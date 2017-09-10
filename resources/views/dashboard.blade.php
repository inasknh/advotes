@extends('layouts.header')
@section('content')
<div class="container" id="content">
	<br>
	<div class="row">
		<div class="col s10 push-s1">
			<div class="row">
				<div class="card-panel col s12 l12">
					<p>Berikut daftar pemilihan yang Anda miliki :
					</p>
				</div>
				<br>

				@foreach($daftarPemilihan as $pemilihan)
				<div class="col s12 m6 l6">
					<div class="card">
							<div class="card-content">
								<h5 class="card-title">{{$pemilihan->nama}}</h5>
								<p>Tanggal Mulai : {{$pemilihan->tanggal_mulai}}</p>
								<p>Tanggal Selesai : {{$pemilihan->tanggal_selesai}}</p>
							</div>
							<div class="card-action blue-grey darken-4">
									<a class="blue-grey-text text-lighten-5" href="{{ url('/dashboard/statistik', $pemilihan->id) }}">Lihat Statistik</a>
						</div>
					</div>
				</div>
				@endforeach


			</div>
		</div>

	</div>

	<div class="row">

	</div>

</div>
@endsection
