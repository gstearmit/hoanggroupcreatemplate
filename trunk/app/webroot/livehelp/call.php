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
$database = include('./include/database.php');
if ($database) {
	include('./include/spiders.php');
	include('./include/class.mysql.php');
	include('./include/class.cookie.php');
	$installed = include('./include/config.php');
	include('./include/version.php');
	include('./include/functions.php');
} else {
	$installed = false;
}

if ($installed == false) {
	include('./include/settings.php');
}

if (!isset($_REQUEST['COMPLETE'])){ $_REQUEST['COMPLETE'] = ''; }
if (!isset($_REQUEST['SECURITY'])){ $_REQUEST['SECURITY'] = ''; }
if (!isset($_REQUEST['BCC'])){ $_REQUEST['BCC'] = ''; }

header('Content-type: text/html; charset=utf-8');

if (file_exists('./locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('./locale/' . LANGUAGE_TYPE . '/guest.php');
}
else {
	include('./locale/en/guest.php');
}

$error = '';
$name = '';
$email = '';
$message = '';
$country = '';
$timezone = '';
$dial = '';
$telephone = '';
$code = '';
$status = '';

$complete = false;
if ($_REQUEST['COMPLETE'] == true) {

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
	$country = stripslashes($_REQUEST['COUNTRY']);
	$timezone = stripslashes($_REQUEST['TIMEZONE']);
	$dial = stripslashes($_REQUEST['DIAL']);
	$telephone = stripslashes($_REQUEST['TELEPHONE']);
	$code = stripslashes($_REQUEST['SECURITY']);

	if ($email == '' || $name == '' || $message == '' || $telephone == '' || $dial == '') {
		$error = "$invalid_details_error_label";
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
				
				$pos = strpos($country, '+');
				$prefix = trim(substr($country, $pos));
				$country = trim(substr($country, 0, $pos - strlen($country)));

				
				if ($timezone) {
					$offset = -$timezone;
					$timezone = ($offset > 0) ? '+' : '-';
					$timezone .= floor($offset / 60);
					$timezone .= (($offset % 60) < 10) ? '0' . $offset % 60 : $offset % 60;
				}
				
				$query = "INSERT INTO " . $table_prefix . "callback(`datetime`, `name`, `email`, `country`, `timezone`, `dial`, `telephone`,`message`) VALUES(NOW(), '$name', '$email', '$country', '$timezone', '$dial', '$telephone', '$message')";
				$id = $SQL->insertquery($query);
			
			}
			
		}
	}
	$complete = true;
}

if ($error != '') {	$complete = false; }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<link href="styles/styles.php" rel="stylesheet" type="text/css"/>
<style type="text/css">
<!--
.background {
	background-image: url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/Banner.png);
	background-repeat: no-repeat;
	background-position: center top;
	margin-left: 0px;
	margin-top: 0px;
	text-align: center;
	min-width: 600px;
}
form {
	margin:0px;
	padding:10px;
}
-->
</style>
<script language="JavaScript" type="text/javascript">
<!--

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

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

function validateDial() {
	var dial = document.OfflineMessageForm.COUNTRY.value;
	document.OfflineMessageForm.DIAL.value = dial.substring(dial.indexOf('+'));
}

function getTimezone() {
	var datetime = new Date();
	if (datetime) {
		return datetime.getTimezoneOffset();
	} else {
		return '';
	}
}

function validateForm() {

	var localtime = getTimezone();
	document.OfflineMessageForm.TIMEZONE.value = localtime;

	if (validateField(document.OfflineMessageForm.NAME, 'NameError') || validateField(document.OfflineMessageForm.EMAIL, 'EmailError') || validateField(document.OfflineMessageForm.TELEPHONE, 'TelephoneError') || validateField(document.OfflineMessageForm.MESSAGE, 'MessageError') || validateField(document.OfflineMessageForm.MESSAGE, 'SecurityError')) {
		return false;
	}
	return true;
}

