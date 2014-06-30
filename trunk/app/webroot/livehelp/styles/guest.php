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
$database = include('../include/database.php');
if ($database) {
	include('../include/spiders.php');
	include('../include/class.mysql.php');
	include('../include/class.cookie.php');
	$installed = include('../include/config.php');
} else {
	$installed = false;
}

if ($installed == false) {
	header('Location: ./default.php');
}

header('Content-type: text/css');

if (file_exists('../locale/' . LANGUAGE_TYPE . '/guest.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/guest.php');
}
else {
	include('../locale/en/guest.php');
}

if (!isset($_SETTINGS['DIRECTION'])) { $_SETTINGS['DIRECTION'] = 'ltr'; }
?>

div, p, td {
	font-family: <?php echo($_SETTINGS['CHATFONT']); ?>;
	font-size: <?php echo($_SETTINGS['CHATFONTSIZE']); ?>;
	color: <?php echo($_SETTINGS['FONTCOLOR']); ?>;
	direction: <?php echo($_SETTINGS['DIRECTION']); ?>;
}
body {
	background-color: <?php echo($_SETTINGS['BACKGROUNDCOLOR']); ?>;
	color: <?php echo($_SETTINGS['FONTCOLOR']); ?>;
}
a:link, a:visited, a:active {
	color: <?php echo($_SETTINGS['LINKCOLOR']); ?>;
}
a.normlink:link, a.normlink:visited, a.normlink:active {
	color: <?php echo($_SETTINGS['LINKCOLOR']); ?>;
	text-decoration: none;
	font-family: <?php echo($_SETTINGS['FONT']); ?>;
	border-bottom-width: 0.05em;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
}
a.normlink:hover {
	color: <?php echo($_SETTINGS['LINKCOLOR']); ?>;
	text-decoration: none;
	font-family: <?php echo($_SETTINGS['FONT']); ?>;
	border-bottom-width: 0.05em;
	border-bottom-style: solid;
	border-bottom-color: <?php echo($_SETTINGS['LINKCOLOR']); ?>;
}
.message {
	font-family: <?php echo($_SETTINGS['CHATFONT']); ?>;
	font-size: <?php echo($_SETTINGS['CHATFONTSIZE']); ?>;
	margin: 0px;
	margin-bottom: 5px;
}
a.message:link, a.message:visited, a.message:active {
	color: <?php echo($_SETTINGS['LINKCOLOR']); ?>;
	text-decoration: none;
	font-family: <?php echo($_SETTINGS['CHATFONT']); ?>;
	font-size: <?php echo($_SETTINGS['CHATFONTSIZE']); ?>;
	border-bottom-width: 0.05em;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
}
a.message:hover {
	color: <?php echo($_SETTINGS['LINKCOLOR']); ?>;
	text-decoration: none;
	font-family: <?php echo($_SETTINGS['CHATFONT']); ?>;
	font-size: <?php echo($_SETTINGS['CHATFONTSIZE']); ?>;
	border-bottom-width: 0.05em;
	border-bottom-style: solid;
	border-bottom-color: <?php echo($_SETTINGS['LINKCOLOR']); ?>;
}

.box {
	background: #FAF6F7;
	border: 1px solid #ddd;
	padding: 5px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-align: justify;
	width: 95%;
	margin: 5px;
}

div.bubble {
	font-size:0.75em;
	margin-left:2px;
	margin-bottom:10px;
	margin-right:3px;
	width:auto;
}

div.bubble blockquote {
	background-color:#FFFFFF;
	border:1px solid #C9C2C1;
	margin:0;
	padding:0;
}

div.bubble blockquote p {
	margin:7px;
	padding:0;
}

div.bubble cite {
	background:transparent url(tip.gif) no-repeat scroll 20px 0;
	font-style:normal;
	margin:0;
	padding:7px 0 0 15px;
	position:relative;
	top:6px;
}

/* Smilies Bubble pop-up */

* {
	margin: 0;
	padding: 0;
}

<?php if ($_SETTINGS['LOGO'] != '') { $margin = 16; } else { $margin = 0; } ?>

.bubbleInfo {
	position: relative;
	top: <?php echo($margin); ?>px;
	left: <?php echo($_SETTINGS['CHATWINDOWWIDTH'] - 125); ?>px;
	width: 500px;
	z-index: 1;
}

.trigger {
	position: absolute;
	left: 60px;
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
 }