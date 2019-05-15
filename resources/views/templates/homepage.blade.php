<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>We Love So</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.3/css/bulma.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/b19f8744bf.css" media="all">
	<link rel="stylesheet" href="https://cdn-assets.minds.com/front/dist/en/styles.2acb051213c9aaefab7a.css">
	<link rel="stylesheet" href="https://cdn-assets.minds.com/front/dist/en/styles.aea4070117f059339031.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
<m-body class="mdl-color--grey-100">
	@if (session('info'))
		<div class="col-md-3">
		</div>
		<div class="col-md-6 personal-info">
        	<div class="alert alert-info alert-dismissable">
          			<i class="fa fa-coffee"></i>
              		{{ session('info') }}
        	</div>
        </div>
    @endif
	@include('templates.partials.navigation')
	<div class="container">
		@yield('content')
		@yield('scripts')
	</div>
</m-body>
</body>
</html>
