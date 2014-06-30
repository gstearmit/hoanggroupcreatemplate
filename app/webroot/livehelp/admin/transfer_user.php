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

if (!isset($_REQUEST['TRANSFER'])){ $_REQUEST['TRANSFER'] = ''; }
if (!isset($_REQUEST['COMPLETE'])){ $_REQUEST['COMPLETE'] = ''; }
if (!isset($_REQUEST['LOGIN_ID'])){ $_REQUEST['LOGIN_ID'] = ''; }
if (!isset($_REQUEST['RADIO_TRANSFER_ID'])){ $_REQUEST['RADIO_TRANSFER_ID'] = ''; }
if (!isset($_REQUEST['USER'])){ $_REQUEST['USER'] = ''; }
$error = '';
$status = '';

$transfer_login_id = $_REQUEST['LOGIN_ID'];
$transfer_username = stripslashes($_REQUEST['USER']);
$transfer_id = '';

$query = "SELECT `id`, `username`, `firstname`, `lastname` FROM " . $table_prefix . "users WHERE (UNIX_TIMESTAMP(NOW())  - UNIX_TIMESTAMP(`refresh`)) < '$connection_timeout' ORDER BY `username`";
$rows = $SQL->selectall($query);

if ($_REQUEST['TRANSFER'] == true) {
	if ($_REQUEST['RADIO_TRANSFER_ID'] != '') {
		$transfer_id = $_REQUEST['RADIO_TRANSFER_ID'];
	}
	elseif ($_REQUEST['COMBO_TRANSFER_ID'] != '') {
		$transfer_id = $_REQUEST['COMBO_TRANSFER_ID'];
	}
	
	if ($transfer_id == '' ) {
		$error = true;
	}
	else {
	
		$query = "UPDATE " . $table_prefix . "sessions SET `datetime` = NOW(), `active` = '-2', `transfer` = '$transfer_id' WHERE `id` = '$transfer_login_id'";
		$SQL->miscquery($query);
		
		header('Location: ./transfer_user.php?COMPLETE=true');
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
<?php
if ($_REQUEST['COMPLETE'] == true) {
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
  parent.messengerFrame.location.href='messenger.php';
  parent.usersFrame.location.href='users.php';
//-->
</script>
<?php
$status = true;
}
?>
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
</head>
<body> 
<div align="center"> 
  <table width="400" border="0"> 
    <tr> 
      <td width="22"><strong><img src="../images/reload.gif" alt="<?php echo($transfer_user_label); ?>" width="22" height="22" border="0"></strong></td> 
      <td colspan="2"><em class="heading"><?php echo($transfer_user_label); ?> - <?php echo($transfer_username); ?></em></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td colspan="2" align="center"> <table width="300" border="0"> 
          <tr> 
            <td width="32"><img src="../images/error.gif" alt="<?php echo($warning_label); ?>" width="32" height="32"></td> 
            <td><div align="center"> 
                <p><span class="heading"><em><?php echo($warning_label); ?><strong></strong></em></span><em><strong><br> 
                  </strong><?php echo($transfer_warning_label); ?></em></p> 
              </div></td> 
          </tr> 
        </table></td> 
    </tr> 
    <form method="get" action="transfer_user.php"> 
      <?php
	  if ($error == true){
	  ?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"> <strong><?php echo($transfer_select_user_label); ?>: </strong> </div></td> 
      </tr> 
      <?php
	  }
	  ?> 
      <?php
	  if ($status == true){
	  ?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"> <strong><?php echo($transfer_complete_label); ?></strong> </div></td> 
      </tr> 
      <?php
	  }
	  ?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><div align="center"> 
            <table width="150" border="0" cellspacing="2" cellpadding="2"> 
              <?php
			if (is_array($rows)) {
				foreach ($rows as $key => $row) {
					if (is_array($row) && $row['id'] != $operator_login_id) {
			?> 
              <tr> 
                <td width="25"> <input type="radio" name="RADIO_TRANSFER_ID" value="<?php echo($row['id']); ?>"></td> 
                <td width="25"><div align="center"><img src="../images/red_staff.gif" alt="<?php echo($online_staff_label); ?>" width="16" height="16" border="0"></div></td> 
                <td width="100"> <label><?php echo($row['username']); ?></label></td> 
              </tr> 
              <?php
					}
				}
			}
			?> 
            </table> 
          </div></td> 
      </tr> 
      <?php
	  if ((is_array($rows)) && (count($rows) > 1)) {
	  ?> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"><div align="center"><em><?php echo($or_label); ?></em></div></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td width="150">&nbsp;</td> 
        <td width="159">&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="right"><?php echo($transfer_to_user_label); ?>:</div></td> 
        <td><select name="COMBO_TRANSFER_ID" id="COMBO_TRANSFER_ID"> 
            <?php
				foreach ($rows as $key => $row) {
					if (is_array($row) && $row['id'] != $operator_login_id) {
			?> 
            <option value="<?php echo($row['id']); ?>"> 
            <?php
						echo($row['username']);
			?> 
            </option> 
            <?php
					}
				}
			?> 
          </select></td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
        <td>&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td colspan="2"> <div align="center"> 
            <input name="USER" type="hidden" id="USER" value="<?php echo($transfer_username); ?>"> 
            <input name="LOGIN_ID" type="hidden" id="LOGIN_ID" value="<?php echo($transfer_login_id); ?>"> 
            <input name="TRANSFER" type="hidden" id="TRANSFER" value="true"> 
            <input type="submit" name="Submit" value="<?php echo($transfer_label); ?>"> 
          </div></td> 
      </tr> 
    </form> 
    <?php
	}
	else {
	?> 
    <tr> 
      <td>&nbsp;</td> 
      <td colspan="2"><div align="center"> <strong><?php echo($please_note_label); ?>: </strong><?php echo($transfer_error_no_admins_label); ?> </div></td> 
    </tr> 
    <?php
    }
    ?> 
  </table> 
</div> 
</body>
</html>
