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
	$installed = include('../include/config.php');
} else {
	$installed = false;
	include('../include/settings.php');
}

header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>stardevelop.com - Live Chat Customer Service Software, Live Help, Customer Support</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<meta http-equiv="P3P" content="CP='ALL DSP COR CUR OUR IND ONL UNI COM NAV'"/>
<script language="JavaScript" type="text/javascript">
<!--

var LiveHelpXMLHTTP;

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

LiveHelpXMLHTTP = checkXMLHTTP();

function getLayer(ID) {

	var obj;
	if (document.getElementById) {
		obj = document.getElementById(ID);
		return obj
	}
	else if (document.layers && document.layers[object] != null) {
		obj = document.layers[ID].document;
		return obj;
	}
	else if (document.all) {
		obj = document.all[ID];
		return obj;
	}
	
	return false;
}

function writeLayer(ID, sText) {

	var oLayer = getLayer(ID);
	if (oLayer != false) {
	
		if (oLayer.innerHTML == null) {
			oLayer.open();
			oLayer.write(sText);
			oLayer.close();
		} else {
			oLayer.innerHTML = sText;
		}
	} else {
		return false;
	}

}

function toggleLayer(ID, visibility) {

	var obj = getLayer(ID);
	if (document.layers && obj != null) {
		if (!visibility) {
			HideDatabaseError(obj);
			obj.visibility = 'hidden';
		} else {
			ShowDatabaseError(obj);
			obj.visibility = 'visible';
		}
	}
	else {
		if (!visibility) {
			HideDatabaseError(obj);
			obj.style.visibility = 'hidden';
		} else {
			ShowDatabaseError(obj);
			obj.style.visibility = 'visible';
		}
	}	
	return false;
}

function HideDatabaseError(obj) {
	dbError = false;
	obj.className = 'HideError';
	
	swapImage('DatabaseErrorImage', '', '../include/Hidden.gif', 1);
	writeLayer('DatabaseErrorTitle', '');
	writeLayer('DatabaseSource', '');
}

function ShowDatabaseError(obj) {
	dbError = true;
	obj.className = 'ShowError';
}

