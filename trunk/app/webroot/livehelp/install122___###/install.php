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

header('Content-type: text/html; charset=utf-8');

// Check memory limit
$memory = ini_get('memory_limit');
if (substr($memory, 0, -1) >= 32) {
	$memory = true;

}
else {
	$memory = ini_set('memory_limit', '32M');
	if ($memory != '' || !function_exists('memory_get_usage')) { $memory = true; } else { $memory = false; }
}

// Check zlib extension
$zlib = extension_loaded('zlib');

if ($_SERVER['SERVER_PORT'] == '443') {	$protocol = 'https://'; } else { $protocol = 'http://'; }
$install_domain = $protocol . $_SERVER['SERVER_NAME'];

error_reporting(E_ERROR | E_PARSE);
set_time_limit(0);

$configuration = '../include/database.php';

if (isset($_REQUEST['COMPLETE'])) {

	// If Magic Quotes are OFF then addslashes
	if (!get_magic_quotes_gpc()) {
		foreach ($_REQUEST as $key => $value) {
			$_REQUEST[$key] = addslashes($value);
		}
		foreach ($_COOKIE as $key => $value) {
			$_COOKIE[$key] = addslashes($value);
		}
	}
	
	$error = '';
	
	define('DB_HOST', $_REQUEST['DB_HOSTNAME']);
	define('DB_NAME', $_REQUEST['DB_NAME']);
	define('DB_USER', $_REQUEST['DB_USERNAME']);
	define('DB_PASS', $_REQUEST['DB_PASSWORD']);
	
	$table_prefix = $_REQUEST['DB_TABLE_PREFIX'];
	
	$install_domain = $_REQUEST['DOMAIN'];
	$offline_email = $_REQUEST['OFFLINEEMAIL'];
	$ip2country_installed = $_REQUEST['IP2COUNTRY_INSTALLED'];
	if ($ip2country_installed == '') { $ip2country_installed = 0; }
	
	$username = $_REQUEST['USERNAME'];
	$password = $_REQUEST['PASSWORD'];
	$password_retype = $_REQUEST['PASSWORD_RETYPE'];
	
	if (DB_HOST == '' || DB_NAME == '' || DB_USER == '' || DB_PASS == '') {
		$error .= 'Please enter the MySQL hostname, database name, database username and database password.<br/>';
	} else
	
	if ($username == '') {
		$error .= 'The operator details cannot be blank.  Please enter all operator details.<br/>';
	}
	
	if ($password == '') {
		$error .= 'Your Live Help operator passwords cannot be blank, please enter passwords.<br/>';
	}
	
	if ($password != $password_retype) {
		$error .= 'Your Live Help operator password do not match, please enter matching passwords.<br/>';
	}
	
	if ($offline_email == '') {
		$error .= 'Please enter an email address that offline messages will be sent to.<br/>';
	}

	// Connect to mySQL database with provided form information
	if ($error == '') {
		if (function_exists('mysql_connect')) {
			$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or $error .= 'Database Connection ' . mysql_error() . ', please confirm the database settings.<br/>';
			if (mysql_error() == '') {
				$selected = mysql_select_db(DB_NAME, $link) or $error = 'Database Connection ' . mysql_error() . ', please confirm the database settings.<br/>'; 
			}
		}
		else {
		
			$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
			if (mysqli_connect_errno()) {
				$error .= 'Database Connection ' . mysqli_connect_error() . ', please confirm the database settings.<br/>';
			}
			else {
				$selected = mysqli_select_db($link, DB_NAME);
				if (!$selected) {
					$error .= 'The MySQL database does not exist, please confirm the database settings.<br/>';
				}
			}
		}
	}
	
	if ($error == '' && $link && $selected) {
	
		$status = 'Installation successfully connected to your database server.<br/>';
	
		$sqlfile = file('mysql.schema.txt');
		$dump = '';
		foreach ($sqlfile as $key => $line) {
			if (trim($line) != '' && substr(trim($line), 0, 1)!='#') {
				$line = str_replace("prefix_", $table_prefix, $line);
				$dump .= trim($line);
			}
		}
	
		$dump = trim($dump,';');
		$tables = explode(';',$dump);
		
		foreach ($tables as $key => $sql) {
			if (function_exists('mysql_connect')) {
				mysql_query($sql, $link);
			}
			else {
				mysqli_query($link, $sql);
			}
		}
	
		if (function_exists('mysql_connect')) {
			if (mysql_error()) {
				$error .= 'MySQL errors occured when creating the database schema.<br/>';
				$sql_error_status = false;
			}
		}
		else {
			if (mysqli_connect_errno()) {
				$error .= 'MySQL errors occured when creating the database schema.<br/>';
				$sql_error_status = false;
			}
		}

		// Truncate settings
		$query = 'TRUNCATE ' . $table_prefix . 'settings';
		if (function_exists('mysql_connect')) {
			mysql_query($query, $link);
		}
		else {
			mysqli_query($link, $query);
		}

		// Remove .www. if at the start of string
		$domain = $_SERVER['SERVER_NAME'];
		if (substr($domain, 0, 4) == 'www.') {
			$domain = substr($domain, 4);
		}
	
		// Insert the settings data into the database, and alter the offline email address.
		$dump = '';
		$sqlfile = file('mysql.data.settings.txt');
		foreach ($sqlfile as $key => $line) {
			if (trim($line) != '' && substr(trim($line), 0, 1) != '#') {
				$line = str_replace('prefix_', $table_prefix, $line);
				$line = str_replace('enquiry@stardevelop.com', $offline_email, $line);
				$line = str_replace("'Domain', 'stardevelop.com'", "'Domain', '$domain'", $line);
				$line = str_replace('http://livehelp.stardevelop.com', $install_domain, $line);
				$line = str_replace("'IP2Country', '0'", "'IP2Country', '$ip2country_installed'", $line);
				$dump .= trim($line);
			}
		}
		unset($sqlfile);
	
		$dump = trim($dump,';');
		$tables = explode(';',$dump);
		
		foreach ($tables as $key => $sql) {
			if (function_exists('mysql_connect')) {
				mysql_query($sql, $link);
			}
			else {
				mysqli_query($link, $sql);
			}
		}
		unset($tables);
	
		if (function_exists('mysql_connect')) {
			if (mysql_error()) {
				$error .= 'MySQL errors occured when inserting the settings.<br/>';
				$sql_error_status = false;
			}
		}
		else {
			if (mysqli_connect_errno()) {
				$error .= 'MySQL errors occured when inserting the settings.<br/>';
				$sql_error_status = false;
			}
		}

		// Create the country table and insert the country data into the database.
		$dump = '';
		$sqlfile = file('mysql.data.countries.txt');
		foreach ($sqlfile as $key => $line) {
			if (trim($line) != '' && substr(trim($line), 0, 1) != '#') {
				$line = str_replace('prefix_', $table_prefix, $line);
				$dump .= trim($line);
			}
		}
		unset($sqlfile);
		
		$dump = trim($dump,';');
		$tables = explode(';', $dump);
		
		foreach ($tables as $key => $sql) {
			if (function_exists('mysql_connect')) {
				mysql_query($sql, $link);
			}
			else {
				mysqli_query($link, $sql);
			}
		}
		unset($tables);
		
		if (function_exists('mysql_connect')) {
			if (mysql_error()) {
				$error .= 'MySQL errors occured when inserting the country specific data.<br/>';
				$sql_error_status = false;
			}
		}
		else {
			if (mysqli_connect_errno()) {
				$error .= 'MySQL errors occured when inserting the country specific data.<br/>';
				$sql_error_status = false;
			}
		}
		

		if ($ip2country_installed == '-1') {
			
			// Create the IP2Country table and insert the geolocation data into the database.
			$sqlfile = gzfile('mysql.data.ip2country.sql.gz');
			if (is_array($sqlfile)) {
				$query = '';
				foreach ($sqlfile as $key => $line) {
					if (trim($line) != '' && substr(trim($line), 0, 1) != '#') {
						$line = str_replace('prefix_', $table_prefix, $line);
						$query .= trim($line); unset($line);
						if (strpos($query, ';') !== false) {
							if (function_exists('mysql_connect')) {
								$result = mysql_query($query, $link);
								if ($result == false) { break; }
							}
							else {
								$result = mysqli_query($link, $query);
								if ($result == false) { break; }
							}
							$query = '';
						}
					}
				}
				unset($sqlfile);
				
				if (function_exists('mysql_connect')) {
					if (mysql_error()) {
						$error .= 'MySQL errors occured when inserting the IP2Country data.<br/>';
						$sql_error_status = false;
					}
				}
				else {
					if (mysqli_connect_errno()) {
						$error .= 'MySQL errors occured when inserting the IP2Country data.<br/>';
						$sql_error_status = false;
					}
				}
			
			} else {
			
				$error .= 'Unable to import IP2Country data.<br/>';
				$sql_error_status = false;
			
			}
		
		}
		
		$algo = 'sha512';
		if (function_exists('hash') && in_array($algo, hash_algos())) {
            $password = hash($algo, $password);
        }
		else {
			$password = sha1($password);
		}
		
		if (function_exists('mysql_connect')) {
			$query = "INSERT INTO " . $table_prefix . "users (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `department`, `image`, `privilege`, `status`) VALUES ('1', '$username', '$password', 'Administrator', 'Account', '$offline_email', 'Sales / Technical Support', '', '-1', '-1')";
			mysql_query($query, $link);
			if (mysql_error()) {
				$query = 'SELECT MAX(`id`) FROM ' . $table_prefix . 'users';
				$result = mysql_query($query, $link);
				if ($row = mysql_fetch_array($result)) {
					$status .= 'The Live Help operator account was successfully created.<br/>';
				} else {
					$status .= 'Unable to create Live Help operator account, account may already exist.<br/>';
				}
			}
			else {
				$status .= 'The Live Help operator account was successfully created.<br/>';
			}
		}
		else {
			$query = "INSERT INTO " . $table_prefix . "users (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `department`, `image`, `privilege`, `status`) VALUES ('1', '$username', '$password', 'Administrator', 'Account', '$offline_email', 'Sales / Technical Support', '', '-1', '-1')";
			mysqli_query($link, $query);
			if (mysqli_error()) {
				$query = 'SELECT MAX(`id`) FROM ' . $table_prefix . 'users';
				$result = mysqli_query($link, $query);
				if ($row = mysqli_fetch_array($result)) {
					$status .= 'The Live Help operator account was successfully created.<br/>';
				} else {
					$status .= 'Unable to create Live Help operator account, account may already exist.<br/>';
				}
			}
			else {
				$status .= 'The Live Help operator account was successfully created.<br/>';
			}
		}
		
		if (function_exists('mysql_connect')) {
			mysql_close($link);
		}
		else {
			mysqli_close($link);
		}
		
		$config_writable = true;
		if ($error == '') {
			if (file_exists($configuration)) {
				if (is_writable($configuration)) {
				
					$content = "<?php\n";
					$content .= "\n";
					$content .= 'define(\'DB_HOST\', \'' . DB_HOST . '\');' . "\n";
					$content .= 'define(\'DB_NAME\', \'' . DB_NAME . '\');' . "\n";
					$content .= 'define(\'DB_USER\', \'' . DB_USER . '\');' . "\n";
					$content .= 'define(\'DB_PASS\', \'' . DB_PASS . '\');' . "\n";
					$content .= "\n";
					$content .= '$table_prefix =  \'' . $table_prefix . '\';' . "\n";
					$content .= "\n";
					$content .= 'return true;' . "\n";
					$content .= "\n";
					$content .= "?>";
		
					if (!$handle = fopen($configuration, 'w')) {
						$config_writable = false;
					}
					else {
						if (!fwrite($handle, $content)) {
							$config_writable = false;
						}
						else {
							$config_writable = true;
							fclose($handle);
						}
					}
				}
				else {
					$config_writable = false;
				}
			}
			else {
				$config_writable = false;
			}
		}
	
	}

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>stardevelop.com - Live Chat Customer Service Software, Live Help, Customer Support</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<meta http-equiv="P3P" content="CP='ALL DSP COR CUR OUR IND ONL UNI COM NAV'"/>
<script language="JavaScript" type="text/javascript">
<!--

var LiveHelpXMLHTTP;

function checkXMLHTTP() {
	obj = null;
	if (window.XMLHttpRequest) {
		obj = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		obj = new ActiveXObject("Microsoft.XMLHTTP")
		if (!obj) {
			try {
				obj = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				try {
					obj = new ActiveXObject("Microsoft.XMLHTTP");
				} catch(e) {
					obj = null;
				}
			}
		}
    }
	return obj;
}

LiveHelpXMLHTTP = checkXMLHTTP();

function getLayer(ID) {

	var obj;
	if (document.getElementById) {
		obj = document.getElementById(ID);
		return obj
	}
	else if (document.layers && document.layers[object] != null) {
		obj = document.layers[ID].document;
		return obj;
	}
	else if (document.all) {
		obj = document.all[ID];
		return obj;
	}
	
	return false;
}

function writeLayer(ID, sText) {

	var oLayer = getLayer(ID);
	if (oLayer != false) {
	
		if (oLayer.innerHTML == null) {
			oLayer.open();
			oLayer.write(sText);
			oLayer.close();
		} else {
			oLayer.innerHTML = sText;
		}
	} else {
		return false;
	}

}

function toggleLayer(ID, visibility) {

	var obj = getLayer(ID);
	if (document.layers && obj != null) {
		if (!visibility) {
			HideDatabaseError(obj);
			obj.visibility = 'hidden';
		} else {
			ShowDatabaseError(obj);
			obj.visibility = 'visible';
		}
	}
	else {
		if (!visibility) {
			HideDatabaseError(obj);
			obj.style.visibility = 'hidden';
		} else {
			ShowDatabaseError(obj);
			obj.style.visibility = 'visible';
		}
	}	
	return false;
}

function HideDatabaseError(obj) {
	dbError = false;
	obj.className = 'HideError';
	
	swapImage('DatabaseErrorImage', '', '../include/Hidden.gif', 1);
	writeLayer('DatabaseErrorTitle', '');
	writeLayer('DatabaseSource', '');
}

function ShowDatabaseError(obj) {
	dbError = true;
	obj.className = 'ShowError';
}

function showError(id) {
	var obj = getLayer(id);
	if (obj != null) {
		obj.style.visibility = 'visible';
		obj.src = '../images/errorsmall.gif';
		return true;
	}
}

function hideError(id) {
	var obj = getLayer(id);
	if (obj != null) { obj.style.visibility = 'hidden';	}
}

function validateField(field, id) {
	if (field.value == '') {
		return showError(id);
	} else {
		hideError(id);
		return false;
	}
}

var dbError = false;

function validateDatabase() {
	if (validateField(document.install.DB_HOSTNAME, 'HostnameError') || validateField(document.install.DB_NAME, 'DatabaseError') || validateField(document.install.DB_USERNAME, 'DatabaseUsernameError') || validateField(document.install.DB_PASSWORD, 'DatabasePasswordError')) {
		return false;
	}
	if (LiveHelpXMLHTTP) {
		if (LiveHelpXMLHTTP.readyState != 0) {
			LiveHelpXMLHTTP.abort();
		}
		
		var URL = '/livehelp/install/verify.php';
		LiveHelpXMLHTTP.open('POST', URL, false);
		var RequestData = 'HOSTNAME=' + document.install.DB_HOSTNAME.value + '&USERNAME=' + document.install.DB_USERNAME.value + '&PASSWORD=' + document.install.DB_PASSWORD.value + '&DATABASE=' + document.install.DB_NAME.value;
		LiveHelpXMLHTTP.setRequestHeader("Cache-Control", "no-cache");
		LiveHelpXMLHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		LiveHelpXMLHTTP.setRequestHeader("Content-length", RequestData.length);
		LiveHelpXMLHTTP.setRequestHeader("Connection", "close");
		LiveHelpXMLHTTP.send(RequestData);
		
		if (LiveHelpXMLHTTP.readyState == 4) {
			// Process response as JavaScript
			if (LiveHelpXMLHTTP.status == 200) {
				eval(LiveHelpXMLHTTP.responseText);
			}
		}
		
		if (dbError) {
			return false;
		} else {
			if (validateField(document.install.OFFLINEEMAIL, 'OfflineEmailError') || validateField(document.install.USERNAME, 'UsernameError') || validateField(document.install.PASSWORD, 'PasswordError') || validateField(document.install.PASSWORD_RETYPE, 'PasswordError')) {
				return false;
			} else {
				if (document.install.PASSWORD.value != document.install.PASSWORD_RETYPE.value) {
					showError('PasswordError');
					return false;
				}
			}
		}
	}	
}

function findObj(n, d) {
	var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
		if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
		if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function swapImage() {
	var i,j=0,x,a=swapImage.arguments; document.sr=new Array; for(i=0;i<(a.length-2);i+=3)
		if ((x=findObj(a[i]))!=null){document.sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

//-->
</script>
<style type="text/css">
<!--
div, p, td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000000;
}
.heading {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #000000;
}
a.normlink:link, a.normlink:visited, a.normlink:active {
	color: #339;
	text-decoration: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border-bottom-width: 0.05em;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
}
a.normlink:hover {
	color: #339;
	text-decoration: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border-bottom-width: 0.05em;
	border-bottom-style: solid;
	border-bottom-color: #339;
}
a.menulink:link, a.menulink:visited, a.menulink:active {
	color: #000000;
	text-decoration: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}
.ShowError {
	position: relative;
	width: 380px;
	height: 50px;
	background-color: #ffffcc;
	border-width: 1px;
	border-color: #ffff77;
	border-style: solid;
	visibility: visible;
	margin-top: 20px;
	margin-bottom: 10px;
}

.HideError {
	visibility: hidden;
	height: 0px;
	margin-bottom: 10px;
}

body, p, td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
}

.tablebody {
	background-image: url(http://www.stardevelop.com/images/bgtable.gif);
	background-position: right top;
	background-repeat: no-repeat;
	background-color: #FFFFFF;
	padding-bottom: 20px;
}
.tableheader {
	background-color: #8FCBEF;
	background-attachment: fixed;
}
.tableheaderspacer {
	background-color: #999999;
}
.menubody {
	background-image:    url(http://www.stardevelop.com/images/bgmenutable.gif);
	background-position: left center;
	background-repeat: no-repeat;
	background-color: #FFFFFF;
}
.menuborder {
	border-top: 1px solid #666666;
	border-right: 0px none;
	border-bottom: 1px solid #666666;
	border-left: 0px none;
}
h1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-style: italic;
}

-->
</style>
<link href="./styles/styles.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<?php
$_SETTINGS = array();
$_SETTINGS['URL'] = '';

if (isset($_REQUEST['COMPLETE'])) { 
	if ($status != '' && !$error)  {
?>
<!-- stardevelop.com Live Help International Copyright - All Rights Reserved //-->
<!--  BEGIN stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
<script language="JavaScript" type="text/JavaScript" src="<?php echo($_SETTINGS['URL']); ?>/livehelp/include/javascript.php"></script>
<!--  END stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
<?php
	}
}
?>
</head>
<body bgcolor="#F3F3F3" text="#000000" link="#8FCBEF" vlink="#8FCBEF" alink="#8FCBEF" onload="MM_preloadImages('/livehelp/install/images/StardevelopOrange.gif')">
<?php
if (isset($_REQUEST['COMPLETE'])) { 
	if ($status != '' && !$error)  {
?>
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
  <img src="<?php echo($_SETTINGS['URL']); ?>/livehelp/locale/en/images/InitateChat.gif" alt="stardevelop.com Live Help" width="323" height="229" border="0" usemap="#LiveHelpInitiateChatMap"/></div>
<!--  END stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
<?php
	}
}
?>
<div align="center" style="margin-top: 10px;">
  <table width="580" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td width="25">&nbsp;</td>
      <td width="600"><div align="right"><a href="http://www.stardevelop.com" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('stardevelop','','/livehelp/install/images/StardevelopOrange.gif',1)"><img src="/livehelp/install/images/StardevelopBlue.gif" alt="stardevelop.com" name="stardevelop" width="120" height="18" border="0" id="stardevelop"/></a></div></td>
      <td width="25">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><div align="right"><img src="./images/BannerInstall.gif" width="641" height="79" border="0" alt="Live Help Messenger" usemap="#Map2"/></div></td>
    </tr>
  </table>
</div>
<table width="650" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <td colspan="2" align="center" valign="middle"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" class="tablebody"><?php
if (isset($_REQUEST['COMPLETE'])) { 
?>
      <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:10px;">
        <tr>
          <td><?php
	if ($status != '') {
?>
            <div align="center">
              <p>Thank you for installing the Live Help Server Software.<br/>
                <?php echo($status); ?></p>
<?php
		if ($error) {
			$error .= 'Please contact technical support for assistance.';
?>
              <h1>Installation Failed (See Error Below)</h1>
              <table width="500" border="0" align="center" cellpadding="10" class="box" style="margin-top:10px; margin-bottom:20px;">
                <tr>
                  <td width="32"><img src="images/Error.gif" alt="Installation Error" width="32" height="32"/></td>
                  <td><div align="center">
                      <h1>Installation Error</h1>
                      <div align="center"><em><?php echo($error); ?></em></div>
                    </div></td>
                </tr>
              </table>
<?php
		} else {
?>
              <h1>Installation Completed</h1>
              <?php
		}
?>
              <div>You can now install the Live Help Messenger Windows application on your operator computers. You will then be able to login using the following dialog as shown below:</div>
              <a href="/livehelp/admin/index.php"><img src="./images/SignIn.jpg" alt="Live Help Messenger Sign-In Window" width="395" height="393" border="0"/></a>
              <?php
		if (isset($_REQUEST['COMPLETE'])) { 
			if ($status != '' && !$error)  {
?>
              </p>
              <div>You should now insert the Live Help HTML code on your web-pages, this code is available within the documentation.</div>
              <div style="margin-top:10px; margin-bottom:20px">The Live Help Online / Offline button is shown below:</div>
<!-- stardevelop.com Live Help International Copyright - All Rights Reserved //-->
<!--  BEGIN stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
<a href="#" target="_blank" onclick="openLiveHelp(); return false"><img src="<?php echo($_SETTINGS['URL']); ?>/livehelp/include/status.php" id="LiveHelpStatus" name="LiveHelpStatus" border="0" alt="Live Help"/></a>
<!--  END stardevelop.com Live Help Messenger Code - Copyright - NOT PERMITTED TO MODIFY IMAGE MAP/CODE/LINKS //-->
<?php
			}
		}
	}
?>
            </div></td>
        </tr>
      </table>
      <?php
} else {

		$config_writable = true;
		if (file_exists($configuration)) {
			if (is_writable($configuration)) {
					$content = file_get_contents($configuration);
					if (!$handle = fopen($configuration, 'w')) {
						$config_writable = false;
					}
					else {
						if (!fwrite($handle, $content)) {
							$config_writable = false;
						}
						else {
							$config_writable = true;
							fclose($handle);
						}
					}
			}
			else {
				$config_writable = false;
			}
		}
		else {
			$config_writable = false;
		}
		list($major, $minor) = explode('.', phpversion());
		
		if ($config_writable == false) {
		?>
      <table width="450" border="0" align="center" cellpadding="10" class="box">
        <tr>
          <td width="32"><img src="images/Error.gif" alt="Installation Error" width="32" height="32"/></td>
          <td><div align="center">
              <h1>Installation Permissions Error</h1>
              <div align="center"><em>You must change the permissions of the /livehelp/include/database.php file so the file is writable.  This must be completed  before starting the installation.</em> </div>
            </div></td>
        </tr>
      </table>
      <?php
		} else if ($major <= 4 && $minor < 2) {
		?>
      <table width="450" border="0" align="center" cellpadding="10" class="box">
        <tr>
          <td width="32"><img src="images/Error.gif" alt="Installation Error" width="32" height="32"/></td>
          <td><div align="center">
              <h1>Missing Installation Requirement</h1>
              <div align="center"><em>You must have at least PHP 4.2.0 installed.  Please upgrade your PHP installation to the latest release.</em> </div>
            </div></td>
        </tr>
      </table>
      <?php
		} else if (!function_exists('mysql_connect') && !function_exists('mysqli_connect')) { 
		?>
      <table width="450" border="0" align="center" cellpadding="10" class="box">
        <tr>
          <td width="32"><img src="images/Error.gif" alt="Installation Error" width="32" height="32"/></td>
          <td><div align="center">
              <h1>Missing Installation Requirement</h1>
              <em>Your PHP installation does not support MySQL databases.  You must enable the MySQL extensions within the PHP.ini configuration file.</em>
              </p>
            </div></td>
        </tr>
      </table>
      <?php
		} else if (!function_exists('preg_replace')) {		
		?>
      <table width="450" border="0" align="center" cellpadding="10" class="box">
        <tr>
          <td width="32"><img src="images/Error.gif" alt="Installation Error" width="32" height="32"/></td>
          <td><div align="center">
              <h1>Missing Installation Requirement</h1>
              <div align="center"><em>You must have Regular Expression Functions (Perl-Compatible) enabled within your PHP configuration.  Please upgrade your PHP installation to include PCRE.</em> </div>
            </div></td>
        </tr>
      </table>
      <?php
		}
		?>
      <div id="DatabaseConnection" class="HideError">
        <div id="ErrorImage" style="position:absolute; top:7px; left:7px; width:32px; height:32px;"><img src="images/Error.gif" alt="Error" name="DatabaseErrorImage" id="DatabaseErrorImage"/></div>
        <div id="DatabaseErrorTitle" style="position:relative; padding-left:50px; padding-right: 10px; margin-top:5px; font-weight:800;"></div>
        <div id="DatabaseSource" style="position:relative; padding-left:50px; padding-right: 10px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;"></div>
      </div>
      <p>Before proceeding please view the documentation at the&nbsp;<a href="http://livehelp.stardevelop.com/documentation/" class="normlink" target="_blank">Customer Support Center</a><br/>
        If you experience problems  please contact technical support.</p>
      <form action="install.php" method="post" name="install" style="margin-bottom: 5px" onsubmit="return validateDatabase();">
        <table border="0">
          <tr>
            <td colspan="2"><div align="center">
                <h1><strong>MySQL Database Setup</strong></h1>
              </div></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Database Hostname:</strong></div></td>
            <td style="text-align:left;"><input name="DB_HOSTNAME" type="text" id="DB_HOSTNAME" value="localhost" style="width: 150px" onblur="validateField(this, 'HostnameError')" onkeypress="return true; validateField(this, 'HostnameError')"/>
              <img id="HostnameError" style="visibility: hidden" src="../images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Database Name:</strong></div></td>
            <td style="text-align:left;"><input name="DB_NAME" type="text" id="DB_NAME" value="livehelp" style="width: 150px" onblur="validateField(this, 'DatabaseNameError')" onkeypress="return true; validateField(this, 'DatabaseNameError')"/>
              <img id="DatabaseNameError" style="visibility: hidden" src="../images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Database Username:</strong> </div></td>
            <td style="text-align:left;"><input name="DB_USERNAME" type="text" id="DB_USERNAME" style="width: 150px" onblur="validateField(this, 'DatabaseUsernameError')" onkeypress="return true; validateField(this, 'DatabaseUsernameError')"/>
              <img id="DatabaseUsernameError" style="visibility: hidden" src="../images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Database Password:</strong> </div></td>
            <td style="text-align:left;"><input name="DB_PASSWORD" type="password" id="DB_PASSWORD" style="width: 150px" onblur="validateField(this, 'DatabasePasswordError')" onkeypress="return true; validateField(this, 'DatabasePasswordError')"/>
              <img id="DatabasePasswordError" style="visibility: hidden" src="../images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Table Prefix:</strong> </div></td>
            <td style="text-align:left;"><input name="DB_TABLE_PREFIX" type="text" id="DB_TABLE_PREFIX" value="livehelp_" style="width: 150px" onblur="validateField(this, 'TablePrefixError')" onkeypress="return true; validateField(this, 'TablePrefixError')" />
              <img id="TablePrefixError" style="visibility: hidden" src="../images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
          </tr>
        </table>
        <br/>
        <table border="0">
          <tr>
            <td><div align="right"><strong>Offline Email Address:</strong></div></td>
            <td style="text-align:left;"><input name="OFFLINEEMAIL" type="text" id="OFFLINEEMAIL" style="width: 250px" onblur="validateField(this, 'OfflineEmailError')" onkeypress="return true; validateField(this, 'OfflineEmailError')"/>
              <img id="OfflineEmailError" style="visibility: hidden" src="../images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
          </tr>
          <?php if (!($memory == false || $zlib == false)) { ?>
          <tr>
            <td><div align="right"><strong>Install Geolocation Database:</strong></div></td>
            <td style="text-align:left;"><input name="IP2COUNTRY_INSTALLED" type="checkbox" id="IP2COUNTRY_INSTALLED" value="-1"/>
              <span class="small">Minimum 7.5MB MySQL Database</span><br/></td>
          </tr>
          <tr>
            <td colspan="2"><div align="center" class="small" style="padding-left:20px; padding-right:20px;">Requirement: The  IP2Country database requires Zlib Compression support and 32MB PHP memory.  Disable this option if experiencing difficulties with the installation.<br/>
              </div></td>
          </tr>
          <?php } ?>
        </table>
        <p><br/>
        </p>
        <table border="0">
          <tr>
            <td colspan="2"><div align="center">
                <h1><strong>Create Operator Account</strong></h1>
              </div></td>
          </tr>
          <tr>
            <td colspan="2"><div align="center">Please complete account details for the Live Help operator:</div></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Username:</strong></div></td>
            <td style="text-align:left;"><input name="USERNAME" type="text" id="USERNAME" style="width: 150px" onblur="validateField(this, 'UsernameError')" onkeypress="return true; validateField(this, 'UsernameError')"/>
              <img id="UsernameError" style="visibility: hidden" src="../images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Password:</strong></div></td>
            <td style="text-align:left;"><input name="PASSWORD" type="password" id="PASSWORD" style="width: 150px" onblur="validateField(this, 'PasswordError')" onkeypress="return true; validateField(this, 'PasswordError')"/>
              <img id="PasswordError" style="visibility: hidden" src="../images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Retype Password:</strong></div></td>
            <td style="text-align:left;"><input name="PASSWORD_RETYPE" type="password" id="PASSWORD_RETYPE" style="width: 150px" onblur="validateField(this, 'PasswordError')" onkeypress="return true; validateField(this, 'PasswordError')"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="COMPLETE" id="COMPLETE" value="true"/>
        <input type="hidden" name="DOMAIN" id="DOMAIN" value="<?php echo($install_domain); ?>"/>
        <?php if ($memory == false || $zlib == false) { ?>
        <input type="hidden" name="IP2COUNTRY_INSTALLED" id="IP2COUNTRY_INSTALLED" value="0"/>
        <?php } ?>
        <input type="submit" name="Submit" value="Complete Install" <?php if (!function_exists('mysql_connect') && !function_exists('mysqli_connect')) { echo('disabled'); } ?>/>
      </form>
    <?php
}
?>
      </td>
  </tr>
  <tr>
    <td height="5" colspan="2" align="center" valign="top" bgcolor="#999999"></td>
  </tr>
  <tr>
    <td height="5" colspan="2" align="center" valign="top" bgcolor="#FFFFFF"></td>
  </tr>
</table>
</body>
</html>