<?php
if ($complete) {
?>
var LiveHelpXMLHTTP = null;
var CallStatusTimer;
var CallStatus = 0;

function checkXMLHTTP() {
	obj = null;
	if (window.XMLHttpRequest) {
		obj = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		obj = new ActiveXObject("Microsoft.XMLHTTP")
		if (!obj) {
			try {
				obj = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				try {
					obj = new ActiveXObject("Microsoft.XMLHTTP");
				} catch(e) {
					obj = null;
				}
			}
		}
    }
	return obj;
}

function LoadCallStatus() {

	LiveHelpXMLHTTP = checkXMLHTTP();
	
	// Run the XML query
	if (LiveHelpXMLHTTP.readyState != 0) {
		LiveHelpXMLHTTP.abort();
	}
	
	var RequestData = 'CALL=1&ID=<?php echo($id); ?>';
	try {
		LiveHelpXMLHTTP.open('POST', '<?php echo($server); ?>/livehelp/refresher.php', true);
	} catch(e) {
		updateStatus(-1);
		LiveHelpXMLHTTP.abort();
		LiveHelpXMLHTTP = null;
		return false;
	}
	
	LiveHelpXMLHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	LiveHelpXMLHTTP.setRequestHeader("Content-length", RequestData.length);
	LiveHelpXMLHTTP.setRequestHeader("Connection", "close");
		
	LiveHelpXMLHTTP.onreadystatechange = function() {
		if (LiveHelpXMLHTTP.readyState == 4) {
			// Process response as JavaScript
			if (LiveHelpXMLHTTP.status == 200) {
				eval(LiveHelpXMLHTTP.responseText);
			}
		}
	};

	try {
		LiveHelpXMLHTTP.send(RequestData);
	} catch(e) {
		updateStatus(-1);
		LiveHelpXMLHTTP.abort();
		LiveHelpXMLHTTP = null;
		return false;
	}

	if (CallStatus < 4) {
		window.clearTimeout(CallStatusTimer);
		CallStatusTimer = window.setTimeout('LoadCallStatus();', 2000);
	} else {
		window.clearTimeout(CallStatusTimer);
	}

}

LiveHelpXMLHTTP = checkXMLHTTP();
if (LiveHelpXMLHTTP != null) {
	LoadCallStatus();
} else {
	var obj = getLayer('CallStatusText');
	if (obj != null) {
		obj.innerHTML = 'You will receive a telephone call shortly.';
	}
}

function updateStatus(status) {
	var obj = getLayer('CallStatusText');
	if (obj != null) {
		switch(status) {
		case 0:
		  obj.innerHTML = 'Waiting for telephone call.';
		  break 
		case 1:
		  obj.innerHTML = 'Initalising telephone call.';
		  break    
		case 2:
		  obj.innerHTML = 'Initalised telephone call.';
		  break
		case 3:
		  obj.innerHTML = 'Dialing telephone <?php echo($prefix . ' ' . $telephone); ?>.';
		  break
		case 4:
		  obj.innerHTML = 'Call connected to <?php echo($prefix . ' ' . $telephone); ?>.';
		  stopProgress();
		  break
		case 6:
		  obj.innerHTML = 'Busy telephone lines.';
		  stopProgress();
		  break
		default:
		  obj.innerHTML = 'Service Unavailable, try again soon.';
		  stopProgress();
		}
	}
	CallStatus = status;
}

function stopProgress() {
	var obj = getLayer('CallProgressImage');
	if (obj != null) {
		obj.style.visibility = 'hidden';
	}
}

<?php
}
?>

//-->
</script>
</head>
<body bgcolor="<?php echo($_SETTINGS['BACKGROUNDCOLOR']); ?>" text="<?php echo($_SETTINGS['FONTCOLOR']); ?>" link="<?php echo($_SETTINGS['LINKCOLOR']); ?>" vlink="<?php echo($_SETTINGS['LINKCOLOR']); ?>" alink="<?php echo($_SETTINGS['LINKCOLOR']); ?>" class="background">
<?php
	if ($_SETTINGS['LOGO'] != '') {
?>
<div style="margin:0 auto; text-align:left; width:600px;">
<img src="<?php echo($_SETTINGS['LOGO']); ?>" alt="<?php echo($_SETTINGS['NAME']); ?>" border="0" style="position: relative; top: 10px; left: 15px;"/>
<?php } else { ?>
<div style="margin:0 auto; text-align:left; width:600px; margin-top:30px;">
  <?php } ?>
  <div align="center">
    <?php
	if ($complete) {
?>
    <div class="box" style="position:absolute; left:140px; top:80px; width:375px; height:30px; padding-top:8px; margin-left: 5px; margin-right:10px; z-index:200"><strong>Status:</strong> <span id="CallStatusText" name="CallStatusText">Waiting for telephone call.</span> <img id="CallProgressImage" name="CallProgressImage" src="./images/loader.gif" alt="Please wait..." width="16" height="16" /></div>
    <?php
	}
?>
    <form action="call.php" method="post" onsubmit="return validateForm();" name="OfflineMessageForm" id="OfflineMessageForm">
      <table border="0" align="center" cellpadding="2" cellspacing="2" style="position: relative; top: 35px;">
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" valign="bottom"><div align="center"><?php echo($enter_details_callback_label); ?></div></td>
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
	  ?>
        <tr>
          <td>&nbsp;</td>
          <td valign="middle"><div align="right"><?php echo($name_label); ?>:</div></td>
<?php
if ($complete) {
?>
          <td style="text-align:left;"><?php echo($name); ?></td>
<?php
} else {
?>
          <td style="text-align:left;"><input name="NAME" type="text" id="NAME" value="<?php echo($name); ?>" size="40" style="width: 400px;" onblur="validateField(this, 'NameError')" onkeypress="return true; validateField(this, 'NameError')" <?php if ($complete) {echo('disabled="disabled"'); } ?>/>
            <img id="NameError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
<?php
}
?>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="middle"><div align="right"><?php echo($email_label); ?>:</div></td>
<?php
if ($complete) {
?>
          <td style="text-align:left;"><?php echo($email); ?></td>
<?php
} else {
?>
          <td style="text-align:left;"><input name="EMAIL" type="text" id="EMAIL" value="<?php echo($email); ?>" size="40" style="width: 400px;" onblur="validateField(this, 'EmailError')" onkeypress="return true; validateField(this, 'EmailError')" <?php if ($complete) {echo('disabled="disabled"'); } ?>/>
            <img id="EmailError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
<?php
}
?>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="middle"><div align="right"><?php echo($country_label); ?>:</div></td>
          <?php
