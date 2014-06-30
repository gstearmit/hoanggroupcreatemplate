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

if (!isset($_REQUEST['UPDATE'])){ $_REQUEST['UPDATE'] = ''; }
if (!isset($_REQUEST['DELETE'])){ $_REQUEST['DELETE'] = ''; }

$status = '';
$pretyped_option = '';
$content = '';
$name = '';

header('Content-type: text/html; charset=utf-8');

if (file_exists('../locale/' . LANGUAGE_TYPE . '/admin.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/admin.php');
}
else {
	include('../locale/en/admin.php');
}

if ($_REQUEST['UPDATE'] == true) {
	
	$type = $_REQUEST['TYPE'];
	$content = stripslashes($_REQUEST['CONTENTS']);
	$name = stripslashes($_REQUEST['NAME']);
	
	if($type != '' && $name != '' && $content != '') {
		$query = "INSERT INTO " . $table_prefix . "responses(`type`, `name`, `content`) VALUES('$type', '$name', '$content')";
		$SQL->insertquery($query);
		$status = $command_added_label;
	}
	else {
		$status = $complete_all_fields_commands_label;
	}
}
elseif($_REQUEST['DELETE'] == true) {
	
	$id = $_REQUEST['COMMANDS'];
	
	$query = "DELETE FROM " . $table_prefix . "responses WHERE `id` = '$id'";
	$SQL->miscquery($query);
	$status = $command_removed_label;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
</head>
<?php
if ($_REQUEST['UPDATE'] == true || $_REQUEST['DELETE'] == true) {
?>
<script language="JavaScript" type="text/JavaScript">
<!--
parent.messengerFrame.location.reload();
//-->
</script>
<?php
}
?>
<body> 
<div align="center"> 
  <table width="450" border="0" align="center"> 
    <tr> 
      <td width="22"><img src="../images/mail_edit.gif" alt="<?php echo($manage_commands_label); ?>" width="22" height="22"></td> 
      <td colspan="2"><em class="heading"><?php echo($manage_commands_label); ?> - <?php echo($current_username); ?></em> </td> 
    </tr> 
    <form name="AddCommand" method="post" action="commands.php"> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="center"><strong><?php echo($status); ?></strong></div></td> 
        <td>&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td width="317"><div align="left"><?php echo($add_commands_label); ?>:</div></td> 
        <td width="48">&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="center"> 
            <input name="TYPE" type="radio" value="2" <?php if ($pretyped_option == 'LINK') { echo('checked'); }?>> 
            <?php echo($link_label); ?> 
            <input name="TYPE" type="radio" value="3" <?php if ($pretyped_option == 'IMAGE') { echo('checked'); }?>> 
            <?php echo($image_label); ?> 
            <input name="TYPE" type="radio" value="4" <?php if ($pretyped_option == 'PUSH') { echo('checked'); }?>> 
            <?php echo($push_label); ?>
            <input name="TYPE" type="radio" value="5" <?php if ($pretyped_option == 'JAVASCRIPT') { echo('checked'); }?>> 
            <?php echo($javascript_label); ?></div></td> 
        <td>&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div><?php echo($name_label); ?>:<br/>
            <input name="NAME" type="text" id="NAME" value="<?php echo($name); ?>" style="width:325px"> 
          </div></td> 
        <td>&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div><?php echo($contents_label); ?>:<br/>
            <input name="CONTENTS" type="text" id="CONTENTS" value="<?php echo($content); ?>" style="width:325px"> 
          </div></td> 
        <td><input name="UPDATE" type="hidden" id="UPDATE" value="true"><input type="submit" name="Submit" value="<?php echo($add_label); ?>"></td> 
      </tr> 
    </form> 
    <tr> 
      <td>&nbsp;</td> 
      <td colspan="2"><div align="center" class="small"><em><?php echo($command_instructions_label); ?></em></div></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td colspan="2"><div align="center"><?php echo($or_label); ?></div></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td><div align="left"><?php echo($delete_commands_label); ?>:</div></td> 
      <td>&nbsp;</td> 
    </tr> 
    <form name="DeleteCommand" method="post" action="commands.php"> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div> 
            <select name="COMMANDS" id="COMMANDS" width="300" style="width:325px;"> 
              <?php
		$query = "SELECT * FROM " . $table_prefix . "responses WHERE `type` > 1";
		$rows = $SQL->selectall($query);
		if (is_array($rows)) {
			foreach ($rows as $key => $row) {
				if (is_array($row)) {
					$id = $row['id'];
					$type = $row['type'];
					$name = $row['name'];
					
					switch ($type) {
						case 2:
							$type = 'Hyperlink';
							break;
						case 3:
							$type = 'Image';
							break;
						case 4:
							$type = 'PUSH';
							break;
						case 5;
							$type = 'JavaScript';
							break;
					}
					?> 
              <option value="<?php echo($id); ?>"><?php echo($type . ' ' . $name); ?></option> 
              <?php
				}
			}
		}
		?> 
            </select> 
            <input name="DELETE" type="hidden" id="DELETE" value="true"> 
          </div></td> 
        <td> <input type="submit" name="Submit" value="<?php echo($delete_label); ?>"></td> 
      </tr> 
    </form> 
  </table> 
</div> 
</body>
</html>
