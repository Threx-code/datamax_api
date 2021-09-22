<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Oluwatosin Amokeodo">
		<meta name="description" content="#Olubolu2021">
		 <meta name="csrf-token" content="{{ csrf_token() }}">		
		 <link rel="icon" href="">
		<title>Datamax</title>
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    	<link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css')}}">
    	<link rel="stylesheet" href="{{ asset('assets/css/assets/css/main.css')}}">
		<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
	<title></title>
</head>
<body>
	<br><br>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top nav_container">
	    <div class="navbar-collapse nav_content">
	        <a class="nav-item nav-link navlink active" href="javascript:void(0);">
	            <h3>Datamax</h3>
	        </a>
	    </div>
	</nav>

<main role="main" class="container starter-template">
    <br><br>
    <div class="row">
        <div class="col-lg-7 offset-lg-2 col-xs-12 tab-content">
			@yield('content')
		</div>
	</div>
</main>
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
</body>
</html>