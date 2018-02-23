<?php
	require "../connect.php";


?> <!DOCTYPE html>


<!DOCTYPE html>

<html lang="en">
<head>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="utf-8">
<title>Create Route | ShareTaxi</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/general_style.css">
<style>
	#map {
		height: 300px;
	}
</style>
</head>
<body>
<div class="container">
<!-- Content -->
<div class="row">
	<div class="col-xs-12">
	<!-- Actual Form -->
		<form method="POST" action="create_dest.php">
			<div class="form-group">
				<label for="user">Origin</label>
				<input type="text" name="source" class="form-control" id="source" placeholder="Search Box" required>
			</div>
			<input type="hidden" name="srcLat" class="form-control" id="srcLat">
			<input type="hidden" name="srcLong" class="form-control" id="srcLong">

			<input type="hidden" name="currentLong" value="<?php echo $userLocation->longitude ; ?>" class="form-control" id="currentLong">
			<input type="hidden" name="currentLat" value="<?php echo $userLocation->latitude ; ?>" class="form-control" id="currentLat">

			<button type="button" class="btn btn-info" id="curr_loc">Your current location</button>
			<div id="map"></div>
			<button type="submit" class="btn btn-success">Next</button>
		</form>
	<!-- End Form -->
		<h2><a href = "<?php echo BASE_URL ; ?>/login/welcome.php">Back</a></h2>
	</div><!-- .col-xs-12 -->
</div><!-- .row -->
</div><!-- .container -->
<script>
	// Note: This requires that you consent to location sharing when
	// prompted by your browser. If you see the error "The Geolocation service
	// failed.", it means you probably did not give permission for the browser to
	// locate you.
	var map, infoWindow, geocoder, searchBox;

	// Initialize the map
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 10.3541, lng: 123.9116}, // Default USC Talamban Campus
			zoom: 18
		});
		
		var input = document.getElementById('source');
		var options = {
			componentRestrictions: {country: "ph"}
		};
		
		infoWindow = new google.maps.InfoWindow;
		geocoder = new google.maps.Geocoder;
		searchBox = new google.maps.places.Autocomplete(input, options);
		map.controls.push(input);

		var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function(){
			var places = searchBox.getPlaces();

			if (places.length == 0) {
				return;
			}

			// Clear out the old markers.
			markers = [];

			// For each place, get the icon, name and location.
			var bounds = new google.maps.LatLngBounds()
			places.forEach(function(place) {
				if (!place.geometry) {
					console.log("Returned place contains no geometry");
					return;
				}
				// Create a marker for each place.
				var pos = {
					lat: place.geometry.location.lat(),
					lng: place.geometry.location.lng()
				};
				// For db
				document.getElementById('srcLat').setAttribute('value', pos.lat);
				document.getElementById('srcLong').setAttribute('value', pos.lng);

				markers.push(new google.maps.Marker({
					map: map,
					title: place.name,
					position: pos
				}));


				if (place.geometry.viewport) {
					// Only geocodes have viewport.
					bounds.union(place.geometry.viewport);
				} else {
					bounds.extend(place.geometry.location);
				}
			});
			map.fitBounds(bounds);
		});
	}
	// If user clicks "Your current location"
	// Google takes his latlong and updates the map
	// Also places the address inside the input box
	document.getElementById("curr_loc").addEventListener('click', function(){
		if (navigator.geolocation) {
		  navigator.geolocation.getCurrentPosition(function(position) {

			var pos = {
			  lat: position.coords.latitude,
			  lng: position.coords.longitude
			};
			// For db
			document.getElementById('srcLat').setAttribute('value', pos.lat);
			document.getElementById('srcLong').setAttribute('value', pos.long);
			// Reverse Geocoding (accepts longlat, returns address)
			geocoder.geocode({'location': pos}, function(results, status) {
				if (status === 'OK') {
					if (results[0]) {
					  // Changes #source input box to the address
					  document.getElementById('source').setAttribute('value', results[0].formatted_address);
					  // Little pop-up
					  infoWindow.setContent(results[0].formatted_address);
					} else {
					  window.alert('No results found');
					}
				} else {
					window.alert('Geocoder failed due to: ' + status);
				}
			});

			infoWindow.setPosition(pos);
			infoWindow.open(map, marker);
			map.setCenter(pos);
			var marker = new google.maps.Marker({
				position: pos,
				map: map,
			});
		  }, function() {
			handleLocationError(true, infoWindow, map.getCenter());
		  });
		} else {
		  // Browser doesn't support Geolocation
		  handleLocationError(false, infoWindow, map.getCenter());
		}
	});

	function getLocationFromIp(){

      var location = "<?php echo $userLocation->city ; ?>,<?php echo $userLocation->region_name ; ?>,<?php echo $userLocation->country_name ; ?> ";
			map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: <?php echo $userLocation->latitude ; ?>, lng: <?php echo $userLocation->longitude ; ?>}, // Default USC Talamban Campus
			zoom: 18
		});


			var pos = {
			  lat: document.getElementById('currentLong').value,
			  lng: document.getElementById('currentLat').value
			};
			// For db
			document.getElementById('srcLat').setAttribute('value', pos.lat);
			document.getElementById('srcLong').setAttribute('value', pos.lng);
      document.getElementById('source').setAttribute('value', location);
			var marker = new window.google.maps.Marker({
				position: pos,
				map: map,
			});


	}


	function handleLocationError(browserHasGeolocation, infoWindow, pos) {

	getLocationFromIp() ;
	/* infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
						  'Error: The Geolocation service failed.' :
						  'Error: Your browser doesn\'t support geolocation.');
		infoWindow.open(map);
	*/ }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBOsw4rpr5IU_mQEmRbiz1EMA3YCtpPaw&callback=initMap&libraries=places&sensor=false&v2"></script>

</body>
</html>
