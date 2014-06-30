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
if (!isset($_SERVER['DOCUMENT_ROOT'])){ $_SERVER['DOCUMENT_ROOT'] = ''; }
if (!isset($_REQUEST['TITLE'])){ $_REQUEST['TITLE'] = ''; }
if (!isset($_REQUEST['URL'])){ $_REQUEST['URL'] = ''; }
if (!isset($_REQUEST['INITIATE'])){ $_REQUEST['INITIATE'] = ''; }
if (!isset($_REQUEST['REFERRER'])){ $_REQUEST['REFERRER'] = ''; }
if (!isset($_REQUEST['WIDTH'])){ $_REQUEST['WIDTH'] = ''; }
if (!isset($_REQUEST['HEIGHT'])){ $_REQUEST['HEIGHT'] = ''; }

include('./database.php');
include('./class.mysql.php');
include('./config.php');
include('./functions.php');

$title = substr($_REQUEST['TITLE'], 0, 150);
$url = $_REQUEST['URL'];
$initiate = $_REQUEST['INITIATE'];
$referrer = $_REQUEST['REFERRER'];
$width = $_REQUEST['WIDTH'];
$height = $_REQUEST['HEIGHT'];

$ipaddress = gethostbyaddr(ip_address());
$useragent = substr($_SERVER['HTTP_USER_AGENT'], 0, 200);

$request_initiated = false;
ignore_user_abort(true);

if ($request_id > 0) {

	// Select the Initiate flag to check if an Administrator has initiated the user with a Support request
	$query = "SELECT `initiate`, `status` FROM " . $table_prefix . "requests WHERE `id` = '$request_id'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$request_initiate_flag = $row['initiate'];
		$request_status = $row['status'];
		if ($request_initiate_flag > 0 || $request_initiate_flag == -1){ $request_initiated = true; }

		if ($initiate != '') {
			// Update Initiate status fields to display the status of the floating popup.
			if ($initiate == 'Opened') {
				// Update request flag to show that the guest user OPENED the Online Chat Request
				$query = "UPDATE " . $table_prefix . "requests SET `refresh` = NOW(), `initiate` = '-1' WHERE `id` = '$request_id'";
				$SQL->miscquery($query);
			}
			elseif ($initiate == 'Accepted') {
				// Update request flag to show that the guest user ACCEPTED the Online Chat Request
				$query = "UPDATE " . $table_prefix . "requests SET `refresh` = NOW(), `initiate` = '-2' WHERE `id` = '$request_id'";
				$SQL->miscquery($query);
			}
			elseif ($initiate == 'Declined') {
				// Update request flag to show that the guest user DENIED the Online Chat Request
				$query = "UPDATE " . $table_prefix . "requests SET `refresh` = NOW(), `initiate` = '-3' WHERE `id` = '$request_id'";
				$SQL->miscquery($query);
			}
			
			header('Content-type: image/gif');
			$fp = @fopen('Hidden.gif', 'rb');
			if ($fp == false) {
				header('Location: ' . $_SETTINGS['URL'] . '/livehelp/include/Hidden.gif');
			} else {
				$contents = fread($fp, filesize('Hidden.gif'));
				echo($contents);
			}
			fclose($fp);
			exit();
		}

		if ($url == '' && $title == '') {  // Update current page time
			$query = "UPDATE " . $table_prefix . "requests SET `refresh` = NOW(), `status` = '$request_status' WHERE `id` = '$request_id'";
			$SQL->miscquery($query);
		}
		else {  // Update current page details
			$query = "UPDATE " . $table_prefix . "requests SET `refresh` = NOW(), `request` = NOW(), `url` = '$url', `title` = '$title', `status` = '0' WHERE `id` = '$request_id'";
			$SQL->miscquery($query);
		}
	
	}
	
}
elseif ($request_id != '') {

	if ($width != '' && $height != '' && $url != '') {
	
		$page = $_REQUEST['URL'];
		for ($i = 0; $i < 3; $i++) {
			$pos = strpos($page, '/');
			if ($pos === false) {
				$page = '';
				break;
			}
			if ($i < 2) {
				$page = substr($page, $pos + 1);
			}
			elseif ($i >= 2) {
				$page = substr($page, $pos);
			}
		}
		if ($page == '') { $page = '/'; }
		$page = urldecode(trim($page));	

		// Update the current URL statistics within the requests tables
		if ($referrer == '') { $referrer = 'Direct Visit / Bookmark'; }
		
		$country = '';
		if ($_SETTINGS['IP2COUNTRY'] == true) {
			$ip = sprintf("%u", ip2long(ip_address()));
			//$query = "SELECT c.country FROM " . $table_prefix . "countries AS c, " . $table_prefix . "ip2country AS i WHERE c.code = i.code AND i.ip_from <= '$ip' AND i.ip_to >= '$ip'";
			$query = "SELECT code FROM " . $table_prefix . "ip2country WHERE ip_from <= '$ip' AND ip_to >= '$ip' LIMIT 1";
			$row = $SQL->selectquery($query);
			if (is_array($row)){
				$query = "SELECT country FROM  " . $table_prefix . "countries WHERE code = '" . $row['code'] . "' LIMIT 1";
				$row = $SQL->selectquery($query);
				$country = ucwords(strtolower($row['country']));
			}
			else {
				$country = 'Unavailable';
			}
		}
		
		$query = "INSERT INTO " . $table_prefix . "requests(`ipaddress`, `useragent`, `resolution`, `country`, `datetime`, `request`, `refresh`, `url`, `title`, `referrer`, `path`, `initiate`, `status`) VALUES('$ipaddress', '$useragent', '$width x $height', '$country', NOW(), NOW(), NOW(), '$url', '$title', '$referrer', '$page', '0', '0')";
		$request_id = $SQL->insertquery($query);
		
		$session = array();
		$session['REQUEST'] = $request_id;
		$session['LANGUAGE'] = LANGUAGE_TYPE;
		$session['DOMAIN'] = $cookie_domain;
		$data = serialize($session);
		
		setCookie('LiveHelpSession', $data, false, '/', $cookie_domain, 0);
		header('P3P: CP=\'' . $_SETTINGS['P3P'] . '\'');
	}
}


// HTTP/1.1
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);

// HTTP/1.0
header('Pragma: no-cache');

header('Content-type: image/gif');
if ($request_initiated == true) {
	$fp = @fopen('HiddenInitiate.gif', 'rb');
	if ($fp == false) {
		header('Location: ' . $_SETTINGS['URL'] . '/livehelp/include/HiddenInitiate.gif');
	} else {
		$contents = fread($fp, filesize('HiddenInitiate.gif'));
		echo($contents);
	}
	fclose($fp);
}
else {
	$fp = @fopen('Hidden.gif', 'rb');
	if ($fp == false) {
		header('Location: ' . $_SETTINGS['URL'] . '/livehelp/include/Hidden.gif');
	} else {
		$contents = fread($fp, filesize('Hidden.gif'));
		echo($contents);
	}
	fclose($fp);
}
?>