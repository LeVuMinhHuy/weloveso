<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>We Love So</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	<link rel="stylesheet" href="{{ asset('css/map.css') }}">
</head>
<body>
<div id="map"></div>
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
<!-- 	@yield('scripts') -->

<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        var uluru = { lat: 10.926098, lng: 108.117153 };
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), { zoom: 4, center: uluru });
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({ position: uluru, map: map });
    }
</script>
<!--Load the API from the specified URL
        * The async attribute allows the browser to render the page while the API loads
        * The key parameter will contain your own API key (which is not needed for this tutorial)
        * The callback parameter executes the initMap() function
        -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDE6mak8vRPX2MEe36G6fghiNej9vTBl6c&callback=initMap">
</script>
</body>
</html>