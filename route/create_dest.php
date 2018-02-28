<?php
	require "../connect.php";
	// Redirects unauthorized/unintentional access
	if( !isset($_POST['srcLat']) || !isset($_POST['srcLong']) ){
		header('location:create_src.php');
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="utf-8">
<title>Create a Route</title>
<link rel='stylesheet' href='css/bootstrap.min.css'>
<link rel='stylesheet' href='../assets/css/global.css' />
<link rel='stylesheet' href='css/general_style.css' />
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
<div class="container">
<!-- Content -->
<div class="row">
	<div class="col-xs-12">
	<!-- Actual Form -->
		<form method="POST" action="create.php"> 
			<input type="hidden" name="destLat" class="form-control" id="destLat">
			<input type="hidden" name="destLong" class="form-control" id="destLong">
			<input type="hidden" name="source" class="form-control" id="source">
			<input type="hidden" name="srcLat" class="form-control" id="srcLat">
			<input type="hidden" name="srcLong" class="form-control" id="srcLong">
			<div id="map"></div>
			<div class='get-location'>
				<button type="submit" class="btn btn-info"><i class='fa fa-map-marker-alt'></i> Proceed</button>
			</div>
			<div class="form-group pick-place">
				<input type="text" name="destination" class="form-control" id="destination" placeholder="Search for Place" required>
			</div>
		</form>
	<!-- End Form -->


	</div><!-- .col-xs-12 -->
</div><!-- .row -->
</div><!-- .container -->
<script >
	// Note: This requires that you consent to location sharing when
	// prompted by your browser. If you see the error "The Geolocation service
	// failed.", it means you probably did not give permission for the browser to
	// locate you.
	var map, infoWindow, geocoder, autoComplete;
	// Previous Data
	prepareSourceDataForTransmission();
	// Initializing the map
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 10.3541, lng: 123.9116}, // Default USC Talamban Campus
			zoom: 18
		});
		
		var input = document.getElementById('destination');
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
			document.getElementById('destLat').setAttribute('value', place.geometry.location.lat());
			document.getElementById('destLong').setAttribute('value', place.geometry.location.lng());
        });
	}
	
	// If user clicks "Your current location"
	// Google takes his latlong and updates the map
	// Also places the address inside the input box
	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
						  'Error: The Geolocation service failed.' :
						  'Error: Your browser doesn\'t support geolocation.');
		infoWindow.open(map);	
	}
	
	function prepareSourceDataForTransmission(){
		var srcLat	= "<?php echo $_POST['srcLat'] ?>",
			srcLong = "<?php echo $_POST['srcLong'] ?>",
			source	= "<?php echo $_POST['source'] ?>";
			
		document.getElementById('srcLat').setAttribute('value', srcLat);
		document.getElementById('srcLong').setAttribute('value', srcLong);
		document.getElementById('source').setAttribute('value', source);
	}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBOsw4rpr5IU_mQEmRbiz1EMA3YCtpPaw&callback=initMap&libraries=places"></script>
</body>
</html>
