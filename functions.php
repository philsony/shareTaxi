<?php

function getUserLocation() {
    
            $ip = $_SERVER['REMOTE_ADDR'];
            
 
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