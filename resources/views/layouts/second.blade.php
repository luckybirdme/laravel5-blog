<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>{{ translang($page_title) }} | LuckyBird</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/styles.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/nprogress.css') }}" rel="stylesheet" >


		<link href="{{ asset('/css/main.css') }}" rel="stylesheet">

		<script src="{{ asset('/js/jquery.min.js') }}"></script>
		
	</head>
	<body class="custom-background">
		<div id = "pjax-container" class = "main-container">
			@include('layouts.navbar')

			<div class="content-container">
				@yield('content')
			</div>
		</div>

		<!-- script references -->
		
		<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('/js/jquery.pjax.js') }}"></script>
		<script src="{{ asset('/js/nprogress.js') }}"></script>
		<script src="{{ asset('/js/moment.js') }}"></script>




		<script src="{{ asset('/js/autoload.js') }}"></script>
	</body>
</html>