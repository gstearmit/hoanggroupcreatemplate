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

if (!isset($_SERVER['DOCUMENT_ROOT'])){ $_SERVER['DOCUMENT_ROOT'] = ""; }

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
	background-image: url(../images/background_settings.gif);
	background-repeat: no-repeat;
	background-position: right bottom;
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>

</head>
<body class="background">
<div align="center">
  <table width="400" border="0" align="center">
    <tr>
      <td width="22"><img src="../images/configure_small.gif" alt="<?php echo($manage_settings_label); ?> - <?php echo($general_label); ?>" width="22" height="22"></td>
      <td><em class="heading"><?php echo($manage_settings_label); ?> - <?php echo($code_label); ?></em> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><?php include("./settings_toolbar.php"); ?>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center">
          <textarea name="textarea" cols="35" rows="2" style="width:300px;height:35px;"><?php echo($head); ?></textarea>
        </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center" class="small"><em><strong><?php echo($steps_label); ?> 1: </strong><?php echo($script_details_label); ?></em></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center">
          <textarea name="textarea" cols="35" rows="2" style="width:300px;height:35px;"><?php echo($body); ?></textarea>
        </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center" class="small"><em><strong><?php echo($steps_label); ?> 2: </strong><?php echo($online_tracker_details_label); ?></em></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center">
        <div align="center">
			<textarea name="textarea" cols="35" rows="2" style="width:300px;height:35px;"><?php echo($image); ?></textarea></textarea>
		</div></td></tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center" class="small"><em><strong><?php echo($steps_label); ?> 3: </strong><?php echo($status_indicator_details_label); ?></em></div></td>
    </tr>
  </table>
</div>
</body>
</html>