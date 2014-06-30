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

function htmlSmilies($message, $path) {

	$smilie[0] = ':-)';
	$smilieImage[0] = 'smilie1.gif';
	$smilie[1] = ':-(';
	$smilieImage[1] = 'smilie2.gif';
	$smilie[2] = '$-D';
	$smilieImage[2] = 'smilie3.gif';
	$smilie[3] = ';-P';
	$smilieImage[3] = 'smilie4.gif';
	$smilie[4] = ':-/';
	$smilieImage[4] = 'smilie5.gif';
	$smilie[5] = ':(';
	$smilieImage[5] = 'smilie6.gif';
	$smilie[6] = "8-)";
	$smilieImage[6] = 'smilie7.gif';
	$smilie[7] = ":)";
	$smilieImage[7] = 'smilie8.gif';
	$smilie[8] = ':-|';
	$smilieImage[8] = 'smilie9.gif';
	$smilie[9] = ':--';
	$smilieImage[9] = 'smilie10.gif';
	$smilie[10] = '/-|';
	$smilieImage[10] = 'smilie11.gif';
	$smilie[11] = ':-O';
	$smilieImage[11] = 'smilie12.gif';

	for($i=0; $i < count($smilie); $i++) {
		$message = str_replace($smilie[$i], '<image src="' . $path . $smilieImage[$i] . '" alt="Smilie">', $message);
	}
	return $message;
}

function time_layout($unixtime) {

	global $minutes_label;
	global $hours_label;

	$minutes = (int)($unixtime / 60);
	if ($minutes > 60) {
		$hours = (int)(($unixtime / 60) / 60);
	  	$minutes = (int)(($unixtime / 60) - ($hours * 60));
		
		if ($minutes < 10) {
	  		$minutes = '0' . (int)(($unixtime / 60) - ($hours * 60));
		}
	  
		$seconds = ($unixtime % 60);
		
		if ($seconds < 10) {
	  		$seconds = '0' . ($unixtime % 60);
		}
		return $hours . ':' . $minutes . ':' . $seconds . ' ' . $hours_label;
	}
	else {
		if ($minutes < 10) {
			$minutes = '0' . (int)($unixtime / 60);
		}
		
		$seconds = ($unixtime % 60);
		
		if ($seconds < 10) {
			$seconds = '0' . ($unixtime % 60);
		}
		return $minutes . ':' . $seconds . ' ' . $minutes_label;
	}
}

function pendingUsersPopup($timeout){

	global $table_prefix;
	global $_SETTINGS;
	global $current_department;
	global $SQL;
	
	// PENDING USERS QUERY displays pending users not logged in on users users table depending on department settings
	if ($_SETTINGS['DEPARTMENTS'] == true) {
		$departments_sql = departmentsSQL($current_department);
		$query = "SELECT DISTINCT (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`datetime`)) AS `display` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $timeout SECOND) AND active = '0' AND $departments_sql";
	}
	else {
		$query = "SELECT DISTINCT (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`datetime`)) AS `display` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $timeout SECOND) AND active = '0'";
	}
	$rows = $SQL->selectall($query);
	
	// Initalise user status to false
	$user_status = 'false';
	
	if (is_array($rows)) {
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$display_flag = $row['display'];
				if ($display_flag < $timeout) {
					$user_status = 'true';
				}
			}
		}
	}

	return $user_status;
}

function browsingUsersPopup($timeout){

	global $table_prefix;
	global $SQL;

	// BROWSING USERS QUERY displays browsing users
	$query = "SELECT DISTINCT (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`request`)) AS `display` FROM " . $table_prefix . "requests WHERE (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`request`)) < '$timeout' AND status = '0'";
	$rows = $SQL->selectall($query);

	// Initalise user status to false
	$user_status = 'false';
	
	$count = 0;
	if (is_array($rows)) {
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$display_flag = $row['display'];
			
				if ($display_flag < $timeout) {
					$user_status = 'true';
				}
			}
		}
	}

	return $user_status;
}


