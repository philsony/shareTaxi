<?php
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