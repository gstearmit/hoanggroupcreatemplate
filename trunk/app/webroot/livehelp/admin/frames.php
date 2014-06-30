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

if (!isset($_REQUEST['REMEMBER'])){ $_REQUEST['REMEMBER'] = ''; }
$username = $_REQUEST['USER_NAME'];

// Get username, password and email from database and authorise the login details
$query = "SELECT `id`, `password`, `disabled` FROM " . $table_prefix . "users WHERE `username` LIKE BINARY '$username'";
$row = $SQL->selectquery($query);
if (!is_array($row)) {
	header('Location: ./index_popup.php?STATUS=error');
	exit;
}
else {	

	if (!isset($_COOKIE['LiveHelpOperatorLogin'])) {
		$password = $_REQUEST['PASSWORD'];
		$length = strlen($row['password']);
		switch ($length) {
			case 40: // SHA1
				$password = sha1($password);
				break;
			case 128: // SHA512
				if (function_exists('hash') && in_array('sha512', hash_algos())) {
					$password = hash('sha512', $password);
				} else {
					header('Location: ./index_popup.php?STATUS=algorithm');
					exit;
				}
				break;
			default: // MD5
				$password = md5($password);
				break;
		}
	}
	
	if (isset($_REQUEST['REMEMBER']) && $_REQUEST['REMEMBER'] == true) {
		if (isset($_COOKIE['LiveHelpOperatorLogin'])) {
			$data = array(); $cookie = new Cookie();
			$data = $cookie->decodeOperatorLogin($_COOKIE['LiveHelpOperatorLogin']);
			
			if (isset($data['USERNAME']) && isset($data['PASSWORD'])) {
				$username = $data['USERNAME'];
				$password = $data['PASSWORD'];
			}
		}
	}
	else {
		// Remove Cookie
		setcookie('LiveHelpOperatorLogin', '', time() - 7776000, '/', $cookie_domain, 0);
	}


	$operatorid = $row['id'];
	$disabled = $row['disabled'];
	if ($disabled == '1') {
		header('Location: ./index_popup.php?STATUS=disabled');
		exit;
	}
	
	if ($password != $row['password']) {
		header('Location: ./index_popup.php?STATUS=error');
		exit;
	}
}

// Set cookie if not already set to remember the username and password if user requested to remember login
if ($_REQUEST['REMEMBER'] == true) {
	$data = array(); $cookie = new Cookie();
	$data['USERNAME'] = $username;
	$data['PASSWORD'] = $password;
	$data = $cookie->encode($data);
	setcookie('LiveHelpOperatorLogin', $data, time() + 7776000, '/', $cookie_domain, 0);
}

// Update operator session to database
$query = "UPDATE " . $table_prefix . "users SET `datetime` = NOW(), `refresh` = NOW() , `status` = '1' WHERE `id` = '$operatorid'";
$SQL->miscquery($query);

$session = array(); $cookie = new Cookie();
$session['OPERATORID'] = $operatorid;
$session['AUTHENTICATION'] = $password;
$session['MESSAGE'] = 0;
$session['TIMEOUT'] = 0;
$session['LANGUAGE'] = LANGUAGE_TYPE;
$data = $cookie->encode($session);

setcookie('LiveHelpOperator', $data, false, '/', $cookie_domain, 0);
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<title>Administration - <?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/JavaScript">
<!--

var sound = 0;

