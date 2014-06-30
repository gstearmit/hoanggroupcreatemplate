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
if (!isset($_SERVER['DOCUMENT_ROOT'])){ $_SERVER['DOCUMENT_ROOT'] = ''; }
if (!isset($_REQUEST['DEPARTMENT'])){ $_REQUEST['DEPARTMENT'] = ''; }
if (!isset($_REQUEST['SERVER'])){ $_REQUEST['SERVER'] = ''; }
if (!isset($_REQUEST['TRACKER'])){ $_REQUEST['TRACKER'] = ''; }
if (!isset($_REQUEST['STATUS'])){ $_REQUEST['STATUS'] = ''; }

include('./database.php');
include('./class.mysql.php');
include('./class.cookie.php');
include('./config.php');

if (file_exists('../locale/' . LANGUAGE_TYPE . '/admin.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/admin.php');
}
else {
	include('../locale/en/admin.php');
}
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
</head>
<body> 
<div align="center"> 
  <p>&nbsp;</p> 
  <table width="300" border="0"> 
    <tr> 
      <td width="32"><img src="../images/error.gif" alt="<?php echo($warning_label); ?>" width="32" height="32"></td> 
      <td><div align="center"> 
          <p><em><?php echo($general_access_denied_label); ?></em></p> 
          <p><em><strong> </strong><?php echo($access_denied_line_one_label); ?></em></p> 
          <p><em><?php echo($access_denied_line_two_label); ?></em></p> 
        </div></td> 
    </tr> 
  </table> 
</div> 
</body>
</html>
