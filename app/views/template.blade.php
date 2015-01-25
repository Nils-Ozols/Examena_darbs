
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	
	<script src="//cdn.ckeditor.com/4.4.6/full/ckeditor.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ URL::to('') }}">Galerijas</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	@if (Auth::guest())
            	<li><a href="{{ URL::to('user/login') }}">Login</a></li>
            	<li><a href="{{ URL::to('user/register') }}">Register</a></li>
            @else
            	<li><a href="{{ URL::to('user') }}">Profile</a></li>
            	<li><a href="{{ URL::to('user/logout') }}">Logout</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
    <div class="container">
		
		@foreach ($errors->all() as $error)
	        <div class="alert alert-danger" role="alert">{{ $error }}</div>
	    @endforeach
		
        @yield('content')

    </div> <!-- /container -->


    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  </body>
</html>