function display(username, message, align, status) {
	if (top.displayFrame) {
		var output;
		var alignment;
		
		if (align == '1') { alignment = 'left'; }
		else if (align == '2') { alignment = 'center'; }
		else if (align == '3') { alignment = 'right'; }
		
		if (status == '0') { color = '<?php echo($_SETTINGS['RECEIVEDFONTCOLOR']); ?>'; sound = 1; }
		else { color = '<?php echo($_SETTINGS['SENTFONTCOLOR']); ?>'; }

		output = '<table width="100%" border="0" align="center"><tr><td><div align="' + alignment + '"><font color="' + color + '" class="message">';

		if (status == '0' || status == '1' || status == '2') { // General Message or Link
			if (username != '') { output += '<strong>' + username + '</strong>: '; }
			message = message.replace(/((?:(?:http(?:s?))|(?:ftp)):\/\/[^\s|<|>|'|\"]*)/g, '<a href="$1" target="_blank" class="message">$1</a>');
<?php
if ($_SETTINGS['SMILIES'] == true) {
?>
			message = htmlSmilies(message);
<?php
}
?>
			output += message;
		} else if (status == '3') { // Image
			message = message.replace(/((?:(?:http(?:s?))):\/\/[^\s|<|>|'|\"]*)/g, '<img src="$1" alt="Received Image">');
			output += message;
		} else if (status == '4') { // PUSH
			output += '<script language="JavaScript" type="text/JavaScript">if (top.window.opener) { top.window.opener.location.href = "' + message + '"; }</script>';
		} else if (status == '5') { // JavaScript
			output += '<script language="JavaScript" type="text/JavaScript">' + message + '</script>';
		}
		
		output += '</font></div></td></tr></table>';
		
		top.displayFrame.displayContentsFrame.document.write(output);
		top.bottom();
		
	}
}

function setTyping() {
	if (top.messengerFrame.document['messengerStatus']) {
		top.messengerFrame.document['messengerStatus'].src = '../locale/<?php echo(LANGUAGE_TYPE); ?>/images/user_typing.gif';
	}
}

function setWaiting() {
	if (top.messengerFrame.document['messengerStatus']) {
		top.messengerFrame.document['messengerStatus'].src = '../locale/<?php echo(LANGUAGE_TYPE); ?>/images/waiting.gif';
	}
}

function refreshDisplayer() {
	if (sound == 1) {
		playSound(); sound = 0;
	}
	window.setTimeout('updateMessages();', <?php echo((int)$chat_refresh * 1000); ?>);
}

function updateMessages() {
	if (top.displayFrame.displayRefreshFrame) {
		top.displayFrame.displayRefreshFrame.location.reload(true);
	}
}

function bottom() {
	if (top.displayFrame) {
		top.displayFrame.displayContentsFrame.window.scrollTo( 0, 99999999 );
	}
}

function playSound() {
	if (document.getElementById('MessageSound')) {
		var sound = document.getElementById('MessageSound');
		sound.Play();
	}
	else if (eval('document.MessageSound')) {
		var sound = document.MessageSound;
		sound.Play();
	}
}

function htmlSmilies(msg) {
	msg = msg.replace(/:D/g, '<image src="../images/16px/Laugh.png" alt="Laugh" title="Laugh">');
	msg = msg.replace(/:\)/g, '<image src="../images/16px/Smile.png" alt="Smile" title="Smile">');
	msg = msg.replace(/:\(/g, '<image src="../images/16px/Sad.png" alt="Sad" title="Sad">');
	msg = msg.replace(/\$\)/g, '<image src="../images/16px/Money.png" alt="Money" title="Money">');
	msg = msg.replace(/&gt;:O/g, '<image src="../images/16px/Angry.png" alt="Angry" title="Angry">');
	msg = msg.replace(/:P/g, '<image src="../images/16px/Impish.png" alt="Impish" title="Impish">');
	msg = msg.replace(/:\\/g, '<image src="../images/16px/Sweat.png" alt="Sweat" title="Sweat">');
	msg = msg.replace(/8\)/g, '<image src="../images/16px/Cool.png" alt="Cool" title="Cool">');
	msg = msg.replace(/&gt;:L/g, '<image src="../images/16px/Frown.png" alt="Frown" title="Frown">');
	msg = msg.replace(/;\)/g, '<image src="../images/16px/Wink.png" alt="Wink" title="Wink">');
	msg = msg.replace(/:O/g, '<image src="../images/16px/Surprise.png" alt="Surprise" title="Surprise">');
	msg = msg.replace(/8-\)/g, '<image src="../images/16px/Woo.png" alt="Woo" title="Woo">');
	msg = msg.replace(/8-O/g, '<image src="../images/16px/Shock.png" alt="Shock" title="Shock">');
	msg = msg.replace(/xD/g, '<image src="../images/16px/Hysterical.png" alt="Hysterical" title="Hysterical">');
	msg = msg.replace(/:-\*/g, '<image src="../images/16px/Kissed.png" alt="Kissed" title="Kissed">');
	msg = msg.replace(/:S/g, '<image src="../images/16px/Dizzy.png" alt="Dizzy" title="Dizzy">');
	msg = msg.replace(/\+O\)/g, '<image src="../images/16px/Celebrate.png" alt="Celebrate" title="Celebrate">');
	msg = msg.replace(/&lt;3/g, '<image src="../images/16px/Adore.png" alt="Adore" title="Adore">');
	msg = msg.replace(/zzZ/g, '<image src="./images/16px/Sleep.png" alt="Sleep" title="Sleep">');
	msg = msg.replace(/:X/g, '<image src="../images/16px/Stop.png" alt="Quiet" title="Quiet">');
	msg = msg.replace(/X-\(/g, '<image src="../images/16px/Worn-out.png" alt="Tired" title="Tired">');
	return msg;
}
//-->
</script>
</head>
<frameset cols="225,*,90" frameborder="NO" border="0" framespacing="0">
  <frameset rows="80,115,0,*" frameborder="NO" border="0" framespacing="0">
    <frame src="users_header.php" name="usersHeaderFrame" scrolling="NO">
    <frame src="status.php" name="statusControlsFrame" scrolling="NO">
    <frame src="users_refresher.php" name="usersRefresherFrame" scrolling="NO">
    <frameset cols="30,*" frameborder="NO" border="0" framespacing="0">
      <frame src="users_messenger.php" name="usersMessengerFrame" scrolling="NO">
      <frame src="users.php" name="usersFrame">
    </frameset>
  </frameset>
  <frameset rows="*,225,0" frameborder="NO" border="0" framespacing="0">
    <frame src="visitors_index.php" name="displayFrame">
    <frame src="messenger.php" name="messengerFrame" scrolling="NO">
    <frame src="blank.php" name="sendMessageFrame" scrolling="NO">
  </frameset>
  <frame src="control_panel.php" name="menuFrame">
</frameset>
<noframes></noframes>
<body>
<embed src="/livehelp/sounds/receive.wav" width="0" height="0" hidden="true" autostart="false" loop="false" name="MessageSound" id="MessageSound" border="0"></embed>
</body>
</html>