<?php
  require('../connect.php');
?>
  <head>
    <title>Market</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <script src='js/jquery-3.2.1.min.js'></script>
    <style>
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

    .options{
      display:inline-block;
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
          <input type='text' id='searchthis' name='latlng' placeholder='Where to go?'>
          <input type'text' id='hiddentext' name='hideme'>
          <button name='sub' type='submit' id='sub_me'>Search</button>
        </form>
      </div>
    </div>

    <!-- contents of the body or LIST OF POOLS availalbe -->
    <div id = 'list'>

      <?php 

          // search for all existing routes in the table and FIND if the user owns any
          $q = "SELECT route_id as `r_id` FROM route WHERE status != 'FINISHED'";
          $result = mysqli_query($conn,$q);
          $rows = mysqli_num_rows($result);
          $numberOfRoutes = 0 ;
          if($rows != 0){ //checks if there are any ROUTES  (pools) ongoing
            while($data = mysqli_fetch_assoc($result)){


                //gets all the necessary data from database given that you OWN THE ROUTE

                $queryThree = "SELECT 
                    t1.pool_id, t1.route_origlat, t1.route_origlong, t1.route_destlat, t1.route_destlong, t1.route_id, t1.route_cost, t1.route_status, t1.add_orig, t1.add_dest, t2.num_users

                                FROM
                                (SELECT p.pool_id as `pool_id`, r.origin_latitude as `route_origlat`, r.origin_longitude as `route_origlong`, r.destination_latitude as `route_destlat`,
                                r.destination_longitude as `route_destlong`, r.route_id as `route_id`, r.cost as `route_cost`, r.status as `route_status`, r.origin_address as `add_orig`,
                                r.destination_address as `add_dest`
                                 FROM route r, pool p, users u
                                 WHERE p.user_id = u.user_id AND p.route_id = r.route_id AND r.route_id = {$data['r_id']} AND p.user_id = {$_SESSION['id']} AND r.status!='FINISHED') t1
                                 INNER JOIN
                                 (SELECT route_id, COUNT(*) as num_users FROM pool GROUP BY route_id) t2
                                 ON t1.route_id = t2.route_id";
                $resultQuery = mysqli_query($conn,$queryThree);


                if(mysqli_num_rows($resultQuery) != 0){
                    $numberOfRoutes++;
                    $poolData = mysqli_fetch_assoc($resultQuery); //since also, only one result set

                    // these are the necessary data for pools
                    echo "<div class='row showborder latlongdata' id='info'>";
                    echo "<div class='col-xs-offset-2 col-xs-8'>";
                      echo "<p class='originlatlong'>Trip Origin: {$poolData['add_orig']}</p>";
                      echo "<p class='destlatlong'>Trip Destination: {$poolData['add_dest']}</p>";
                      echo "<p class='num_user_pool'>Number of sharers: {$poolData['num_users']}</p>";
                      echo "<p class='cost'>Trip cost: {$poolData['route_cost']}</p>";
                      echo "<p class='status'>Pool Status: {$poolData['route_status']}</p>";
                      echo "<p class='pool_id'>Route ID: {$poolData['route_id']}</p>";

                      //INSERT MESSAGE MODULE
                      echo "<form method='POST' action ='#' class='options'>";
                        echo "<input type='text' value={$poolData['route_id']} name='route_id' class='hiddeninput'>";
                        echo "<input type='text' value={$poolData['pool_id']} name='pool_id' class='hiddeninput'>";
                        echo "<a href='".BASE_URL."messaging/".$_SESSION['id']."/".$poolData['pool_id']."'><button type=\"button\" class='btn btn-primary' name=''>Message Group</button></a>";
                      echo "</form>";

                      //finds the minimum pool_id to determine what user created the ROUTE
                      $query = "SELECT MIN(pool_id) as `pool_id`, user_id, route_id FROM pool WHERE route_id = {$data['r_id']}";
                      $result2 = mysqli_query($conn,$query);
                      $info = mysqli_fetch_assoc($result2); //since it's always going to be one result only
                      $ownerId = $info['user_id']; //checks if you own the route

                      if($ownerId == $_SESSION['id']){

                      //INSERT UPDATE MODULE
                      echo "<form method='POST' action ='".BASE_URL."route/update_src.php' class='options'>";
                        echo "<input type='text' value={$poolData['route_id']} name='route_id' class='hiddeninput'>";
                        echo "<input type='text' value={$poolData['pool_id']} name='pool_id' class='hiddeninput'>";
                        echo "<button class='btn btn-success' name='submitme'>Edit</button>";
                      echo "</form>";

                      //INSERT DELETE MODULE
                      echo "<form method='POST' action ='".BASE_URL."route/delete.php' class='options'>";
                        echo "<input type='text' value={$poolData['route_id']} name='route_id' class='hiddeninput'>";
                        echo "<input type='text' value={$poolData['pool_id']} name='pool_id' class='hiddeninput'>";
                        echo "<button class='btn btn-danger' name='submitme'>Delete  Pool</button>";
                      echo "</form>";

                      echo "<form method='POST' action='".BASE_URL."route/updateRouteStatus.php' class='options'>";
                        echo "<input type='text' value={$poolData['route_id']} name='route_id' class='hiddeninput'>";
                        echo "<button class='btn btn-primary' type='submit'>Finish</button>";
                      echo "</form>";


                    }
                    echo "</div>";
                    echo "</div>";
                  }
            }
          }


           if($numberOfRoutes == 0){

            //if there exist no route that you created, this option is prompted
            echo "<div class='row'>";
            echo "<center><p class='h1'>You do not currently own a pool.</center>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<center><a href='".BASE_URL."market/testmarket.php'><button class='btn btn-success'>Create Pool</button></a></center>";
            echo "</div>";
          }
      ?>
    </div>
    <h2><a href = "<?php echo BASE_URL ; ?>/login/welcome.php">Back</a></h2>
  </div>
  <div id="map"></div>
    <script>
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
