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

if (!isset($_REQUEST['ID'])) { $_REQUEST['ID'] = ''; }
if (!isset($_REQUEST['STAFF'])) { $_REQUEST['STAFF'] = 0; }

$guest_login_id = $_REQUEST['ID'];
$staff = $_REQUEST['STAFF'];

// Check if an operator has accepted the chat request
$query = "SELECT `active` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$active = $row['active'];
}
else {
	$active = '';
}

$session = array();
$session['OPERATORID'] = $operator_login_id;
$session['AUTHENTICATION'] = $operator_authentication;
$session['LANGUAGE'] = $language;

if ($timeout == 0) {
	if ($active > 0 || $staff) {
		$session['TIMEOUT'] = 1;
	}
}
else {
	$session['TIMEOUT'] = 1;
}

if ($active > 0 || $staff) {

	if ($staff) {
	
		$query = "SELECT `username` FROM " . $table_prefix . "users WHERE `id` = '$guest_login_id'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$guest_username = $row['username'];
		}
	
		$query = "SELECT `id`, `user`, `username`, `message`, `align`, `status` FROM " . $table_prefix . "administration WHERE ((`user` = '$guest_login_id' AND `username` = '$current_username') OR (`user` = '$operator_login_id' AND `username` = '$guest_username')) AND `status` >= '0' AND `id` > '$guest_message' AND (UNIX_TIMESTAMP(`datetime`) - UNIX_TIMESTAMP('$current_login_datetime')) > '0' ORDER BY `datetime`";
		$rows = $SQL->selectall($query);
	}
	else {
		$query = "SELECT `id`, `session`, `username`, `message`, `align`, `status` FROM " . $table_prefix . "messages WHERE `session` = '$guest_login_id' AND `status` >= '0' AND `id` > '$guest_message' ORDER BY `datetime`";
		$rows = $SQL->selectall($query);
	}
	
	if (is_array($rows)) {
	
		$messages = array();
		$messages = $rows;
		
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$message = $row['id'];
			}
		}
		$session['MESSAGE'] = $message;
	}
}

if (!isset($session['MESSAGE'])) { $session['MESSAGE'] = $guest_message; }

$cookie = new Cookie();
$data = $cookie->encode($session);
setcookie('LiveHelpOperator', $data, false, '/', $cookie_domain, 0);

// HTTP/1.1
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);

// HTTP/1.0
header('Pragma: no-cache');
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
</head>
<body>
<?php
if (($active > 0 || $staff) && $timeout == 0) {
	$message = "<link href='/livehelp/styles/styles.php' rel='stylesheet' type='text/css'><script language='JavaScript'>if (top.document.MessageForm) { top.document.MessageForm.MESSAGE.disabled = false; }</script>";
	$message = addslashes($message);
?>
<script language="JavaScript">
<!--
top.display('', '<?php echo($message); ?>', '2', '1');
//-->
</script>
<?php
}
if (($active == -3 || $active == -1) && !$staff) {
	// Send message to notify user the chat is closed or declined and send JavaScript to disable input
	$message = addslashes($logout_user_message_label);
?>
<script language="JavaScript">
<!--
top.display('', '<?php echo($message); ?>', '2', '1');
//-->
</script>
<?php
}

$typingresult = 0;
if (!$staff) {
	// Check the typing status of the current operator
	$query = "SELECT `typing` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$typing = $row['typing'];
		
		switch($typing) {
		case 0: // None
			$typingresult = 0;
			break;
		case 1: // Guest Only
			$typingresult = 1;
			break;
		case 2: // Operator Only
			$typingresult = 0;
			break;
		case 3: // Both
			$typingresult = 1;
			break;		
		}
	}
}

if (($active > 0 || $staff) && isset($messages)) {
	if (is_array($messages)) {
	
		foreach ($messages as $key => $row) {
			if (is_array($row)) {
	
				if ($staff != '') {
					$id = $row['user'];
				}
				else {
					$id = $row['session'];
				}
	
				$username = $row['username'];
				$message = $row['message'];
				$align = $row['align'];
				$status = $row['status'];
				
				$message = str_replace('<', '&lt;', $message);
				$message = str_replace('>', '&gt;', $message);
				$message = preg_replace("/(\r\n|\r|\n)/", '<br />', $message);
				
				// Search and replace smilies with images if smilies are enabled
				if ($_SETTINGS['SMILIES'] == true) {
					$message = htmlSmilies($message, '../images/');
				}
				
				// Output message
				if ($status <= 3) {
?>
<script language="JavaScript">
<!--
top.display('<?php echo(addslashes($username)); ?>', '<?php echo(addslashes($message)); ?>', '<?php echo($align); ?>', '<?php echo($status); ?>');
//-->
</script>
<?php
				}
			}
		}
	}
}

?>
<script language="JavaScript" type="text/JavaScript">
<!--

<?php
if (!$staff) {
	if (!$typingresult || $active == 0) {
?>
top.setWaiting();
<?php
	}
	else {
?>
top.setTyping();
<?php
	}
}
if ($active == 0 || $active > 0 || $staff) {
?>
top.refreshDisplayer();
<?php
}
?>

//-->
</script>
</body>
</html>