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

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ORIGIN'])) {
		header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 1728000');
		header("Content-Length: 0");
		header("Content-Type: text/plain");
		exit();
	} else {
		header("HTTP/1.1 403 Access Forbidden");
		header("Content-Type: text/plain");  
		exit();
	}
}

if (!isset($_SERVER['HTTP_REFERER'])){ $_SERVER['HTTP_REFERER'] = ''; }
if (!isset($_REQUEST['JS'])){ $_REQUEST['JS'] = false; }
if (!isset($_REQUEST['TRACKER'])){ $_REQUEST['TRACKER'] = false; }
if (!isset($_REQUEST['CALLBACK'])){ $_REQUEST['CALLBACK'] = false; }
if (!isset($_REQUEST['DEPARTMENT'])){ $_REQUEST['DEPARTMENT'] = ''; }
if (!isset($_REQUEST['SERVER'])){ $_REQUEST['SERVER'] = ''; }

$installed = false;
$database = include('./database.php');
if ($database) {
	include('./spiders.php');
	include('./class.mysql.php');
	include('./class.cookie.php');
	$installed = include('./config.php');
	include('./functions.php');
} else {
	$installed = false;
}

if ($installed == false && !$_REQUEST['CALLBACK']) {
	include('./settings.php');
	header('Content-type: image/gif');
	if (@readfile('../../../' . $online_install_logo) == false) {
			header('Location: ../../../' . $online_install_logo);
	}
	exit();
}

$javascript = $_REQUEST['JS'];
$tracker = $_REQUEST['TRACKER'];
$callback = $_REQUEST['CALLBACK'];
$department = $_REQUEST['DEPARTMENT'];

$available = 0;
$hidden = 0;
$online = 0;
$away = 0;
$brb = 0;

// Counts the total number of support users within each Online/Offline/BRB/Away status mode
if ((float)$_SETTINGS['SERVERVERSION'] >= 3.80) { // iPhone PUSH Supported
	$query = "SELECT `username`, `status`, `department` FROM " . $table_prefix . "users WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) OR `device` <> ''";
} else {
	$query = "SELECT `username`, `status`, `department` FROM " . $table_prefix . "users WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND)";
}
$rows = $SQL->selectall($query);
if(is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			if($department != '' && $_SETTINGS['DEPARTMENTS']) {
				// Department Array
				$departments = array_map('trim', explode(';', $row['department']));
				if (array_search($department, $departments) !== false) {
					switch ($row['status']) {
						case 0: // Offline - Hidden
							$hidden++;
							break;
						case 1: // Online
							$online++;
							break;
						case 2: // Be Right Back
							$brb++;
							break;
						case 3: // Away
							$away++;
							break;
					}
				}
			}
			else {
				switch ($row['status']) {
					case 0: // Offline - Hidden
						$hidden++;
						break;
					case 1: // Online
						$online++;
						break;
					case 2: // Be Right Back
						$brb++;
						break;
					case 3: // Away
						$away++;
						break;
				}
			}	
		}
	}
}

$available = $online + $away + $brb;

