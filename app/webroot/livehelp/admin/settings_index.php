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

if (isset($_REQUEST['DOMAIN'])){ $_SETTINGS['DOMAIN'] = $_REQUEST['DOMAIN']; }
if (isset($_REQUEST['URL'])){ $_SETTINGS['URL'] = $_REQUEST['URL']; }
if (isset($_REQUEST['NAME'])){ $_SETTINGS['NAME'] = $_REQUEST['NAME']; }
if (isset($_REQUEST['LOGO'])){ $_SETTINGS['LOGO'] = $_REQUEST['LOGO']; }
if (isset($_REQUEST['INTRODUCTION'])){ $_SETTINGS['INTRODUCTION'] = $_REQUEST['INTRODUCTION']; }
if (isset($_REQUEST['DEPARTMENTS'])){ $_SETTINGS['DEPARTMENTS'] = $_REQUEST['DEPARTMENTS']; }
if (isset($_REQUEST['TIMEZONE'])){ $_SETTINGS['TIMEZONE'] = $_REQUEST['TIMEZONE']; }
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
  <form name="UPDATE_SETTINGS" method="post" action="settings_index.php"> 
    <table width="400" border="0" align="center"> 
      <tr> 
        <td width="22"><img src="../images/configure_small.gif" alt="<?php echo($manage_settings_label); ?> - <?php echo($general_label); ?>" width="22" height="22"></td> 
        <td colspan="2"><em class="heading"><?php echo($manage_settings_label); ?> - <?php echo($general_label); ?></em> </td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><?php include("./settings_toolbar.php"); ?> </td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($site_name_label); ?>:</div></td> 
        <td><input name="DOMAIN" type="text" id="DOMAIN" value="<?php echo($_SETTINGS['DOMAIN']); ?>" style="width: 200px;"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -125px"><?php echo($site_name_label); ?>: <?php echo($site_name_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($site_address_label); ?>:</div></td> 
        <td><input name="URL" type="text" id="URL" value="<?php echo($_SETTINGS['URL']); ?>" style="width: 200px;"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -125px"><?php echo($site_address_label); ?>: <?php echo($site_address_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($live_help_name_label); ?>:</div></td> 
        <td><input name="NAME" type="text" id="NAME" value="<?php echo($_SETTINGS['NAME']); ?>" style="width: 200px;"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -125px"><?php echo($live_help_name_label); ?>: <?php echo($live_help_name_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($live_help_logo_label); ?>:</div></td> 
        <td><input name="LOGO" type="text" id="LOGO" value="<?php echo($_SETTINGS['LOGO']); ?>" style="width: 200px;"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -125px"><?php echo($live_help_logo_label); ?>: <?php echo($live_help_logo_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($welcome_note_label); ?>: </div></td> 
        <td><input name="INTRODUCTION" type="text" id="INTRODUCTION" value="<?php echo($_SETTINGS['INTRODUCTION']); ?>" style="width: 200px;"> <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -125px"><?php echo($welcome_note_label); ?>: <?php echo($welcome_note_tooltip_label); ?>.</span></a></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($departments_label); ?>:</div></td> 
        <td> <input name="DEPARTMENTS" type="radio" value="-1" <?php if ($_SETTINGS['DEPARTMENTS'] == true) { echo("checked"); }?>> 
          <?php echo($on_label); ?> 
          <input name="DEPARTMENTS" type="radio" value="0" <?php if ($_SETTINGS['DEPARTMENTS'] == false) { echo("checked"); }?>> 
          <?php echo($off_label); ?>  <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="width: 200px; top: -60px; left: -80px;"><?php echo($departments_label); ?>: <?php echo($departments_tooltip_label); ?>.</span></a></td> 
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><?php echo($timezone_label); ?>:</div></td>
        <td><select name="TIMEZONE" width="200" style="width: 225px;">
            <option value="-1200" <?php if($_SETTINGS['TIMEZONE'] == '-1200') { echo('selected'); } ?>>(GMT-12:00 <?php echo($hours_label); ?>) Internat. Date Line West</option>
            <option value="-1100" <?php if($_SETTINGS['TIMEZONE'] == '-1100') { echo('selected'); } ?>>(GMT-11:00 <?php echo($hours_label); ?>) Midway Island, Samoa</option>
            <option value="-1000" <?php if($_SETTINGS['TIMEZONE'] == '-1000') { echo('selected'); } ?>>(GMT-10:00 <?php echo($hours_label); ?>) Hawaii</option>
            <option value="-0900" <?php if($_SETTINGS['TIMEZONE'] == '-0900') { echo('selected'); } ?>>(GMT-09:00 <?php echo($hours_label); ?>) Alaska</option>
            <option value="-0800" <?php if($_SETTINGS['TIMEZONE'] == '-0800') { echo('selected'); } ?>>(GMT-08:00 <?php echo($hours_label); ?>) Pacific Time</option>
            <option value="-0700" <?php if($_SETTINGS['TIMEZONE'] == '-0700') { echo('selected'); } ?>>(GMT-07:00 <?php echo($hours_label); ?>) Mountain Time</option>
            <option value="-0600" <?php if($_SETTINGS['TIMEZONE'] == '-0600') { echo('selected'); } ?>>(GMT-06:00 <?php echo($hours_label); ?>) Central Time</option>
            <option value="-0500" <?php if($_SETTINGS['TIMEZONE'] == '-0500') { echo('selected'); } ?>>(GMT-05:00 <?php echo($hours_label); ?>) Eastern Time</option>
            <option value="-0400" <?php if($_SETTINGS['TIMEZONE'] == '-0400') { echo('selected'); } ?>>(GMT-04:00 <?php echo($hours_label); ?>) Atlantic Time</option>
            <option value="-0330" <?php if($_SETTINGS['TIMEZONE'] == '-0330') { echo('selected'); } ?>>(GMT-03:30 <?php echo($hours_label); ?>) Newfoundland</option>
            <option value="-0300" <?php if($_SETTINGS['TIMEZONE'] == '-0300') { echo('selected'); } ?>>(GMT-03:00 <?php echo($hours_label); ?>) Brazil, Buenos Aires</option>
            <option value="-0200" <?php if($_SETTINGS['TIMEZONE'] == '-0200') { echo('selected'); } ?>>(GMT-02:00 <?php echo($hours_label); ?>) Mid-Atlantic.</option>
            <option value="-0100" <?php if($_SETTINGS['TIMEZONE'] == '-0100') { echo('selected'); } ?>>(GMT-01:00 <?php echo($hours_label); ?>) Cape Verde Islands</option>
            <option value="0" <?php if($_SETTINGS['TIMEZONE'] == '0') { echo('selected'); } ?>>(GMT) Greenwich Mean Time: London</option>
            <option value="+0100" <?php if($_SETTINGS['TIMEZONE'] == '+0100') { echo('selected'); } ?>>(GMT+01:00 <?php echo($hours_label); ?>) Berlin, Paris, Rome</option>
            <option value="+0200" <?php if($_SETTINGS['TIMEZONE'] == '+0200') { echo('selected'); } ?>>(GMT+02:00 <?php echo($hours_label); ?>) South Africa</option>
            <option value="+0300" <?php if($_SETTINGS['TIMEZONE'] == '+0300') { echo('selected'); } ?>>(GMT+03:00 <?php echo($hours_label); ?>) Baghdad, Moscow</option>
            <option value="+0330" <?php if($_SETTINGS['TIMEZONE'] == '+0330') { echo('selected'); } ?>>(GMT+03:30 <?php echo($hours_label); ?>) Tehran</option>
            <option value="+0400" <?php if($_SETTINGS['TIMEZONE'] == '+0400') { echo('selected'); } ?>>(GMT+04:00 <?php echo($hours_label); ?>) Adu Dhabi, Baku</option>
            <option value="+0430" <?php if($_SETTINGS['TIMEZONE'] == '+0430') { echo('selected'); } ?>>(GMT+04:30 <?php echo($hours_label); ?>) Kabul</option>
            <option value="+0500" <?php if($_SETTINGS['TIMEZONE'] == '+0430') { echo('selected'); } ?>>(GMT+05:00 <?php echo($hours_label); ?>) Islamabad</option>
            <option value="+0530" <?php if($_SETTINGS['TIMEZONE'] == '+0530') { echo('selected'); } ?>>(GMT+05:30 <?php echo($hours_label); ?>) Calcutta, Madras</option>
            <option value="+0600" <?php if($_SETTINGS['TIMEZONE'] == '+0600') { echo('selected'); } ?>>(GMT+06:00 <?php echo($hours_label); ?>) Almaty, Colomba</option>
            <option value="+0700" <?php if($_SETTINGS['TIMEZONE'] == '+0700') { echo('selected'); } ?>>(GMT+07:00 <?php echo($hours_label); ?>) Bangkok, Jakarta</option>
            <option value="+0800" <?php if($_SETTINGS['TIMEZONE'] == '+0800') { echo('selected'); } ?>>(GMT+08:00 <?php echo($hours_label); ?>) Singapore, Perth</option>
            <option value="+0900" <?php if($_SETTINGS['TIMEZONE'] == '+0900') { echo('selected'); } ?>>(GMT+09:00 <?php echo($hours_label); ?>) Osaka, Seoul, Tokyo</option>
            <option value="+0930" <?php if($_SETTINGS['TIMEZONE'] == '+0930') { echo('selected'); } ?>>(GMT+09:30 <?php echo($hours_label); ?>) Adelaide, Darwin</option>
            <option value="+1000" <?php if($_SETTINGS['TIMEZONE'] == '+1000') { echo('selected'); } ?>>(GMT+10:00 <?php echo($hours_label); ?>) Melbourne, Sydney</option>
            <option value="+1100" <?php if($_SETTINGS['TIMEZONE'] == '+1100') { echo('selected'); } ?>>(GMT+11:00 <?php echo($hours_label); ?>) New Caledonia</option>
            <option value="+1200" <?php if($_SETTINGS['TIMEZONE'] == '+1200') { echo('selected'); } ?>>(GMT+12:00 <?php echo($hours_label); ?>) Auckland, Wellington, Fiji</option>
          </select>
            <a href="#" class="tooltip"><img src="../images/help_dialog.gif" alt="Help" width="9" height="11" border="0"><span style="left: -150px; top: -65px;"><?php echo($timezone_label); ?>: <?php echo($timezone_tooltip_label); ?>.</span></a></td>
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
