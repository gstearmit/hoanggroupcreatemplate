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
if (!isset($_REQUEST['DELETE'])){ $_REQUEST['DELETE'] = ''; }
$error_access_denied = '';

$user_id = $_REQUEST['UID'];

$query = "SELECT * FROM " . $table_prefix . "users WHERE `id` = '$user_id'";
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$delete_user_id = $row['id'];
	$delete_username = $row['username'];
	$delete_first_name = $row['firstname'];
	$delete_last_name = $row['lastname'];
	$delete_email = $row['email'];
	$delete_department = $row['department'];
}

if($_REQUEST['DELETE'] == true) {

	if (($current_user_id == $user_id) || ($current_privilege > 1 && $current_user_id != $user_id) || ($current_privilege == 1 && $current_department != $delete_department)) {
		$error_access_denied = true;
	}
	else {
		$query = "DELETE FROM " . $table_prefix . "users WHERE `id` = '$user_id'";
		$SQL->miscquery($query);
		header('Location: ./users_index.php');
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
  <form action="./users_delete.php?UID=<?php echo($delete_user_id); ?>" method="post"> 
    <table width="400" border="0"> 
      <tr> 
        <td width="22"><img src="../images/staff.gif" alt="<?php echo($manage_accounts_label); ?>" width="22" height="22"></td> 
        <td colspan="2"><em class="heading"><?php echo($delete_user_details_label); ?> - <?php echo($delete_username); ?></em></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"> 
            <table width="300" border="0"> 
              <tr> 
                <td width="32"><img src="../images/error.gif" alt="<?php echo($warning_label); ?>" width="32" height="32"></td> 
                <td><div align="center"> 
                    <p><em><?php echo($warning_label); ?><strong><br> 
                      </strong><?php echo($delete_user_warning_label); ?></em></p> 
                  </div></td> 
              </tr> 
            </table> 
          </div></td> 
      </tr> 
      <?php
		if ($error_access_denied == true){
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"> <strong> <?php echo($delete_access_denied_label); ?></strong></div></td> 
      </tr> 
      <tr> 
        <?php
		}
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($username_label); ?>:</div></td> 
        <td><input name="USERNAME" type="text" id="USERNAME" value="<?php echo($delete_username); ?>"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($first_name_label); ?>:</div></td> 
        <td><input name="FIRST_NAME" type="text" id="FIRST_NAME" value="<?php echo($delete_first_name); ?>"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($last_name_label); ?>:</div></td> 
        <td><input name="LAST_NAME" type="text" id="LAST_NAME" value="<?php echo($delete_last_name); ?>"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($email_label); ?>:</div></td> 
        <td><input name="EMAIL" type="text" id="EMAIL" value="<?php echo($delete_email); ?>"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($department_label); ?>:</div></td> 
        <td><input name="DEPARTMENT" type="text" id="DEPARTMENT" value="<?php echo($delete_department); ?>"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
      </tr> 
    </table> 
    <input name="DELETE" type="hidden" id="DELETE" value="true"> 
    <input type="submit" name="Submit" value="<?php echo($delete_user_label); ?>"> 
  </form> 
</div> 
<div align="right"><a href="users_index.php" class="normlink"><?php echo($back_to_user_accounts_label); ?></a></div>
</body>
</html>
