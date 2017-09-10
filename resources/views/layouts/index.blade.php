<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="_token" content="{!! csrf_token() !!}" />

	<title>Pemilihan Raya UI</title>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/materialize.css')}}" media="screen,projection"/>
    <link rel="stylesheet" href="{{asset('css/extra-css.css')}}"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('js/materialize.js')}}"></script>

	@section('css')

  @show

</head>
<body>
	@show
	<div class="container">
		@yield('content')
	</div>
</body>

<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
</html>
<script src="{{asset('js/materialize.min.js')}}"></script>
<script src="{{ asset('js/initialize-select.js') }}"></script>
<script src="{{ asset('js/initialize-pickadate.js') }}"></script>
