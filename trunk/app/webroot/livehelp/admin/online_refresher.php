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

ignore_user_abort(true);

// Update last refresh field so loged in user stays online
$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW() WHERE `id` = '$operator_login_id'";
$SQL->miscquery($query);

// Output 1x1 pixel to the admin users_header.php JavaScript page
header('Content-type: image/gif');
readfile('../include/Hidden.gif');
?>