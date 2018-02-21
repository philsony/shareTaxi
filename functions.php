<?php
session_start();


function getUserLocation() {
            $location = null ;
            $ip = $_SERVER['REMOTE_ADDR'];
	          //For dev environment
	          if($ip == "::1"){
           			 $ip = '125.212.56.78';
      			 }
            $url = "http://freegeoip.net/json/$ip";
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $data = curl_exec($ch);
            curl_close($ch);
            
            if ($data) {
                $location = json_decode($data);
							
            }
        
        return $location;

}

	function session_check($arr) {
		$success = true;
		foreach($arr as $mem) {
			if(!isset($_SESSION[$mem])) { 
				$success = false;
				break;
			}
		}
		return $success;
	}
?>

