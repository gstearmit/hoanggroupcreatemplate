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
include('./include/spiders.php');
include('./include/database.php');
include('./include/class.mysql.php');
include('./include/class.cookie.php');
include('./include/config.php');

// Find total guest visitors that are pending within the selected department
$query = "SELECT `department` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$department = $row['department'];
	$query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`refresh`)) < '$connection_timeout' AND `active` = '0' AND `department` LIKE '%$department%'";
}
else {
	$query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`refresh`)) < '$connection_timeout' AND `active` = '0'";
}
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$users_online = $row['count(`id`)'];
}
else {
	$users_online = '1';
}

header('Content-type: text/html; charset=utf-8');

if (file_exists('./locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('./locale/' . LANGUAGE_TYPE . '/guest.php');
}
else {
	include('./locale/en/guest.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<link href="styles/guest.php" rel="stylesheet" type="text/css"/>
</head>
<body bgcolor="#FFFFFF" onkeydown="parent.parent.focusChat();" style="margin:0px; width:300px;">
<div id="WaitingLayer" class="box"><?php echo($thank_you_patience_label); ?><br/><br/>
  <span class="small" style="text-align: right;"><?php echo($currently_label . ' ' . $users_online . ' ' . $users_waiting_label); ?>. [<a href="#" class="normlink" onclick="document.location.reload(true);"><?php echo($refresh_label); ?></a>]</span>
</div>
<?php
if ($_SETTINGS['OFFLINEEMAIL'] == true) {
?>
<div id="ContinueLayer" class="box" style="border:none; background:none; text-align:right; visibility:hidden;"><?php echo($continue_waiting_label); ?> <a href="offline.php" target="_top" class="normlink"><?php echo($offline_email_label); ?></a> ?</div>
<?php
}
?>
<div id="MessagesLayer" class="box" style="position:absolute; top:0px; left:0px; border:none; background:none; text-align:right;">&nbsp;</div>
</body>
</html>