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

if ($current_privilege > 1){
	header('Location: ./denied.php');
	exit();
}

$query = "TRUNCATE " . $table_prefix . "sessions";
$SQL->miscquery($query);

$query = "TRUNCATE " . $table_prefix . "messages";
$SQL->miscquery($query);

$query = "TRUNCATE " . $table_prefix . "administration";
$SQL->miscquery($query);

$query = "TRUNCATE " . $table_prefix . "requests";
$SQL->miscquery($query);

header('Location: ./db_index.php');
?>