if ($javascript == true || $tracker == true) {

	if (!isset($_SERVER['DOCUMENT_ROOT'])){ $_SERVER['DOCUMENT_ROOT'] = ''; }
	if (!isset($_REQUEST['TITLE'])){ $_REQUEST['TITLE'] = ''; }
	if (!isset($_REQUEST['URL'])){ $_REQUEST['URL'] = ''; }
	if (!isset($_REQUEST['INITIATE'])){ $_REQUEST['INITIATE'] = ''; }
	if (!isset($_REQUEST['REFERRER'])){ $_REQUEST['REFERRER'] = ''; }
	if (!isset($_REQUEST['WIDTH'])){ $_REQUEST['WIDTH'] = ''; }
	if (!isset($_REQUEST['HEIGHT'])){ $_REQUEST['HEIGHT'] = ''; }
	
	$title = substr($_REQUEST['TITLE'], 0, 150);
	$url = $_REQUEST['URL'];
	$initiate = $_REQUEST['INITIATE'];
	$referrer = $_REQUEST['REFERRER'];
	$width = $_REQUEST['WIDTH'];
	$height = $_REQUEST['HEIGHT'];
	
	$ipaddress = gethostbyaddr(ip_address());
	$useragent = substr($_SERVER['HTTP_USER_AGENT'], 0, 200);
	
	$totalpages = 0;
	
	$request_initiated = false;
	ignore_user_abort(true);

	// AJAX Cross-site Headers
	if (isset($_SERVER['HTTP_ORIGIN'])) {
		header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
		header('Access-Control-Allow-Credentials: true');
	}

	// HTTP/1.1
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	
	// HTTP/1.0
	header('Pragma: no-cache');

	if ($request_id > 0) {
	
		// Select the Initiate flag to check if an Administrator has initiated the user with a Support request
		$query = "SELECT `initiate`, `status`, `path` FROM " . $table_prefix . "requests WHERE `id` = '$request_id'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$request_initiate_flag = $row['initiate'];
			$request_status = $row['status'];
			$request_path = $row['path'];
			
			if ($request_initiate_flag > 0 || $request_initiate_flag == -1) { $request_initiated = true; }
			$previouspath = explode('; ', $request_path);
			$totalpages = count($previouspath);

			if (isset($_SETTINGS['INITIATECHATAUTO']) && $_SETTINGS['INITIATECHATAUTO'] > 0) {
				if (($request_initiate_flag == 0 || $request_initiate_flag == -1) && $online > 0 && $totalpages >= $_SETTINGS['INITIATECHATAUTO']) {
					$request_initiated = true;
				}
			}
	
			if ($initiate != '') {
				// Update Initiate status fields to display the status of the floating popup.
				if ($initiate == 'Opened') {
					// Update request flag to show that the guest user OPENED the Online Chat Request
					$initiate = '-1';
				}
				elseif ($initiate == 'Accepted') {
					// Update request flag to show that the guest user ACCEPTED the Online Chat Request
					$initiate = '-2';
				}
				elseif ($initiate == 'Declined') {
					// Update request flag to show that the guest user DENIED the Online Chat Request
					$initiate = '-3';
				}
				
				if ($url == '' && $title == '') {  // Update current page time
					$query = "UPDATE " . $table_prefix . "requests SET `refresh` = NOW(), `initiate` = '$initiate', `status` = '$request_status' WHERE `id` = '$request_id'";
					$SQL->miscquery($query);
				}
				else {  // Update current page details
					$query = "UPDATE " . $table_prefix . "requests SET `refresh` = NOW(), `request` = NOW(), `initiate` = '$initiate', `url` = '$url', `title` = '$title', `status` = '0' WHERE `id` = '$request_id'";
					$SQL->miscquery($query);
				}
				
			} else {
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
			$session['GUEST_LOGIN_ID'] = 0;
			$session['GUEST_USERNAME'] = '';
			$session['MESSAGE'] = 0;
			$session['OPERATOR'] = '';
			$session['TOTALOPERATORS'] = 0;
			$session['SECURITY'] = '';
			$session['LANGUAGE'] = LANGUAGE_TYPE;
			$session['DOMAIN'] = $cookie_domain;
			
			$COOKIE = new Cookie;
			$data = $COOKIE->encode($session);
			setCookie('LiveHelpSession', $data, false, '/', $cookie_domain, 0);
			
			header('P3P: CP=\'' . $_SETTINGS['P3P'] . '\'');
		}
	}
	
	if ($javascript == true && $request_initiated == true) {
		echo('displayInitiateChat();');
	}

}

// Set Be Right Back active status if all users are in BRB mode inc. Departments
if ($available == $brb && $brb > 0 ) {
	$brb_mode_active = true;
}
else {
	$brb_mode_active = false;
}
// Set Away active status if all users are in Away mode inc. Departments
if ($available == $away && $away > 0 ) {
	$away_mode_active = true;
}
else {
	$away_mode_active = false;
}

