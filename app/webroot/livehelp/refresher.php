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
include('include/database.php');
include('include/class.mysql.php');
include('include/class.cookie.php');
include('include/config.php');
include('include/functions.php');

if (!isset($_REQUEST['JS'])){ $_REQUEST['JS'] = false; }
if (!isset($_REQUEST['INIT'])){ $_REQUEST['INIT'] = false; }
if (!isset($_REQUEST['CALL'])){ $_REQUEST['CALL'] = false; }
if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
if (!isset($_REQUEST['TYPING'])){ $_REQUEST['TYPING'] = ''; }
if (!isset($_REQUEST['TIME'])){ $_REQUEST['TIME'] = ''; }
if (!isset($_REQUEST['COOKIE'])){ $_REQUEST['COOKIE'] = ''; }

$javascript = $_REQUEST['JS'];
$initalised = $_REQUEST['INIT'];
$status = $_REQUEST['TYPING'];

if ($_REQUEST['CALL'] == true) {
	$query = "SELECT `status` FROM " . $table_prefix . "callback WHERE `id` = '" . $_REQUEST['ID'] . "'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		echo('updateStatus(' . $row['status'] . ');');
	}
	exit();
}

if ($_REQUEST['COOKIE'] != '') {
	$cookie_domain = $_REQUEST['COOKIE'];
}

if ($javascript == true) {

	$query = "SELECT `typing` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$typing = $row['typing'];
		
		if (isset($_COOKIE['LiveHelpOperator'])) {
			if ($status) { // Currently Typing
				switch($typing) {
				case 0: // None
					$result = 2;
					break;
				case 1: // Guest Only
					$result = 3;
					break;
				case 2: // Operator Only
					$result = 2;
					break;
				case 3: // Both
					$result = 3;
					break;
				}
			}
			else { // Not Currently Typing
				switch($typing) {
				case 0: // None
					$result = 0;
					break;
				case 1: // Guest Only
					$result = 1;
					break;
				case 2: // Operator Only
					$result = 0;
					break;
				case 3: // Both
					$result = 1;
					break;	
				}	
			}
		} else {
			if ($status) { // Currently Typing
				switch($typing) {
				case 0: // None
					$result = 1;
					break;
				case 1: // Guest Only
					$result = 1;
					break;
				case 2: // Operator Only
					$result = 3;
					break;
				case 3: // Both
					$result = 3;
					break;
				}
			}
			else { // Not Currently Typing
				switch($typing) {
				case 0: // None
					$result = 0;
					break;
				case 1: // Guest Only
					$result = 0;
					break;
				case 2: // Operator Only
					$result = 2;
					break;
				case 3: // Both
					$result = 2;
					break;	
				}	
			}
		}
					
		// Update the typing status of the specified Login ID
		$query = "UPDATE " . $table_prefix . "sessions SET `typing` = '$result' WHERE `id` = '$guest_login_id'";
		$SQL->miscquery($query);
		
	}
}

// Check if an operator has accepted the chat request
$query = "SELECT `active`, `department`, `datetime` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$active = $row['active'];
	$datetime = $row['datetime'];
	$department = $row['department'];
}

$session = array();
$session['REQUEST'] = $request_id;
$session['GUEST_LOGIN_ID'] = $guest_login_id;
$session['GUEST_USERNAME'] = $guest_username;
$session['SECURITY'] = $security;
$session['LANGUAGE'] = LANGUAGE_TYPE;
$session['DOMAIN'] = $cookie_domain;

