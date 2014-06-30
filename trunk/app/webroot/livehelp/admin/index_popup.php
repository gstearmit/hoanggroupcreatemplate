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

$installed = false;
$database = include('../include/database.php');
if ($database) {
	include('../include/spiders.php');
	include('../include/class.mysql.php');
	include('../include/class.cookie.php');
	$installed = include('../include/config.php');
	include('../include/version.php');
} else {
	$installed = false;
	include('../include/settings.php');
}

$install_dir = '../install';

if (!isset($_REQUEST['STATUS'])){ $_REQUEST['STATUS'] = ''; }
$status = $_REQUEST['STATUS'];

$username = ''; $password = '';
if (isset($_COOKIE['LiveHelpOperatorLogin'])) {
	$session = array(); $cookie = new Cookie();
	$session = $cookie->decodeOperatorLogin($_COOKIE['LiveHelpOperatorLogin']);
	$username = $session['USERNAME'];
	$password = $session['PASSWORD'];
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
<title><?php echo($_SETTINGS['NAME']) ?> - Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
</head>
<body link="#000000" vlink="#000000" alink="#000000">
<br>
<div align="center">
  <p><img src="../images/help_logo_admin.gif" alt="stardevelop.com Live Help" width="289" height="105" border="0" /></p>
  <p><?php echo($welcome_message_label); ?>
<?php
  if ($installed == false) {
?>
    <br>
<?php
  echo($enter_user_pass_label);
  }
?>
  </p>
<?php
if($status == 'error') {
?>
  <p><strong><?php echo($access_denied_label); ?></strong></p>
<?php
}
elseif($status == 'disabled') {
?>
  <p><strong><?php echo($access_denied_account_disabled_label); ?></strong></p>
    <?php
}
if ($installed == true) {
?>
  <form name="login" method="POST" action="frames.php">
    <table width="300" border="0">
      <tr>
        <td><div align="right"><?php echo($username_label); ?>:</div></td>
        <td><input name="USER_NAME" type="text" value="<?php echo($username); ?>" style="width:150px;"></td>
      </tr>
      <tr>
        <td><div align="right"><?php echo($password_label); ?>:</div></td>
        <td><input name="PASSWORD" type="password" value="<?php echo(substr($password, 0, 8)); ?>" style="width:150px;"></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
            <input name="REMEMBER" type="checkbox" value="true" <?php if (isset($_COOKIE['LiveHelpOperatorLogin'])) { echo('checked'); } ?>>
            <span class="small">
            <?php
		  	echo($remember_login_details_label);
	?>
            </span></div></td>
      </tr>
    </table>
    <p class="small"><em><?php echo($admin_supports_line_one_label); ?><br>
      <?php echo($admin_supports_line_two_label); ?></em><br>
      <em><?php echo($admin_supports_line_three_label); ?></em></p>
    <p>
      <input type="hidden" name="SERVER" value="<?php echo($_SERVER['HTTP_HOST']); ?>">
    </p>
    <p>
      <input name="Submit" type="submit" id="Submit" value="<?php echo($login_label); ?>">
    </p>
  </form>
  <?php
}

if ($installed == true && file_exists($install_dir)) {
?>
  <table width="300" border="0">
    <tr>
      <td width="32"><img src="../images/error.gif" alt="<?php echo($warning_label); ?>" width="32" height="32"></td>
      <td><div align="center">
          <p><span class="heading"><em><?php echo($security_warning_label); ?><strong></strong></em></span><em><strong><br>
            </strong><?php echo($security_instructions_label); ?></em></p>
        </div></td>
    </tr>
  </table>
  <?php
}
?>
  <p class="small"><?php echo($stardevelop_copyright_label); ?></p>
</div>
</body>
</html>
