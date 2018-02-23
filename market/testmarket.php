<?php
  require('../connect.php');

?><!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <script src='js/jquery-3.2.1.min.js'></script>
    <style>

    <?php 
       $getLocation = "";
       $getLocationdata= "hidden";
    if($_SESSION['user']['location_longitude'] == 0.00000000 || $_SESSION['user']['location_latitude'] == 0.00000000  ){
       $getLocation = 'hidden' ;
       $getLocationdata= "";
    }
    ?>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        display:none;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .center {
        text-align: center;
      }
    .showborder{
      border:3px solid black;
    }
    .latlongdata{
      display:block;
    }
    .pools:hover{
      cursor:pointer;
    }
    #hiddentext{
      display:none;
    }

    a{
      color:inherit;
    }

    .hiddeninput{
      display:none;
    }


    </style>
  </head>
  <body>
    <?php
      include('../core/alerts.php');
     ?>
  <div class='container-fluid'>
    <div class='row showborder'>
      <!-- go to active pools page -->
      <div class='col-xs-offset-1 col-xs-2 col-md-offset-1 col-md-2 col-lg-offset-1 col-lg-2'>
        <a href='myactive_pools.php'><p class='h4'>Active Pools</p></a>
      </div>
      <!-- go to market page -->
      <div class='col-xs-3 col-xs-offset-1 col-md-3 col-md-offset-2 col-lg-offset-2 col-lg-3 header'>
        <a href='testmarket.php'><p class='h4'>Market</p></a>
      </div>

      <!-- search bar -->
      <div class='col-xs-4 col-md-4 col-lg-4'>
        <form id='searchform' method='POST' action='search.php'>
          <input type='text' id='searchthis' value="" name='latlng' placeholder='Where to go?'>
          <input type'text' id='hiddentext' name='hideme'>
          <button name='sub' type='submit' id='sub_me'>Search</button>
        </form>
      </div>
    </div>

    <!-- contents of the body or LIST OF POOLS availalbe -->
