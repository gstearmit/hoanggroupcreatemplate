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
	background-image: url(../images/background_users.gif);
	background-repeat: no-repeat;
	background-position: right bottom;
}
-->
</style>
</head>
<body class="background"> 
<table width="425" border="0" align="center"> 
  <tr> 
    <td width="22"><img src="../images/staff.gif" alt="<?php echo($manage_accounts_label); ?>" width="22" height="22"></td> 
    <td colspan="5"><em class="heading"><?php echo($manage_accounts_label); ?></em></td> 
  </tr> 
  <tr> 
    <td>&nbsp;</td> 
    <td><strong><?php echo($username_label); ?></strong></td> 
    <td><strong><?php echo($name_label); ?></strong></td> 
    <td><strong><?php echo($department_label); ?></strong></td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
  </tr> 
  <?php
$query = "SELECT `id`, `username`, `firstname`, `lastname`, `department`, `disabled`, `status`, (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`refresh`)) AS `timeout` FROM " . $table_prefix . "users";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
			$department = $row['department'];
			
			// Display first department ONLY
			$multi_departments = split(';', $row['department']);
			if (is_array($multi_departments) && count($multi_departments) > 1) {
				$department = $multi_departments[0] . "..";
			}		
?> 
  <tr> 
    <td> <?php
if ($row['disabled'] == 1){
?> 
      <img src="../images/account_disabled.gif" alt="<?php echo($account_disabled_label); ?>"> 
      <?php
}
else {
	// Operator is Online and connected to Live Help
	if($row['timeout'] < $connection_timeout) {
		if($row['status'] == '0') { // Hidden
?> 
      <img src="../images/disconnected_small.gif" alt="<?php echo($offline_label); ?>"> 
      <?php
		}
		elseif($row['status'] == '1') { // Online
?> 
      <img src="../images/staff_small.gif" alt="<?php echo($online_label); ?>"> 
      <?php
		}
		elseif($row['status'] == '2') { // BRB
?> 
      <img src="../images/brb_small.gif" alt="<?php echo($brb_label); ?>"> 
      <?php
		}
	}
	// Operator is not Online connected to Live Help
	else{
?> 
      <img src="../images/disconnected_small.gif" alt="<?php echo($offline_label); ?>"> 
      <?php
	}
}
?> </td> 
    <td><?php echo($row['username']); ?></td> 
    <td><?php echo($row['firstname'] . ' ' . $row['lastname']); ?></td> 
    <td><?php echo($department); ?></td> 
    <td width="22"><input name="Edit" type="button" onClick="document.location = './users_edit.php?UID=<?php echo($row['id']); ?>'" value="<?php echo($edit_label); ?>"></td> 
    <td width="22"><input name="Delete" type="button" onClick="document.location = './users_delete.php?UID=<?php echo($row['id']); ?>'" value="<?php echo($delete_label); ?>"></td> 
  </tr> 
  <?php
		}
	}
}

?> 
  <tr> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
  </tr> 
  <tr> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td colspan="2"><div align="right"><a href="./users_add.php" class="normlink"><?php echo($add_user_label); ?></a></div></td> 
    <td><a href="./users_add.php"><img src="../images/user_add.gif" alt="<?php echo($add_user_label); ?>" width="22" height="22" border="0"></a></td> 
  </tr> 
</table> 
</body>
</html>
