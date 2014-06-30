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

$total_length = '';

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
<style type="text/css">
<!--
.background {
	background-image: url(../images/background_database.gif);
	background-repeat: no-repeat;
	background-position: right bottom;
}
-->
</style>
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--

function resetDatabase() {
	var result = confirm('Are you sure you wish to reset the Live Help database? All chat transcripts, guest sessions, and visitor data will be deleted.');
	if (result == true) {
		document.location.href="./db_reset.php";
	}
}

//-->
</script>
</head>
<body class="background"> 
<div align="center"> 
  <table width="400" border="0"> 
    <tr> 
      <td width="22"><img src="../images/dbase_small.gif" alt="<?php echo($manage_db_label); ?>" width="22" height="22"></td> 
      <td colspan="2"><em class="heading"><?php echo($manage_db_label); ?> - <?php echo(DB_NAME); ?> </em></td> 
    </tr> 
    <tr> 
      <td></td> 
      <td></td> 
      <td></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
      <td><strong><?php echo($table_name_label); ?></strong></td> 
      <td><div align="right"><strong><?php echo($size_label); ?></strong></div></td> 
    </tr> 
    <?php
$query = "SHOW TABLE STATUS";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			$name = $row['Name'];
			$data = $row['Data_length'];
			$index = $row['Index_length'];
			if (substr($name, 0, strlen($table_prefix)) == $table_prefix) {
?> 
    <tr> 
      <td>&nbsp;</td> 
      <td><?php echo($name); ?></td> 
      <td><div align="right"><?php echo($data + $index); ?> bytes </div></td> 
    </tr> 
    <?php
				$total_length += ($data + $index);
			}
		}
	}
}

?> 
    <tr> 
      <td>&nbsp;</td> 
      <td><div align="right"><strong><?php echo($total_label); ?>:</strong></div></td> 
      <td><div align="right"><?php echo(round($total_length/1024,2)); ?> KB</div></td> 
    </tr> 
  </table> 
  <form action="./db_sql_dump.php" method="get" name="sql_dump" id="sql_dump"> 
    <input name="SQL_DUMP" type="hidden" id="SQL_DUMP" value="true">
    <input type="submit" name="Submit" value="<?php echo($backup_label); ?>" <?php if ($current_privilege > 2) { echo('disabled="true"'); } ?>>&nbsp;<input type="button" name="Reset" value="<?php echo($reset_database_label); ?>" onClick="resetDatabase();" <?php if ($current_privilege > 2) { echo('disabled="true"'); } ?>>  
  </form> 
</div> 
</body>
</html>
