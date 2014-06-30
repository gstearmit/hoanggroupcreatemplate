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

include('settings_include.php');

if (isset($_REQUEST['BACKGROUNDCOLOR'])){ $_SETTINGS['BACKGROUNDCOLOR'] = $_REQUEST['BACKGROUNDCOLOR']; }
if (isset($_REQUEST['CHATFONT'])){ $_SETTINGS['CHATFONT'] = $_REQUEST['CHATFONT']; }
if (isset($_REQUEST['CHATFONTSIZE'])){ $_SETTINGS['CHATFONTSIZE'] = $_REQUEST['CHATFONTSIZE']; }
if (isset($_REQUEST['LOCALE'])){ $_SETTINGS['LOCALE'] = $_REQUEST['LOCALE']; }
if (isset($_REQUEST['SMILIES'])){ $_SETTINGS['SMILIES'] = $_REQUEST['SMILIES']; }

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
  <form name="UPDATE_SETTINGS" method="post" action="settings_display.php"> 
    <table width="400" border="0" align="center"> 
      <tr> 
        <td width="22"><img src="../images/configure_small.gif" alt="<?php echo($manage_settings_label); ?> - <?php echo($display_label); ?>" width="22" height="22"></td> 
        <td colspan="3"><em class="heading"><?php echo($manage_settings_label); ?> - <?php echo($display_label); ?></em> </td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><?php include("./settings_toolbar.php"); ?></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($background_color_label); ?>:</div></td> 
        <td><input name="BACKGROUNDCOLOR" type="text" id="BACKGROUNDCOLOR" value="<?php echo($_SETTINGS['BACKGROUNDCOLOR']); ?>" size="7" maxlength="7"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -40px;"><?php echo($background_color_label); ?>: <?php echo($background_color_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($chat_font_type_label); ?>:</div></td> 
        <td><input name="CHATFONT" type="text" id="CHATFONT" value="<?php echo($_SETTINGS['CHATFONT']); ?>"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -125px"><?php echo($chat_font_type_label); ?>: <?php echo($chat_font_type_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($chat_font_size_label); ?>:</div></td> 
        <td><input name="CHATFONTSIZE" type="text" id="CHATFONTSIZE" value="<?php echo($_SETTINGS['CHATFONTSIZE']); ?>" size="7" maxlength="7"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="top:-60px; left:-125px;"><?php echo($chat_font_size_label); ?>: <?php echo($chat_font_size_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($locale_label); ?>:</div></td>
        <td><select name="LOCALE">
            <?php
$languages = file('../locale/i18n.txt');
foreach ($languages as $key => $line) {
	$i18n = split(',', $line);
	$code = trim($i18n[0]);
	$name = trim($i18n[1]);
	$available = file_exists('../locale/' . $code . '/admin.php');
	if ($available) {
?>
            <option value="<?php echo($code); ?>"<?php if ($_SETTINGS['LOCALE'] == $code) { echo(' selected'); } ?>><?php echo($name . ' [' . $code . ' - utf-8]'); ?></option>
            <?php
	}
}
?>
        </select> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -145px;"><?php echo($locale_label); ?>: <?php echo($locale_tooltip_label); ?>.</span></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($smilies_label); ?>:</div></td>
        <td><input name="SMILIES" type="radio" value="-1" <?php if ($_SETTINGS['SMILIES'] == true) { echo("checked"); }?>>
            <?php echo($on_label); ?>
            <input name="SMILIES" type="radio" value="0" <?php if ($_SETTINGS['SMILIES'] == false) { echo("checked"); }?>>
            <?php echo($off_label); ?> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span><?php echo($smilies_label); ?>: <?php echo($smilies_tooltip_label); ?>.</span></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><div align="center"> 
            <input name="SAVE" type="hidden" id="SAVE" value="1"> 
            <input name="Submit" type="submit" id="Submit" value="<?php echo($save_label); ?>" <?php if ($current_privilege > 2 || $_REQUEST['SAVE'] == true) { echo('disabled="true"'); } ?>>
          </div></td> 
      </tr> 
    </table> 
  </form> 
</div> 
</body>
</html>
