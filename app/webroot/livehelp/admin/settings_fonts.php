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

if (isset($_REQUEST['FONT'])){ $_SETTINGS['FONT'] = $_REQUEST['FONT']; }
if (isset($_REQUEST['FONTSIZE'])){ $_SETTINGS['FONTSIZE'] = $_REQUEST['FONTSIZE']; }
if (isset($_REQUEST['FONTCOLOR'])){ $_SETTINGS['FONTCOLOR'] = $_REQUEST['FONTCOLOR']; }
if (isset($_REQUEST['SENTFONTCOLOR'])){ $_SETTINGS['SENTFONTCOLOR'] = $_REQUEST['SENTFONTCOLOR']; }
if (isset($_REQUEST['RECEIVEDFONTCOLOR'])){ $_SETTINGS['RECEIVEDFONTCOLOR'] = $_REQUEST['RECEIVEDFONTCOLOR']; }
if (isset($_REQUEST['LINKCOLOR'])){ $_SETTINGS['LINKCOLOR'] = $_REQUEST['LINKCOLOR']; }
if (isset($_REQUEST['BACKGROUNDCOLOR'])){ $_SETTINGS['BACKGROUNDCOLOR'] = $_REQUEST['BACKGROUNDCOLOR']; }
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
  <form name="UPDATE_SETTINGS" method="post" action="settings_fonts.php"> 
    <table width="400" border="0" align="center"> 
      <tr> 
        <td width="22"><img src="../images/configure_small.gif" alt="<?php echo($manage_settings_label); ?> - <?php echo($display_label); ?>" width="22" height="22"></td> 
        <td colspan="2"><em class="heading"><?php echo($manage_settings_label); ?> - <?php echo($fonts_label); ?></em> </td> 
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
        <td><div align="right"><?php echo($font_type_label); ?>: </div></td> 
        <td><input name="FONT" type="text" id="FONT" value="<?php echo($_SETTINGS['FONT']); ?>" size="25"> 
        <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -175px;"><?php echo($font_type_label); ?>: <?php echo($font_type_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($font_size_label); ?>:</div></td> 
        <td><input name="FONTSIZE" type="text" id="FONTSIZE" value="<?php echo($_SETTINGS['FONTSIZE']); ?>" size="7" maxlength="7"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span><?php echo($font_size_label); ?>: <?php echo($font_size_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($font_color_label); ?>:</div></td> 
        <td> <input name="FONTCOLOR" type="text" id="FONTCOLOR" value="<?php echo($_SETTINGS['FONTCOLOR']); ?>" size="7" maxlength="7"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span><?php echo($font_color_label); ?>: <?php echo($font_color_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($font_link_color_label); ?>:</div></td> 
        <td> <input name="LINKCOLOR" type="text" id="LINKCOLOR" value="<?php echo($_SETTINGS['LINKCOLOR']); ?>" size="7" maxlength="7"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span><?php echo($font_link_color_label); ?>: <?php echo($font_link_color_tooltip_label); ?>.</span></a></td> 
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($sent_font_color_label); ?>:</div></td>
        <td><input name="SENTFONTCOLOR" type="text" id="SENTFONTCOLOR" value="<?php echo($_SETTINGS['SENTFONTCOLOR']); ?>" size="7" maxlength="7"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="width: 200px;"><?php echo($sent_font_color_label); ?>: <?php echo($sent_font_color_tooltip_label); ?>.</span></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($received_font_color_label); ?>:</div></td>
        <td><input name="RECEIVEDFONTCOLOR" type="text" id="RECEIVEDFONTCOLOR" value="<?php echo($_SETTINGS['RECEIVEDFONTCOLOR']); ?>" size="7" maxlength="7"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="width: 200px;"><?php echo($received_font_color_label); ?>: <?php echo($received_font_color_tooltip_label); ?>.</span></a></td>
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
