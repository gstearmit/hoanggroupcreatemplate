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

if (!isset($_REQUEST['REFERER'])){ $_REQUEST['REFERER'] = ''; }
if (!isset($_REQUEST['URL'])){ $_REQUEST['URL'] = ''; }
if (!isset($_REQUEST['SERVER'])){ $_REQUEST['SERVER'] = ''; }
if (!isset($_REQUEST['TITLE'])){ $_REQUEST['TITLE'] = ''; }
if (!isset($_REQUEST['DEPARTMENT'])){ $_REQUEST['DEPARTMENT'] = ''; }
if (!isset($_REQUEST['ERROR'])){ $_REQUEST['ERROR'] = ''; }

$installed = false;
$database = include('include/database.php');
if ($database) {
	include('include/spiders.php');
	include('include/class.mysql.php');
	include('include/class.cookie.php');
	$installed = include('include/config.php');
	include('include/version.php');
} else {
	$installed = false;
}

if ($installed == false) {
	header('Location: offline.php');
	exit();
}

header('Content-type: text/html; charset=utf-8');

if (file_exists('locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('locale/' . LANGUAGE_TYPE . '/guest.php');
} else {
	include('locale/en/guest.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<link href="styles/styles.php" rel="stylesheet" type="text/css"/>
<style type="text/css">
<!--
.background {
	background-image: url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/Banner.png);
	background-repeat: no-repeat;
	background-position: center top;
	margin-left: 0px;
	margin-top: 0px;
	text-align: center;
	min-width: 600px;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--

function disableForm() {
	document.login.Submit.disabled = true;
	return true;
}

//-->
</script>
</head>
<body bgcolor="<?php echo($_SETTINGS['BACKGROUNDCOLOR']); ?>" text="<?php echo($_SETTINGS['FONTCOLOR']); ?>" link="<?php echo($_SETTINGS['LINKCOLOR']); ?>" vlink="<?php echo($_SETTINGS['LINKCOLOR']); ?>" alink="<?php echo($_SETTINGS['LINKCOLOR']); ?>" class="background">
<div style="margin:0 auto; text-align:left; width:600px;">
<?php if ($_SETTINGS['LOGO'] != '') { ?>
<img src="<?php echo($_REQUEST['SERVER'] . $_SETTINGS['LOGO']); ?>" alt="<?php echo($_SETTINGS['NAME']); ?>" border="0" style="position:relative; top:10px; left:15px;"/>
<div align="center" style="position:relative; top:20px;">
<?php } else { ?>
<div align="center" style="position:relative; top:90px;">
<?php } ?>
  <p><?php echo($welcome_label); ?><br/>
    <?php echo($also_send_message_label); ?>.</p>
  <table width="400" border="0" cellpadding="5">
    <tr>
      <td width="32"><img src="images/note.gif" alt="<?php echo($cookies_error_label); ?>" width="53" height="57" border="0"/></td>
      <td><div align="center">
          <p><span class="heading"><em><?php echo($cookies_error_label); ?></em></span><em><strong><br/>
            </strong><?php echo($cookies_enable_label); ?></em></p>
          <p><em><?php echo($cookies_else_label); ?></em></p>
        </div></td>
    </tr>
  </table>
  <p class="small"><?php echo($stardevelop_copyright_label); ?></p>
</div></div>
</body>
</html>