function transferredUsersPopup($timeout){

	global $table_prefix;
	global $operator_login_id;
	global $SQL;

	// TRANSFERRED USERS QUERY displays transferred users not loged in on users users table
	$query = "SELECT DISTINCT (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`datetime`)) AS display FROM " . $table_prefix . "sessions WHERE (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`refresh`)) < '$timeout' AND active = '-2' AND `transfer` = '$operator_login_id'";
	$rows = $SQL->selectall($query);

	// Initalise user status to false
	$user_status = 'false';
	
	if (is_array($rows)) {
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$display_flag = $row['display'];
			
				if ($display_flag < $timeout) {
					$user_status = 'true';
				}
			}
		}
	}

	return $user_status;
}

function totalPendingUsers(){

	global $table_prefix;
	global $connection_timeout;
	global $SQL;

	// PENDING USERS QUERY displays pending site visitors
	$query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '0'";
	$row = $SQL->selectquery($query);

	// Initalise user status to false
	$total_users = '0';
	if (is_array($row)) {
		$total_users = $row['count(login_id)'];
	}

	return $total_users;
}

function totalBrowsingUsers(){

	global $table_prefix;
	global $connection_timeout;
	global $SQL;

	// BROWSING USERS QUERY displays browsing users
	$query = "SELECT count(`id`) FROM " . $table_prefix . "requests WHERE (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`refresh`)) < '$connection_timeout'";
	$row = $SQL->selectquery($query);

	// Initalise user status to false
	$total_users = '0';
	if (is_array($row)) {
		$total_users = $row['count(`id`)'];
	}

	return $total_users;
}

function departmentsSQL($department) {

	$multi_departments = split ('[;]', $department);
	$sql = '';
	
	if (is_array($multi_departments)) {
		$i = 0;
		$length = count($multi_departments);
		if ($length > 1) {
			while ($i < $length):
				$department = trim(addslashes($multi_departments[$i]));
				if ($i == 0) {
					$sql = "( `department` = '$department'";
				}
				elseif ($i > 0 && $i < $length - 1) {
					$sql .= " OR `department` = '$department'";
				}
				elseif ($i == $length - 1) {
					$sql .= " OR `department` = '$department' OR `department` = '' )";
				}
				$i++;
			endwhile;
		}
		else {
			$sql = "( `department` = '$department' OR `department` = '' )";
		}
	}
	else {
		$sql = "( `department` = '$department' OR `department` = '' )";
	}
	return $sql;
}


function stripinvalidxml($value) {
	$ret = ''; $current = '';
	$length = strlen($value);
	for ($i=0; $i < $length; $i++) {
		$current = ord($value{$i});
		if (($current == 0x9) || ($current == 0xA) || ($current == 0xD) || (($current >= 0x20) && ($current <= 0xD7FF)) || (($current >= 0xE000) && ($current <= 0xFFFD)) || (($current >= 0x10000) && ($current <= 0x10FFFF))) {
			$ret .= chr($current);
		} else {
			$ret .= '';
		}
	}
	return $ret;
}

function xmlelementinvalidchars($string) {
	$string = str_replace(array('>', '<', '&'), array('&gt;', '&lt;', '&amp;'), $string);
	return stripinvalidxml($string);
}

function xmlattribinvalidchars($string) {
	$string = str_replace(array('>', '<', '"', '&', '\''), array('&gt;', '&lt;', '&quot;', '&amp;', '&apos;'), $string);
	return stripinvalidxml($string);
}

function unixtimestamp($datetime){

	$datetime = explode(" ", $datetime);
	$date = explode("-", $datetime[0]); 
	$time = explode(":", $datetime[1]); 
	unset($datetime);
	
	list($year, $month, $day) = $date;
	list($hour, $minute, $second) = $time;
	
	return mktime(intval($hour), intval($minute), intval($second), intval($month), intval($day), intval($year));
	
}

function ip_public($ip, $array) {
	foreach ($array as $subnet) {
		list($network, $mask) = split('/', $subnet);
		
		$network = str_pad(decbin(ip2long($network)), 32, '0', 'STR_PAD_LEFT');
		$ip = str_pad(decbin(ip2long($ip)), 32, '0', 'STR_PAD_LEFT');

		if (strcmp(substr($network, 0, $mask), substr($ip, 0, $mask)) == 0) {
			return true;
			break;
		}
	}
	return false;
}