if ($online > 0 || $brb_mode_active == 'true' || $away_mode_active == 'true') {
	// Be Right Back Mode
	if ($brb_mode_active == true) {
	
		if ($javascript == true) {
			echo('changeStatus("BRB");');
			exit();
		}
		elseif ($tracker == true) {
			if ($request_initiated == true) {
				LoadTrackerPixel('BeRightBackInitiate.gif');
			} else {
				LoadTrackerPixel('BeRightBack.gif');
			}
		}
	
		if ($callback == true) {
			header('Content-type: image/gif');
			$fp = @fopen('./Hidden.gif', 'rb');
			if ($fp == false) {
				header('Location: ' . $_SETTINGS['URL'] . './tienthoi/livehelp/include/Hidden.gif');
			} else {
				$contents = fread($fp, filesize('./Hidden.gif'));
				echo($contents);
			}
			fclose($fp);
			exit();
		}
	
		header('Content-type: image/gif');
		if (substr($_SETTINGS['BERIGHTBACKLOGO'], 0, 5) == 'http://' || substr($_SETTINGS['BERIGHTBACKLOGO'], 0, 6) == 'https://') {
			if ($server != '' && ini_get('allow_url_fopen') == true) {
				$fp = @fopen('../../' . $_SETTINGS['BERIGHTBACKLOGO'], 'rb');
				if ($fp == false) {
					header('Location: ' . $_SETTINGS['URL'] . $_SETTINGS['BERIGHTBACKLOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['BERIGHTBACKLOGO']));
					echo($contents);
				}
				fclose($fp);
			}
			else {
				$fp = @fopen('../../' . $_SETTINGS['BERIGHTBACKLOGO'], 'rb');
				if ($fp == false) {
					header('Location: ../../' . $_SETTINGS['BERIGHTBACKLOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['BERIGHTBACKLOGO']));
					echo($contents);
				}
				fclose($fp);
			}
		} else {
			header('Location: ' . $_SETTINGS['BERIGHTBACKLOGO']);
		}
		exit();
	} // Away Mode
	elseif ($away_mode_active == true) {
	
		if ($javascript == true) {
			echo('changeStatus("Away");');
			exit();
		}
		elseif ($tracker == true) {
			if ($request_initiated == true) {
				LoadTrackerPixel('AwayInitiate.gif');
			} else {
				LoadTrackerPixel('Away.gif');
			}
		}
		
		if ($callback == true) {
			header('Content-type: image/gif');
			$fp = @fopen('./Hidden.gif', 'rb');
			if ($fp == false) {
				header('Location: ' . $_SETTINGS['URL'] . './tienthoi/livehelp/include/Hidden.gif');
			} else {
				$contents = fread($fp, filesize('./Hidden.gif'));
				echo($contents);
			}
			fclose($fp);
			exit();
		}
	
		header('Content-type: image/gif');
		if (substr($_SETTINGS['AWAYLOGO'], 0, 5) == 'http://' || substr($_SETTINGS['AWAYLOGO'], 0, 6) == 'https://') {
			if ($server != '' && ini_get('allow_url_fopen') == true) {
				$fp = @fopen('../../' . $_SETTINGS['AWAYLOGO'], 'rb');
				if ($fp == false) {
					header('Location: ' . $_SETTINGS['URL'] . $_SETTINGS['AWAYLOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['AWAYLOGO']));
					echo($contents);
				}
				fclose($fp);
			}
			else {
				$fp = @fopen('../../' . $_SETTINGS['AWAYLOGO'], 'rb');
				if ($fp == false) {
					header('Location: ../../' . $_SETTINGS['AWAYLOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['AWAYLOGO']));
					echo($contents);
				}
				fclose($fp);
			}
		} else {
			header('Location: ' . $_SETTINGS['AWAYLOGO']);
		}
		exit();
	}
	else { // Online
	
		if ($javascript == true) {
			echo('changeStatus("Online");');
			exit();
		}
		elseif ($tracker == true) {
			if ($request_initiated == true) {
				LoadTrackerPixel('OnlineInitiate.gif');
			} else {
				LoadTrackerPixel('Online.gif');
			}
		}
		
		if ($callback == true) {
			$_SETTINGS['CALLBACKLOGO'] = '/tienthoi/livehelp/locale/en/images/Callback.gif';
			header('Content-type: image/gif');
			if ($server != '' && ini_get('allow_url_fopen') == true) {
				$fp = @fopen('../../' . $_SETTINGS['CALLBACKLOGO'], 'rb');
				if ($fp == false) {
					header('Location: ' . $_SETTINGS['URL'] . $_SETTINGS['CALLBACKLOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['CALLBACKLOGO']));
					echo($contents);
				}
				fclose($fp);
			}
			else {
				$fp = @fopen('../../' . $_SETTINGS['CALLBACKLOGO'], 'rb');
				if ($fp == false) {
					header('Location: ../../' . $_SETTINGS['CALLBACKLOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['CALLBACKLOGO']));
					echo($contents);
				}
				fclose($fp);
			}
			exit();
		}
	
		header('Content-type: image/gif');
		if (substr($_SETTINGS['ONLINELOGO'], 0, 5) == 'http://' || substr($_SETTINGS['ONLINELOGO'], 0, 6) == 'https://') {
			if ($server != '' && ini_get('allow_url_fopen') == true) {
				$fp = @fopen('../../' . $_SETTINGS['ONLINELOGO'], 'rb');
				if ($fp == false) {
					header('Location: ' . $_SETTINGS['URL'] . $_SETTINGS['ONLINELOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['ONLINELOGO']));
					echo($contents);
				}
				fclose($fp);
			}
			else {
				$fp = @fopen('../../' . $_SETTINGS['ONLINELOGO'], 'rb');
				if ($fp == false) {
					header('Location: ../../' . $_SETTINGS['ONLINELOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['ONLINELOGO']));
					echo($contents);
				}
				fclose($fp);
			}
		} else {
			header('Location: ' . $_SETTINGS['ONLINELOGO']);
		}
		exit();
	}
}
else {

	if ($javascript == true) {
		if ($hidden > 0) {
			echo('changeStatus("Hidden");');
		}
		else {
			echo('changeStatus("Offline");');
		}
		exit();
	}
	elseif ($tracker == true) {
		if ($request_initiated == true) {
			LoadTrackerPixel('HiddenInitiate.gif');
		} else {
			LoadTrackerPixel('Hidden.gif');
		}
	}

	if ($callback == true) {
		header('Content-type: image/gif');
		$fp = @fopen('./Hidden.gif', 'rb');
		if ($fp == false) {
			header('Location: ' . $_SETTINGS['URL'] . './tienthoi/livehelp/include/Hidden.gif');
		} else {
			$contents = fread($fp, filesize('./Hidden.gif'));
			echo($contents);
		}
		fclose($fp);
		exit();
	}

	if ($_SETTINGS['OFFLINEEMAIL'] == false) {
		header('Content-type: image/gif');
		if (substr($_SETTINGS['OFFLINEEMAILLOGO'], 0, 5) == 'http://' || substr($_SETTINGS['OFFLINEEMAILLOGO'], 0, 6) == 'https://') {
			if ($server != '' && ini_get('allow_url_fopen') == true) {
				$fp = @fopen('../../' . $_SETTINGS['OFFLINEEMAILLOGO'], 'rb');
				if ($fp == false) {
					header('Location: ' . $_SETTINGS['URL'] . $_SETTINGS['OFFLINEEMAILLOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['OFFLINEEMAILLOGO']));
					echo($contents);
				}
				fclose($fp);
			}
			else {
				$fp = @fopen('../../' . $_SETTINGS['OFFLINEEMAILLOGO'], 'rb');
				if ($fp == false) {
					header('Location: ../../' . $_SETTINGS['OFFLINEEMAILLOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['OFFLINEEMAILLOGO']));
					echo($contents);
				}
				fclose($fp);
			}
		} else {
			header('Location: ' . $_SETTINGS['OFFLINEEMAILLOGO']);
		}
		exit();
	}
	else {
		header('Content-type: image/gif');
		if (substr($_SETTINGS['OFFLINELOGO'], 0, 5) == 'http://' || substr($_SETTINGS['OFFLINELOGO'], 0, 6) == 'https://') {
			if ($server != '' && ini_get('allow_url_fopen') == true) {
				$fp = @fopen('../../' . $_SETTINGS['OFFLINELOGO'], 'rb');
				if ($fp == false) {
					header('Location: ' . $_SETTINGS['URL'] . $_SETTINGS['OFFLINELOGO']);;
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['OFFLINELOGO']));
					echo($contents);
				}
				fclose($fp);
			}
			else {
				$fp = @fopen('../../' . $_SETTINGS['OFFLINELOGO'], 'rb');
				if ($fp == false) {
					header('Location: ../../' . $_SETTINGS['OFFLINELOGO']);
				} else {
					$contents = fread($fp, filesize('../../' . $_SETTINGS['OFFLINELOGO']));
					echo($contents);
				}
				fclose($fp);
			}
		} else {
			header('Location: ' . $_SETTINGS['OFFLINELOGO']);
		}
		exit();
	}
}

function LoadTrackerPixel($image) {
	$fp = @fopen($image, 'rb');
	if ($fp == false) {
		header('Location: ' . $_SETTINGS['URL'] . '/tienthoi/livehelp/include/' . $image);
	} else {
		$contents = fread($fp, filesize($image));
		echo($contents);
	}
	fclose($fp);
	exit();
}

?>