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
include('../include/functions.php');

ignore_user_abort(true);

if (!isset($_REQUEST['ACTION'])){ $_REQUEST['ACTION'] = ''; }
if (!isset($_REQUEST['CHAT'])){ $_REQUEST['CHAT'] = ''; }
if (!isset($_REQUEST['USERNAME'])){ $_REQUEST['USERNAME'] = ''; }
if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
if (!isset($_REQUEST['OPERATOR'])){ $_REQUEST['OPERATOR'] = ''; }
if (!isset($_REQUEST['FROM'])){ $_REQUEST['FROM'] = ''; }

$action = $_REQUEST['ACTION'];
$chat = $_REQUEST['CHAT'];
$username = $_REQUEST['USERNAME'];
$id = $_REQUEST['ID'];
$operator = $_REQUEST['OPERATOR'];
$from = $_REQUEST['FROM'];

if ($action == 'Accept') {
	// Check if already assigned to a Support operator
	$query = "SELECT `username`, `active` FROM " . $table_prefix . "sessions WHERE `id` = '$id'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$username = $row['username'];
		$active = $row['active'];
		// If the site visitor is Pending 0 or Transferred -2 Then assign an operator, else do nothing.
		if ($active == '0' || $active == '-2') {
		
			// Update the active flag of the guest user to the ID of the operator
			$query = "UPDATE " . $table_prefix . "sessions SET `active` = '$operator_login_id' WHERE `id` = '$id'";
			$SQL->miscquery($query);
			
			if ($chat == false) {
				header('Location: ./users.php?CHAT=1&USERNAME=' . $username . '&ID=' . $id);
				exit();
			}
	
		}
	}
} elseif ($action == 'Close') {

	// Update active of user to -3 to remove from users panel
	$query = "UPDATE " . $table_prefix . "sessions SET `active` = '-3' WHERE `id` = '$id'";
	$SQL->miscquery($query);
	
	header('Location: ./users.php');
	exit();
}

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
<SCRIPT LANGUAGE="JavaScript">
<!--

function multiLoad(doc1, doc2) {
	parent.displayFrame.location.href = doc1;
	parent.messengerFrame.location.href = doc2;
}

<?php
if ($chat == true) {
?>
multiLoad('./displayer.php?USER=<?php echo(addslashes($username)); ?>&ID=<?php echo($id); ?>', './messenger.php?USER=<?php echo(addslashes($username)); ?>&ID=<?php echo($id); ?>');
window.setTimeout('document.location.href = "./users.php";', 10000);

<?php
}
?>
//-->
</script>
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
</head>
<body link="#000000" vlink="#000000" alink="#000000" onFocus="parent.document.title = 'Administration <?php echo(addslashes($_SETTINGS['NAME'])); ?>'"  style="margin: 0px;">
<?php

$query = "SELECT `datetime`, `department` FROM " . $table_prefix . "users WHERE `id` = '$operator_login_id'";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			$login_datetime = $row['datetime'];
			$department = $row['department'];
		}
	}
}

?>
<table border="0" cellpadding="0" cellspacing="1">
  <tr valign="middle">
    <td width="24" valign="middle"><div align="center"><img src="../images/staff.gif" alt="<?php echo($staff_label); ?>" name="StaffIcon" width="22" height="22"> </div></td>
    <td width="125" class="headingusers"><?php echo($staff_label); ?></td>
    <td width="20" valign="middle"></td>
    <td width="20" valign="middle"></td>
    <td width="20" valign="middle"></td>
  </tr>
  <?php
// Online Operators User Query
$query = "SELECT `id`, `username` FROM " . $table_prefix . "users WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `status` = '1' ORDER BY `username`";
$rows = $SQL->selectall($query);

if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			$id = $row['id'];
			$username = $row['username'];