function ip_valid($ip) {
	if (($longip = ip2long($ip)) !== false) { 
		if ($ip == long2ip($longip)) { 
			return true;
		}
	}
	return false;
}

function ip_address() {

	$private_networks = array('10.0.0.0/8', '127.0.0.0/8', '172.16.0.0/12', '192.168.0.0/16');

	if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
		$result = preg_match_all('/\d{1,3}[\.]\d{1,3}[\.]\d{1,3}[\.]\d{1,3}/i', $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'], $ip_array);
		if ($result == true) {
			if (is_array($ip_array[0])) {

				$ip_array = $ip_array[0];
				array_push($ip_array, $_SERVER['REMOTE_ADDR']);

				foreach($ip_array as $ip) {
					if ($ip != '' && ip_valid($ip) && ip_public($ip, $private_networks)) {
						return $ip;
						break;
					}
				}
			}
		}
	}
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$result = preg_match_all('/\d{1,3}[\.]\d{1,3}[\.]\d{1,3}[\.]\d{1,3}/i', $_SERVER['HTTP_X_FORWARDED_FOR'], $ip_array);
		if ($result == true) {
			if (is_array($ip_array[0])) {

				$ip_array = $ip_array[0];
				array_push($ip_array, $_SERVER['REMOTE_ADDR']);

				foreach($ip_array as $ip) {
					if ($ip != '' && ip_valid($ip) && ip_public($ip, $private_networks)) {
						return $ip;
						break;
					}
				}
			}
		}
	}
	
	return $_SERVER['REMOTE_ADDR'];

}

if (!function_exists('json_encode')) {

	function json_encode($a = false) {
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		
		if (is_scalar($a)) {
			if (is_float($a)) {
				// Always use "." for floats.
				return floatval(str_replace(",", ".", strval($a)));
			}

			if (is_string($a)) {
				static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
				return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
			}
			else {
				return $a;
			}
		}
		
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
			if (key($a) !== $i) {
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList) {
			foreach ($a as $v) $result[] = json_encode($v);
			return '[' . join(',', $result) . ']';
		} else {
			foreach ($a as $k => $v) $result[] = json_encode($k).':' . json_encode($v);
			return '{' . join(',', $result) . '}';
		}
  }
}


$head = <<<END
<!-- stardevelop.com Live Help International Copyright - All Rights Reserved //-->
<!--  BEGIN stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
<script language="JavaScript" type="text/JavaScript" src="{$_SETTINGS['URL']}/livehelp/include/javascript.php"></script>
<!--  END stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
END;

$body = <<<END
<!-- stardevelop.com Live Help International Copyright - All Rights Reserved //-->
<!--  BEGIN stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
<div id="floatLayer" align="left" style="position:absolute; left:10px; top:10px; visibility:hidden; z-index:5000;">
  <map name="LiveHelpInitiateChatMap" id="LiveHelpInitiateChatMap">
    <area shape="rect" coords="50,210,212,223" href="http://livehelp.stardevelop.com" target="_blank" alt="stardevelop.com Live Help"/>
    <area shape="rect" coords="113,183,197,206" href="#" onclick="openLiveHelp();acceptInitiateChat();return false;" alt="Accept"/>
    <area shape="rect" coords="206,183,285,206" href="#" onclick="declineInitiateChat();return false;" alt="Decline"/>
    <area shape="rect" coords="263,86,301,104" href="#" onclick="declineInitiateChat();return false;" alt="Close"/>
  </map>
  <div id="InitiateText" align="center" style="position:relative; left:30px; top:145px; width:275px; height:35px; z-index:5001; text-align:center; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; color: #000000">Do you have any questions that I can help you with?</div>
  <img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/InitateChat.gif" alt="stardevelop.com Live Help" width="323" height="229" border="0" usemap="#LiveHelpInitiateChatMap"/></div>
<!--  END stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
END;

$image = <<<END
<!-- stardevelop.com Live Help International Copyright - All Rights Reserved //-->
<!--  BEGIN stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
<a href="#" target="_blank" onclick="openLiveHelp(); return false"><img src="{$_SETTINGS['URL']}/livehelp/include/status.php" id="LiveHelpStatus" name="LiveHelpStatus" border="0" alt="Live Help"/></a>
<!--  END stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
END;


?>