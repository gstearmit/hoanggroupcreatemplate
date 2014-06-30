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

if (!isset($_REQUEST['DEPARTMENT'])){ $_REQUEST['DEPARTMENT'] = ''; }
if (!isset($_REQUEST['ERROR'])){ $_REQUEST['ERROR'] = ''; }

$installed = false;
$database = include('include/database.php');
if ($database) {
	include('include/spiders.php');
	include('include/class.mysql.php');
	include('include/class.cookie.php');
	$installed = include('include/config.php');
	include('include/version.php');
} else {
	$installed = false;
}

if ($installed == false) {
	header('Location: ./offline.php');
	exit();
}

if ($installed == true) {

	if (!isset($_COOKIE['LiveHelpSession'])) {
		header('Location: ./cookies.php?LANGUAGE=' . LANGUAGE_TYPE);
		exit();
	}

	// Checks if any users in user table are online
	if ($_REQUEST['ERROR'] == '') {
		if ((float)$_SETTINGS['SERVERVERSION'] >= 3.80) { // iPhone PUSH Supported
			$query = "SELECT `id` FROM " . $table_prefix . "users WHERE (`refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) OR `device` <> '') AND `status` = '1'";
		} else {
			$query = "SELECT `id` FROM " . $table_prefix . "users WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND  AND `status` = '1'";
		}
		if ($_REQUEST['DEPARTMENT'] != '' && $_SETTINGS['DEPARTMENTS'] == true) { $query .= " AND department LIKE '" . $_REQUEST['DEPARTMENT'] . "'"; }
		$row = $SQL->selectquery($query);
		if(!is_array($row)) {
			header('Location: ./offline.php?LANGUAGE=' . LANGUAGE_TYPE);
			exit();
		}
	}
	
	if ($_SETTINGS['LOGINDETAILS'] == false) {
		if (isset($_REQUEST['DEPARTMENT'])) {
			header('Location: ./frames.php?LANGUAGE=' . LANGUAGE_TYPE . '&DEPARTMENT=' . $_REQUEST['DEPARTMENT']);
		} else {
			header('Location: ./frames.php?LANGUAGE=' . LANGUAGE_TYPE);
		}
		exit();
	}

}

if (isset($_COOKIE['LiveHelpChat'])) {
	$cookie = new Cookie();
	$session = $cookie->decodeGuestLogin($_COOKIE['LiveHelpChat']);

	$username = $session['USER'];
	$email = $session['EMAIL'];
	$department = $session['DEPARTMENT'];
	$question = $session['QUESTION'];

} else {
	$username = ''; $email = ''; $department = ''; $question = '';
}

header('Content-type: text/html; charset=utf-8');

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
	text-align: center;
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
	margin: 0px;
	padding: 10px;
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