function showError(id) {
	var obj = getLayer(id);
	if (obj != null) {
		obj.style.visibility = 'visible';
		obj.src = '../images/errorsmall.gif';
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

var dbError = false;

function validateDatabase() {
	if (validateField(document.install.DB_HOSTNAME, 'HostnameError') || validateField(document.install.DB_NAME, 'DatabaseError') || validateField(document.install.DB_USERNAME, 'DatabaseUsernameError') || validateField(document.install.DB_PASSWORD, 'DatabasePasswordError')) {
		return false;
	}
	if (LiveHelpXMLHTTP) {
		if (LiveHelpXMLHTTP.readyState != 0) {
			LiveHelpXMLHTTP.abort();
		}
		
		var URL = '/livehelp/install/verify.php?HOSTNAME=' + document.install.DB_HOSTNAME.value + '&USERNAME=' + document.install.DB_USERNAME.value + '&PASSWORD=' + document.install.DB_PASSWORD.value + '&DATABASE=' + document.install.DB_NAME.value;
		LiveHelpXMLHTTP.open('GET', URL, false);
		LiveHelpXMLHTTP.send(null);
		
		if (LiveHelpXMLHTTP.readyState == 4) {
			// Process response as JavaScript
			if (LiveHelpXMLHTTP.status == 200) {
				eval(LiveHelpXMLHTTP.responseText);
			}
		}
		
		if (dbError) {
			return false;
		} else {
			if (validateField(document.install.OFFLINEEMAIL, 'OfflineEmailError') || validateField(document.install.USERNAME, 'UsernameError') || validateField(document.install.PASSWORD, 'PasswordError')) {
				return false;
			}
		}
	}	
}

function findObj(n, d) {
	var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
		if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
		if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function swapImage() {
	var i,j=0,x,a=swapImage.arguments; document.sr=new Array; for(i=0;i<(a.length-2);i+=3)
		if ((x=findObj(a[i]))!=null){document.sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

//-->
</script>
<style type="text/css">
<!--
div, p, td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000000;
}
.heading {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #000000;
}
a.normlink:link, a.normlink:visited, a.normlink:active {
	color: #339;
	text-decoration: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border-bottom-width: 0.05em;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
}
a.normlink:hover {
	color: #339;
	text-decoration: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border-bottom-width: 0.05em;
	border-bottom-style: solid;
	border-bottom-color: #339;
}
a.menulink:link, a.menulink:visited, a.menulink:active {
	color: #000000;
	text-decoration: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}
.ShowError {
	position: relative;
	width: 380px;
	height: 50px;
	background-color: #FFFFCC;
	border-width: 1px;
	border-color: #FFCC33;
	border-style: solid;
	visibility: visible;
	margin-top: 20px;
	margin-bottom: 10px;
}

.HideError {
	visibility: hidden;
	height: 0px;
	margin-bottom: 10px;
}
-->
</style>
<style type="text/css">
<!--
body, p, td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
}

.tablebody {
	background-image:      url(http://www.stardevelop.com/images/bgtable.gif);
	background-position: right top;
	background-repeat: no-repeat;
	background-color: #FFFFFF;
}
.tableheader {
	background-color: #8FCBEF;
	background-attachment: fixed;
}
.menubody {
	background-image:    url(http://www.stardevelop.com/images/bgmenutable.gif);
	background-position: left center;
	background-repeat: no-repeat;
	background-color: #FFFFFF;
}
.menuborder {
	border-top: 1px solid #666666;
	border-right: 0px none;
	border-bottom: 1px solid #666666;
	border-left: 0px none;
}
h1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-style: italic;
}

-->
</style>
<link href="./styles/styles.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/JavaScript">
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
//-->
</script>
</head>
<body bgcolor="#F3F3F3" text="#000000" link="#8FCBEF" vlink="#8FCBEF" alink="#8FCBEF" onload="MM_preloadImages('/livehelp/install/images/StardevelopOrange.gif')">
<div align="center" style="margin-top: 10px;">
  <table width="580" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td width="25">&nbsp;</td>
      <td width="600"><div align="right"><a href="http://www.stardevelop.com" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('stardevelop','','/images/stardevelop_orange.gif',1)"><img src="/livehelp/install/images/StardevelopBlue.gif" alt="stardevelop.com" name="stardevelop" width="120" height="18" border="0" id="stardevelop"/></a></div></td>
      <td width="25">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><div align="right"><img src="./images/BannerInstall.gif" width="641" height="79" border="0" alt="Live Help Messenger" usemap="#Map2"/></div></td>
    </tr>
  </table>
</div>
<table width="650" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <td colspan="2" align="center" valign="middle"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" class="tablebody">
<?php
if (!file_exists('./LICENSE.TXT') || !file_exists('./mysql.schema.txt') || !file_exists('./mysql.data.settings.txt') || !file_exists('./mysql.data.ip2country.sql.gz') || !file_exists('./mysql.data.countries.txt')) {
?>
        <table width="500" border="0" align="center" class="box" style="margin-top: 15px;">
          <tr>
            <td width="32"><img src="images/Error.gif" alt="Installation Error" width="32" height="32"/></td>
            <td><div align="center"><h1>Installation Critical Error</h1><em>The /livehelp/install/ directory is missing critical files.  Please re-upload the /livehelp/install/ directory before proceeding with the installation.</em></div></td>
          </tr>
        </table>
<?php
} else if ($installed == false && DB_HOST != '' && DB_NAME != '' && DB_USER != '' && DB_PASS != '') {
?>
        <table width="500" border="0" align="center" cellpadding="10" class="box" style="margin-top: 15px;">
          <tr>
            <td width="32"><img src="images/Error.gif" alt="Installation Error" width="32" height="32"/></td>
            <td><div align="center"><h1>MySQL Connection Error</h1><em>Please ensure that your MySQL server has connectivity and the /livehelp/include/database.php configuration file contains the correct database details.</em></div></td>
          </tr>
        </table>
<?php
}

if (file_exists('./LICENSE.TXT')) {
	$handle = fopen('./LICENSE.TXT', 'r');
	$licensecontents = fread($handle, filesize ('./LICENSE.TXT'));
	fclose($handle);
}
?>
      <div align="center" style="padding-left:20px; padding-right:20px;">
        <h1 align="left"><strong>Software License Agreement</strong></h1>
        <form name="install" method="post" action="install.php">
          <p>
            <textarea name="textarea" cols="100" rows="17" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;"><?php echo($licensecontents); ?></textarea>
            <br/>
          </p>
          <p><strong>Note:</strong> Before proceeding please read and accept the above software license agreement and software documentation at the&nbsp;<a href="http://livehelp.stardevelop.com/documentation/" class="normlink" target="_blank">Customer Support Center</a></p>
          <p>
            <input type="submit" name="Submit" value="Accept"/>
            &nbsp;
            <input type="button" name="Submit" value="Decline"/>
          </p>
        </form>
      </div>
	  </td>
  </tr>
  <tr>
    <td height="5" colspan="2" align="center" valign="top" bgcolor="#999999"></td>
  </tr>
  <tr>
    <td height="5" colspan="2" align="center" valign="top" bgcolor="#FFFFFF"></td>
  </tr>
</table>
</body>
</html>
