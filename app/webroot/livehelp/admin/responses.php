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

if (!isset($_REQUEST['UPDATE'])){ $_REQUEST['UPDATE'] = ''; }
if (!isset($_REQUEST['DELETE'])){ $_REQUEST['DELETE'] = ''; }
if (!isset($_REQUEST['NAME'])){ $_REQUEST['NAME'] = ''; }
if (!isset($_REQUEST['CONTENT'])){ $_REQUEST['CONTENT'] = ''; }

$status = ''; $content = ''; $name = '';

if ($_REQUEST['UPDATE'] == true) {
	
	$content = $_REQUEST['CONTENT'];
	$name = $_REQUEST['NAME'];
	
	if(($content != '')) {
		$query = "INSERT INTO " . $table_prefix . "responses(`type`, `name`, `content`) VALUES(1, '$name', '$content')";
		$SQL->insertquery($query);
		$status = $response_added_label;
	}
	else {
		$status = $complete_all_fields_responses_label;
	}
}
elseif($_REQUEST['DELETE'] == true) {
	
	$id = $_REQUEST['RESPONSES'];
	
	$query = "DELETE FROM " . $table_prefix . "responses WHERE `id` = '$id'";
	$SQL->miscquery($query);
	$status = $response_removed_label;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
      <td width="22"><img src="../images/mail_edit.gif" alt="<?php echo($manage_responses_label); ?>" width="22" height="22"></td> 
      <td><em class="heading"><?php echo($manage_responses_label); ?> - <?php echo($current_username); ?></em> </td> 
      <td width="48">&nbsp;</td> 
    </tr> 
    <form name="AddResponse" method="post" action="responses.php"> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div align="center"><strong><?php echo($status); ?></strong></div></td> 
        <td>&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td width="317"><div align="left"><?php echo($add_responses_label); ?>:</div></td> 
        <td width="48">&nbsp;</td> 
      </tr> 
      <tr> 
        <td>&nbsp;</td> 
        <td>
		  <div>
		    <?php echo($name_label); ?>:<br/>
			<input name="NAME" type="text" id="NAME" value="<?php echo($name); ?>" style="width:325px">
		  </div>
		  <div>
			<?php echo($contents_label); ?>:<br/>
            <textarea name="CONTENT" id="CONTENT" style="width:325px; height:100px"><?php echo($content); ?></textarea>
          </div></td> 
        <td valign="bottom"><input name="UPDATE" type="hidden" id="UPDATE" value="true"><input type="submit" name="Submit" value="<?php echo($add_label); ?>"></td> 
      </tr> 
    </form> 
    <tr> 
      <td>&nbsp;</td> 
      <td colspan="2"><div align="center" class="small"><em><?php echo($response_instructions_label); ?></em></div></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td colspan="2"><div align="center"><?php echo($or_label); ?></div></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td><div align="left"><?php echo($delete_responses_label); ?>:</div></td> 
      <td>&nbsp;</td> 
    </tr> 
    <form name="DeleteResponse" method="post" action="responses.php"> 
      <tr> 
        <td>&nbsp;</td> 
        <td><div> 
            <select name="RESPONSES" id="RESPONSES" width="300" style="width:325px;"> 
              <?php
		$query = "SELECT * FROM " . $table_prefix . "responses WHERE `type` = 1";
		$rows = $SQL->selectall($query);
		if (is_array($rows)) {
			foreach ($rows as $key => $row) {
				if (is_array($row)) {
					$id = $row['id'];
					$content = $row['content'];
					?> 
              <option value="<?php echo($id); ?>"><?php echo($content); ?></option> 
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
