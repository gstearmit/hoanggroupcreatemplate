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
include('include/database.php');
include('include/class.mysql.php');
include('include/class.cookie.php');
include('include/config.php');
include('include/functions.php');


function strbytes($str) { 
	
	// Number of characters in string 
	$strlen_var = strlen($str); 
	
	// # Bytes
	$d = 0; 
  
	/* 
	* Iterate over every character in the string, 
	* escaping with a slash or encoding to UTF-8 where necessary 
	*/
	for ($c = 0; $c < $strlen_var; ++$c) { 
	  
		$ord_var_c = ord($str{$d});
		if (($ord_var_c >= 0x20) && ($ord_var_c <= 0x7F)) {
			// characters U-00000000 - U-0000007F (same as ASCII) 
			$d++;
		} else if (($ord_var_c & 0xE0) == 0xC0) {
			// characters U-00000080 - U-000007FF, mask 110XXXXX 
			// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8 
			$d+=2;
		} else if (($ord_var_c & 0xF0) == 0xE0) {
			// characters U-00000800 - U-0000FFFF, mask 1110XXXX 
			// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8 
			$d+=3;
		} else if (($ord_var_c & 0xF8) == 0xF0) { 
			// characters U-00010000 - U-001FFFFF, mask 11110XXX 
			// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8 
			$d+=4;
		} else if (($ord_var_c & 0xFC) == 0xF8) {
			// characters U-00200000 - U-03FFFFFF, mask 111110XX 
			// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8 
			$d+=5;
		} else if (($ord_var_c & 0xFE) == 0xFC) {
			// characters U-04000000 - U-7FFFFFFF, mask 1111110X 
			// see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8 
			$d+=6;
		} else {
			$d++;
		}
	}
  
	return $d; 
}

ignore_user_abort(true);

if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
if (!isset($_REQUEST['STAFF'])){ $_REQUEST['STAFF'] = ''; }
if (!isset($_REQUEST['MESSAGE'])){ $_REQUEST['MESSAGE'] = ''; }
if (!isset($_REQUEST['RESPONSE'])){ $_REQUEST['RESPONSE'] = ''; }
if (!isset($_REQUEST['COMMAND'])){ $_REQUEST['COMMAND'] = ''; }

$id = $_REQUEST['ID'];
$staff = $_REQUEST['STAFF'];
$message = trim($_REQUEST['MESSAGE']);
$response = trim($_REQUEST['RESPONSE']);
$command = trim($_REQUEST['COMMAND']);

// Check if the message contains any content else return headers
if ($message == '' && $response == '' && $command == '') { exit(); }

