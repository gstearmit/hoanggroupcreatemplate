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

$request = $_REQUEST['REQUEST'];
$record = $_REQUEST['RECORD'];

// Update active field of user to the ID of the operator that initiated support
$query = "UPDATE " . $table_prefix . "requests SET `initiate` = '$operator_login_id' WHERE `id` = '$request'";
$SQL->miscquery($query);

header('Location: ./visitors_index.php?RECORD=' . $record);
?>