?>
  <tr>
    <td width="24"><p align="center">
        <?php if ($operator_login_id != $id) { ?>
        <a href="<?php echo("javascript:multiLoad('./displayer.php?USER=" . addslashes($username) . "&ID=$id&STAFF=1', './messenger.php?USER=" . addslashes($username) . "&ID=$id&STAFF=1')"); ?>">
        <?php } ?>
        <img src="../images/red_staff.gif" alt="<?php echo($online_staff_label); ?>" width="16" height="16" border="0">
        <?php if ($operator_login_id != $id) { ?>
        </a>
        <?php } ?>
      </p></td>
    <td width="125"><?php if ($operator_login_id != $id) { ?>
      <a href="<?php echo("javascript:multiLoad('./displayer.php?USER=" . addslashes($username) . "&ID=$id&STAFF=1', './messenger.php?USER=" . addslashes($username) . "&ID=$id&STAFF=1')"); ?>" class="normlink">
      <?php } ?>
      <?php echo($username); ?>
      <?php if ($operator_login_id != $id) { ?>
      </a>
      <?php } ?></td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
		}
	}
}
else {
?>
  <tr>
    <td width="24"><div align="center"><img src="../images/red_staff_grey.gif" alt="No online staff." width="16" height="16"></div></td>
    <td width="125" class="smallusers">No online staff.</td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td width="24" height="10"></td>
    <td width="125" height="10"></td>
    <td width="20" height="10"></td>
    <td width="20" height="10"></td>
    <td width="20" height="10"></td>
  </tr>
  <tr>
    <td width="24"><div align="center"><img src="../images/online.gif" alt="<?php echo($online_label); ?>" name="OnlineIcon" width="22" height="22"> </div></td>
    <td width="125" class="headingusers"><?php echo($online_label); ?></td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
// Online Guest Users Query
$query = "SELECT `id`, `request`, `username` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '$operator_login_id' ORDER BY `username`";
$rows = $SQL->selectall($query);

if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			$id = $row['id'];
			$request_id = $row['request'];
			$username = $row['username'];
?>
  <tr>
    <td width="24"><p align="center"><a href="#" onClick="<?php echo("multiLoad('./displayer.php?USER=" . addslashes($username) . "&ID=$id', './messenger.php?USER=" . addslashes($username) . "&ID=$id')"); ?>"><img src="../images/green.gif" alt="<?php echo($online_guest_label); ?>" width="16" height="16" border="0"></a> </p></td>
    <td width="125"><a href="#" onClick="<?php echo("multiLoad('./displayer.php?USER=" . addslashes($username) . "&ID=$id', './messenger.php?USER=" . addslashes($username) . "&ID=$id')"); ?>" class="normlink"><?php echo($username); ?></a></td>
    <td width="20"><div align="center"><a href="visitors_index.php?REQUEST=<?php echo($request_id); ?>" target="displayFrame"><img src="../images/user_info.gif" alt="<?php echo($information_label); ?>" width="16" height="16" border="0"></a></div></td>
    <td width="20"><div align="center"><a href="users.php?ACTION=Close&ID=<?php echo($id); ?>&FROM=<?php echo($operator_login_id); ?>"><img src="../images/ignore_user.gif" alt="<?php echo($close_request_label); ?>" width="16" height="16" border="0"></a></div></td>
    <td width="20">&nbsp;</td>
  </tr>
  <?php 
		}
	}
}
else {
?>
  <tr>
    <td width="24"><div align="center"><img src="../images/green_grey.gif" alt="No online users." width="16" height="16"></div></td>
    <td width="125" class="smallusers">No online users.</td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td height="10"></td>
    <td width="125" height="10"></td>
    <td width="20" height="10"></td>
    <td width="20" height="10"></td>
    <td width="20" height="10"></td>
  </tr>
  <tr>
    <td width="24"><div align="center"><img src="../images/pending.gif" alt="<?php echo($pending_label); ?>" width="22" height="22"> </div></td>
    <td width="125" class="headingusers"><?php echo($pending_label); ?></td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
// Pending Users Query
if ($_SETTINGS['DEPARTMENTS'] == true) {
 	$sql = departmentsSQL($department);
	$query = "SELECT DISTINCT `id`, `request`, `username` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '0' AND $sql ORDER BY `username`";
}
else {
	$query = "SELECT DISTINCT `id`, `request`, `username` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '0' ORDER BY `username`";
}
$rows = $SQL->selectall($query);

if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			$id = $row['id'];
			$request_id = $row['request'];
			$username = $row['username'];
?>
  <embed src="/livehelp/sounds/arrive.wav" width="0" height="0" hidden="true" autostart="true" loop="false" name="PendingSound" id="PendingSound" border="0"/>
  <tr>
    <td width="24"><p align="center"><a href="users.php?ACTION=Accept&USER=<?php echo($username); ?>&ID=<?php echo($id); ?>&OPERATOR=<?php echo($operator_login_id); ?>"><img src="../images/blue.gif" alt="<?php echo($pending_user_label); ?>" width="16" height="16" border="0"></a> </p></td>
    <td width="125"><a href="users.php?ACTION=Accept&ID=<?php echo($id); ?>&OPERATOR=<?php echo($operator_login_id); ?>&MULTILOAD=true" class="normlink"><?php echo($username); ?></a></td>
    <td width="20"><div align="center"><a href="users.php?ACTION=Accept&ID=<?php echo($id); ?>&OPERATOR=<?php echo($operator_login_id); ?>"><img src="../images/add_user.gif" alt="<?php echo($add_user_label); ?>" width="16" height="16" border="0"></a></div></td>
    <td width="20"><div align="center"><a href="visitors_index.php?REQUEST=<?php echo($request_id); ?>" target="displayFrame"><img src="../images/user_info.gif" alt="<?php echo($information_label); ?>" width="16" height="16" border="0"></a></div></td>
    <td width="20"><div align="center"><a href="users.php?ACTION=Close&ID=<?php echo($id); ?>&FROM=<?php echo($operator_login_id); ?>"><img src="../images/ignore_user.gif" alt="<?php echo($close_request_label); ?>" width="16" height="16" border="0"></a></div></td>
  </tr>
  <?php
		}
	}
}
else {
?>
  <tr>
    <td width="24"><div align="center"><img src="../images/blue_grey.gif" alt="No pending users." width="16" height="16"></div></td>
    <td width="125" class="smallusers">No pending users.</td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td height="10"></td>
    <td width="125" height="10"></td>
    <td width="20" height="10"></td>
    <td width="20" height="10"></td>
    <td width="20" height="10"></td>
  </tr>
  <tr>
    <td width="24"><div align="center"><img src="../images/transferred.gif" alt="<?php echo($transferred_label); ?>" name="OnlineIcon" width="22" height="22"> </div></td>
    <td width="125" class="headingusers"><?php echo($transferred_label); ?></td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
// Transferred Users Query
$query = "SELECT DISTINCT `id`, `request`, `username` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '-2' AND `transfer` = '$operator_login_id' ORDER BY `username`";
$rows = $SQL->selectall($query);

if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			$id = $row['id'];
			$request_id = $row['request'];
			$username = $row['username'];
?>
  <embed src="/livehelp/sounds/arrive.wav" width="0" height="0" hidden="true" autostart="true" loop="false" name="PendingSound" id="PendingSound" border="0"/>
  <tr>
    <td width="24"><p align="center"><a href="users.php?ACTION=Accept&USER=<?php echo($username); ?>&ID=<?php echo($id); ?>&OPERATOR=<?php echo($operator_login_id); ?>"><img src="../images/orange.gif" alt="<?php echo($transferred_user_label); ?>" width="16" height="16" border="0"></a> </p></td>
    <td width="125"><a href="users.php?ACTION=Accept&ID=<?php echo($id); ?>&OPERATOR=<?php echo($operator_login_id); ?>" class="normlink"><?php echo($username); ?></a></td>
    <td width="20"><div align="center"><a href="users.php?ACTION=Accept&ID=<?php echo($id); ?>&OPERATOR=<?php echo($operator_login_id); ?>"><img src="../images/add_user.gif" alt="<?php echo($add_user_label); ?>" width="16" height="16" border="0"></a></div></td>
    <td width="20"><div align="center"><a href="visitors_index.php?REQUEST=<?php echo($request_id); ?>" target="displayFrame"><img src="../images/user_info.gif" alt="<?php echo($information_label); ?>" width="16" height="16" border="0"></a></div></td>
    <td width="20"><div align="center"><a href="users.php?ACTION=Close&ID=<?php echo($id); ?>&FROM=<?php echo($operator_login_id); ?>"><img src="../images/ignore_user.gif" alt="<?php echo($close_request_label); ?>" width="16" height="16" border="0"></a></div></td>
  </tr>
  <?php
		}
	}
}
else {
?>
  <tr>
    <td width="24"><div align="center"><img src="../images/orange_grey.gif" alt="No transferred users." width="16" height="16"></div></td>
    <td width="125" class="smallusers">No transferred users.</td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
}	
?>
  <tr>
    <td height="10"></td>
    <td width="125" height="10"></td>
    <td width="20" height="10"></td>
    <td width="20" height="10"></td>
    <td width="20" height="10"></td>
  </tr>
  <tr>
    <td width="24"><div align="center"><img src="../images/offline.gif" alt="<?php echo($offline_label); ?>" width="22" height="22"> </div></td>
    <td width="125" class="headingusers"><?php echo($offline_label); ?></td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
