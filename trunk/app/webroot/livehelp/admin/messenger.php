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
include('../include/version.php');
include('../include/auth.php');

ignore_user_abort(true);

if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
if (!isset($_REQUEST['USER'])){ $_REQUEST['USER'] = ''; }
if (!isset($_REQUEST['STAFF'])){ $_REQUEST['STAFF'] = 0; }

$guest_login_id = $_REQUEST['ID'];
$guest_username = stripslashes($_REQUEST['USER']);
$staff = $_REQUEST['STAFF'];

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/JavaScript">
<!--

function toggle(object) {
  if (document.getElementById) {
    if (document.getElementById(object).style.visibility == 'visible')
      document.getElementById(object).style.visibility = 'hidden';
    else
      document.getElementById(object).style.visibility = 'visible';
  }

  else if (document.layers && document.layers[object] != null) {
    if (document.layers[object].visibility == 'visible' ||
        document.layers[object].visibility == 'show' )
      document.layers[object].visibility = 'hidden';
    else
      document.layers[object].visibility = 'visible';
  }

  else if (document.all) {
    if (document.all[object].style.visibility == 'visible')
      document.all[object].style.visibility = 'hidden';
    else
      document.all[object].style.visibility = 'visible';
  }

  return false;
}

function currentTime() {
	var date = new Date();
	return date.getTime();
}

function isTyping() {
	var updateIsTypingStatus = new Image;
	var time = currentTime();
	
	var message = document.MessageForm.MESSAGE.value;
	var intLength = message.length;
	if (intLength == 0) {
		notTyping();
	}
	else {	
		updateIsTypingStatus.src = '/livehelp/typing.php?ID=<?php echo($guest_login_id); ?>&STATUS=1&TIME=' + time;
	}
}

function notTyping() {
	var updateNotTypingStatus = new Image;
	var time = currentTime();
	
	updateNotTypingStatus.src = '/livehelp/typing.php?ID=<?php echo($guest_login_id); ?>&STATUS=0&TIME=' + time;
}

function limitInput(field, limit) {
	if (field.value.length > limit) {
		field.value = field.value.substring(0, limit);
	}
}

function swapImgRestore() { //v3.0
  var i,x,a=document.sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.p) d.p=new Array();
    var i,j=d.p.length,a=preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.p[j]=new Image; d.p[j++].src=a[i];}}
}

function findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function swapImage() { //v3.0
  var i,j=0,x,a=swapImage.arguments; document.sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=findObj(a[i]))!=null){document.sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript" src="../scripts/jquery-1.3.2.js"></script>
<script language="JavaScript" type="text/JavaScript" src="../scripts/admin.js.php"></script>
<style type="text/css">
<!--

/* Smilies Bubble pop-up */

* {
	margin: 0;
	padding: 0;
}
        
.bubbleInfo {
	position: relative;
	top: 30px;
	left: 360px;
	width: 500px;
	z-index: 1;
}

.trigger {
	position: absolute;
	left: 70px;
	top: 0px;
}
 

.popup {
	position: absolute;
	display: none;
	z-index: 50;
	border-collapse: collapse;
}

.popup td.corner {
	height: 15px;
	width: 19px;
}

.popup td#topleft { background-image: url(../images/bubble-1.png); }
.popup td.top { background-image: url(../images/bubble-2.png); }
.popup td#topright { background-image: url(../images/bubble-3.png); }
.popup td.left { background-image: url(../images/bubble-4.png); }
.popup td.right { background-image: url(../images/bubble-5.png); }
.popup td#bottomleft { background-image: url(../images/bubble-6.png); }
.popup td.bottom { background-image: url(../images/bubble-7.png); text-align: center;}
.popup td.bottom img { display: block; margin: 0 auto; }
.popup td#bottomright { background-image: url(../images/bubble-8.png); }

.popup-contents {
	text-align: center;
	background-color: #FFFFFF;
 }

-->
</style>
</head>
<body onFocus="parent.document.title = 'Admin <?php echo($_SETTINGS['NAME']); ?>'"; onLoad="preloadImages('../locale/<?php echo(LANGUAGE_TYPE); ?>/images/send_hover.gif')">
<div id="Layer1" style="position:absolute; left:310px; top:8px; width:196px; height:60px; z-index:1; visibility: hidden;"><img src="../images/smilies_background.gif" alt="Emoticons (Smilies)"></div>
<div id="Layer2" style="position:absolute; left:320px; top:17px; width:146px; height:49px; z-index:2; visibility: hidden;">
  <div align="center"> <a href="#" onClick="appendText(':-)'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie1.gif" name="22" width="20" height="20" border="0" alt="Smile :-)"></a><a href="#" onClick="appendText(';-P'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie4.gif" width="21" height="20" border="0" alt="Smile with tongue out ;-P"></a><a href="#" onClick="appendText(':)'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie8.gif" width="20" height="20" border="0" alt="Smile :)"></a><a href="#" onClick="appendText('$-D'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie3.gif" width="20" height="21" border="0" alt="Smile with money eyes $-D"></a><a href="#" onClick="appendText('8-)'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie7.gif" width="21" height="20" border="0" alt="Hot Smile 8-)"></a><a href="#" onClick="appendText(':-/');toggle('Layer1');toggle('Layer2');return false;"><img src="../images/smilie5.gif" width="20" height="20" border="0" alt="Confused Smile :-/"></a><a href="#" onClick="appendText(':-O'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie12.gif" width="20" height="20" border="0" alt="Suprised smile :-O"></a><a href="#" onClick="appendText(':('); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie6.gif" width="20" height="21" border="0" alt="Sad smile :("></a><a href="#" onClick="appendText(':-('); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie2.gif" width="20" height="20" border="0" alt="Sad Smile :-("></a><a href="#" onClick="appendText(':-|'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie9.gif" width="20" height="20" border="0" alt="Disappointed Smile :-|"></a><a href="#" onClick="appendText(':--'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie10.gif" width="20" height="20" border="0" alt="Thinking Smile :--"></a><a href="#" onClick="appendText('/-|'); toggle('Layer1'); toggle('Layer2'); return false;"><img src="../images/smilie11.gif" width="21" height="20" border="0" alt="Angry /-|"></a></div>
</div>
<div align="center">
  <form action="../send.php" method="POST" name="MessageForm" target="sendMessageFrame">
    <table width="470" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td colspan="2"><span class="small"><?php echo($chatting_with_label); ?>&nbsp;
          <?php
		  if ($guest_login_id == '') {
		  	echo($click_chat_user_label);
		  }
		  else {
		  	$query = "SELECT `server` FROM " . $table_prefix . "sessions WHERE `id` = '$guest_login_id'";
		  	$row = $SQL->selectquery($query);
		  	if (is_array($row)) {
		  	  $server = $row['server'];
			  if ($server != '') {
			  	if (substr($server, 0, 7) == 'http://') {
			  		$server = substr($server, 7);
			  	}
			  	elseif (substr($server, 0, 8) == 'https://') {
			  		$server = substr($server, 8);
			  	}
				echo(' ' . $guest_username . '@' . $server);
			  }
			  else {
			    echo(' ' . $guest_username);
			  }
		  	}
		  }
		  
		  if ($staff == '') {
		  ?>
          </span> <img src="../locale/<?php echo(LANGUAGE_TYPE); ?>/images/waiting.gif" alt="Typing Status" name="messengerStatus" width="125" height="20" id="messengerStatus"><?php } ?> </td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="20" height="20">&nbsp;</td>
              <td rowspan="3">
				<div align="center">
                  <textarea name="MESSAGE" cols="38" rows="3" onKeyDown="return checkEnter(event); limitInput(this, '255')" onKeyUp="limitInput(this, '255')" onBlur="notTyping()" style="width: 380px"></textarea>
                  <a href="#" onMouseOut="swapImgRestore()" onMouseOver="swapImage('Send','','../locale/<?php echo(LANGUAGE_TYPE); ?>/images/send_hover.gif',1)" onClick="processForm();"><img src="../locale/<?php echo(LANGUAGE_TYPE); ?>/images/send.gif" alt="<?php echo($send_msg_label); ?>" name="Send" width="58" height="50" border="0"></a>&nbsp;
<?php
if ($_SETTINGS['SMILIES'] == true) {
?>
					<div class="bubbleInfo">
						<div>
							<img class="trigger" src="../images/Smile.png" id="download"/>
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
								<div class="popup-contents"><img src="../images/Laugh.png" title="Laugh" onclick="appendText(':D'); return false;"/>&nbsp;<img src="../images/Smile.png" title="Smile" onclick="appendText(':)'); return false;"/>&nbsp;<img src="../images/Sad.png" title="Sad" onclick="appendText(':('); return false;"/>&nbsp;
								<img src="../images/Money.png" title="Money" onclick="appendText('$)'); return false;"/>&nbsp;<img src="../images/Impish.png" title="Impish" onclick="appendText(':P'); return false;"/>&nbsp;<img src="../images/Sweat.png" title="Sweat" onclick="appendText(':\\'); return false;"/>&nbsp;
								<img src="../images/Cool.png" title="Cool" onclick="appendText('8)'); return false;"/>&nbsp;<img src="../images/Frown.png" title="Frown" onclick="appendText('>:L'); return false;"/>&nbsp;<img src="../images/Wink.png" title="Wink" onclick="appendText(';)'); return false;"/>&nbsp;<img src="../images/Surprise.png" title="Suprise" onclick="appendText(':O'); return false;"/><br/>
								<img src="../images/Woo.png" title="Woo" onclick="appendText('8-)'); return false;"/>&nbsp;<img src="../images/Worn-out.png" title="Tired" onclick="appendText('X-('); return false;"/>&nbsp;<img src="../images/Shock.png" title="Shock" onclick="appendText('8-O'); return false;"/>&nbsp;
								<img src="../images/Hysterical.png" title="Hysterical" onclick="appendText('xD'); return false;"/>&nbsp;<img src="../images/Kissed.png" title="Kissed" onclick="appendText(':-*'); return false;"/>&nbsp;<img src="../images/Dizzy.png" title="Dizzy" onclick="appendText(':S'); return false;"/>&nbsp;<img src="../images/Celebrate.png" title="Celebrate" onclick="appendText('+O)'); return false;"/>&nbsp;
								<img src="../images/Angry.png" title="Angry" onclick="appendText('>:O'); return false;"/>&nbsp;<img src="../images/Adore.png" title="Adore" onclick="appendText('<3'); return false;"/>&nbsp;<img src="../images/Sleep.png" title="Sleep" onclick="appendText('zzZ'); return false;"/>&nbsp;<img src="../images/Stop.png" title="Quite" onclick="appendText(':X'); return false;"/>&nbsp;
								</div>
								</td>
								<td class="right">    
							</tr>

							<tr>
								<td class="corner" id="bottomleft"/>
								<td class="bottom"><img width="30" height="29" alt="Smilies" src="../images/bubble-tail2.png" style="position:relative; left:140px"></td>
								<td id="bottomright" class="corner"/>
							</tr>
						</tbody></table>
					</div>
<?php
}
?>
				 </div></td>
                  <input name="ID" type="hidden" id="ID" value="<?php echo($guest_login_id); ?>"><?php
				  if ($staff != '') {
?>
				  <input name="STAFF" type="hidden" id="STAFF" value="<?php echo($staff); ?>"><?php
				  }
?>
              <td width="20" height="20">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="20" height="20">&nbsp;</td>
              <td width="20" height="20">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><div align="right"><?php echo($responses_label); ?>:</div></td>
        <td><select name="RESPONSE" id="RESPONSE" width="300" style="width:300px;"<?php if ($staff != '') { echo(' disabled="true"'); } ?>>
            <?php
		$query = "SELECT `id`, `content` FROM " . $table_prefix . "responses WHERE `type` = 1";
		$rows = $SQL->selectall($query);
		if (is_array($rows)) {
		?>
            <option value=''><?php echo($select_response_label); ?></option>
            <?php
			foreach ($rows as $key => $row) {
				if (is_array($row)) {
					$id = $row['id'];
					$content = $row['content'];
		?>
            <option value="<?php echo($content); ?>"><?php echo($content); ?></option>
            <?php
				}
			}
		?>
          </select>
          <a href="#" onClick="appendResponse()"><img src="../images/mail_send.gif" alt="<?php echo($append_response_label); ?>" width="22" height="22" border="0"></a>&nbsp;<a href="responses.php" target="displayFrame"><img src="../images/mail_edit.gif" alt="<?php echo($edit_responses_label); ?>" width="22" height="22" border="0"></a>
          <?php
		}
		else {
		?>
          <option value=''><?php echo($click_add_response_label); ?></option>
          </select>
          <a href="responses.php" target="displayFrame"><img src="../images/mail_edit.gif" alt="<?php echo($edit_responses_label); ?>" width="22" height="22" border="0"></a>
          <?php
		}
		?>
        </td>
      </tr>
      <tr>
        <td><div align="right"><?php echo($commands_label); ?>:</div></td>
        <td><select name="COMMAND" id="COMMAND" width="300" style="width:300px;"<?php if ($staff != '') { echo(' disabled="true"'); } ?>>
            <?php
		$query = "SELECT `id`, `name`, `type`, `content` FROM " . $table_prefix . "responses WHERE `type` > 1";
		$rows = $SQL->selectall($query);
		if (is_array($rows)) {
		?>
            <option value=''><?php echo($select_command_label); ?></option>
            <?php
			foreach ($rows as $key => $row) {
				if (is_array($row)) {
					$id = $row['id'];
					$name = $row['name'];
					$type = $row['type'];
					$content = $row['content'];
				
					switch ($type) {
						case 2:
							$type = 'Hyperlink';
							break;
						case 3:
							$type = 'Image';
							break;
						case 4:
							$type = 'PUSH';
							break;
						case 5;
							$type = 'JavaScript';
							break;
					}
					?>
            <option value="<?php echo($id); ?>"><?php echo($type . ' - ' . $name); ?></option>
            <?php
				}
			}
		?>
          </select>
          <a href="commands.php" target="displayFrame"><img src="../images/mail_edit.gif" alt="<?php echo($edit_commands_label); ?>" width="22" height="22" border="0"></a>
          <?php
		}
		else {
		?>
          <option value=''><?php echo($click_add_command_label); ?></option>
          </select>
          <a href="commands.php" target="displayFrame"><img src="../images/mail_edit.gif" alt="<?php echo($edit_commands_label); ?>" width="22" height="22" border="0"></a>
          <?php
		}
		?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
        <?php
			if ($guest_login_id != '') {
		?>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="30"><div align="center"><a href="transfer_user.php?LOGIN_ID=<?php echo($guest_login_id); ?>&USER=<?php echo($guest_username); ?>" target="displayFrame"><img src="../images/reload.gif" alt="<?php echo($transfer_user_label); ?>" width="22" height="22" border="0"></a></div></td>
                <td class="small"><a href="transfer_user.php?LOGIN_ID=<?php echo($guest_login_id); ?>&USER=<?php echo($guest_username); ?>" target="displayFrame" class="normlink"><?php echo($transfer_user_label); ?></a></td>
                <td width="20"><div align="center" class="small">-</div></td>
                <td width="30"><div align="center"><a href="print.php?LOGIN_ID=<?php echo($guest_login_id); ?>&USER=<?php echo($guest_username); ?>" target="displayFrame"><img src="../images/fileprint.gif" alt="<?php echo($print_chat_label); ?>" width="22" height="22" border="0"></a></div></td>
                <td class="small"><a href="print.php?LOGIN_ID=<?php echo($guest_login_id); ?>&USER=<?php echo($guest_username); ?>" target="displayFrame" class="normlink"><?php echo($print_chat_label); ?></a></td>
                <td width="20"><div align="center" class="small">-</div></td>
                <td width="30"><div align="center"><a href="displayer_frame.php?ID=<?php echo($guest_login_id); ?>&USER=<?php echo($guest_username); ?>" target="displayFrame"><img src="../images/chat.gif" alt="<?php echo($display_chat_label); ?>" width="22" height="22" border="0"></a></div></td>
                <td class="small"><a href="displayer.php?ID=<?php echo($guest_login_id); ?>&USER=<?php echo($guest_username); ?>" target="displayFrame" class="normlink"><?php echo($display_chat_label); ?></a></td>
              </tr>
            </table>
        <?php
			}
		?>
          </div></td>
      </tr>
    </table>
    <span class="small"><?php echo($stardevelop_copyright_label); ?><br>
    <?php echo($stardevelop_livehelp_version_label); ?></span>
  </form>
  <script language="JavaScript">
<!--
document.MessageForm.MESSAGE.focus();

function processForm() {
  notTyping();
  void(document.MessageForm.submit());
  document.MessageForm.MESSAGE.value='';
  document.MessageForm.RESPONSE.value = '';
  document.MessageForm.COMMAND.value = '';
  document.MessageForm.MESSAGE.focus();
}

function appendResponse() {
  var current = document.MessageForm.MESSAGE.value;
  var text = document.MessageForm.RESPONSE.value;
  document.MessageForm.RESPONSE.value = '';
  document.MessageForm.MESSAGE.value = current + text;
  document.MessageForm.MESSAGE.focus();
}

function appendText(text) {
  var current = document.MessageForm.MESSAGE.value;
  document.MessageForm.MESSAGE.value = current + text;
  document.MessageForm.MESSAGE.focus();
}

function checkEnter(e) {
  isTyping();
  var characterCode

  if(e && e.which){
    e = e
	characterCode = e.which
  }
  else{							
    e = event						
	characterCode = e.keyCode
  } 
  
  if(characterCode == 13){ 
    processForm()
    return false 
  }
  else{
    return true 
  }
}
//-->
</script>
</div>
</body>
</html>
