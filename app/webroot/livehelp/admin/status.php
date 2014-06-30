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

if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
if (!isset($_REQUEST['STATUS'])){ $_REQUEST['STATUS'] = ''; }

$id = $_REQUEST['ID'];
$status = $_REQUEST['STATUS'];

if ($status == '') {
	$status = $online_label;
}
elseif ($status == '0') {
	// Update active flield of admin session to enter offline hidden mode ie. 0
	$query = "UPDATE " . $table_prefix . "users SET `status` = '0' WHERE `id` = '$id'";
	$SQL->miscquery($query);
	
	$status = $offline_label;
}
elseif ($status == '1') {
	// Update active field of admin session to enter online staff mode ie. 1
	$query = "UPDATE " . $table_prefix . "users SET `status` = '1' WHERE `id` = '$id'";
	$SQL->miscquery($query);
	
	$status = $online_label;
}
elseif ($status == '2') {
	// Update active of admin session to enter Be Right Back mode ie. 2
	$query = "UPDATE " . $table_prefix . "users SET `status` = '2' WHERE `id` = '$id'";
	$SQL->miscquery($query);
	
	$status = $brb_label;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
</head>
<body text="#000000" link="#333333" vlink="#000000" alink="#000000" style="margin-top: 0px;"> 
<table width="200" border="0" align="center" cellpadding="2" cellspacing="2"> 
  <tr> 
    <td width="22"><div align="center"><a href="status.php?ID=<?php echo($operator_login_id); ?>&STATUS=1"><img src="../images/staff.gif" alt="<?php echo($online_connected_mode_label); ?>" width="22" height="22" border="0"></a></div></td> 
    <td width="22"><div align="center"><a href="status.php?ID=<?php echo($operator_login_id); ?>&STATUS=0"><img src="../images/disconnected.gif" alt="<?php echo($offline_hidden_mode_label); ?>" width="22" height="22" border="0"></a></div></td> 
    <td width="22"><div align="center"><a href="status.php?ID=<?php echo($operator_login_id); ?>&STATUS=2"><img src="../images/brb.gif" alt="<?php echo($brb_hidden_mode_label); ?>" width="22" height="22" border="0"></a></div></td> 
    <td><div align="right" class="small"><a href="http://livehelp.stardevelop.com/documentation/" target="_blank" class="normlink"><?php echo($help_label); ?></a> - <a href="#" onClick="parent.usersFrame.location.reload(true);" class="normlink"><?php echo($refresh_label); ?></a> </div></td> 
  </tr> 
</table> 
<table width="200" border="0" align="center" cellpadding="2" cellspacing="2"> 
  <tr> 
    <td><div align="right"><em><?php echo($currently_logged_in_label . ' ' . $current_username); ?> <?php echo($using_mode_label); ?> '<strong><?php echo($status); ?></strong>'</em></div></td> 
  </tr> 
</table> 
</body>
</html>