// Offline Users Query
$query = "SELECT DISTINCT `id`, `request`, `username` FROM " . $table_prefix . "sessions WHERE `datetime` > '$login_datetime' AND (`active` = '$operator_login_id' OR `active` = '0' OR `active` = '-1') AND `refresh` < DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) ORDER BY `username`";
$rows = $SQL->selectall($query);

if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			$id = $row['id'];
			$request_id = $row['request'];
			$username = $row['username'];
?>
  <tr>
    <td width="24"><p align="center"><a href="view_transcript.php?ID=<?php echo($id); ?>&USER=<?php echo($username); ?>" target="displayFrame"><img src="../images/red.gif" alt="<?php echo($offline_user_label); ?>" width="16" height="16" border="0"></a> </p></td>
    <td width="125"><a href="view_transcript.php?ID=<?php echo($id); ?>&USER=<?php echo($username); ?>" target="displayFrame" class="normlink"><?php echo($username); ?></a></td>
    <td width="20"><div align="center"><a href="visitors_index.php?REQUEST=<?php echo($request_id); ?>" target="displayFrame"><img src="../images/user_info.gif" alt="<?php echo($information_label); ?>" width="16" height="16" border="0"></a></div></td>
    <td width="20"><a href="users.php?ACTION=Close&ID=<?php echo($id); ?>&FROM=<?php echo($operator_login_id); ?>"><img src="../images/ignore_user.gif" alt="<?php echo($close_request_label); ?>" width="16" height="16" border="0"></a></td>
    <td width="20"></td>
  </tr>
  <?php
		}
	}
}
else {
?>
  <tr>
    <td width="24"><div align="center"><img src="../images/red_grey.gif" alt="No offline users." width="16" height="16"></div></td>
    <td width="125" class="smallusers">No offline users.</td>
    <td width="20"></td>
    <td width="20"></td>
    <td width="20"></td>
  </tr>
  <?php
}

?>
</table>
</body>
</html>
