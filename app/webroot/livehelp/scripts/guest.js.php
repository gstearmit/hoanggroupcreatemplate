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
include('../include/spiders.php');
include('../include/database.php');
include('../include/class.mysql.php');
include('../include/class.cookie.php');
include('../include/config.php');

$login_id = $_REQUEST['ID'];
$username = $_REQUEST['USER'];

header('Content-type: text/html; charset=utf-8');

if (file_exists('../locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/guest.php');
}
else {
	include('../locale/en/guest.php');
}

?>
<!--
// stardevelop.com Live Help International Copyright 2003
// JavaScript Check Status Functions

var loggingOut = false; var chatEnded = false; var currentlyTyping = false; var initalisedChat = 0; var bubble = 0;
var MessageTimer;

function currentTime() {
	var date = new Date();
	return date.getTime();
}

function windowLogout() {
	if (loggingOut == false && chatEnded == false) {
		var time = currentTime();
		sendMessageFrame.location.href = './logout.php?time=' + time;
		display('', '', '<?php echo(addslashes($ended_chat_label)); ?><br/><input type="button" style="width:95px; height:25px; margin-top:5px;" value="<?php echo(addslashes($restart_chat_label)); ?>" onclick="location = \'/livehelp/frames.php\'"/>', 2, 1);
		loggingOut = true; chatEnded = true;
		return '';
	}
}

function setBeforeUnload(){
    window.onbeforeunload = windowLogout;
}

setBeforeUnload(true);

<?php
if ($_SETTINGS['OFFLINEEMAIL'] == true) {
?>
var continueTimer = setTimeout('windowOffline()', <?php echo($guest_timeout * 1000); ?>);

function windowOffline() {
	if ($("#ContinueLayer")) { $("#ContinueLayer").fadeIn("normal"); }
}
<?php
}
?>

jQuery.preloadImages = function() {
	for(var i = 0; i<arguments.length; i++) {
		jQuery("<img>").attr("src", arguments[i]);
	}
}

var ReceivedMessage = -4; var SentMessage = 0; var LastGuestMessage = 0;

