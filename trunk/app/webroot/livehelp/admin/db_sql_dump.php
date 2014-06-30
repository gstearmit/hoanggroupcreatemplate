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
include('../include/database.php');
include('../include/class.mysql.php');
include('../include/class.cookie.php');
include('../include/config.php');
include('../include/auth.php');

if ($current_privilege > 1){
	header('Location: ./denied.php');
	exit();
}

$current_date = date('D M j G:i:s Y');
$dump_buffer = '';

$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# stardevelop LiveHelp SQL dump\n";
$dump_buffer .= "# Created: $current_date\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";


$dump_buffer .= "\n";
$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# $table_prefix" . "administration table data dump\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";

$query = "SELECT * FROM " . $table_prefix . "administration";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
			$id = $row['id'];
			$user = $row['user'];
			$username = $row['username'];
			$datetime = $row['datetime'];
			$message = $row['message'];
			$align = $row['align'];
			$status = $row['status'];
			
			$dump_buffer .= "INSERT INTO `" . $table_prefix . "administration` VALUES ('$id', '$user', '$username', '$datetime', '$message', '$align', '$status'" . ' );' . "\n";
		}
	}
}

$dump_buffer .= "\n";
$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# $table_prefix" . "commands table data dump\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";

$query = "SELECT * FROM " . $table_prefix . "commands";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
			$id = $row['id'];
			$type = $row['type'];
			$description = $row['description'];
			$contents = $row['contents'];
		
			$dump_buffer .= "INSERT INTO `" . $table_prefix . "commands` VALUES ('$id',  '$type',  '$description',  '$contents'" . ' );' . "\n";
		}
	}
}

$dump_buffer .= "\n";
$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# $table_prefix" . "messages table data dump\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";

$query = "SELECT * FROM " . $table_prefix . "messages";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
			$id = $row['id'];
			$session = $row['session'];
			$username = $row['username'];
			$datetime = $row['datetime'];
			$message = $row['message'];
			$align = $row['align'];
			$status = $row['status'];
			
			$dump_buffer .= "INSERT INTO `" . $table_prefix . "messages` VALUES ('$id', '$session', '$username', '$datetime', '$message', '$align', '$status'" . ' );' . "\n";
		}
	}
}

$dump_buffer .= "\n";
$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# $table_prefix" . "requests table data dump\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";

$query = "SELECT * FROM " . $table_prefix . "requests";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
		$id = $row['id'];
		$ipaddress = $row['ipaddress'];
		$useragent = $row['useragent'];
		$resolution = $row['resolution'];
		$datetime = $row['datetime'];
		$request = $row['request'];
		$refresh = $row['refresh'];
		$url = $row['url'];
		$title = $row['title'];
		$referrer = $row['referrer'];
		$path = $row['path'];
		$initiate = $row['initiate'];
		$status = $row['status'];
	
		$dump_buffer .= "INSERT INTO `" . $table_prefix . "requests` VALUES ('$id', '$ipaddress', '$useragent', '$datetime', '$request', '$refresh', '$url', '$title', '$referrer', '$path'', '$initiate', '$status'" . ' );' . "\n";
		}
	}
}

$dump_buffer .= "\n";
$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# $table_prefix" . "responses table data dump\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";

$query = "SELECT * FROM " . $table_prefix . "responses";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
		$id = $row['id'];
		$contents = $row['contents'];
		
		$dump_buffer .= "INSERT INTO `" . $table_prefix . "responses` VALUES ('$id',  '$contents'" . ' );' . "\n";
		}
	}
}

$dump_buffer .= "\n";
$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# $table_prefix" . "sessions table data dump\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";

$query = "SELECT * FROM " . $table_prefix . "sessions";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
		$id = $row['id'];
		$request = $row['request'];
		$username = $row['username'];
		$datetime = $row['datetime'];
		$refresh = $row['refresh'];
		$email = $row['email'];
		$server = $row['server'];
		$department = $row['department'];
		$rating = $row['rating'];
		$typing = $row['typing'];
		$transfer = $row['transfer'];
		$active = $row['active'];
		
		$dump_buffer .= "INSERT INTO `" . $table_prefix . "sessions` VALUES ('$id', '$request', '$username', '$datetime', '$refresh', '$email', '$server', '$department', '$rating', '$typing', '$transfer', '$active'" . ' );' . "\n";
		}
	}
}

$dump_buffer .= "\n";
$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# $table_prefix" . "settings table data dump\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";

$query = "SELECT * FROM " . $table_prefix . "settings";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
		$id = $row['id'];
		$name = $row['name'];
		$value = $row['value'];
		
		$dump_buffer .= "INSERT INTO `" . $table_prefix . "settings` VALUES ('$id',  '$name',  '$value'" . ' );' . "\n";
		}
	}
}

$dump_buffer .= "\n";
$dump_buffer .= "##################################\n";
$dump_buffer .= "#\n";
$dump_buffer .= "# $table_prefix" . "users table data dump\n";
$dump_buffer .= "#\n";
$dump_buffer .= "##################################\n";

$query = "SELECT * FROM " . $table_prefix . "users";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
		$id = $row['id'];
		$username = $row['username'];
		$password = $row['password'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['email'];
		$department = $row['department'];
		$datetime = $row['datetime'];
		$refresh = $row['refresh'];
		$disabled = $row['disabled'];
		$privilege = $row['privilege'];
		$status = $row['status'];
		
		$dump_buffer .= "INSERT INTO `" . $table_prefix . "users` VALUES ('$id', '$username', '$password', '$firstname', '$lastname', '$email', '$department', '$datetime', '$refresh', '$disabled', '$privilege', '$status'" . ' );' . "\n";
		}
	}
}

if ($_REQUEST['SQL_DUMP'] == true) {
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . DB_NAME . '_dump.sql"');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');
	echo $dump_buffer;
}
?>
