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

if (!isset($_REQUEST['STAFF'])){ $_REQUEST['STAFF'] = ''; }

$username = stripslashes($_REQUEST['USER']);
$id = $_REQUEST['ID'];
$staff = $_REQUEST['STAFF'];

$session = array(); $cookie = new Cookie();
$session['OPERATORID'] = $operator_login_id;
$session['AUTHENTICATION'] = $operator_authentication;
$session['MESSAGE'] = 0;
$session['TIMEOUT'] = 0;
$session['LANGUAGE'] = $language;

$data = $cookie->encode($session);
setcookie('LiveHelpOperator', $data, false, '/', $cookie_domain, 0);

header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<title>Admin <?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<frameset rows="40,0,*" frameborder="NO" border="0" framespacing="0">
  <frame src="header.php?USER=<?php echo($username); ?>&ID=<?php echo($id); ?>&STAFF=<?php echo($staff); ?>" name="displayHeaderFrame" scrolling="NO">
  <frame src="refresher.php?USER=<?php echo($username); ?>&ID=<?php echo($id); ?>&STAFF=<?php echo($staff); ?>" name="displayRefreshFrame" scrolling="NO">
  <frame src="blank.php" name="displayContentsFrame">
</frameset>
<noframes></noframes>
</html>
