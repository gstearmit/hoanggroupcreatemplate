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

$installed = false;
$database = include('include/database.php');
if ($database) {
	include('include/spiders.php');
	include('include/class.mysql.php');
	include('include/class.cookie.php');
	$installed = include('include/config.php');
	include('include/version.php');
}

if ($installed == false) {
	include('include/settings.php');
}

if (!isset($_REQUEST['COMPLETE'])){ $_REQUEST['COMPLETE'] = ''; }
if (!isset($_REQUEST['SECURITY'])){ $_REQUEST['SECURITY'] = ''; }
if (!isset($_REQUEST['BCC'])){ $_REQUEST['BCC'] = ''; }

header('Content-type: text/html; charset=utf-8');
if (file_exists('locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('locale/' . LANGUAGE_TYPE . '/guest.php');
}
else {
	include('locale/en/guest.php');
}

$error = '';
$email = '';
$name = '';
$message = '';
$code = '';
$status = '';

if($_REQUEST['COMPLETE'] == true) {

	foreach ($_REQUEST as $key => $value) {
		if ($key != 'Submit') { 
			$value = str_replace('<', '&lt;', $value);
			$value = str_replace('>', '&gt;', $value);
			$value = trim($value);
			$_REQUEST[$key] = $value;
		}
	}

	$name = stripslashes($_REQUEST['NAME']);
	$email = stripslashes($_REQUEST['EMAIL']);
	$message = stripslashes($_REQUEST['MESSAGE']);
	$code = stripslashes($_REQUEST['SECURITY']);
	$bcc = stripslashes($_REQUEST['BCC']);
	
	if ($email == '' || $name == '' || $message == '') {
		$error = $enter_details_callback_label;
	}
	else {
	
		if (!ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.
					  '@'.
					  '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.
					  '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $email)) {
					  $error = $invalid_email_error_label;
		}
		else {
		
			$code = sha1(strtoupper($code));
			if ($security != $code && $_SETTINGS['SECURITYCODE'] == true && ((function_exists('imagepng') || function_exists('imagejpeg')) && function_exists('imagettftext') && $security_code)) {
				$error = $invalid_security_error_label;
				
				// Generate a NEW random string
				$chars = array('a','A','b','B','c','C','d','D','e','E','f','F','g','G','h','H','i','I','j','J','k','K','l','L','m','M','n','N','o','O','p','P','q','Q','r','R','s','S','t','T','u','U','v','V','w','W','x','X','y','Y','z','Z','1','2','3','4','5','6','7','8','9');
				$security = '';
				for ($i = 0; $i < 5; $i++) {
				   $security .= $chars[rand(0, count($chars)-1)];
				}
				
				$session = array();
				$session['REQUEST'] = $request_id;
				$session['GUEST_LOGIN_ID'] = $guest_login_id;
				$session['GUEST_USERNAME'] = $guest_username;
				$session['MESSAGE'] = 0;
				$session['OPERATOR'] = '';
				$session['TOTALOPERATORS'] = 0;
				$session['SECURITY'] = sha1(strtoupper($security));
				$session['LANGUAGE'] = LANGUAGE_TYPE;
				$session['DOMAIN'] = $cookie_domain;
					
				$COOKIE = new Cookie;
				$data = $COOKIE->encode($session);
				setCookie('LiveHelpSession', $data, false, '/', $cookie_domain, 0);

			}
			else {
				$country = 'Unavailable';
				$url = 'Unavailable';
				$title = 'Unavailable'; 
				$referrer = 'Unavailable';
				
				$query = "SELECT `url`, `title`, `referrer` FROM " . $table_prefix . "requests WHERE `id` = '$request_id'";
				$row = $SQL->selectquery($query);
				if (is_array($row)) {
					$url = $row['url'];
					$title = $row['title'];
					$referrer = $row['referrer'];
					
					if ($url == '') { $url = 'Unavailable'; }
					if ($title == '') { $title = 'Unavailable'; }
					if ($referrer == '') { $referrer = 'Unavailable'; } elseif ($referrer == 'false') { $referrer = 'Direct Link / Bookmark'; }
				}
				
				if ($_SETTINGS['IP2COUNTRY'] == true) { 
					$ip = sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
					
					$query = "SELECT code FROM " . $table_prefix . "ip2country WHERE ip_from <= '$ip' AND ip_to >= '$ip' LIMIT 1";
					$row = $SQL->selectquery($query);
					if (is_array($row)){
						$query = "SELECT country FROM  " . $table_prefix . "countries WHERE code = '" . $row['code'] . "' LIMIT 1";
						$row = $SQL->selectquery($query);
						$country = ucwords(strtolower($row['country']));
					}
					else {
						$country = 'Unavailable';
					}
				}

				// Determine EOL
				$server = strtoupper(substr($_SERVER['OS'], 0, 3));
				if ($server == 'WIN') { 
					$eol = "\r\n"; 
				} elseif ($server == 'MAC') { 
					$eol = "\r"; 
				} else { 
					$eol = "\n"; 
				}

				# Boundry for marking the split & Multitype Headers 
				$mime_boundary = sha1(time());
				$subject = '=?UTF-8?B?' . base64_encode($_SETTINGS['NAME'] . ' Offline Message') . '?=';
								
				$headers = 'From: "=?UTF-8?B?' . base64_encode($name) . '?=" <' . $_SETTINGS['EMAIL'] . '>' . $eol;
				$headers .= 'Reply-To: <' . $email . '>' . $eol;
				$headers .= 'Return-Path: <' . $email . '>' . $eol;
				$headers .= 'MIME-Version: 1.0' . $eol; 
				$headers .= 'Content-Type: multipart/alternative; boundary="' . $mime_boundary . '"' . $eol; 
				
				$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
				$message = preg_replace("/(\r\n|\r|\n)/", '<br/>', $message);
				
				$html = <<<END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--

div, p {
	font-family: Calibri, Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
}

//-->
</style>
</head>

<body>
<p><img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/OfflineEmail.gif" width="531" height="79" alt="Offline Message" /></p>
<p><strong>Message:</strong></p>
<p>$message</p>
<p>$name<br/>$email</p>
<p>&nbsp;</p>
<p><strong>IP / Hostname Logged:</strong> $hostname<br />
<strong>Country:</strong> $country<br />
<strong>Current Page:</strong> <a href="$url">$url</a><br />
<strong>Current Page Title:</strong> $title<br />
<strong>Referer:</strong> <a href="$referrer">$referrer</a></p>
<p><img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/LogoSmall.png" width="217" height="52" alt="{$_SETTINGS['DOMAIN']}" /></p>
</body>
</html>
END;

				// Add Plain Text Email
				$body = '--' . $mime_boundary . $eol;
				$body .= 'Content-type: text/plain; charset=utf-8' . $eol . $eol;
				$body .= $message . $eol . $eol;
				$body .= "IP / Hostname Logged:  $hostname" . $eol;
				if ($_SETTINGS['IP2COUNTRY'] == true) { $body .= "Country:  $country" . $eol; }
				$body .= "URL:  $url" . $eol;
				$body .= "URL Title:  $title" . $eol;
				$body .= "Referrer:  $referrer" . $eol . $eol;
				
				// Add HTML Email
				$body .= '--' . $mime_boundary . $eol;
				$body .= 'Content-type: text/html; charset=utf-8' . $eol . $eol;
				$body .= $html . $eol . $eol;
				$body .= "--" . $mime_boundary . "--" . $eol . $eol;
				
				$sendmail_path = ini_get('sendmail_path');
				mail($_SETTINGS['EMAIL'], $subject, $body, $headers);
				
				if ($bcc == true) {
				
					$bcchtml = <<<END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--

div, p {
	font-family: Calibri, Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
}

//-->
</style>
</head>

<body>
<p><img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/OfflineEmail.gif" width="531" height="79" alt="Offline Message" /></p>
<p><strong>Message:</strong></p>
<p>$message</p>
<p>$name<br/>$email</p>
<p><img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/LogoSmall.png" width="217" height="52" alt="{$_SETTINGS['DOMAIN']}" /></p>
</body>
</html>
END;

					$headers = 'From: "=?UTF-8?B?' . base64_encode($name) . '?=" <' . $_SETTINGS['EMAIL'] . '>' . $eol;
					$headers .= 'Reply-To: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
					$headers .= 'Return-Path: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
					$headers .= 'MIME-Version: 1.0' . $eol; 
					$headers .= 'Content-Type: multipart/alternative; boundary="' . $mime_boundary . '"' . $eol; 

					// Add Plain Text Email
					$body = '--' . $mime_boundary . $eol;
					$body .= 'Content-type: text/plain; charset=utf-8' . $eol . $eol;
					$body .= $message . $eol . $eol;
					
					// Add HTML Email
					$body .= '--' . $mime_boundary . $eol;
					$body .= 'Content-type: text/html; charset=utf-8' . $eol . $eol;
					$body .= $bcchtml . $eol . $eol;
					$body .= "--" . $mime_boundary . "--" . $eol . $eol;

					mail($email, $subject, $body, $headers);

				}
			}
		}
	}
	
	$message = stripslashes($_REQUEST['MESSAGE']);
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<link href="styles/styles.php" rel="stylesheet" type="text/css"/>
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
.background {
	margin: 0px;
	text-align: center;
	min-width: 100%;
	width: 100%;
}
form {
	margin:0px;
	padding:10px;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript" src="scripts/jquery-1.3.2.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--

$(function(){
	
	$(window).resize(function() {
		
		var height = $(window).height();
		var width = $(window).width();
		
		$('.body').css('width', width + 'px');
		$('.body').css('min-width', '625px');
		
		$('#MESSAGE').css('height', height - 325 + 'px');
		$('#MESSAGE').css('min-height', '100px');
		
		$('#NAME').css('width', width - 250 + 'px');
		$('#EMAIL').css('width', width - 250 + 'px');
		$('#MESSAGE').css('width', width - 250 + 'px');
		
		if (width - 277 > 348) { $('#BannerCenter').css('width', width - 277 + 'px'); } else { $('#BannerCenter').css('width', '348px'); }

	});

});


function getLayer(id) {
	if (document.getElementById) {
		return document.getElementById(id);
	} else if (document.layers && document.layers[id] != null) {
		return document.layers[id];
	} else if (document.all) {
		return document.all[id];
	}
}

function showError(id) {
	var obj = getLayer(id);
	if (obj != null) {
		obj.style.visibility = 'visible';
		obj.src = 'images/errorsmall.gif';
		return true;
	}
}

function hideError(id) {
	var obj = getLayer(id);
	if (obj != null) { obj.style.visibility = 'hidden';	}
}

function validateField(field, id) {
	if (field.value == '') {
		return showError(id);
	} else {
		hideError(id);
		return false;
	}
}

function validateForm() {

	if (validateField(document.OfflineMessageForm.NAME, 'NameError') || validateField(document.OfflineMessageForm.EMAIL, 'EmailError') || validateField(document.OfflineMessageForm.MESSAGE, 'MessageError')) {
		return false;
	}
	return true;
}

//-->
</script>
</head>
<body bgcolor="<?php echo($_SETTINGS['BACKGROUNDCOLOR']); ?>" text="<?php echo($_SETTINGS['FONTCOLOR']); ?>" link="<?php echo($_SETTINGS['LINKCOLOR']); ?>" vlink="<?php echo($_SETTINGS['LINKCOLOR']); ?>" alink="<?php echo($_SETTINGS['LINKCOLOR']); ?>" class="background">
  <div class="body">
	<div style="margin:0px auto; text-align:center; height:60px">
		<div style="position:absolute; top:0px; left:5px; height:60px; width:95px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerLeft.png); background-repeat:no-repeat;"></div>
		<div id="BannerCenter" style="position:absolute; top:0px; left:100px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerCenter.png); background-repeat:repeat-x; width:<?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 277); ?>px; height:60px;"></div>
		<div style="position:absolute; top:0px; right:5px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerRight.png); background-repeat:no-repeat; width:172px; height:60px;"></div>
	</div>
<?php
	if ($_SETTINGS['LOGO'] != '') {
?>
	<img src="<?php echo($_SETTINGS['LOGO']); ?>" alt="<?php echo($_SETTINGS['NAME']); ?>" border="0" style="position: absolute; top:6px; left:10px;"/>
<?php
	} else {
?>
<?php
	}
	if($_REQUEST['COMPLETE'] == '' || $error != '') {
?>
  <div align="center" style="margin-top:10px;">
  <form action="offline.php" method="post" onsubmit="return validateForm();" name="OfflineMessageForm" id="OfflineMessageForm" style="padding:0px; margin:0px;">
    <table border="0" align="center" cellpadding="2" cellspacing="2">
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" valign="bottom"><div align="center"><?php echo($unfortunately_offline_label); ?><br/>
            <?php echo($fill_details_below_label); ?>: </div></td>
      </tr>
      <?php
	  if ($error != '') {
	  ?>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" valign="bottom"><div align="center"><strong><?php echo($error); ?></strong></div></td>
      </tr>
      <?php
	  }
	  elseif ($_SETTINGS['OFFLINEEMAILREDIRECT'] != '' || $_SETTINGS['OFFLINEEMAIL'] == false) {
	  ?>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" valign="bottom"><div align="center"><strong>This feature has been disabled, please contact us via. email.  Thank you.</strong></div></td>
      </tr>
      <?php
	  }
	  ?>
      <tr>
        <td>&nbsp;</td>
        <td valign="middle"><div align="right"><?php echo($name_label); ?>:</div></td>
        <td><input name="NAME" type="text" id="NAME" value="<?php echo($name); ?>" size="40" style="width: <?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 250); ?>px;" onblur="validateField(this, 'NameError')" onkeypress="return true; validateField(this, 'NameError')" <?php if ($_SETTINGS['OFFLINEEMAILREDIRECT'] != '' || $_SETTINGS['OFFLINEEMAIL'] == false) { echo('disabled="disabled"'); } ?>/>
          <img id="NameError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="middle"><div align="right"><?php echo($email_label); ?>:</div></td>
        <td><input name="EMAIL" type="text" id="EMAIL" value="<?php echo($email); ?>" size="40" style="width: <?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 250); ?>px;" onblur="validateField(this, 'EmailError')" onkeypress="return true; validateField(this, 'EmailError')" <?php if ($_SETTINGS['OFFLINEEMAILREDIRECT'] != '' || $_SETTINGS['OFFLINEEMAIL'] == false) { echo('disabled="disabled"'); } ?>/>
          <img id="EmailError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="top"><div align="right"><?php echo($message_label); ?>:</div></td>
        <td align="right" valign="top"><div align="left">
            <textarea name="MESSAGE" cols="30" rows="6" id="MESSAGE" style="width:<?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 250); ?>px; height:<?php echo($_SETTINGS['CHATWINDOWHEIGHT'] - 325); ?>px; vertical-align: middle; font-family:<?php echo($_SETTINGS['CHATFONT']); ?>; font-size: <?php echo($_SETTINGS['CHATFONTSIZE']); ?>;" onblur="validateField(this, 'MessageError')" onkeypress="return true; validateField(this, 'MessageError')" <?php if ($_SETTINGS['OFFLINEEMAILREDIRECT'] != '' || $_SETTINGS['OFFLINEEMAIL'] == false) { echo('disabled="disabled"'); } ?>><?php echo($message); ?></textarea>
            <img id="MessageError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></div></td>
      </tr>
	  <?php
	  if ($_SETTINGS['SECURITYCODE'] == true && (function_exists('imagepng') || function_exists('imagejpeg')) && function_exists('imagettftext') && $security_code) {
	  ?>
      <tr>
        <td>&nbsp;</td>
        <td align="right" valign="middle"><?php echo($security_code_label); ?>:</td>
        <td align="left" valign="middle"><span style="height: 30px; vertical-align: middle;"><input name="SECURITY" type="text" id="SECURITY" value="" size="6" style="width:100px;" onblur="validateField(this, 'SecurityError')" onkeypress="return true; validateField(this, 'SecurityError')" <?php if ($_SETTINGS['OFFLINEEMAILREDIRECT'] != '' || $_SETTINGS['OFFLINEEMAIL'] == false) { echo('disabled="disabled"'); } ?>/>
        </span><img src="security.php" style="height: 30px; vertical-align: middle;" alt="Security Code"/><img id="SecurityError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
      </tr>
	  <?php
	  }
	  ?>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="right" valign="top"><div align="center">
            <input name="BCC" type="checkbox" value="1" <?php if ($_SETTINGS['OFFLINEEMAILREDIRECT'] != '' || $_SETTINGS['OFFLINEEMAIL'] == false) { echo('disabled="disabled"'); } ?>/>
            <?php echo($send_copy_label); ?></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="right" valign="top"><div align="center">
            <input name="COMPLETE" type="hidden" id="COMPLETE" value="1"/>
            <input name="COOKIE" type="hidden" id="COOKIE" value="<?php echo($_REQUEST['COOKIE']); ?>"/>
			<input name="LANGUAGE" type="hidden" id="LANGUAGE" value="<?php echo(LANGUAGE_TYPE); ?>"/>
            <div align="center">
                    <input type="submit" name="Submit" value="<?php echo($send_msg_label); ?>" <?php if ($_SETTINGS['OFFLINEEMAILREDIRECT'] != '' || $_SETTINGS['OFFLINEEMAIL'] == false) { echo('disabled="disabled"'); } ?>/>
            </div><br/><span class="small"><?php echo($stardevelop_copyright_label); ?></span></div></td>
      </tr>
    </table>
  </form>
<?php
  }
  else {
  ?>
  <?php echo($thank_you_enquiry_label); ?><br>
  <?php echo($contacted_soon_label); ?><br>
  <br>
  <table border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td width="22">&nbsp;</td>
      <td valign="bottom"><div align="right"><?php echo($email_label); ?>:</div></td>
      <td width="260" style="text-align:left"><em><?php echo($email); ?></em></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td valign="bottom"><div align="right"><?php echo($name_label); ?>:</div></td>
      <td style="text-align:left"><em><?php echo($name); ?></em></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td valign="top"><div align="right"><?php echo($message_label); ?>:</div></td>
      <td align="right" valign="top"><textarea name="textarea" cols="30" rows="12" id="textarea" style="width:400px; font-family:<?php echo($_SETTINGS['CHATFONT']); ?>; font-size:<?php echo($_SETTINGS['CHATFONTSIZE']); ?>;" readonly="readonly"><?php echo($message); ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" align="right" valign="top"><div align="center"></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" align="right" valign="top"><div align="center"><span class="small"><?php echo($stardevelop_copyright_label); ?></span></div></td>
    </tr>
  </table>
</div>
<?php
  }
  ?>
    </div>
  </div>
</body>
</html>
