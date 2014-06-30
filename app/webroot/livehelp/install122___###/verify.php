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

error_reporting(E_ERROR | E_PARSE);
set_time_limit(0);

// If Magic Quotes are OFF then addslashes
if (!get_magic_quotes_gpc()) {
	$_REQUEST = array_map('addslashes', $_REQUEST);
}

// HTTP/1.1
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);

// HTTP/1.0
header('Pragma: no-cache');

if (function_exists('mysql_connect')) {
	$link = mysql_connect($_REQUEST['HOSTNAME'], $_REQUEST['USERNAME'], $_REQUEST['PASSWORD']);
	if (!$link) {
		$error = 'MySQL Database Error: ' . mysql_errno();
		switch (mysql_errno()) {
			case 1045:
				$error = 'Invalid Database Username / Password';
				break;
		}
?>
writeLayer('DatabaseErrorTitle', '<?php echo(addslashes($error)); ?>');
writeLayer('DatabaseSource', '<?php echo(addslashes(mysql_error())); ?>');
toggleLayer('DatabaseConnection', true);
<?php
		exit();
	} else {
		$selected = mysql_select_db($_REQUEST['DATABASE'], $link);
		if (!$selected) {
?>
writeLayer('DatabaseErrorTitle', '<?php echo('Invalid MySQL Database Name'); ?>');
writeLayer('DatabaseSource', '<?php echo(addslashes(mysql_error())); ?>');
toggleLayer('DatabaseConnection', true);
showError('DatabaseNameError');
<?php
			exit();
		}
	}
}
else {

	$link = mysqli_connect($_REQUEST['HOSTNAME'], $_REQUEST['USERNAME'], $_REQUEST['PASSWORD']);
	if (!$link) {
		$error = 'MySQL Database Error: ' . mysqli_connect_errno();
		switch (mysqli_connect_errno()) {
			case 1045:
				$error = 'Invalid Database Username / Password';
				break;
		}
?>
writeLayer('DatabaseErrorTitle', '<?php echo(addslashes($error)); ?>');
writeLayer('DatabaseSource', '<?php echo(addslashes(mysqli_connect_error())); ?>');
toggleLayer('DatabaseConnection', true);
<?php
		exit();
	}
}

?>
if (dbError) {
	toggleLayer('DatabaseConnection', false);
}