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

header('Content-type: text/html; charset=utf-8');

if (file_exists('../locale/' . LANGUAGE_TYPE . '/admin.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/admin.php');
}
else {
	include('../locale/en/admin.php');
}

if (!isset($_REQUEST['STATUS'])){ $_REQUEST['STATUS'] = ''; }

$connection_status = $_REQUEST['STATUS'];

if ($connection_status == '') { $connection_status = 'online'; }

if ($connection_status == 'online') {
	$connection_status = $online_label;
}
elseif ($connection_status == 'offline') {
	$connection_status = $offline_label;
}
elseif ($connection_status == 'brb') {
	$connection_status = $brb_label;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--

// stardevelop.com Live Help International Copyright 2003
// JavaScript Check Status Functions

function currentTime() {
	var date = new Date();
	return date.getTime();
}

function onlineRefresher() {
	var tracker = new Image;
	var time = currentTime();
	
	tracker.src = './online_refresher.php?TIME=' + time + '';
	var timer = window.setTimeout('onlineRefresher();', <?php echo($connection_timeout * 200); ?>);
}

onlineRefresher();

window.setTimeout('parent.usersFrame.location.reload(true);', 10000);
	
//-->
</script>
</head>
<body> 
<div align="center"><img src="../images/help_logo_sm.gif" alt="stardevelop.com Live Help" width="178" height="66"> </div> 
</body>
</html>
