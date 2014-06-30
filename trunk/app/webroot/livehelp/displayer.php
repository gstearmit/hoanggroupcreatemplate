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
include('./include/database.php');
include('./include/class.mysql.php');
include('./include/class.cookie.php');
include('./include/config.php');

header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
</head>
<body style="margin:0px;">
<iframe id="displayRefreshFrame" name="displayRefreshFrame" src="./include/blank.php" frameborder="0" width="0" height="0" style="visibility:hidden; border:none;"></iframe>
<iframe id="displayContentsFrame" name="displayContentsFrame" src="blank.php" frameborder="0" width="100%" style="border:none; height:240px;"></iframe>
</body>
</html>