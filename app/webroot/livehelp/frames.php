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
include('include/spiders.php');
include('include/database.php');
include('include/class.mysql.php');
include('include/class.cookie.php');
include('include/config.php');
include('include/functions.php');
include('include/version.php');

if (!isset($_REQUEST['USER'])){ $_REQUEST['USER'] = ''; }
if (!isset($_REQUEST['EMAIL'])){ $_REQUEST['EMAIL'] = ''; }
if (!isset($_REQUEST['QUESTION'])){ $_REQUEST['QUESTION'] = ''; }
if (!isset($_REQUEST['DEPARTMENT'])){ $_REQUEST['DEPARTMENT'] = ''; }
if (!isset($_REQUEST['SERVER'])){ $_REQUEST['SERVER'] = ''; }
if (!isset($_REQUEST['URL'])){ $_REQUEST['URL'] = ''; }

$username = $_REQUEST['USER'];
$email = $_REQUEST['EMAIL'];
$department = $_REQUEST['DEPARTMENT'];
$question = $_REQUEST['QUESTION'];
$referer = $_REQUEST['URL'];
$ip_address = $_SERVER['REMOTE_ADDR'];

if (!isset($_REQUEST['Submit'])) {
	if (isset($_COOKIE['LiveHelpChat'])) {
		$cookie = new Cookie();
		$session = $cookie->decodeGuestLogin($_COOKIE['LiveHelpChat']);

		$username = $session['USER'];
		$email = $session['EMAIL'];
		$department = $session['DEPARTMENT'];
		$question = $session['QUESTION'];
	}
}

if ($_REQUEST['COOKIE'] != '') {
	$cookie_domain = $_REQUEST['COOKIE'];
}

if ($_SETTINGS['REQUIREGUESTDETAILS'] == true && $_SETTINGS['LOGINDETAILS'] == true) {

	if ($username == '' || ($email == '' && $_SETTINGS['LOGINEMAIL'] == true)) {
		if ($department == '') {
			header('Location: index.php?ERROR=empty');
			exit();
		}
		else {
			header('Location: index.php?ERROR=empty&DEPARTMENT=' . $department);
			exit();
		}
	}
	else if ($_SETTINGS['LOGINEMAIL'] == true) {
		if (!ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.
			'@'.
			'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.
			'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $email)) {
			if ($department == '') {
				header('Location: index.php?ERROR=email');
				exit();
			}
			else {
				header('Location: index.php?ERROR=email&DEPARTMENT=' . $department);
				exit();
			}
		}
	}
}

// Online Operators
if ((float)$_SETTINGS['SERVERVERSION'] >= 3.80) { // iPhone PUSH Supported
	$query = "SELECT `id`, `device` FROM " . $table_prefix . "users WHERE (`refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) OR `device` <> '') AND `status` = '1'";
} else {
	$query = "SELECT `id` FROM " . $table_prefix . "users WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `status` = '1'";
}
if ($_SETTINGS['DEPARTMENTS'] == true && $department != '') { $query .= " AND `department` LIKE '%$department%'"; }
$rows = $SQL->selectall($query);

$devices = array();
if (is_array($rows)) {
	// iPhone Devices
	if ((float)$_SETTINGS['SERVERVERSION'] >= 3.80) { // iPhone PUSH Supported
		foreach ($rows as $key => $row) {
			$devices[] = $row['device'];
		}
	}
}
else {
	header('Location: offline.php?SERVER=' . $_REQUEST['SERVER']);
	exit();
}

$server = $_SETTINGS['URL'];

// Get the applicable hostname to show where the site visitor is located
$query = "SELECT `url` FROM " . $table_prefix . "requests WHERE `id` = '$request_id'";
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$server = $row['url'];

	for ($i = 0; $i < 3; $i++) {
		$substr_pos = strpos($server, '/');
		if ($substr_pos === false) {
			break;
		}
		if ($i < 2) {
			$server = substr($server, $substr_pos + 1);
		}
		else {
			$server = substr($server, 0, $substr_pos);
		}
	
	}
	
	if (substr($server, 0, 4) == 'www.') { $server = substr($server, 4); }

}