if (isset($_COOKIE['LiveHelpOperator']) && $id != '') {
	
	$session = array(); $cookie = new Cookie();
	$session = $cookie->decodeOperator($_COOKIE['LiveHelpOperator']);
	
	$operator_login_id = $session['OPERATORID'];
	$operator_authentication = $session['AUTHENTICATION'];
	$language = $session['LANGUAGE'];
	
	if ($operator_login_id != '' && $operator_authentication != '') {
	
		$query = "SELECT `username` FROM " . $table_prefix . "users WHERE `id` = '$operator_login_id' AND `password` = '$operator_authentication'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$current_username = $row['username'];
			
			if ($message != '') {
				// Send messages from POSTed data
				if ($staff) {
					$query = "INSERT INTO " . $table_prefix . "administration (`user`, `username`, `datetime`, `message`, `align`, `status`) VALUES('$id', '$current_username', NOW(), '$message', '1', '1')";
					$SQL->insertquery($query);
				}
				else {
					$query = "INSERT INTO " . $table_prefix . "messages (`session`, `username`, `datetime`, `message`, `align`, `status`) VALUES('$id', '$current_username', NOW(), '$message', '1', '1')";
					$SQL->insertquery($query);
				}
			}
		
			// Format the message string
			$response = trim($response);
		
			if ($response != '') {
				// Send messages from POSTed response data
				$query = "INSERT INTO " . $table_prefix . "messages (`session`, `username`, `datetime`, `message`, `align`, `status`) VALUES ('$id', '$current_username', NOW(), '$response', '1', '1')";
				$SQL->insertquery($query);
			}
			if ($command != '') {
				$query = "SELECT `type`, `name`, `content` FROM " . $table_prefix . "responses WHERE `id` = '$command' AND `type` > 1";
				$row = $SQL->selectquery($query);
				if (is_array($row)) {
					$type = $row['type'];
					$name = $row['name'];
					$content = addslashes($row['content']);
								
					switch ($type) {
						case '2':
							$status = 2;
							$command = addslashes($name . " \r\n " . $content); 
							$operator = '';
							break;
						case '3':
							$status = 3;
							$command = addslashes($name . " \r\n " . $content);
							$operator = '';
							break;
						case '4':
							$status = 4;
							$command = addslashes($content);
							$operator = addslashes('The ' . $name . ' has been PUSHed to the visitor.');
							break;
						case '5':
							$status = 5;
							$command = addslashes($content);
							$operator = addslashes('The ' . $name . ' has been sent to the visitor.');
							break;
					}
					
					if ($command != '') {
						$query = "INSERT INTO " . $table_prefix . "messages (`session`, `username`, `datetime`, `message`, `align`, `status`) VALUES ('$id', '', NOW(), '$command', '2', '$status')";
						if ($operator != '') {
							$query .= ", ('$id', '', NOW(), '$operator', '2', '-1')";
						}
						$SQL->insertquery($query);
					}
					
				}
			}
		}
	}
}
else {
	
	$message = str_replace('<', '&lt;', $message);
	$message = str_replace('>', '&gt;', $message);
	$message = trim($message);
	
	if ($message != '') {
	
		// Send Guest Message
		$query = "INSERT INTO " . $table_prefix . "messages (`session`, `username`, `datetime`, `message`, `align`) VALUES ('$guest_login_id', '$guest_username', NOW(), '$message', '1')";
		$id = $SQL->insertquery($query);

		// iPhone PUSH Alerts
		$query = "SELECT COUNT(`id`) AS total FROM " . $table_prefix . "messages WHERE `session` = '$guest_login_id' AND `status` = '7'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$total = $row['total'];
			if ($total > 0) {
			
				// iPhone PUSH Message Alert
				$query = "SELECT `username`, `active` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
				$row = $SQL->selectquery($query);
				if (is_array($row)) {
				
					// Device ID
					$username = $row['username'];
					$operator = $row['active'];
					
					$query = "SELECT `device` FROM " . $table_prefix . "users WHERE `id` = '$operator'";
					$row = $SQL->selectquery($query);
					if (is_array($row)) {
						$device = $row['device'];
						$devices = array($device);
						
						if (count($devices) > 0) {

							// iPhone APNS PUSH HTTP / HTTPS API
							$key = '20237df3ede04c4daa6657723cd6e62e473c26a0f793ac77ed17f1c14338d2fac9f1ccd8431b6152cad2647c1c04a25b4e7f0ee305c586cfad24aedea8ab34ac';
							
							// APNS Alert Options
							$alert = "$username: $message";

							$length = mb_strlen($alert, 'utf-8');
							$bytes = strbytes(json_encode($alert));
							$shortened = false;
							while ($bytes > 110) { // Max 200 bytes - Russian Cyrillic Issue 110 bytes
								$length--;
								$alert = mb_strcut($alert, 0, $length, 'utf-8');
								$bytes = strbytes(json_encode($alert));
								$shortened = true;
							}
							if ($shortened == true) { $alert .= '...'; }
							$sound = 'Message.wav';
							
							// APNS JSON Payload (Max. Payload 256 bytes)
							$aps = array('alert' => $alert, 'sound' => $sound);
							$json = array('aps' => $aps);
							
							// Web Service Data
							$data = array('key' => $key, 'devices' => $devices, 'payload' => $json);
							$query = json_encode($data);
							$url = 'http://api.stardevelop.com/php-apns/push.php';
							
							/* Test Payload Bytes
							$payload = json_encode($json);
							$bytes = strbytes($payload);
							echo('JSON Bytes: ' . $bytes);
							$apnsmessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device)) . chr(0) . chr(strbytes($payload)) . $payload;
							$bytes = strbytes($apnsmessage);
							echo('Payload Bytes: ' . $bytes);
							*/
							
							// Query Web Service
							$headers = array('Accept: application/json', 'Content-Type: application/json');
							$ch = curl_init($url);
							curl_setopt($ch, CURLOPT_HEADER, $headers);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
							$result = curl_exec($ch);
							curl_close($ch);
						
						}
					}
				}
			}
		}
		
	}
}
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE BLANK PUBLIC>