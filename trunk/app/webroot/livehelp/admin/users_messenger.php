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

if (!isset($_REQUEST['STATUS'])){ $_REQUEST['STATUS'] = ''; }
if (!isset($_REQUEST['REFRESH_STATUS'])){ $_REQUEST['REFRESH_STATUS'] = ''; }

$connection_status = $_REQUEST['STATUS'];
$refresh_status = $_REQUEST['REFRESH_STATUS'];

header('Content-type: text/html; charset=utf-8');

if (file_exists('../locale/' . LANGUAGE_TYPE . '/admin.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/admin.php');
}
else {
	include('../locale/en/admin.php');
}

if ($connection_status == '') { $connection_status = 'online'; }
if ($refresh_status == '') { $refresh_status = false; }

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
</head>
<body text="#000000" link="#333333" vlink="#000000" alink="#000000" style="margin: 0px;"> 
<table height="100%" border="0" cellpadding="0" cellspacing="0"> 
  <tr> 
    <td><img src="../images/users_messenger.gif" alt="stardevelop.com Live Help Messenger" width="30" height="300" align="bottom"></td> 
  </tr> 
</table> 
</body>
</html>