function validateEmail() {
	var email = document.login.EMAIL.value;
	if (email != '') {
		if (email.match(/^[\-!#$%&'*+\\.\/0-9=?A-Z^_`a-z{|}~]+@[\-!#$%&'*+\\\/0-9=?A-Z^_`a-z{|}~]+\.[\-!#$%&'*+\\.\/0-9=?A-Z^_`a-z{|}~]+$/)) {
			hideError('EmailError');
			return false;
		} else {
			showError('EmailError');
			return true;
		}
	}
}

function validateForm() {
<?php
if ($_SETTINGS['DEPARTMENTS'] == true) {
	if ($_SETTINGS['REQUIREGUESTDETAILS'] == true && $_SETTINGS['LOGINDETAILS'] == true) {
		if ($_SETTINGS['LOGINEMAIL'] == false) {
?>
	if (validateField(document.login.USER, 'UsernameError') || validateField(document.login.DEPARTMENT, 'DepartmentError')) {
		return false;
	}
<?php
		} else {
?>
	if (validateField(document.login.USER, 'UsernameError') || validateField(document.login.EMAIL, 'EmailError') || validateField(document.login.DEPARTMENT, 'DepartmentError')) {
		if (document.login.EMAIL.value != '' && validateEmail()) {
			return false;
		}
		return false;
	}
<?php
		}
	} else {
?>
	if (document.login.EMAIL.value != '' && validateEmail()) {
		return false;
	}
	if (validateField(document.login.DEPARTMENT, 'DepartmentError')) {
		return false;
	}
<?php
	}
} else {
	if ($_SETTINGS['REQUIREGUESTDETAILS'] == true && $_SETTINGS['LOGINDETAILS'] == true) {
		if ($_SETTINGS['LOGINEMAIL'] == false) {
?>
	if (validateField(document.login.USER, 'UsernameError')) {
		return false;
	}
<?php
		} else {
?>
	if (validateField(document.login.USER, 'UsernameError') || validateField(document.login.EMAIL, 'EmailError')) {
		return false;
	}
<?php
		}
	}
}
?>
	return true;
}

//-->
</script>
</head>
<body class="background">
<div class="body">
	<div style="margin:0px auto; text-align:center; height:60px">
		<div style="position:absolute; top:0px; left:5px; height:60px; width:255px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerLeft.png); background-repeat:no-repeat;"><!--<img src="<?php echo($_SETTINGS['LOGO']); ?>" alt="<?php echo($_SETTINGS['NAME']); ?>" border="0" style="position: relative; top: 6px; left: 0px;"/>--></div>
		<div id="BannerCenter" style="position:absolute; top:0px; left:100px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerCenter.png); background-repeat:repeat-x; width:<?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 277); ?>px; height:60px;"></div>
		<div style="position:absolute; top:0px; right:5px; background-image:url(./locale/<?php echo(LANGUAGE_TYPE); ?>/images/BannerRight.png); background-repeat:no-repeat; width:172px; height:60px;"></div>
	</div>
<?php if ($_SETTINGS['LOGO'] != '') { ?>
<img src="<?php echo($_SETTINGS['LOGO']); ?>" alt="<?php echo($_SETTINGS['NAME']); ?>" border="0" style="position: absolute; top: 6px; left: 10px;"/>
<?php
} else {
?>
<?php
}
?>
  <div align="center" style="position:relative; top:10px">
  <b><?php echo($welcome_label); ?><br/>
  <br/>
  <?php if ($_SETTINGS['OFFLINEEMAIL'] == true) { echo($else_send_message_label); ?> <a href="offline.php?LANGUAGE=<?php echo(LANGUAGE_TYPE); ?>" class="normlink"><?php echo($offline_message_label); ?></a><br/><?php echo($note_label); ?><br/><br/><?php echo($enter_guest_details_label); ?></b>
  <?php
  }
  if ($_REQUEST['ERROR'] == 'email') {
  ?>
  <br/><strong><?php echo($invalid_email_error_label); ?></strong>
  <?php } 
  if ($_REQUEST['ERROR'] == 'empty') {
  ?>
  <br/><strong><?php echo($empty_user_details_label); ?></strong>
  <?php
  }
  ?>
  <form name="login" method="post" onsubmit="return validateForm();" action="frames.php">
    <table border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td><div align="right"><?php echo($name_label); ?>:</div></td>
<?php
if ($_SETTINGS['REQUIREGUESTDETAILS'] == true && $_SETTINGS['LOGINDETAILS'] == true) {
?>
        <td style="text-align:left;"><input type="text" name="USER" style="width:250px" value="<?php echo($username); ?>" maxlength="20" onblur="validateField(this, 'UsernameError')" onkeypress="return true; validateField(this, 'UsernameError')"/>
        <img id="UsernameError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"></td>

<?php
} else {
?>
        <td style="text-align:left;"><input type="text" name="USER" style="width:250px;" value="<?php echo($username); ?>" maxlength="20"/></td>
<?php
}
?>
      </tr>
<?php
if ($_SETTINGS['LOGINEMAIL'] == true) {
	if ($_SETTINGS['REQUIREGUESTDETAILS'] == true && $_SETTINGS['LOGINDETAILS'] == true) {
?>
      <tr>
        <td><div align="right"><?php echo($email_label); ?>:</div></td>
        <td style="text-align:left;"><input type="text" name="EMAIL" style="width:250px;" value="<?php echo($email); ?>" onblur="validateField(this, 'EmailError')" onkeypress="return true; validateField(this, 'EmailError')">
        <img id="EmailError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
      </tr>
<?php
/*
      <tr>
        <td><div align="right"><?php echo($telephone_label); ?>:</div></td>
        <td style="text-align:left;"><input type="text" name="TELEPHONE" style="width:250px;" value="<?php echo($telephone); ?>" onblur="validateField(this, 'TelephoneError')" onkeypress="return true; validateField(this, 'TelephoneError')">
        <img id="TelephoneError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
      </tr>
*/
	} else {
?>
      <tr>
        <td><div align="right"><?php echo($email_label); ?>:</div></td>
        <td style="text-align:left;"><input type="text" name="EMAIL" style="width:250px;" value="<?php echo($email); ?>"/>
        <img id="EmailError" style="visibility: hidden" src="images/errorsmall.gif" alt="Invalid Email Address" width="16" height="16"/></td>
      </tr>
<?php
/*
      <tr>
        <td><div align="right"><?php echo($telephone_label); ?>:</div></td>
        <td style="text-align:left;"><input type="text" name="TELEPHONE" style="width:250px;" value="<?php echo($telephone); ?>"/>
        <img id="TelephoneError" style="visibility: hidden" src="images/errorsmall.gif" alt="Invalid Telephone Number" width="16" height="16"/></td>
      </tr>
*/
	}
}

if ($_SETTINGS['DEPARTMENTS'] == true && $_REQUEST['DEPARTMENT'] == '' && $installed == true || $_REQUEST['ERROR'] == 'empty')  { ?>
      <tr>
        <td><div align="right"><?php echo($department_label); ?>:</div></td>
        <td style="text-align:left;"><select name="DEPARTMENT" style="width:250px;" onblur="validateField(this, 'DepartmenteError')" onkeypress="return true; validateField(this, 'DepartmenteError')">
<?php
			if ((float)$_SETTINGS['SERVERVERSION'] >= 3.80) { // iPhone PUSH Supported
		  		$query = "SELECT DISTINCT `department` FROM " . $table_prefix . "users WHERE (`refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) OR `device` <> '') AND `status` = '1' ORDER BY `department`";
		  	} else {
		  		$query = "SELECT DISTINCT `department` FROM " . $table_prefix . "users WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `status` = '1' ORDER BY `department`";
		  	}
			$rows = $SQL->selectall($query);
			
			if (is_array($rows)) {
				$departments = array();
				foreach ($rows as $key => $row) {
					if (is_array($row)) {
						$department = split('[;]',  $row['department']);
						if (is_array($department)) {
							foreach ($department as $key => $depart) {
								$depart = trim($depart);
								if (!in_array($depart, $departments)) {
									$departments[] = $depart;
								}
							}
						}
						else {
							$department = trim($row['department']);
							if (!in_array($department, $departments)) {
								$departments[] = $department;
							}
						}
					}
				}
				
				$total = count($departments);
				if ($total > 1) {
?>
            <option value="">&nbsp;</option>
<?php			
				}
				asort($departments);
				if (is_array($departments)) {
					foreach($departments as $key => $department) {
						if ($total == 1) {
?>
            <option value="<?php echo($department); ?>" selected="selected"><?php echo($department); ?></option>
<?php
						} else {
?>
            <option value="<?php echo($department); ?>"><?php echo($department); ?></option>
<?php
						}
					}
				}
			}
?>
          </select>
          <img id="DepartmentError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
      </tr>
<?php
}
elseif (($_SETTINGS['DEPARTMENTS'] == true) || ($_REQUEST['DEPARTMENT'] != '')) {
?>
      <input name="DEPARTMENT" type="hidden" value="<?php echo($_REQUEST['DEPARTMENT']); ?>"/>
<?php
}
if ($_SETTINGS['LOGINQUESTION'] == true) {
?>
      <tr>
        <td valign="top"><div align="right"><?php echo($question_label); ?>:</div></td>
        <td valign="top" style="text-align:left;"><textarea name="QUESTION" rows="3" style="width:250px; height:80px; font-family:<?php echo($_SETTINGS['CHATFONT']); ?>; font-size:<?php echo($_SETTINGS['CHATFONTSIZE']); ?>;"><?php echo($question); ?></textarea>
        <img id="QuestionError" style="visibility: hidden" src="images/errorsmall.gif" alt="Required" width="16" height="16"/></td>
      </tr>
<?php
}
?>
    </table>
    <br/>
    <input name="COOKIE" type="hidden" value="<?php echo($_REQUEST['COOKIE']); ?>"/>
    <input name="LANGUAGE" type="hidden" value="<?php echo($_REQUEST['LANGUAGE']); ?>"/>
    <input name="Submit" type="submit" id="Submit" value="<?php echo($continue_label); ?>"/>
  </form>
  <div class="small" style="margin-top:40px"><?php echo($stardevelop_copyright_label); ?></div>
</div>
</div>
</body>
</html>