if ($username == '') { $username = 'Guest'; }
//if ($_SETTINGS['PREVIOUSCHATTRANSCRIPTS'] == false) { $guest_login_id = 0; }

// If the site visitor has chatted previously then start new session 
if ($guest_login_id == 0) {
	// Add session details
	$query = "INSERT INTO " . $table_prefix . "sessions (`request`, `username`, `datetime`, `email`, `question`, `server`, `department`, `refresh`) VALUES ('$request_id', '$username', NOW(), '$email', '$question', '$server', '$department', NOW())";
	$login_id = $SQL->insertquery($query);
}
else {
	$login_id = $guest_login_id;
	
	// Retrieve the current connected server
	$query = "SELECT `server` FROM " . $table_prefix . "sessions WHERE `id` = '$login_id'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$server = $row['server'];
		
		// Update session details
		$query = "UPDATE " . $table_prefix . "sessions SET `request` = '$request_id', `username` = '$username', `datetime` = NOW(), `email` = '$email', `question` = '$question', `server` = '$server', `department` = '$department', `refresh` = NOW(), `active` = '0' WHERE `id` = '$login_id'";
		$SQL->miscquery($query);
	}  
	else {
		// Add session details
		$query = "INSERT INTO " . $table_prefix . "sessions (`request`, `username`, `datetime`, `email`, `question`, `server`, `department`, `refresh`) VALUES ('$request_id', '$username', NOW(), '$email', '$question', '$server', '$department', NOW())";
		$login_id = $SQL->insertquery($query);
	}
}
	
// Remove the Initate chat flag and flag as chatting from the requests as the chat has started.
$query = "UPDATE " . $table_prefix . "requests SET `initiate` = '-4' WHERE `id` = '$request_id'";
$SQL->miscquery($query);

// Retrieve the current connected server
if ($server != '') {
	$query = "SELECT `server` FROM " . $table_prefix . "sessions WHERE `id` = '$login_id'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$server = $row['server'];
	}
}

$session = array();
$session['REQUEST'] = $request_id;
$session['GUEST_LOGIN_ID'] = $login_id;
$session['GUEST_USERNAME'] = $username;
$session['MESSAGE'] = 0;
$session['OPERATOR'] = '';
$session['TOTALOPERATORS'] = 0;
$session['SECURITY'] = $security;
$session['LANGUAGE'] = LANGUAGE_TYPE;
$session['DOMAIN'] = $cookie_domain;

$COOKIE = new Cookie;
$data = $COOKIE->encode($session);
setCookie('LiveHelpSession', $data, false, '/', $cookie_domain, 0);

function query_str($params) {
	$str = '';
	foreach ($params as $key => $value) {
	   $str .= (strlen($str) < 1) ? '' : '&';
	   $str .= $key . '=' . $value;
	}
	return ($str);
}

$chat = array();
$chat['USER'] = stripslashes($_REQUEST['USER']);
$chat['EMAIL'] = stripslashes($_REQUEST['EMAIL']);
$chat['DEPARTMENT'] = stripslashes($_REQUEST['DEPARTMENT']);
$chat['QUESTION'] = stripslashes($_REQUEST['QUESTION']);

$COOKIE = new Cookie;
$data = $COOKIE->encode($chat);
setcookie('LiveHelpChat', $data, false, '/', $cookie_domain, 0);

header('Content-type: text/html; charset=utf-8');

// Find total guest visitors that are pending within the selected department
$query = "SELECT `department` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$department = $row['department'];
	$query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '0' AND `department` LIKE '%$department%'";
}
else {
	$query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '0'";
}
$row = $SQL->selectquery($query);
if (is_array($row)) {
	$users_online = $row['count(`id`)'];
}
else {
	$users_online = '1';
}

