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

if (isset($_REQUEST['INITIATECHATVERTICAL'])){ $_SETTINGS['INITIATECHATVERTICAL'] = $_REQUEST['INITIATECHATVERTICAL']; }
if (isset($_REQUEST['INITIATECHATHORIZONTAL'])){ $_SETTINGS['INITIATECHATHORIZONTAL'] = $_REQUEST['INITIATECHATHORIZONTAL']; }
if (isset($_REQUEST['CHATUSERNAME'])){ $_SETTINGS['CHATUSERNAME'] = $_REQUEST['CHATUSERNAME']; }
if (isset($_REQUEST['CAMPAIGNIMAGE'])){ $_SETTINGS['CAMPAIGNIMAGE'] = $_REQUEST['CAMPAIGNIMAGE']; }
if (isset($_REQUEST['CAMPAIGNLINK'])){ $_SETTINGS['CAMPAIGNLINK'] = $_REQUEST['CAMPAIGNLINK']; }
if (isset($_REQUEST['REQUIREGUESTDETAILS'])){ $_SETTINGS['REQUIREGUESTDETAILS'] = $_REQUEST['REQUIREGUESTDETAILS']; }
if (isset($_REQUEST['P3P'])){ $_SETTINGS['P3P'] = $_REQUEST['P3P']; }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
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
  <form name="UPDATE_SETTINGS" method="post" action="settings_chat.php"> 
    <table width="400" border="0" align="center"> 
      <tr> 
        <td width="22"><img src="../images/configure_small.gif" alt="<?php echo($manage_settings_label); ?> - <?php echo($display_label); ?>" width="22" height="22"></td> 
        <td colspan="2"><em class="heading"><?php echo($manage_settings_label); ?> - <?php echo($chat_label); ?></em> </td> 
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
        <td><div align="right"><?php echo($initiate_vert_align_label); ?>: </div></td> 
        <td><select name="INITIATECHATVERTICAL" id="INITIATECHATVERTICAL" style="width:60px;"> 
            <option value="Top" <?php if ($_SETTINGS['INITIATECHATVERTICAL'] == 'Top') { echo('selected'); } ?>>Top</option> 
            <option value="Center" <?php if ($_SETTINGS['INITIATECHATVERTICAL'] == 'Center') { echo('selected'); } ?>>Center</option> 
            <option value="Bottom" <?php if ($_SETTINGS['INITIATECHATVERTICAL'] == 'Bottom') { echo('selected'); } ?>>Bottom</option> 
          </select> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="top: 40px;"><?php echo($initiate_vert_align_label); ?>: <?php echo($initiate_vert_align_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($initiate_horz_align_label); ?>:</div></td> 
        <td><select name="INITIATECHATHORIZONTAL" id="INITIATECHATHORIZONTAL" style="width:60px;"> 
            <option value="Left" <?php if ($_SETTINGS['INITIATECHATHORIZONTAL'] == 'Left') { echo('selected'); } ?>>Left</option> 
            <option value="Middle" <?php if ($_SETTINGS['INITIATECHATHORIZONTAL'] == 'Middle') { echo('selected'); } ?>>Middle</option> 
            <option value="Right" <?php if ($_SETTINGS['INITIATECHATHORIZONTAL'] == 'Right') { echo('selected'); } ?>>Right</option> 
          </select> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span><?php echo($initiate_horz_align_label); ?>: <?php echo($initiate_horz_align_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($chat_username_label); ?>:</div></td> 
        <td> <input type="radio" name="CHATUSERNAME" value="-1" <?php if ($_SETTINGS['CHATUSERNAME'] == true) { echo("checked"); }?>> 
          <?php echo($on_label); ?> 
          <input type="radio" name="CHATUSERNAME" value="0" <?php if ($_SETTINGS['CHATUSERNAME'] == false) { echo("checked"); }?>> 
          <?php echo($off_label); ?> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -115px"><?php echo($chat_username_label); ?>: <?php echo($disable_chat_username_tooltip_label); ?>.</span></a></td> 
      </tr>
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($campaign_image_label); ?>:</div></td> 
        <td><input name="CAMPAIGNIMAGE" type="text" id="CAMPAIGNIMAGE" value="<?php echo($_SETTINGS['CAMPAIGNIMAGE']); ?>"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -150px"><?php echo($campaign_image_label); ?>: <?php echo($campaign_image_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($campaign_link_label); ?>:</div></td> 
        <td><input name="CAMPAIGNLINK" type="text" id="CAMPAIGNLINK" value="<?php echo($_SETTINGS['CAMPAIGNLINK']); ?>"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -150px"><?php echo($campaign_link_label); ?>: <?php echo($campaign_link_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($require_guest_details_label); ?>:</div></td> 
        <td> <input type="radio" name="REQUIREGUESTDETAILS" value="-1" <?php if ($_SETTINGS['REQUIREGUESTDETAILS'] == true) { echo("checked"); }?>> 
          <?php echo($on_label); ?> 
          <input type="radio" name="REQUIREGUESTDETAILS" value="0" <?php if ($_SETTINGS['REQUIREGUESTDETAILS'] == false) { echo("checked"); }?>> 
          <?php echo($off_label); ?> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -115px"><?php echo($require_guest_details_label); ?>: <?php echo($require_guest_details_tooltip_label); ?>.</span></a></td> 
      </tr>
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($p3p_label); ?>:</div></td> 
        <td><input name="P3P" type="text" id="P3P" value="<?php echo($_SETTINGS['P3P']); ?>"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -160px"><?php echo($p3p_label); ?>: <?php echo($p3p_tooltip_label); ?>.</span></a></td> 
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
