<?php
  require('../connect.php');

?><!DOCTYPE html>
<html>
  <head>
    <title>Market</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="css/market.css">
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
      
      .setLocation {
            max-width: 243px;
      }
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
    .{
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
      include('../main.php');
      include('../core/alerts.php');
     ?>
    <br>
  <div class='container-fluid'>
    <div class='row'>
      <div class="col-md-10 col-md-offset-1 col-xs-offset-1 col-xs-10">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-5 col-xs-12">
              <a href='testmarket.php'><p class='h4 activelink'>Market</p></a> &nbsp;
              <a href='myactive_pools.php'><p class='h4 activelink'>Active Pools</p></a>
            </div>
            <div class='extendonmobile'></div>
            <div class="col-md-3 col-md-offset-3 col-xs-12">
              <form style='display: inline; text-align: right;' id='searchform' method='POST' action='search.php'>
                <input type='text' id='searchthis' value="" name='latlng' placeholder='Where to go?'>
                <input type'text' id='hiddentext' name='hideme'>
                <button name='sub' type='submit' id='sub_me'>Search</button>
              </form>
            </div>
          </div>
        </div>
        <br><br>
      <div id = 'list'>     <?php
         echo "<div class='row ".$getLocationdata."'>";
          echo "<center><p class='h4'>We need to get your location first</p></center>";
          echo "</div>";
          echo "<div id=\"geolocationButton\" class='row center text-center col-xs-12 ".$getLocationdata."'>";
          echo "<center><button onclick=\"getLocation()\" class='btn btn-success setLocation'>Click here to set your location</button></center>";
          echo "</div><br><br><br>";
  

        $query = "SELECT route_id FROM `pool` WHERE user_id != {$_SESSION['id']}";
        $tryresult = mysqli_query($conn,$query);
        $tryrow = mysqli_num_rows($tryresult);
        if($tryrow == 0){
          $q = "SELECT big1.*, big2.* FROM
                  (SELECT
                   (
                    (
                      ACOS(
                          SIN('".$_SESSION['user']['location_latitude']."' * PI() / 180) * SIN(
                              `t1`.`route_origlat` * PI() / 180) + COS('".$_SESSION['user']['location_latitude']."' * PI() / 180) * COS(`t1`.`route_origlat` * PI() / 180) * COS(
                                  (
                                      '".$_SESSION['user']['location_longitude']."' - `t1`.`route_origlong`
                                  ) * PI() / 180)
                              ) * 180 / PI()) * 60 * 1.1515) AS distance
                              
                              , t1.pool_id, t1.route_origlat, t1.route_origlong, t1.route_destlat, t1.route_destlong, t1.route_id, t2.num_users, t1.route_cost, t1.route_status, t1.add_orig, t1.add_dest
                        FROM
                        (SELECT p.pool_id as `pool_id`, r.origin_latitude as `route_origlat`, r.origin_longitude as `route_origlong`, r.destination_latitude as `route_destlat`, r.destination_longitude as `route_destlong`,
                        r.route_id as `route_id`, r.cost as `route_cost`, r.status as `route_status`, r.origin_address as `add_orig`, r.destination_address as `add_dest`
                        FROM route r, pool p, users u
                        WHERE p.user_id = u.user_id AND p.route_id = r.route_id AND r.status = 'Waiting' and u.user_id != {$_SESSION['id']}) t1
                        INNER JOIN
                          (SELECT route_id, COUNT(*) as num_users
                          FROM pool GROUP BY route_id) t2
                          ON t1.route_id = t2.route_id
                          WHERE t2.num_users < 4
                          GROUP BY t2.route_id DESC ORDER BY distance";
        }else{
        //SEARCHES THE DATABASE FOR THE DATA WITH THE LAT,LNG CODE EQUAL TO THE USER'S CURRENT LAT,LNG CODE. THIS IS THE DEFAULT OF A MARKET
        $q = "SELECT big1.*, big2.* FROM
                (SELECT
                 (
                  (
                    ACOS(
                        SIN('".$_SESSION['user']['location_latitude']."' * PI() / 180) * SIN(
                            `t1`.`route_origlat` * PI() / 180) + COS('".$_SESSION['user']['location_latitude']."' * PI() / 180) * COS(`t1`.`route_origlat` * PI() / 180) * COS(
                                (
                                    '".$_SESSION['user']['location_longitude']."' - `t1`.`route_origlong`
                                ) * PI() / 180)
                            ) * 180 / PI()) * 60 * 1.1515) AS distance
                            
                            , t1.pool_id, t1.route_origlat, t1.route_origlong, t1.route_destlat, t1.route_destlong, t1.route_id, t2.num_users, t1.route_cost, t1.route_status, t1.add_orig, t1.add_dest
                      FROM
                      (SELECT p.pool_id as `pool_id`, r.origin_latitude as `route_origlat`, r.origin_longitude as `route_origlong`, r.destination_latitude as `route_destlat`, r.destination_longitude as `route_destlong`,
                      r.route_id as `route_id`, r.cost as `route_cost`, r.status as `route_status`, r.origin_address as `add_orig`, r.destination_address as `add_dest`
                      FROM route r, pool p, users u
                      WHERE p.user_id = u.user_id AND p.route_id = r.route_id AND r.status = 'Waiting' and u.user_id != {$_SESSION['id']}) t1
                      INNER JOIN
                        (SELECT route_id, COUNT(*) as num_users
                        FROM pool GROUP BY route_id) t2
                        ON t1.route_id = t2.route_id
                        WHERE t2.num_users < 4
                        GROUP BY t2.route_id DESC ORDER BY distance) big1
            LEFT JOIN 
              (SELECT route_id FROM `pool` WHERE user_id != {$_SESSION['id']})big2
            ON big1.route_id = big2.route_id
            GROUP BY big1.route_id";
        }

        //$query_two = "SELECT route_id, COUNT(*) as num_users FROM pool GROUP BY route_id";

        $result = mysqli_query($conn, $q);
        $rows = mysqli_num_rows($result);
        if($rows != 0){ //check if there exists pools in the market
          while($data = mysqli_fetch_assoc($result)){

            //dispalys the necessary data for the pools
            echo "<div class='row  latlongdata' id='info'>";
            echo "<div class='col-xs-offset-2 col-md-6 col-md-offset-3 col-xs-8 box bg-light'>";
              echo "<p class='originlatlong'>From: {$data['add_orig']}</p>";
              echo "<p class='destlatlong'>To: {$data['add_dest']}</p>";
              echo "<p class='num_user_pool'>Sharers: {$data['num_users']}</p>";
              echo "<p class='cost'>Cost: {$data['route_cost']}</p>";
              echo "<p class='status'>Status: {$data['route_status']}</p>";
            echo "<p class='pool_id'>Distance: ".number_format($data['distance'])." KM</p>";

              // allows the user to join a pool, rejects if 4 (doesnt happen anyway since it wont show up here due to SQL restriction of pools sharer > 4)
              echo "<form method='POST' action ='".BASE_URL."market/joinpool.php'>";
                echo "<input type='text' value={$data['route_id']} name='route_id' class='hiddeninput'>";
                echo "<input type='text' value={$data['pool_id']} name='pool_id' class='hiddeninput'>";
                echo "<button class='btn btn-success joinpool' name='submitme'>Join Pool</button>";
              echo "</form>";
            echo "</div>";
            echo "</div>";
          }
        }else{

          //prompts when there are no WAITING pools in the market
          echo "<div class='container-fluid'><div class='row ".$getLocation."'>";
          echo "<center><h4>There are no pools available as of the moment.</h4></center>";
          echo "</div>";
          echo "<center><a href='".BASE_URL."route/create_src.php'><button class='submit' style='width: auto;'>Create a Pool Instead</button></a></center>";

       
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