if (count($devices) > 0) {

	// iPhone APNS PUSH HTTP / HTTPS API
	$key = '20237df3ede04c4daa6657723cd6e62e473c26a0f793ac77ed17f1c14338d2fac9f1ccd8431b6152cad2647c1c04a25b4e7f0ee305c586cfad24aedea8ab34ac';
	
	// TODO: Future Accept Alert
	//array('body' => "$username is pending for Live Help at $server", 'action-loc-key' => 'Accept');
	
	// APNS Alert Options
	$alert = "$username is pending for Live Help at $server";
	$sound = 'Pending.wav';
	$badge = (is_numeric($users_online) ? $users_online : 0);
	$chat = array('id' => 250, 'action' => 'accept');
	
	// APNS JSON Payload
	$aps = array('alert' => $alert, 'sound' => $sound, 'badge' => $badge);
	$json = array('aps' => $aps, 'chat' => $chat);
	
	// Web Service Data
	$data = array('key' => $key, 'devices' => $devices, 'payload' => $json);
	$query = json_encode($data);
	$url = 'http://api.stardevelop.com/php-apns/push.php';
	
	// Query Web Service
	$headers = array('Accept: application/json', 'Content-Type: application/json');
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
	$result = curl_exec($ch);
	curl_close($ch);

}

if ($_SETTINGS['LOGO'] != '') { $margin = 16; $footer = -10; $textmargin = 15; } else { $margin = 50; $footer = 30; $textmargin = 50; }

