<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	  	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
		<meta name="csrf-token" content="{{ csrf_token() }}"/>
		<title>AdVotes</title>


	  	<link rel="stylesheet" href="{{asset('css/materialize.css')}}" media="screen,projection"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
	  	<link rel="stylesheet" href="{{asset('css/materialize.min.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/signin.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/materialize.min.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/header.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/extra-css.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.materialize.css')}}"/>
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/dataTables.materialize.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
		@section('css')
		@show
	</head>
	<body>
			@yield('header')
			@yield('scripts')
	</body>
</html>
