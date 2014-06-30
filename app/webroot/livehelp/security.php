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
} else {
	$installed = false;
}

if ($installed == false) {
	include('include/settings.php');
}

if ((function_exists('imagepng') || function_exists('imagejpeg')) && function_exists('imagettftext')) {

	// Generate the random string
	$chars = array('a','A','b','B','c','C','d','D','e','E','f','F','g','G','h','H','i','j','J','k','K','L','m','M','n','N','p','P','q','Q','r','R','s','S','t','T','u','U','v','V','w','W','x','X','y','Y','z','Z','2','3','4','5','6','7','8','9');
	$ascii = array();
	
	$security = '';
	for ($i = 0; $i < 5; $i++) {
		$char = $chars[rand(0, count($chars) - 1)];
		$ascii[$i] = ord($char);
		$security .= $char;
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
	
	function hex2rgb($hex) {
		$color = str_replace('#','',$hex);
		$rgb = array(hexdec(substr($color,0,2)), hexdec(substr($color,2,2)), hexdec(substr($color,4,2)));
		return $rgb;
	}
	
	if ($_SETTINGS['BACKGROUNDCOLOR'] == '') { $_SETTINGS['BACKGROUNDCOLOR'] = '#FFFFFF'; }
	$rgb = hex2rgb($_SETTINGS['BACKGROUNDCOLOR']);
	$image = imagecreate(80, 30); /* Create a blank JPEG image */
	$bg = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
	imagefilledrectangle($image, 0, 0, 80, 30, $bg);
	
	// Create random angle
	$size = 16;
	$angle = rand(-5, -3);
	$color = imagecolorallocate($image, 0, 0, 0);
	$path = realpath('.');
	if (substr($path, -1) == '/') {
		$font = $path . 'styles/fonts/FrancophilSans.ttf';
	} else {
		$font = $path . '/styles/fonts/FrancophilSans.ttf';
	}
	
	// Determine text size, and use dimensions to generate x & y coordinates
	$textsize = imagettfbbox($size, $angle, $font, $security);
	$twidth = abs($textsize[2] - $textsize[0]);
	$theight = abs($textsize[5] - $textsize[3]);
	$x = (imagesx($image) / 2) - ($twidth / 2);
	$y = (imagesy($image)) - ($theight / 2);
	
	// Add text to image
	imagettftext($image, $size, $angle, $x, $y, $color, $font, $security);
	
	if (function_exists('imagepng')) {
		// Output GIF Image
		header('Content-Type: image/png');
		imagepng($image);
	}
	elseif (function_exists('imagejpeg')) {
		// Output JPEG Image
		header('Content-Type: image/jpeg');
		imagejpeg($image, '', 100);
	}
	
	// Destroy the image to free memory
	imagedestroy($image);
	exit();

}
else {

	if (strpos(php_sapi_name(), 'cgi') === false ) { header('HTTP/1.0 404 Not Found'); } else { header('Status: 404 Not Found'); }
	exit;
	
}

?>