if ($active > 0) {

	if ($initalised > 0) {
		// Only operator messages
		$query = "SELECT `id`, `datetime`, `username`, `message`, `align`, `status` FROM " . $table_prefix . "messages WHERE `session` = '$guest_login_id' AND `status` >= '1' AND `id` > '$guest_message' ORDER BY `datetime`";
	} else {
		// All messages except PUSH
		$query = "SELECT `id`, `datetime`, `username`, `message`, `align`, `status` FROM " . $table_prefix . "messages WHERE `session` = '$guest_login_id' AND `status` >= '0' AND `status` <> '4' AND `id` > '$guest_message' ORDER BY `datetime`";
	}
	$messages = $SQL->selectall($query);
	if (is_array($messages)) {
	
		// Count the total operators in the current conversation
		$query = "SELECT count(DISTINCT `username`) FROM " . $table_prefix . "messages WHERE `session` = '$guest_login_id' AND `status` > '0'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$operators = $row['count(DISTINCT `username`)'];
		}
		$joined = $total_operators;
		
		foreach ($messages as $key => $row) {
			if (is_array($row)) {
				$guest_message = $row['id'];
				
				// If message datetime is greater than datetime of session
				if ((unixtimestamp($row['datetime']) - unixtimestamp($datetime)) > 0) {
					if ($operators > 1 && ($operators > $joined)) {
						$username = $row['username'];
						$status = $row['status'];
						
						// If the username is not equal to the original operator
						// and the message was from an operator
						// and the joined conversation system message has not been sent
						if (($operator_username != $username) && $status > 0) {
						
							// Select supporters full name
							$query = "SELECT `username`, `firstname`, `lastname` FROM " . $table_prefix . "users WHERE `username` = '$username'";
							$row = $SQL->selectquery($query);
							if (is_array($row)) {
								$first = $row['firstname'];
								$last = $row['lastname'];
								
								if ($first != '') {
									// Send message to notify user they are out of Pending status
									$message_joined = "$first $last";
								}
							}
							$joined++;
							$session['TOTALOPERATORS'] = $operators;
						}
					}
				}
			}
		}
	}
}

$session['MESSAGE'] = $guest_message;

if ($active > 0 && $initalised == 0) {
	$css = '<link href="/livehelp/styles/guest.php" rel="stylesheet" type="text/css"/>';

	// Select supporters full name
	$query = "SELECT `username`, `firstname`, `lastname` FROM " . $table_prefix . "users WHERE `id` = '$active'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$username = $row['username'];
		$first = $row['firstname'];
		$last = $row['lastname'];
		
		if (!($first == '' || $last == '')) {
			// Send message to notify user they are out of Pending status
			$message = $first . ' ' . $last;
			if ($_SETTINGS['DEPARTMENTS'] == true && $department != '') {
				$message .= ' (' . $department . ')';
			}
		}
	}
	
	if ($_SETTINGS['CHATUSERNAME'] == false) { $username = ''; }
	
	$session['OPERATOR'] = $username;
	$session['TOTALOPERATORS'] = $total_operators + 1;
}

if (!isset($session['OPERATOR'])) { $session['OPERATOR'] = $operator_username; }
if (!isset($session['TOTALOPERATORS'])) { $session['TOTALOPERATORS'] = $total_operators; }

$COOKIE = new Cookie;
$data = $COOKIE->encode($session);
setCookie('LiveHelpSession', $data, false, '/', $cookie_domain, 0);
header('P3P: CP=\'' . $_SETTINGS['P3P'] . '\'');

// HTTP/1.1
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);

// HTTP/1.0
header('Pragma: no-cache');
header('Content-type: text/html; charset=utf-8');

if (file_exists('locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('locale/' . LANGUAGE_TYPE . '/guest.php');
}
else {
	include('locale/en/guest.php');
}

if ($initalised == 0 && $active > 0) {
	if ($javascript == false) {
?>
<script language="JavaScript">
<!--
<?php
	}

	if ($javascript == false) {
?>
//-->
</script>
<?php
	}
}


if (isset($message_joined)) {
	$message_joined .= ' ' . $joined_conversation_label;
	$message_joined = addslashes($message_joined);
	if ($javascript == false) {
?>
<script language="JavaScript">
<!--
<?php
	}
?>
self.display('', '', '<?php echo($message_joined); ?>', '2', '1');
self.alert();
<?php
	if ($javascript == false) {
?>
//-->
</script>
<?php
	}
}

if ($javascript == false) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
</head>
<body>
<?php
}

