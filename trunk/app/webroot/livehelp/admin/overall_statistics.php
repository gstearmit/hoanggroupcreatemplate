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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.background {
	background-image: url(../images/background_statistics.gif);
	background-repeat: no-repeat;
	background-position: right bottom;
}
-->
</style>

</head>
<body class="background"> 
<div align="center"> 
  <table width="400" border="0"> 
    <tr> 
      <td width="22"><strong><img src="../images/stats_small.gif" alt="<?php echo($overall_stats_label); ?>" width="22" height="22" border="0"></strong></td> 
      <td colspan="2"><em class="heading"><?php echo($overall_stats_label); ?> - </em></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td width="225">&nbsp;</td> 
      <td width="150">&nbsp;</td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td><div align="right"><?php echo($total_unique_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "requests";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
		  echo($row['count(`id`)']);
	  }
	  else {
		  echo('Unavailable');
	  }
	  ?></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($total_supported_label); ?>: </div></td> 
      <td> <?php
	  $query = "SELECT count(DISTINCT sessions.id) FROM " . $table_prefix . "sessions AS sessions, " . $table_prefix . "messages AS messages WHERE sessions.id = messages.session AND `active` != '0'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
		  $supported = $row['count(DISTINCT sessions.id)'];
		  echo($supported);
	  }
	  else {
		  echo('Unavailable');
	  }
	  ?></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($total_unsupported_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "sessions";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
		  echo($row['count(`id`)'] - $supported);
	  }
	  else {
		  echo('Unavailable');
	  }
	  ?></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($total_sent_msgs_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "messages WHERE `status` > '0'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
	  	echo($row['count(`id`)']);
	  }
	  ?> </td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($total_received_msgs_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "messages WHERE `status` = '0'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
	  	echo($row['count(`id`)']);
	  }
	  ?> </td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($average_rating_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT `rating` FROM " . $table_prefix . "sessions  WHERE `rating` > '0'";
	  $rows = $SQL->selectall($query);
	  $total_rating = 0;
	  $count = 0;
	  if (is_array($rows)) {
	  	foreach ($rows as $key => $row) {
	  		if (is_array($row)) {
				$total_rating = $total_rating + $row['rating'];
				$count++;
	  		}
		}
		$average_rating = $total_rating / $count;
	  	echo(round($average_rating, 2));
	  }
	  else {
	  	echo($unavailable_label);
	  }
	  ?> 
        / 5</td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td>&nbsp;</td> 
      <td>&nbsp;</td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td colspan="2" valign="top"><em><?php echo($current_session_stats_label); ?>: <?php echo($current_username); ?></em></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($sent_msgs_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "messages WHERE `username` = '$current_username' AND `status` > '0'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
	  	echo($row['count(`id`)']);
	  }
	  ?></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($received_msgs_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "messages WHERE `username` <> '$current_username' AND `status` = '0'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
	  	echo($row['count(`id`)']);
	  }
	  ?></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($supported_users_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE `active` = '$operator_login_id'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
	  	echo($row['count(`id`)']);
	  }
	  ?></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($average_rating_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT `rating` FROM " . $table_prefix . "sessions WHERE `active` = '$operator_login_id' AND rating > '0'";
	  $rows = $SQL->selectall($query);
	  $total_rating = 0;
	  $count = 0;
	  if (is_array($rows)) {
	  	foreach ($rows as $key => $row) {
	  		if (is_array($row)) {
				$total_rating = $total_rating + $row['rating'];
				$count++;
	  		}
		}
		$average_rating = $total_rating / $count;
	  	echo(round($average_rating, 2) . ' / 5');
	  }
	  else {
	  	echo($unavailable_label);
	  }
	  ?></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td valign="top"><div align="right"><?php echo($total_time_label); ?>:</div></td> 
      <td> <?php
	  $query = "SELECT ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`datetime`))) AS `time` FROM " . $table_prefix . "users WHERE `id` = '$operator_login_id'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
		  $time = $row['time'];
	
		  $minutes = (int)($time / 60);
		  if ($minutes > 60) {
			  $hours = (int)(($time / 60) / 60);
			  $minutes = (int)(($time / 60) - ($hours * 60));
		  if ($minutes < 10) {
			  $minutes = '0' . (int)(($time / 60) - ($hours * 60));
		  }
		  $seconds = ($time % 60);
		  if ($seconds < 10) {
			  $seconds = '0' . ($time % 60);
		  }
			  echo($hours . ':' . $minutes . ':' . $seconds . ' ' . $hours_label);
		  }
		  else {
			  if ($minutes < 10) {
				  $minutes = '0' . (int)($time / 60);
			  }
			  $seconds = ($time % 60);
			  if ($seconds < 10) {
				  $seconds = '0' . ($time % 60);
			  }
			  echo($minutes . ':' . $seconds . ' ' . $minutes_label);
		  }
	  }
	  else {
	  	  echo($unavailable_label);
	  }
      ?> </td> 
    </tr> 
  </table> 
</div> 
</body>
</html>