if (file_exists('locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('locale/' . LANGUAGE_TYPE . '/guest.php');
}
else {
	include('locale/en/guest.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<style type="text/css">
<!--

html, body {
    height: 100%;
}

.body {
	min-height: 435px;
	min-width: 625px;
	height: auto !important;
	height: 100%;
	margin: 0px auto;
	text-align: left;
	position: relative;
	width: 100%;
}

.footer {
    margin-top: 10px;
}

.background {
	margin: 0px;
	text-align: center;
	min-width: 100%;
	width: 100%;
}

-->
</style>
<link href="styles/styles.php" rel="stylesheet" type="text/css"/>
<link href="styles/guest.php" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/JavaScript" src="scripts/jquery-1.3.2.js"></script>
<script language="JavaScript" type="text/JavaScript" src="scripts/jquery.rating.js"></script>
<script language="JavaScript" type="text/JavaScript" src="scripts/jquery.scrollTo.js"></script>
<script language="JavaScript" type="text/JavaScript" src="scripts/soundmanager2.js"></script>
<script language="JavaScript" type="text/JavaScript" src="scripts/guest.js.php?ID=<?php echo($login_id); ?>&amp;USER=<?php echo($username); ?>&amp;COOKIE=<?php echo($_REQUEST['COOKIE']); ?>&amp;LANGUAGE=<?php echo(LANGUAGE_TYPE); ?>"></script>
<link href="styles/jquery.rating.css" rel="stylesheet" type="text/css"/>
</head>
<body onunload="windowLogout();" class="background" onkeydown="focusChat();">
<div style="margin:0px auto; text-align:left">
	<div class="body">
		<div style="margin:0px auto; text-align:center; height:60px">
			<div style="position:absolute; top:0px; left:5px; height:60px; width:95px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerLeft.png); background-repeat:no-repeat;"></div>
			<div id="BannerCenter" style="position:absolute; top:0px; left:100px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerCenter.png); background-repeat:repeat-x; width:<?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 277); ?>px; height:60px;"></div>
			<div style="position:absolute; top:0px; right:5px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerRight.png); background-repeat:no-repeat; width:172px; height:60px;"></div>
		</div>
<?php if ($_SETTINGS['LOGO'] != '') { ?>
		<img src="<?php echo($_REQUEST['SERVER'] . $_SETTINGS['LOGO']); ?>" alt="<?php echo($_SETTINGS['NAME']); ?>" border="0" style="position:absolute; top:10px; left:15px;"/>
<?php
}
?>
		<div id="displayFrame" style="height:<?php echo($_SETTINGS['CHATWINDOWHEIGHT'] - 170); ?>px; width:<?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 150); ?>px; overflow:auto; margin:0px 0px 20px 5px; border-radius:3px; -moz-border-radius:3px; webkit-border-radius:3px; border: 1px solid #d0d0bf; background-color:#fff">
			<div id="WaitingLayer" class="box"><?php echo($thank_you_patience_label); ?><br/><br/>
				<span class="small" style="text-align: right;"><?php echo($currently_label . ' ' . $users_online . ' ' . $users_waiting_label); ?>. [<a href="#" class="normlink" onclick="document.location.reload(true);"><?php echo($refresh_label); ?></a>]</span>
			</div>
<?php
if ($_SETTINGS['OFFLINEEMAIL'] == true) {
?>
		<div id="ContinueLayer" class="box" style="border:none; background:none; text-align:right; display:none;"><?php echo($continue_waiting_label); ?> <a href="offline.php" target="_top" class="normlink"><?php echo($offline_email_label); ?></a> ?</div>
<?php
}
?>
			<div id="Messages"></div>
			<div id="scrollPlaceholder"></div>
		</div>
<?php if ($_SETTINGS['CAMPAIGNIMAGE'] != '') { ?>
		<div style="position:absolute; right:-10px; top:80px; width:150px;">
<?php if ($_SETTINGS['CAMPAIGNLINK'] != '') { ?>
			<a href="<?php echo($_SETTINGS['CAMPAIGNLINK']); ?>" target="_blank">
<?php } ?>
			<img src="<?php echo($_SETTINGS['CAMPAIGNIMAGE']); ?>" border="0" alt="Live Help - Welcome, how can I be of assistance?" style="position:relative; top:-20px"/>
<?php if ($_SETTINGS['CAMPAIGNLINK'] != '') { ?>
			</a>
<?php } ?>
		</div>
		<div style="position:absolute; bottom:50px; right:35px; top:240px">
			<div>
				<input class="star" name="rate" type="radio" title="<?php echo($very_poor_label); ?>" value="1"/>
				<input class="star" name="rate" type="radio" title="<?php echo($poor_label); ?>" value="2"/>
				<input class="star" name="rate" type="radio" title="<?php echo($good_label); ?>" value="3"/>
				<input class="star" name="rate" type="radio" title="<?php echo($very_good_label); ?>" value="4"/>
				<input class="star" name="rate" type="radio" title="<?php echo($excellent_label); ?>" value="5"/>
			</div>
		</div>
<?php
	}
?>
	<div id="TypingStatus" style="position:absolute; bottom:85px; right:155px">
		<img src="./locale/<?php echo(LANGUAGE_TYPE); ?>/images/waiting.gif" alt="Typing Status" name="messengerStatus" id="messengerStatus"/>
	</div>
<?php
	
if ($_SETTINGS['SMILIES'] == true) {
?>
    <div class="bubbleInfo">
        <div>
            <img class="trigger" src="images/Smile.png" id="download"/>
        </div>
        <table id="dpop" class="popup" style="left:-33px; top:-110px; opacity:0; display:none;">
        	<tbody><tr>
        		<td id="topleft" class="corner"/>
        		<td class="top"/>
        		<td id="topright" class="corner"/>
        	</tr>
        	<tr style="background-color:#FFFFFF">
        		<td class="left">
        		<td>
				<div class="popup-contents"><img src="images/Laugh.png" title="Laugh" onclick="appendText(':D'); return false;"/>&nbsp;<img src="images/Smile.png" title="Smile" onclick="appendText(':)'); return false;"/>&nbsp;<img src="images/Sad.png" title="Sad" onclick="appendText(':('); return false;"/>&nbsp;
				<img src="images/Money.png" title="Money" onclick="appendText('$)'); return false;"/>&nbsp;<img src="images/Impish.png" title="Impish" onclick="appendText(':P'); return false;"/>&nbsp;<img src="images/Sweat.png" title="Sweat" onclick="appendText(':\\'); return false;"/>&nbsp;
				<img src="images/Cool.png" title="Cool" onclick="appendText('8)'); return false;"/>&nbsp;<img src="images/Frown.png" title="Frown" onclick="appendText('>:L'); return false;"/>&nbsp;<img src="images/Wink.png" title="Wink" onclick="appendText(';)'); return false;"/>&nbsp;<img src="images/Surprise.png" title="Suprise" onclick="appendText(':O'); return false;"/><br/>
				<img src="images/Woo.png" title="Woo" onclick="appendText('8-)'); return false;"/>&nbsp;<img src="images/Worn-out.png" title="Tired" onclick="appendText('X-('); return false;"/>&nbsp;<img src="images/Shock.png" title="Shock" onclick="appendText('8-O'); return false;"/>&nbsp;
				<img src="images/Hysterical.png" title="Hysterical" onclick="appendText('xD'); return false;"/>&nbsp;<img src="images/Kissed.png" title="Kissed" onclick="appendText(':-*'); return false;"/>&nbsp;<img src="images/Dizzy.png" title="Dizzy" onclick="appendText(':S'); return false;"/>&nbsp;<img src="images/Celebrate.png" title="Celebrate" onclick="appendText('+O)'); return false;"/>&nbsp;
				<img src="images/Angry.png" title="Angry" onclick="appendText('>:O'); return false;"/>&nbsp;<img src="images/Adore.png" title="Adore" onclick="appendText('<3'); return false;"/>&nbsp;<img src="images/Sleep.png" title="Sleep" onclick="appendText('zzZ'); return false;"/>&nbsp;<img src="images/Stop.png" title="Quiet" onclick="appendText(':X'); return false;"/>&nbsp;
				</div>
        		</td>
        		<td class="right">    
        	</tr>
        	<tr>
        		<td class="corner" id="bottomleft"/>
        		<td class="bottom"><img width="30" height="29" alt="Smilies" src="images/bubble-tail2.png" style="position:relative; left:140px"></td>
        		<td id="bottomright" class="corner"/>
        	</tr>
        </tbody></table>
    </div>
<?php
}
?>
	<iframe id="sendMessageFrame" name="sendMessageFrame" src="#" frameborder="0" width="0" height="0" style="visibility:hidden; border:none;"></iframe>
	<div>
		<textarea id="Message" onkeypress="return checkEnter(event);" onfocus="self.focussed = true;" onblur="typing(false); self.focussed = false" style="width:<?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 160); ?>px; height:45px; margin-left:10px; font-family:<?php echo($_SETTINGS['CHATFONT']); ?>; font-size:<?php echo($_SETTINGS['CHATFONTSIZE']); ?>; <?php echo($textarea_style); ?>"></textarea>
		<img src="./locale/<?php echo(LANGUAGE_TYPE); ?>/images/send.gif" alt="<?php echo($send_msg_label); ?>" id="Send" name="Send" width="58" height="50" border="0" onmouseout="$('#Send').attr('src', './locale/<?php echo(LANGUAGE_TYPE); ?>/images/send.gif');" onmouseover="$('#Send').attr('src', './locale/<?php echo(LANGUAGE_TYPE); ?>/images/send_hover.gif');" onclick="return processForm();" style="position:relative; top:3px"/>
	</div>
	<div class="footer small" style="text-align:center<?php if ($_SETTINGS['LOGO'] != '') { echo('; position:relative; top:' . $margin . 'px'); } ?>"><?php echo($stardevelop_copyright_label); ?></div>
</div>
<iframe id="FileDownload" name="FileDownload" height="0" width="0" style="display:none; border:none"></iframe>
</body>
</html>
