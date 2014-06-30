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

if ($current_privilege > 2){
	header('Location: ./denied.php');
	exit();
}

if (!isset($_REQUEST['MONTH'])){ $_REQUEST['MONTH'] = ''; }
if (!isset($_REQUEST['DATE'])){ $_REQUEST['DATE'] = ''; }

if ($_REQUEST['DATE'] == '') {
	$num_date = date('Y-m-d', mktime(date('H') + $timezonehours, date('i') + $timezoneminutes, 0, date('m'), date('d'), date('Y')));
 	  
	$day = date('d', mktime(date('H') + $timezonehours, date('i') + $timezoneminutes, 0, date('m'), date('d'), date('Y')));
	$month = date('F', mktime(date('H') + $timezonehours, date('i') + $timezoneminutes, 0, date('m'), date('d'), date('Y')));
	$year = date('Y', mktime(date('H') + $timezonehours, date('i') + $timezoneminutes, 0, date('m'), date('d'), date('Y'))); 
}

if (LANGUAGE_TYPE != 'en') {	  
	switch ($month) { 
		case 'January':
			$month = $january_label; 
			break;
		case 'February':
			$month = $february_label; 
			break;
		case 'March':
			$month = $march_label; 
			break;
		case 'April':
			$month = $april_label; 
			break;
		case 'May':
			$month = $may_label; 
			break;
		case 'June':
			$month = $june_label; 
			break;
		case 'July':
			$month = $july_label; 
			break;
		case 'August':
			$month = $august_label; 
			break;
		case 'September':
			$month = $september_label; 
			break;
		case 'October':
			$month = $october_label; 
			break;
		case 'November':
			$month = $november_label; 
			break;
		case 'December':
			$month = $december_label; 
			break;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/JavaScript">
<!--
function getReport(td, date){
	var day = td.innerHTML.replace(/<[^>]+>/g,'');
	day = day.replace(/^\s*|\s*$/g, '');
	
	if (day != 0) {
		if (day < 10) {
		day = '0' + day;
		}
		location.href = 'reports_index.php?DATE=' + date + '-' + day + '&MONTH=<?php echo($_REQUEST['MONTH']); ?>';
	}
}
//-->
</script>
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.background {
	background-image: url(../images/background_reports.gif);
	background-repeat: no-repeat;
	background-position: right bottom;
}
-->
</style>
</head>
<body class="background"> 
<div align="center"> 
  <table border="0" cellspacing="2" cellpadding="2"> 
    <tr> 
      <td width="22"><strong><img src="../images/reports_small.gif" alt="<?php echo($daily_reports_label); ?>" width="22" height="22" border="0"></strong></td> 
      <td colspan="2"><em class="heading"><?php echo($daily_reports_label); ?> - </em></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td><?php
	  include('calendar_include.php');
      ?></td> 
      <td><table border="0" align="center" cellpadding="2" cellspacing="2"> 
          <tr> 
            <td colspan="2">&nbsp;</td> 
          </tr> 
          <tr> 
            <td colspan="2"><div align="center">
                <p align="right"><strong><em><?php echo($date_label); ?>:
                  <?php
			if ($_REQUEST['DATE'] == '') {
				  echo($day . ' ' . $month . ' ' . $year);
			}
			else {
				  $num_date = $_REQUEST['DATE'];
				  list($year, $month, $day) = split('[-]', $num_date);
				  $date = date('d F Y', mktime(date('H'), date('i'), 0, $month, $day, $year));
				  echo($date);
			}
			?> 
                  </em></strong></p> 
              </div></td> 
          </tr> 
          <tr> 
            <td><div align="right"><?php echo($unique_label); ?>:</div></td> 
            <td><?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "requests WHERE DATE_FORMAT(DATE_ADD(`request`, INTERVAL '$timezonehours:$timezoneminutes' HOUR_MINUTE), '%Y-%m-%d') = '$num_date'";
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
            <td><div align="right"><?php echo($supported_users_label); ?>:</div></td> 
            <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE (active > '0' OR active = '-1' OR active = '-3') AND DATE_FORMAT(DATE_ADD(`datetime`, INTERVAL '$timezonehours:$timezoneminutes' HOUR_MINUTE), '%Y-%m-%d') = '$num_date'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
		  $supported_users = $row['count(`id`)'];
		  echo($supported_users);
	  }
	  ?></td> 
          </tr> 
          <tr> 
            <td><div align="right"><?php echo($unsupported_users_label); ?>:</div></td> 
            <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE active = '0' AND DATE_FORMAT(DATE_ADD(`datetime`, INTERVAL '$timezonehours:$timezoneminutes' HOUR_MINUTE), '%Y-%m-%d') = '$num_date'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
		  echo($row['count(`id`)']);
	  }
	  ?></td> 
          </tr> 
          <tr> 
            <td><div align="right"><?php echo($sent_msgs_label); ?>:</div></td> 
            <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "messages WHERE `username` = '$current_username' AND `status` > '0' AND DATE_FORMAT(DATE_ADD(`datetime`, INTERVAL '$timezonehours:$timezoneminutes' HOUR_MINUTE), '%Y-%m-%d') = '$num_date'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
		  echo($row['count(`id`)']);
	  }
	  ?> </td> 
          </tr> 
          <tr> 
            <td><div align="right"><?php echo($received_msgs_label); ?>:</div></td> 
            <td> <?php
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "messages WHERE `username` <> '$current_username' AND `status` = '0' AND DATE_FORMAT(DATE_ADD(`datetime`, INTERVAL '$timezonehours:$timezoneminutes' HOUR_MINUTE), '%Y-%m-%d') = '$num_date'";
	  $row = $SQL->selectquery($query);
	  if (is_array($row)) {
		  echo($row['count(`id`)']);
	  }
	  ?> </td> 
          </tr> 
        </table></td> 
    </tr> 
  </table> 
  <?php
 	if ($supported_users > 0) {
		if ($_REQUEST['DATE'] == '') {
			$date = date('d-m-Y', mktime());
		}
		else {
			$num_date= $_REQUEST['DATE'];
			list($year, $month, $day) = split('[-]', $num_date);
			$date = date('d-m-Y', mktime(date('H') + $timezonehours, date('i') + $timezoneminutes, 0, $month, $day, $year));
		}
	?> 
  <p> 
    <input type="button" name="Button" value="View Daily Summary" onClick="location.href = './reports_daily_summary.php?DATE=<?php echo($date); ?>';"> 
    <?php
	}
	?> 
  </p> 
  </p> 
</div> 
</body>
</html>
