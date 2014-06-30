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

ignore_user_abort(true);

if (!isset($_REQUEST['RATING'])){ $_REQUEST['RATING'] = ''; }

header('Content-type: text/html; charset=utf-8');

if (file_exists('./locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('./locale/' . LANGUAGE_TYPE . '/guest.php');
}
else {
	include('./locale/en/guest.php');
}

$rating = $_REQUEST['RATING'];
if ($rating != '') {
	$query = "UPDATE " . $table_prefix . "sessions SET `rating` = '$rating' WHERE `id` = '$guest_login_id'";
	$SQL->miscquery($query);
	
	if ($_SETTINGS['TRANSCRIPTVISITORALERTS'] == true) {
		$query = "SELECT `id`, `username`, `active` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$id = $row['id'];
			$username = $row['username'];
			$active = $row['active'];
					
			if ($active > 0) {
				$message = "$username has rated the chat session $rating";
					$query = "INSERT INTO " . $table_prefix . "messages (`session`, `username`, `datetime`, `message`, `align`, `status`) VALUES ('$id', '', NOW(), '$message', '2', '-3')";
					$SQL->insertquery($query);
				}
			}
	}
	
	exit();
}
else {
	
	$query = "SELECT `request`, `active` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$operator_login_id = $row['active'];
		$request_id = $row['request'];
		
		if ($operator_login_id != '-1' || $operator_login_id != '-3') {
			$query = "UPDATE " . $table_prefix . "sessions SET `active` = '-1' WHERE `id` = '$guest_login_id'";
			$SQL->miscquery($query);
			$query = "UPDATE " . $table_prefix . "requests SET `initiate` = '0' WHERE `id` = '$request_id'";
			$SQL->miscquery($query);
		}
	}
}
?>