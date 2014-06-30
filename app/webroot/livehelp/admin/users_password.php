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
if (!isset($_REQUEST['COMPLETE'])){ $_REQUEST['COMPLETE'] = ''; }
if (!isset($_REQUEST['UPDATE'])){ $_REQUEST['UPDATE'] = ''; }

$error = false;
$error_password = false;
$error_incorrect = false;

$user_id = $_REQUEST['UID'];
$complete = $_REQUEST['COMPLETE'];

$query = "SELECT `username` FROM " . $table_prefix . "users WHERE `id` = '$user_id'";
$row = $SQL->selectquery($query);

if($_REQUEST['UPDATE'] == true) {

	$password = $_REQUEST['CURRENT_PASSWORD'];
	$new_password = $_REQUEST['NEW_PASSWORD'];
	$confirm_password = $_REQUEST['CONFIRM_PASSWORD'];

	if ($password == '' || $new_password == '' || $confirm_password == '') {
		$error = true;
	}
	elseif ($new_password != $confirm_password) {
		$error_password = true;
	}
	elseif (($error != true) && ($error_password != true)) {
		
		$query = "SELECT * FROM " . $table_prefix . "users WHERE `id` = '$user_id'";
		$row = $SQL->selectquery($query);
			if (!is_array($row)) {
				$error_incorrect = true;
			}
			else {
				
				$length = strlen($row['password']);
				switch ($length) {
					case 40: // SHA1
						$password = sha1($password);
						break;
					case 128: // SHA512
						if (function_exists('hash') && in_array('sha512', hash_algos())) {
							$password = hash('sha512', $password);
						} else {
							header('Location: ./index_popup.php?STATUS=algorithm');
							exit;
						}
						break;
					default: // MD5
						$password = md5($password);
						break;
				}
				
				if ($row['password'] == $password) {
				
					// Change Password
					if (function_exists('hash') && in_array('sha512', hash_algos())) {
						$new_password = hash('sha512', $new_password);
					} else {
						$new_password = sha1($new_password);
					}
					
					$query = "UPDATE " . $table_prefix . "users SET `password` = '$new_password' WHERE `id` = '$user_id'";
					$SQL->miscquery($query);	
					header('Location: ./users_password.php?COMPLETE=true&UID=' . $user_id);
					
				} else {
					$error_incorrect = true;
				}
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
  <form action="./users_password.php?UID=<?php echo($user_id); ?>" method="post"> 
    <table width="400" border="0"> 
      <tr> 
        <td width="22"><img src="../images/staff.gif" alt="<?php echo($manage_accounts_label); ?>" width="22" height="22"></td> 
        <td colspan="2"><em class="heading"><?php echo($change_user_password_label); ?> - <?php echo($row['username']); ?></em></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2">&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><table width="300" border="0" align="center"> 
            <tr> 
              <td width="32"><img src="../images/error.gif" alt="<?php echo($warning_label); ?>" width="32" height="32"></td> 
              <td><div align="center"> 
                  <p><em><?php echo($warning_label); ?><strong><br> 
                    </strong><?php echo($change_user_warning_label); ?></em></p> 
                </div></td> 
            </tr> 
          </table></td> 
      </tr> 
      <?php
		if ($error == true){
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"><?php echo($complete_error_label); ?> </div></td> 
      </tr> 
      <?php
		}
		if ($error_password == true){
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><div align="center"><strong><?php echo($change_user_match_error_label); ?></strong></div></td> 
      </tr> 
      <?php
		}
		if ($error_incorrect == true){
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><div align="center"><strong><?php echo($change_user_password_error_label); ?></strong></div></td> 
      </tr> 
      <?php
		}
		if ($complete == true){
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><div align="center"><strong><?php echo($change_user_changed_label); ?></strong></div></td> 
      </tr> 
      <?php
		}
		?> 
      <tr> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($current_password_label); ?>: </div></td> 
        <td><input name="CURRENT_PASSWORD" style="width: 175px" type="password" id="CURRENT_PASSWORD"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"> <?php echo($new_password_label); ?>:</div></td> 
        <td><input name="NEW_PASSWORD" style="width: 175px" type="password" id="NEW_PASSWORD"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($retype_password_label); ?>:</div></td> 
        <td><input name="CONFIRM_PASSWORD" style="width: 175px" type="password" id="CONFIRM_PASSWORD"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
      </tr> 
    </table> 
    <input name="UPDATE" type="hidden" id="UPDATE" value="true"> 
    <input type="submit" name="Submit" value="<?php echo($update_password_label); ?>">
  </form> 
</div> 
<div align="right"><a href="users_index.php" class="normlink"><?php echo($back_to_user_accounts_label); ?></a></div>
</body>
</html>
