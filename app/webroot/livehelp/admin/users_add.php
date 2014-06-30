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

if (!isset($_REQUEST['ADD'])){ $_REQUEST['ADD'] = ''; }
$error = '';
$error_username = '';
$error_access_denied = '';
$username = '';
$first_name = '';
$last_name = '';
$password = '';
$password_retype = '';
$email = '';
$department = '';
$privilege = '';

if($_REQUEST['ADD'] == true) {

	$username = $_REQUEST['USERNAME'];
	$first_name = $_REQUEST['FIRST_NAME'];
	$last_name = $_REQUEST['LAST_NAME'];
	$password = $_REQUEST['PASSWORD'];
	$password_retype = $_REQUEST['PASSWORD_RETYPE'];
	$email = $_REQUEST['EMAIL'];
	$department = $_REQUEST['DEPARTMENT'];
	$privilege = $_REQUEST['PRIVILEGE'];
	
	if ($current_privilege > 1 && $current_username != $username) {
		$error_access_denied = true;
	}
	elseif ($username == '' || $first_name == '' || $password == '' || $password_retype == '' || $email == '' || $department == '' || $password != $password_retype) {
		$error = true;
	}
	else {
		// Check username doesn't already exist within the users table, duplicate users not allowed
		$query = "SELECT `id` FROM " . $table_prefix . "users WHERE `username` = '$username'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$error_username = true;
		}
		elseif ($error == '' && $error_access_denied == '' && $error_username == '') {
		
			if (function_exists('hash') && in_array('sha512', hash_algos())) {
				$password = hash('sha512', $password);
			} else {
				$password = sha1($password);
			}
			$query = "INSERT INTO " . $table_prefix . "users(`username`, `firstname`, `lastname`, `password`, `email`, `department`, `privilege`) VALUES('$username', '$first_name', '$last_name', '$password', '$email', '$department', '$privilege')";
			$SQL->insertquery($query);
			header('Location: ./users_index.php?');
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
  <form action="./users_add.php" method="post">
    <table width="400" border="0">
      <tr>
        <td width="22"><img src="../images/user_add.gif" alt="<?php echo($add_user_details_label); ?>" width="22" height="22"></td>
        <td colspan="2"><em class="heading"><?php echo($add_user_details_label); ?></em></td>
      </tr>
      <?php
		if ($error_access_denied == true){
		?>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><div align="center"> <strong><?php echo($add_access_denied_label); ?></strong> </div></td>
      </tr>
      <tr>
        <?php
		}
		elseif ($error == true){
		?>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><div align="center"> <strong><?php echo($add_user_error_label); ?></strong> </div></td>
      </tr>
      <tr>
        <?php
		}
		elseif ($error_username == true){
		?>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><div align="center"> <strong><?php echo($add_user_exists_label); ?></strong> </div></td>
      </tr>
      <tr>
        <?php
		}
		?>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($username_label); ?>:</div></td>
        <td><input name="USERNAME" style="width: 175px" type="text" id="USERNAME" value="<?php echo($username); ?>"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($first_name_label); ?>:</div></td>
        <td><input name="FIRST_NAME" style="width: 175px" type="text" id="FIRST_NAME" value="<?php echo($first_name); ?>"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($last_name_label); ?>:</div></td>
        <td><input name="LAST_NAME" style="width: 175px" type="text" id="LAST_NAME" value="<?php echo($last_name); ?>"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($password_label); ?>:</div></td>
        <td><input name="PASSWORD" style="width: 175px" type="password" id="PASSWORD"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($retype_password_label); ?>:</div></td>
        <td><input name="PASSWORD_RETYPE" style="width: 175px" type="password" id="PASSWORD_RETYPE"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($email_label); ?>:</div></td>
        <td><input name="EMAIL" style="width: 175px" type="text" id="EMAIL" value="<?php echo($email); ?>"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($department_label); ?>:</div></td>
        <td><?php if(($current_privilege == 1)) { ?>
          <em><?php echo($current_department); ?>
          <input name="DEPARTMENT" type="hidden" value="<?php echo($current_department); ?>">
          </em>
          <?php } else { ?>
          <input name="DEPARTMENT" style="width: 175px" type="text" id="DEPARTMENT" value="<?php echo($department); ?>">
          <?php } ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($privilege_label); ?>:</div></td>
        <td><select name="PRIVILEGE" style="width: 175px" id="PRIVILEGE"<?php if($current_privilege > 1) { echo(' disabled="true"'); } ?>>
            <?php
			if($current_privilege != 1) {
			?>
            <option value="0"<?php if ($privilege == 0) { echo(' selected'); } ?>><?php echo($full_administrator_label); ?></option>
            <option value="1"<?php if ($privilege == 1) { echo(' selected'); } ?>><?php echo($department_administrator_label); ?></option>
            <?php
			}
			?>
            <option value="2"<?php if ($privilege == 2) { echo(' selected'); } ?>><?php echo($limited_administrator_label); ?></option>
            <option value="3"<?php if ($privilege == 3) { echo(' selected'); } ?>><?php echo($support_sales_staff_label); ?></option>
            <option value="4"<?php if ($privilege == 4) { echo(' selected'); } ?>><?php echo($guest_label); ?></option>
          </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <input name="ADD" type="hidden" id="ADD" value="true">
    <input type="submit" name="Submit" value="<?php echo($add_user_label); ?>">
  </form>
</div>
<div align="right"><a href="users_index.php" class="normlink"><?php echo($back_to_user_accounts_label); ?></a></div>
</body>
</html>
