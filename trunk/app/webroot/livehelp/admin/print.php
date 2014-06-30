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

$guest_login_id = $_REQUEST['LOGIN_ID'];
$guest_username = stripslashes($_REQUEST['USER']);

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
</head>
<body onLoad="parent.displayFrame.focus();window.print();"> 
<table width="450" border="0" align="center"> 
  <tr> 
    <td width="22"><img src="../images/fileprint.gif" alt="<?php echo($print_chat_transcript_label); ?>" width="22" height="22"></td> 
    <td><em class="heading"><?php echo($print_chat_transcript_label); ?> - <?php echo($guest_username); ?></em> 
      <div align="right"></div></td> 
  </tr> 
</table> 
<?php
include('displayer.inc.php');
?> 
</body>
</html>
