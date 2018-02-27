<?php
	require "../connect.php";
?> 
<!DOCTYPE html>

<html lang="en">
<head>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="utf-8">
<title>Create a Route</title>
<link rel='stylesheet' href='css/bootstrap.min.css'>
<link rel='stylesheet' href='css/general_style.css' />
<link rel='stylesheet' href='../assets/css/global.css' />
<style>
	#map {
		height: 85vh;
	}
</style>
</head>
<body>
<?php
		include('../main.php');
		include('../core/alerts.php');
?>
        
<div class="container-fluid">
<div class="row">
	<div class="col-xs-12">
		<form method="POST" action="create_dest.php">
			<input type="hidden" name="srcLat" class="form-control" id="srcLat">
			<input type="hidden" name="srcLong" class="form-control" id="srcLong">
			<input type="hidden" name="currentLong" value="<?php echo $userLocation->longitude ; ?>" class="form-control" id="currentLong">
			<input type="hidden" name="currentLat" value="<?php echo $userLocation->latitude ; ?>" class="form-control" id="currentLat">
			<div id="map"></div>
			<div class='get-location'>
				<button type="button" class="btn btn-info" id="curr_loc">Get current location</button>
			</div>
			<div class='next'>
				<button type="submit" class="btn btn-success"><i class='fa fa-angle-right'></i></button>
			</div>
			<div class="form-group pick-place">
				<input type="text" name="source" class="form-control" id="source" placeholder="Search for Place" required>
			</div>
		</form>
	</div>
</div>
</div>
<script>
	// Note: This requires that you consent to location sharing when
	// prompted by ` browser. If you see the error "The Geolocation service
	// failed.", it means you probably did not give permission for the browser to
	// locate you.
	var map, infoWindow, geocoder, autoComplete;
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
		autoComplete = new google.maps.places.Autocomplete(input, options);
		map.controls.push(input);
		// Brute Force: Prevents user from inputting bogus text with enter, still possible by clicking submit button
		google.maps.event.addDomListener(input, 'keydown', function(e) { 
			if (e.keyCode == 13){
				e.preventDefault();
			}
		});
		var marker = new google.maps.Marker({
			map: map,
			anchorPoint: new google.maps.Point(0, -29)
        });
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        autoComplete.addListener('place_changed', function(){
			marker.setVisible(false);
			
			var place = autoComplete.getPlace();
			if (!place.geometry) {
				// User entered the name of a Place that was not suggested and
				// pressed the Enter key, or the Place Details request failed.
				window.alert("Error: '" + place.name + "' is invalid. Please choose one of the choices.");
				return false;
			}
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good.
			}
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);
			
			// For db
			document.getElementById('srcLat').setAttribute('value', place.geometry.location.lat());
			document.getElementById('srcLong').setAttribute('value', place.geometry.location.lng());
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBOsw4rpr5IU_mQEmRbiz1EMA3YCtpPaw&callback=initMap&libraries=places&v2"></script>

</body>
</html>