if ($complete) {
?>
          <td style="text-align:left;"><?php echo($country); ?></td>
          <?php
} else {
?>
          <td style="text-align:left;"><select name="COUNTRY" style="width: 225px; font-family:<?php echo($_SETTINGS['CHATFONT']); ?>; font-size: <?php echo($_SETTINGS['CHATFONTSIZE']); ?>;" onchange="validateDial()">
              <option value="&nbsp;"></option>
              <?php

$ipcountry = ''; $dialcode = '';
if ($_SETTINGS['IP2COUNTRY'] == true) {
	$ip = sprintf("%u", ip2long(ip_address()));
	$query = "SELECT `code` FROM " . $table_prefix . "ip2country WHERE `ip_from` <= '$ip' AND `ip_to` >= '$ip' LIMIT 1";
	$row = $SQL->selectquery($query);
	if (is_array($row)){
		$ipcountry = $row['code'];
	}
}

$query = 'SELECT `code`, `country`, `dial` FROM ' . $table_prefix . 'countries ORDER BY `country`';
$row = $SQL->selectquery($query);
while ($row) {
	if (is_array($row)) {
		$country = ucwords(strtolower($row['country']));
		$dial = '+' . $row['dial'];
		if ($country != '' && $ipcountry == $row['code']) {
			$dialcode = $dial;
?>
              <option value="<?php echo($country . ' ' . $dial); ?>" selected="selected"><?php echo($country . ' ' . $dial); ?></option>
              <?php
		} else {
?>
              <option value="<?php echo($country . ' ' . $dial); ?>"><?php echo($country . ' ' . $dial); ?></option>
              <?php
		}
	}
	$row = $SQL->selectnext();
}

?>
            </select>
            <?php
}
?>
            <img id="EmailError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="middle"><div align="right"><?php echo($telephone_label); ?>:</div></td>
<?php
if ($complete) {
?>
          <td style="text-align:left;"><?php echo($dial . ' ' . $telephone); ?></td>
<?php
} else {
?>
          <td style="text-align:left;">
            <input name="DIAL" type="text" id="DIAL" value="<?php echo($dialcode); ?>" size="40" style="width:40px; margin-right:5px;" readonly="readonly"/>
            <input name="TELEPHONE" type="text" id="TELEPHONE" value="<?php echo($telephone); ?>" size="40" style="width:170px;" onblur="validateField(this, 'TelephoneError')" onkeypress="return true; validateField(this, 'TelephoneError')"/>
            <img id="TelephoneError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
<?php
}
?>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top"><div align="right"><?php echo($message_label); ?>:</div></td>
          <td align="right" valign="top"><div align="left">
              <textarea name="MESSAGE" cols="30" rows="6" id="MESSAGE" style="width:400px; vertical-align: middle; font-family:<?php echo($_SETTINGS['CHATFONT']); ?>; font-size: <?php echo($_SETTINGS['CHATFONTSIZE']); ?>;" onblur="validateField(this, 'MessageError')" onkeypress="return true; validateField(this, 'MessageError')" <?php if ($complete) {echo('disabled="disabled"'); } ?>><?php echo($message); ?></textarea>
              <img id="MessageError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></div></td>
        </tr>
        <?php
	if (!$complete && $_SETTINGS['SECURITYCODE'] == true && (function_exists('imagepng') || function_exists('imagejpeg')) && function_exists('imagettftext') && $security_code) {
	  ?>
        <tr>
          <td>&nbsp;</td>
          <td align="right" valign="middle"><?php echo($security_code_label); ?>:</td>
          <td align="left" valign="middle"><span style="height: 30px; vertical-align: middle;">
            <input name="SECURITY" type="text" id="SECURITY" value="" size="6" style="width:100px;" onblur="validateField(this, 'SecurityError')" onkeypress="return true; validateField(this, 'SecurityError')"/>
            </span><img src="security.php" style="height: 30px; vertical-align: middle;" alt="Security Code"/><img id="SecurityError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
        </tr>
        <?php
	}
	  ?>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" align="right" valign="top"><div align="center">
              <input name="TIMEZONE" type="hidden" id="TIMEZONE" value=""/>
              <input name="COMPLETE" type="hidden" id="COMPLETE" value="1"/>
              <input name="COOKIE" type="hidden" id="COOKIE" value="<?php echo($_REQUEST['COOKIE']); ?>"/>
              <input name="LANGUAGE" type="hidden" id="LANGUAGE" value="<?php echo(LANGUAGE_TYPE); ?>"/>
              <table border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td><div align="center">
                      <input type="submit" name="Submit" value="<?php echo($continue_label); ?>" <?php if ($complete) {echo('disabled="disabled"'); } ?>/>
                    </div></td>
                </tr>
              </table>
              <br/>
              <span class="small"><?php echo($stardevelop_copyright_label); ?></span></div></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>