if ($active > 0 && $initalised == 0) {
	if ($javascript == false) {
?>
<script language="JavaScript">
<!--
<?php
	}
	if (isset($message)) {
		$message = $now_chatting_with_label . ' ' . $message;
		$message = addslashes($message);
?>
self.display(-3, '', 'document.onkeydown = focusChat;', '2', '5');
self.display(-2, '', '<?php echo($css . $message); ?>', '2', '1');
<?php
	}

	if ($_SETTINGS['INTRODUCTION'] != '') {
		$_SETTINGS['INTRODUCTION'] = addslashes(preg_replace("/(\r\n|\r|\n)/", '<br />', $_SETTINGS['INTRODUCTION']));
		$_SETTINGS['INTRODUCTION'] = preg_replace("/({Username})/", $guest_username, $_SETTINGS['INTRODUCTION']);
?>
self.display(-1, '<?php echo($username); ?>', '<?php echo($_SETTINGS['INTRODUCTION']); ?>', '1', '1');
self.initalisedChat = 1;
<?php
	}
	if ($javascript == false) {
?>
//-->
</script>
<?php
	}
}
elseif ($active == -3 || $active == -1) {

	// Send message to notify user the chat is closed or declined and send JavaScript to disable input
	$closed = $closed_user_message_label;
	$disable = '$(\'#Message\').attr(\'disabled\', \'disabled\'); window.clearTimeout(MessageTimer);';
	
	if ($javascript == false) {
?>
<script language="JavaScript">
<!--
<?php
	}
?>
self.display('', '', '<?php echo(addslashes($closed)); ?>', '2', '1');
self.display('', '', '<?php echo(addslashes($disable)); ?>', '2', '5');
self.alert(); self.chatEnded = true;
clearTimeout(self.MessageTimer);
<?php
	if ($javascript == false) {
?>
//-->
</script>
<?php
	}
}

$typingresult = 0;
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
		$typingresult = 0;
		break;
	case 2: // Operator Only
		$typingresult = 1;
		break;
	case 3: // Both
		$typingresult = 1;
		break;		
	}
}

if ($active > 0) {
	// Check for operator connection issue
	$timeout = $connection_timeout * 2;
	$query = "SELECT `id` FROM " . $table_prefix . "users WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $timeout SECOND) AND `id` = '$active' LIMIT 1";
	$row = $SQL->selectquery($query);
	if (!is_array($row)) {
?>
self.connectionError();
<?php
	}
}

if (isset($messages)) {
	if (is_array($messages)) {
		if ($javascript == false) {
?>
<script language="JavaScript">
<!--
<?php
		}
		
		foreach ($messages as $key => $row) {
			if (is_array($row)) {

				$id = $row['id'];
				$username = $row['username'];
				$message = $row['message'];
				$align = $row['align'];
				$status = $row['status'];
				
				if ($_SETTINGS['CHATUSERNAME'] == false) { $username = ''; }
				$message = str_replace('<', '&lt;', $message);
				$message = str_replace('>', '&gt;', $message);
				$message = preg_replace("/(\r\n|\r|\n)/", '<br />', $message);
				
				// Output message
				if ($status >= 0) {

?>
self.display(<?php echo($id); ?>, '<?php echo(addslashes($username)); ?>', '<?php echo(addslashes($message)); ?>', '<?php echo($align); ?>', '<?php echo($status); ?>');
<?php

				}
			}
		}
?>
self.alert();
<?php
		
		if ($javascript == false) {
?>
//-->
</script>
<?php
		}
	}
}

// Update last refresh so user is online
$query = "UPDATE " . $table_prefix . "sessions SET `refresh` = NOW() WHERE `id` = '$guest_login_id'";
$SQL->miscquery($query);

if ($javascript == false) {
?>
<script language="JavaScript" type="text/JavaScript">
<!--

<?php
}
if (!$typingresult || !($active > 0)) {
?>
self.setWaiting();
<?php
}
else {
?>
self.setTyping();
<?php
}
if ($javascript == false) {
?>
//-->
</script>
</body>
</html>
<?php
}
?>