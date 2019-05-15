
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn-assets.minds.com/front/dist/en/styles.2acb051213c9aaefab7a.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css">
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://gyrocode.github.io/jquery-datatables-alphabetSearch/1.2.2/css/dataTables.alphabetSearch.css">
  <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-alphabetSearch/1.2.2/js/dataTables.alphabetSearch.min.js"></script>
  <meta charset="utf-8">
  <title>We Love So</title>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
  <link rel="stylesheet" href="{{ asset('css/map.css') }}">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js" ></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>
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
	<br><br>
	@yield('content')
</body>
</html>