<<<<<<< HEAD
    <div id = 'list'>     <?php
         echo "<div class='row ".$getLocationdata."'>";
          echo "<center><p class='h1'>We need to get your location first</p></center>";
          echo "</div>";
          echo "<div id=\"geolocationButton\" class='row center ".$getLocationdata."'>";
          echo "<center><button onclick=\"getLocation()\" class='btn btn-success'>Click Here to set your location</button></center>";
          echo "</div></br>";
  

        //SEARCHES THE DATABASE FOR THE DATA WITH THE LAT,LNG CODE EQUAL TO THE USER'S CURRENT LAT,LNG CODE. THIS IS THE DEFAULT OF A MARKET
    <div id = 'list'>
        <?php
         echo "<div class='row ".$getLocationdata."'>";
          echo "<center><p class='h1'>We need to get your location first</p></center>";
          echo "</div>";
          echo "<div id=\"geolocationButton\" class='row center ".$getLocationdata."'>";
          echo "<center><button onclick=\"getLocation()\" class='btn btn-success'>Click Here to set your location</button></center>";
          echo "</div></br>";
  

        //SEARCHES THE DATABASE FOR THE DATA WITH THE LAT,LNG CODE EQUAL TO THE USER'S CURRENT LAT,LNG CODE. THIS IS THE DEFAULT OF A MARKET

        $q = "SELECT  (
        (
            ACOS(
                SIN('".$_SESSION['user']['location_latitude']."' * PI() / 180) * SIN(
                    `t1`.`route_origlat` * PI() / 180) + COS('".$_SESSION['user']['location_latitude']."' * PI() / 180) * COS(`t1`.`route_origlat` * PI() / 180) * COS(
                        (
                            '".$_SESSION['user']['location_longitude']."' - `t1`.`route_origlong`
                        ) * PI() / 180)
                    ) * 180 / PI()) * 60 * 1.1515) AS distance
                    
                    , t1.pool_id, t1.route_origlat, t1.route_origlong, t1.route_destlat, t1.route_destlong, t1.route_id, t2.num_users, t1.route_cost, t1.route_status, t1.add_orig, t1.add_dest

                GROUP BY t2.route_id DESC ORDER BY distance";


        //$query_two = "SELECT route_id, COUNT(*) as num_users FROM pool GROUP BY route_id";

        $result = mysqli_query($conn, $q);
        $rows = mysqli_num_rows($result);
        if($rows != 0){ //check if there exists pools in the market
          while($data = mysqli_fetch_assoc($result)){

            //dispalys the necessary data for the pools
            echo "<div class='row showborder latlongdata' id='info'>";
            echo "<div class='col-xs-offset-2 col-xs-8'>";
              echo "<p class='originlatlong'>Trip Origin: {$data['add_orig']}</p>";
              echo "<p class='destlatlong'>Trip Destination: {$data['add_dest']}</p>";
              echo "<p class='num_user_pool'>Number of sharers: {$data['num_users']}</p>";
              echo "<p class='cost'>Trip cost: {$data['route_cost']}</p>";
              echo "<p class='status'>Pool Status: {$data['route_status']}</p>";
              echo "<p class='pool_id'>Pool ID: {$data['pool_id']}</p>";

            echo "<p class='pool_id'>Distance between you and the owner: ".number_format($data['distance'])." KM</p>";


              // allows the user to join a pool, rejects if 4 (doesnt happen anyway since it wont show up here due to SQL restriction of pools sharer > 4)
              echo "<form method='POST' action ='".BASE_URL."market/joinpool.php'>";
                echo "<input type='text' value={$data['route_id']} name='route_id' class='hiddeninput'>";
                echo "<input type='text' value={$data['pool_id']} name='pool_id' class='hiddeninput'>";
                echo "<button class='btn btn-success' name='submitme'>Join Pool</button>";
              echo "</form>";
            echo "</div>";
            echo "</div>";
          }
        }else{

          //prompts when there are no WAITING pools in the market
          echo "<div class='row ".$getLocation."'>";
          echo "<center><p class='h1'>No pools available, sorry.</center>";
          echo "</div>";
          echo "<div class='row ".$getLocation."'>";
          echo "<center><a href='".BASE_URL."route/create_src.php'><button class='btn btn-success'>Create Pool</button></a></center>";
          echo "</div>";


          echo "<div class='row ".$getLocationdata."'>";
          echo "<center><p class='h1'>We need to get your location first</p></center>";
          echo "</div>";
          echo "<div id=\"geolocationButton\" class='row center ".$getLocationdata."'>";
          echo "<center><button onclick=\"getLocation()\" class='btn btn-success'>Click Here to set your location</button></center>";
          echo "</div>";

        }
      ?>
    </div>
  </div>


  <div id="map"></div>

  <script>
      function getLocation() {
          document.getElementById("geolocationButton").innerHTML = '<img src="<?php echo BASE_URL ; ?>assets/images/please_wait.gif"/>';
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(savePosition);
          } else {
              //get The latitude from the IP
              var data =   {latitude: <?php echo $userLocation->latitude ; ?>, longitude: <?php echo $userLocation->longitude ; ?>};
              sendData(data);
          }
      }

     function sendData(data){

       $.ajax({
           url: "<?php echo BASE_URL ; ?>user/updateLocation.php",
           type: "POST",
           data: data,
           success: function(reponse) {
               response = JSON.parse(reponse);
               console.log(response);
               if (response.status == 1) {
                   window.location = response.url;
               }
           }
       });

     }
      function savePosition(position) {
          var data = {
              latitude: position.coords.latitude,
              longitude: position.coords.longitude
          };

          sendData(data);
      }

      var map;
      //this function is used to initialize the API, since we need its geocode function for the convertion of text to LAT,LNG code
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }

      //converts A TEXT to a "LAT,LNG" code FORMAT

  $('#sub_me').click(function(e){
        var geocoder = new google.maps.Geocoder;
        var data = document.getElementById("searchthis").value;
        var latlng = "";
        geocoder.geocode({'address':data}, function(results,status){
          if(status === "OK"){
            var lat = "" + results[0].geometry.location.lat();
            var long = ""+ results[0].geometry.location.lng();

            latlng = lat.concat(",").concat(long);
            document.getElementById("hiddentext").value = latlng;
            $('#searchform').submit();
          }
        });
    return false;
  });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBogPqUY4RKPhqj48exkWL3Ktx0Wy7JW1Q&callback=initMap"
    async defer></script>
  </body>
</html>