function display(id, username, message, align, status) {
	if ($("#Messages")) {
		var output;
		var alignment;
		
		if (align == '1') { alignment = 'left'; } else if (align == '2') { alignment = 'center'; } else if (align == '3') { alignment = 'right'; }
		if (status == '0') { color = '<?php echo($_SETTINGS['SENTFONTCOLOR']); ?>'; border = '#C9C2C1'; fill = '#FFFFFF' } else { color = '<?php echo($_SETTINGS['RECEIVEDFONTCOLOR']); ?>'; border = '#A9A9A9'; fill = '#F5F5F5'; window.focus(); focusChat(); }

		if (bubble == 1) {
			if (username != '') { output = '<div id="msg' + id + '" align="' + alignment + '" class="bubble" style="color: '+ color + '; border-color:' + border + '">'; } else {
				output = '<div id="msg' + id + '" align="' + alignment + '" style="color: '+ color + '; border-color:' + border + '">';
			}
		} else { output = '<div id="msg' + id + '" align="' + alignment + '" style="color:'+ color + '; margin:4px">'; }
		if (status == '0' || status == '1' || status == '2' || status == '7') { // General, Operator, Link, Mobile Device Messages
			if (username != '' && bubble != 1) { output += username + ' <?php echo($says_label); ?>:<br/>'; }
			message = message.replace(/([a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4})/g, '<a href="mailto:$1" class="message">$1</a>');
			message = message.replace(/((?:(?:http(?:s?))|(?:ftp)):\/\/[^\s|<|>|'|\"]*)/g, '<a href="$1" target="_blank" class="message">$1</a>');
			if (status != '0') { error = false; }
<?php
if ($_SETTINGS['SMILIES'] == true) {
?>
			message = htmlSmilies(message);
<?php
}
?>
			if (bubble == 1) {
				if (username != '') {
					output += '<blockquote style="border-color:' + border + '; background-color: ' + fill + '"><p style="color:' + color + '">' + message + '</p></blockquote>';
				} else {
					output += '<div style="margin: 0; color:' + color + '; font-size:11px">' + message + '</div>';
				}
				if (username != '') { output += '<cite><strong>' + username + '</strong></cite>'; }
			} else { output += '<div style="margin:0 0 0 15px; color: ' + color + '">' + message + '</div>'; }
		} else if (status == '3') { // Image
			message = message.replace(/((?:(?:http(?:s?))):\/\/[^\s|<|>|'|\"]*)/g, '<img src="$1" alt="Received Image">');
			result = message.match(/((?:(?:http(?:s?))):\/\/[^\s|<|>|'|"]*)/g);
			if (result != null) {
				output = '<div id="msg' + id + '"></div>';
				$("#Messages").append(output);
				$('<img />').attr('src', result).load(function(){
							var output = '';
							var width = $('#displayFrame').css('width');
							var displayWidth = parseInt(width) - 50;
							var unitMeasurement = width.slice(-2);
							if (this.width > displayWidth) {
								output = '<img src="' + this.src + '" alt="Received Image" style="width:' + displayWidth + unitMeasurement + '; max-width:' + this.width + 'px">';
							} else {
								output = '<img src="' + this.src + '" alt="Received Image" style="max-width:' + this.width + 'px">'
							}
							$("#msg" + id).append(output); alert(); 
							soundManager.play('MessageAlert');
							window.focus();
					});
				output = '';
				
			} else {
				output += message;
			}
		} else if (status == '4') { // PUSH
			eval('if (window.opener) { window.opener.location.href = "' + message + '"; window.opener.focus(); }');
			output += '<?php echo(addslashes($pushed_url_label)); ?> <a href="#" onclick="window.opener.focus(); return false;" class="message"><?php echo(addslashes($click_here_label)); ?></a> <?php echo(addslashes($or_label)); ?> <a href="' + message + '" target="_blank" class="message">' + message + '</a> <?php echo(addslashes($open_new_window_label)); ?>';
		} else if (status == '5') { // JavaScript
			eval(message);
		} else if (status == '6') { // File Transfer
			output += '<?php echo(addslashes($sent_file_label)); ?> <a href="' + message + '" target="FileDownload"><?php echo(addslashes($start_downloading_label)); ?></a> <?php echo(addslashes($right_click_save_label)); ?>';
		} output += '</div>';
		
		$("#WaitingLayer").fadeOut("normal");
<?php
if ($_SETTINGS['OFFLINEEMAIL'] == true) {
?>
		$("#ContinueLayer").fadeOut("normal");
		clearTimeout(continueTimer);
<?php
}
?>
		if (id != '') {
			if (status == 0) { // Visitor
				if (id > SentMessage) {
					//if (bubble == 1) {
						if (LastGuestMessage > 0) {
							$("#msg" + LastGuestMessage + " div").append('<br/>' + message);
						} else {
							$("#Messages").append(output);
							LastGuestMessage = id;
						}
					//} else { $("#Messages").append(output); }
					alert(); SentMessage = id;
				}
			} else { // Operator
				if (id > ReceivedMessage && output != '') {
					$("#Messages").append(output); alert(); 
					soundManager.play('MessageAlert');
					window.focus();
					ReceivedMessage = id; LastGuestMessage = 0;
				}
			}
		} else {
			$("#Messages").append(output);
		}
	}
}

var error = false;
function connectionError() {
	if (error == false && chatEnded == false) {
		output = '<div style="margin:0 0 0 15px; text-align: center; color: <?php echo($_SETTINGS['RECEIVEDFONTCOLOR']); ?>"><?php echo(addslashes($connection_error_label)); ?></div>';
		$("#Messages").append(output);
		error = true;
	}
}

var focussed = false;
function focusChat() {
	if ($('#Message')) {
		if ($('#Message').attr('disabled') == false && focussed == false) {
			$('#Message').focus();
			var prevText = $('#Message').val();
			$('#Message').val(prevText);
		}
	}
}

function setTyping() {
	if ($('#messengerStatus')) { $('#messengerStatus').attr('src', '/livehelp/locale/<?php echo(LANGUAGE_TYPE); ?>/images/user_typing.gif'); }
}

function setWaiting() {
	if ($('#messengerStatus')) { $('#messengerStatus').attr('src', '/livehelp/locale/<?php echo(LANGUAGE_TYPE); ?>/images/waiting.gif'); }
}

function alert() {
	if ($('#displayFrame')) { $('#displayFrame').scrollTo($("#scrollPlaceholder")); }
}

function LoadMessages() {
	var time = currentTime();
	var URL = '/livehelp/refresher.php?JS=1&TYPING=' + currentlyTyping + '&INIT=' + initalisedChat + '&COOKIE=<?php echo($cookie_domain); ?>&TIME=' + time + '&LANGUAGE=<?php echo(LANGUAGE_TYPE); ?>';
	$.getScript(URL);

	MessageTimer = window.setTimeout('LoadMessages();', 1500);
}

function typing(status) {
	if (status == true) { status = 1; } else { status = 0; } currentlyTyping = status;
}

function htmlSmilies(msg) {
	var style = 'style="max-width:16px" class="noresize"';
	msg = msg.replace(/:D/g, '<image src="./images/16px/Laugh.png" alt="Laugh" title="Laugh" ' + style + '>');
	msg = msg.replace(/:\)/g, '<image src="./images/16px/Smile.png" alt="Smile" title="Smile" ' + style + '>');
	msg = msg.replace(/:\(/g, '<image src="./images/16px/Sad.png" alt="Sad" title="Sad" ' + style + '>');
	msg = msg.replace(/\$\)/g, '<image src="./images/16px/Money.png" alt="Money" title="Money" ' + style + '>');
	msg = msg.replace(/&gt;:O/g, '<image src="./images/16px/Angry.png" alt="Angry" title="Angry" ' + style + '>');
	msg = msg.replace(/:P/g, '<image src="./images/16px/Impish.png" alt="Impish" title="Impish" ' + style + '>');
	msg = msg.replace(/:\\/g, '<image src="./images/16px/Sweat.png" alt="Sweat" title="Sweat" ' + style + '>');
	msg = msg.replace(/8\)/g, '<image src="./images/16px/Cool.png" alt="Cool" title="Cool" ' + style + '>');
	msg = msg.replace(/&gt;:L/g, '<image src="./images/16px/Frown.png" alt="Frown" title="Frown" ' + style + '>');
	msg = msg.replace(/;\)/g, '<image src="./images/16px/Wink.png" alt="Wink" title="Wink" ' + style + '>');
	msg = msg.replace(/:O/g, '<image src="./images/16px/Surprise.png" alt="Surprise" title="Surprise" ' + style + '>');
	msg = msg.replace(/8-\)/g, '<image src="./images/16px/Woo.png" alt="Woo" title="Woo" ' + style + '>');
	msg = msg.replace(/8-O/g, '<image src="./images/16px/Shock.png" alt="Shock" title="Shock" ' + style + '>');
	msg = msg.replace(/xD/g, '<image src="./images/16px/Hysterical.png" alt="Hysterical" title="Hysterical" ' + style + '>');
	msg = msg.replace(/:-\*/g, '<image src="./images/16px/Kissed.png" alt="Kissed" title="Kissed" ' + style + '>');
	msg = msg.replace(/:S/g, '<image src="./images/16px/Dizzy.png" alt="Dizzy" title="Dizzy" ' + style + '>');
	msg = msg.replace(/\+O\)/g, '<image src="./images/16px/Celebrate.png" alt="Celebrate" title="Celebrate" ' + style + '>');
	msg = msg.replace(/&lt;3/g, '<image src="./images/16px/Adore.png" alt="Adore" title="Adore" ' + style + '>');
	msg = msg.replace(/zzZ/g, '<image src="./images/16px/Sleep.png" alt="Sleep" title="Sleep" ' + style + '>');
	msg = msg.replace(/:X/g, '<image src="./images/16px/Stop.png" alt="Quiet" title="Quiet" ' + style + '>');
	msg = msg.replace(/X-\(/g, '<image src="./images/16px/Worn-out.png" alt="Tired" title="Tired" ' + style + '>');
	return msg;
}

function removeHTML(msg) {
	msg = msg.replace(/</g, '&lt;'); msg = msg.replace(/>/g, '&gt;'); msg = msg.replace(/\r\n|\r|\n/g, '<br />');
	return msg;
}

function processForm() {
	if ($('#Message').val() != '') {
		if (initalisedChat == 0) {
			$.post("send.php", { MESSAGE: $('#Message').val()} );
			$('#Message').val('');
		}
		else {
			self.display(self.SentMessage + 1, '<?php if ($_SETTINGS['CHATUSERNAME'] == true) { echo($username); } ?>', removeHTML($('#Message').val()), '1', '0');
			self.alert();
			$.post("send.php", { MESSAGE: $('#Message').val()} );
			$('#Message').val('');
			typing(false);
		}
	}
  	return false;
}

function appendText(text) {
	if (!$('#Message').attr('disabled')) {
		var current = $('#Message').val();
		$('#Message').val(current + text);
	}
}

function checkEnter(e) {
	var characterCode; typing(true);
	if (e.keyCode == 13 || e.charCode == 13) { processForm(); return false; } else { return true; }
}

// Setup Sounds
soundManager.url = '/livehelp/sounds/';
soundManager.debugMode = false;
soundManager.onload = function() {
	soundManager.createSound('MessageAlert','/livehelp/sounds/alert.mp3');
}

$(function(){

	LoadMessages();

	$.preloadImages('./locale/<?php echo(LANGUAGE_TYPE); ?>/images/send_hover.gif');

	$('input[@type=radio].star').rating({ callback: function(value, link){ $.post("logout.php", { RATING: value} ); } });
	
	// Emoticons Fade and Hover Events
	$(".popup-contents img").fadeTo("fast", 0.6);
	$(".popup-contents img").hover(
      function () {
        $(this).fadeTo("fast", 1);
      }, 
      function () {
        $(this).fadeTo("fast", 0.6);
      }
    );
	
	$(window).resize(function() {
		$('#displayFrame').css('height', 'auto');
		$('#displayFrame').css('width', 'auto');
		
		var height = $(window).height();
		var width = $(window).width();
		if (height > 435) { $('#displayFrame').css('height', height - 170 + 'px'); } else { $('#displayFrame').css('height', '265px'); }
		if (width > 625) { $('#displayFrame').css('width', width - 150 + 'px'); } else { $('#displayFrame').css('width', '475px'); }
		
		$('.body').css('width', width + 'px');
		$('.body').css('min-width', '625px');
		
		$('#Message').css('width', width - 160 + 'px');
		if (width - 277 > 348) { $('#BannerCenter').css('width', width - 277 + 'px'); } else { $('#BannerCenter').css('width', '348px'); }
		$('.bubbleInfo').css('left', width - 125 + 'px');
		
		width = $('#displayFrame').css('width');
		var displayWidth = parseInt(width);
		var unitMeasurement = width.slice(-2);
		$('#Messages img').not('.noresize').each(function () {
			var maxWidth = parseInt($(this).css('max-width'));
			var newWidth = displayWidth - 50;
			if (newWidth <= maxWidth) {
				$(this).css('width', newWidth + unitMeasurement);
			}
		});
		alert();
	});
	
	// Smilies
	$('.bubbleInfo').each(function () {
		var distance = 10;
		var time = 250;
		var hideDelay = 500;
		var hideDelayTimer = null;
		var beingShown = false;
		var shown = false;
		var trigger = $('.trigger', this);
		var info = $('.popup', this).css('opacity', 0);

	$([trigger.get(0), info.get(0)]).mouseover(function () {
		if (hideDelayTimer) clearTimeout(hideDelayTimer);
			if (beingShown || shown) {
				// don't trigger the animation again
				return;
			} else {
				// reset position of info box
				beingShown = true;

				info.css({
					top: -85,
					left: -240,
					display: 'block'
				}).animate({
					top: '-=' + distance + 'px',
					opacity: 1
				}, time, 'swing', function() {
					beingShown = false;
					shown = true;
				});
			}

			return false;
		}).mouseout(function () {
			if (hideDelayTimer) clearTimeout(hideDelayTimer);
			hideDelayTimer = setTimeout(function () {
				hideDelayTimer = null;
				info.animate({
					top: '-=' + distance + 'px',
					opacity: 0
				}, time, 'swing', function () {
					shown = false;
					info.css('display', 'none');
				});

			}, hideDelay);

			return false;
		});
	});


if (jQuery.browser.msie) {  
	// Fix CSS background PNG images in all IE versions
	$(".popup td").each(function(){
		var bgIMG = jQuery(this).css('background-image');
		if(bgIMG.indexOf(".png") != -1){
			var iebg = bgIMG.split('url("')[1].split('")')[0];
			jQuery(this).css('background-image', 'none');
			jQuery(this).get(0).runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + iebg + "', sizingMethod='scale')";
		}
	});
}

});

//-->