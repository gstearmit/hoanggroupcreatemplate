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

if (!isset($_REQUEST['UID'])){ $_REQUEST['UID'] = ''; }
if (!isset($_REQUEST['UPDATE'])){ $_REQUEST['UPDATE'] = ''; }

$error = false;
$error_username = false;
$error_access_denied = false;

$user_id = $_REQUEST['UID'];

// Get the existing details, details of user that's details are being changed from the users table
$query = "SELECT * FROM " . $table_prefix . "users WHERE `id` = '$user_id'";
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$edit_user_id = $row['id'];
	$edit_username = $row['username'];
	$edit_first_name = $row['firstname'];
	$edit_last_name = $row['lastname'];
	$edit_email = $row['email'];
	$edit_department = $row['department'];
	$edit_access_level = $row['privilege'];
	$edit_disabled = $row['disabled'];
}

if($_REQUEST['UPDATE'] == true) {

	$username = $_REQUEST['USERNAME'];
	$first_name = $_REQUEST['FIRST_NAME'];
	$last_name = $_REQUEST['LAST_NAME'];
	$email = $_REQUEST['EMAIL'];
	$department = $_REQUEST['DEPARTMENT'];
	$disabled = $_REQUEST['DISABLED'];
	$privilege = $_REQUEST['PRIVILEGE'];

	if (($current_privilege > 1 && $current_user_id != $user_id) || ($current_privilege >= 1 && $current_department != $edit_department)) {
		$error_access_denied = true;
	}
	elseif ($username == '' || $first_name == '' || $email == '' || ($department == '' && $current_privilege < 1)) {
		$error = true;
	}
	elseif ($username != $edit_username) {
		// Check username doesn't already exist within the users table, duplicate users not allowed
		$query = "SELECT `id` FROM " . $table_prefix . "users WHERE `username` = '$username'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$error_username = true;
		}
	}

	if ($error == false && $error_username == false && $error_access_denied == false) {
		// Don't update username, account status and access levels if...
		// User is the default root user setup with the Install and default user is the entity changing their own details
		if ($current_privilege == -1  && $current_user_id == $edit_user_id) {
			$query = "UPDATE " . $table_prefix . "users SET firstname = '$first_name', lastname = '$last_name', email = '$email', department = '$department' WHERE `id` = '$user_id'";
			$SQL->miscquery($query);
			header('Location: ./users_index.php');
		}
		// Don't update account status and access levels if...
		// Logged in user is a Full Admin user or Root Superuser and...
		// they are changing their own details
		elseif($current_privilege < 1 && $current_user_id == $edit_user_id) {
			$query = "UPDATE " . $table_prefix . "users SET `username` = '$username', `firstname` = '$first_name', `lastname` = '$last_name', `email` = '$email', `department` = '$department' WHERE `id` = '$user_id'";
			$SQL->miscquery($query);
			header('Location: ./users_index.php');
		}
		// Update account status and access levels if...
		// Loged in user is a Full Admin user or Root Superuser and...
		// they are changing other users details
		elseif($current_privilege < 1 && $current_user_id != $edit_user_id) {
			$query = "UPDATE " . $table_prefix . "users SET `username` = '$username', `firstname` = '$first_name', `lastname` = '$last_name', `email` = '$email', `department` = '$department', `disabled` = '$disabled', `privilege` = '$privilege' WHERE `id` = '$user_id'";
			$SQL->miscquery($query);
			header('Location: ./users_index.php');
		}
		// Update account status if...
		// Loged in user is a Department Admin user and...
		// they are changing other users details within their department
		elseif($current_privilege == 1 && $current_user_id != $edit_user_id && $current_department == $edit_department) {
			$query = "UPDATE " . $table_prefix . "users SET `username` = '$username', `firstname` = '$first_name', `lastname` = '$last_name', `email` = '$email', `disabled` = '$disabled', `privilege` = '$privilege' WHERE `id` = '$user_id'";
			$SQL->miscquery($query);	
			header('Location: ./users_index.php');
		}
		// Update all user information details
		elseif($current_privilege >= 1) {
			$query = "UPDATE " . $table_prefix . "users SET `username` = '$username', `firstname` = '$first_name', `lastname` = '$last_name', `email` = '$email' WHERE `id` = '$user_id'";
			$SQL->miscquery($query);
			header('Location: ./users_index.php');
		}
		else {
			header('Location: ./users_index.php');
		}
	}
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
<div align="center"> 
  <form action="./users_edit.php?UID=<?php echo($edit_user_id); ?>" method="post"> 
    <table width="400" border="0"> 
      <tr> 
        <td width="22"><img src="../images/staff.gif" alt="<?php echo($manage_accounts_label); ?>" width="22" height="22"></td> 
        <td colspan="2"><em class="heading"><?php echo($edit_user_details_label); ?> - <?php echo($edit_username); ?></em></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2">&nbsp;</td> 
      </tr> 
      <?php
		if ($error_access_denied == true){
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"> <strong> <?php echo($edit_access_denied_label); ?></strong></div></td> 
      </tr> 
      <tr> 
        <?php
		}
		elseif ($error == true){
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"> <strong><?php echo($complete_error_label); ?></strong> </div></td> 
      </tr> 
      <tr> 
        <?php
		}
		elseif ($error_username == true){
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"> <strong><?php echo($add_user_exists_label); ?></strong> </div></td> 
      </tr> 
      <tr> 
        <?php
		}
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($username_label); ?>:</div></td> 
        <td><?php if(($edit_user_id == 1 && $edit_access_level == -1)) { ?> 
          <em><?php echo($edit_username); ?> (Superuser Account)
          <input name="USERNAME" type="hidden" value="<?php echo($edit_username); ?>"> 
          </em> 
          <?php } else { ?> 
          <input name="USERNAME" style="width: 175px" type="text" id="USERNAME" value="<?php echo($edit_username); ?>"> 
          <?php } ?></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($first_name_label); ?>:</div></td> 
        <td><input name="FIRST_NAME" style="width: 175px" type="text" id="FIRST_NAME" value="<?php echo($edit_first_name); ?>"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($last_name_label); ?>:</div></td> 
        <td><input name="LAST_NAME" style="width: 175px" type="text" id="LAST_NAME" value="<?php echo($edit_last_name); ?>"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($email_label); ?>:</div></td> 
        <td><input name="EMAIL" style="width: 175px" type="text" id="EMAIL" value="<?php echo($edit_email); ?>"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($department_label); ?>:</div></td> 
        <td><input name="DEPARTMENT" style="width: 175px" type="text" id="DEPARTMENT" value="<?php echo($edit_department); ?>"<?php if($current_privilege > 1) { echo(' disabled="true"'); } ?>></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($privilege_label); ?>:</div></td> 
        <td><select name="PRIVILEGE" style="width: 175px" id="PRIVILEGE"<?php if ($current_privilege > 1 || ($current_privilege == 1 && current_department != $edit_department)) { echo(' disabled="true"'); } ?>> 
            <option value="0"<?php if ($edit_access_level <= 0) { echo(' selected'); } ?>><?php echo($full_administrator_label); ?></option> 
            <option value="1"<?php if ($edit_access_level == 1) { echo(' selected'); } ?>><?php echo($department_administrator_label); ?></option> 
            <option value="2"<?php if ($edit_access_level == 2) { echo(' selected'); } ?>><?php echo($limited_administrator_label); ?></option> 
            <option value="3"<?php if ($edit_access_level == 3) { echo(' selected'); } ?>><?php echo($support_sales_staff_label); ?></option> 
            <option value="4"<?php if ($edit_access_level == 4) { echo(' selected'); } ?>><?php echo($guest_label); ?></option> 
          </select></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($account_status_label); ?>:</div></td> 
        <td> <input name="DISABLED" type="radio" value="0"<?php if ($edit_disabled == 0) { echo(' checked'); } ?><?php if ($current_privilege > 1 || ($current_privilege == 1 && current_department != $edit_department)) { echo(' disabled="true"'); } ?>> 
          <?php echo($enabled_label); ?> 
          <input name="DISABLED" type="radio" value="1"<?php if ($edit_disabled == 1) { echo(' checked'); } ?><?php if ($current_privilege > 1 || ($current_privilege == 1 && current_department != $edit_department)) { echo(' disabled="true"'); } ?>> 
          <?php echo($disabled_label); ?> </td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
      </tr> 
    </table> 
    <input name="UPDATE" type="hidden" id="UPDATE" value="true"> 
    <input type="submit" name="Submit" value="<?php echo($save_label); ?>"> 
&nbsp; 
    <input name="Password" type="button" onClick="document.location = './users_password.php?UID=<?php echo($edit_user_id); ?>'" value="<?php echo($change_password_label); ?>"> 
  </form> 
</div> 
<div align="right"><a href="users_index.php" class="normlink"><?php echo($back_to_user_accounts_label); ?></a></div>
</body>
</html>
