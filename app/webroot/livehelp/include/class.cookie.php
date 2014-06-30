<?php
/*
stardevelop.com Live Help
International Copyright stardevelop.com

You may not distribute this program in any manner,
modified or otherwise, without the express, written
consent from stardevelop.com

You may make modifications, but only for your own 
use and within the confines of the License Agreement.
All rights reserved.

Selling the code for this program without prior 
written consent is expressly forbidden. Obtain 
permission before redistributing this program over 
the Internet or in any other medium.  In all cases 
copyright and header must remain intact.  
*/

class Cookie {

	function Cookie() {	
	}
	
	function encode($vars) {
		ksort($vars);
		$data = ''; $count = 0; $last = count($vars) - 1;
		foreach($vars as $key => $value) {
			if ($count == $last) {
				$data .= str_replace(';', '%3B', $value);
			} else {
				$data .= str_replace(';', '%3B', $value) . ';';
			}
			$count++;
		}
		return $data;
	}
	
	function decode($data) {
		$array = array();
		list($array['DOMAIN'], $array['GUEST_LOGIN_ID'], $array['GUEST_USERNAME'], $array['LANGUAGE'], $array['MESSAGE'], $array['OPERATOR'], $array['REQUEST'], $array['SECURITY'], $array['TOTALOPERATORS']) = explode(';', $data);

		foreach($array as $key => $value) {
			$array[$key] = str_replace('%3B', ';', $value);
		}
		return $array;
	}
	
	function decodeOperator($data) {
		$array = array();
		list($array['AUTHENTICATION'], $array['LANGUAGE'], $array['MESSAGE'], $array['OPERATORID'], $array['TIMEOUT']) = explode(';', $data);

		foreach($array as $key => $value) {
			$array[$key] = str_replace('%3B', ';', $value);
		}
		return $array;
	}
	
	function decodeOperatorLogin($data) {
		$array = array();
		list($array['PASSWORD'], $array['USERNAME']) = explode(';', $data);

		foreach($array as $key => $value) {
			$array[$key] = str_replace('%3B', ';', $value);
		}
		return $array;
	}

	function decodeGuestLogin($data) {
		$array = array();
		list($array['DEPARTMENT'], $array['EMAIL'], $array['QUESTION'], $array['USER']) = explode(';', $data);

		foreach($array as $key => $value) {
			$array[$key] = str_replace('%3B', ';', $value);
		}
		return $array;
	}
	
}

?>