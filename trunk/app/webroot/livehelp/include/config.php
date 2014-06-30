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

ini_set('magic_quotes_sybase', 0);

// Open MySQL Connection
$SQL = new MySQL; 
$SQL->connect();

/*
function stripslashes_string($value) {
	return is_array($value) ? stripslashes($value) : $value;
}
*/

if (get_magic_quotes_gpc()) {
	$_COOKIE = array_map('stripslashes', $_COOKIE);
	$_REQUEST = array_map('stripslashes', $_REQUEST);
}

$_REQUEST = array_map('addslashes', $_REQUEST);


if (!isset($_SERVER['HTTP_REFERER'])){ $_SERVER['HTTP_REFERER'] = ''; }
if (!isset($_REQUEST['COOKIE'])){ $_REQUEST['COOKIE'] = ''; }
if (!isset($_REQUEST['SERVER'])){ $_REQUEST['SERVER'] = ''; }

$query = "SELECT `name`, `value` FROM " . $table_prefix . "settings";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	$_SETTINGS = array();
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
			$_SETTINGS[strtoupper($row['name'])] = $row['value'];
		}
	}
}
else {
	return false;
	exit();
}

if (!isset($_SETTINGS['CHATWINDOWWIDTH'])) { $_SETTINGS['CHATWINDOWWIDTH'] = 625; }
if (!isset($_SETTINGS['CHATWINDOWHEIGHT'])) { $_SETTINGS['CHATWINDOWHEIGHT'] = 435; }

// Auto-detect cookie domain / TLD
if ($_SERVER['SERVER_PORT'] == '443') {	$protocol = 'https://'; } else { $protocol = 'http://'; }
$url = $protocol . $_SERVER['HTTP_HOST'];
$_SETTINGS['URL'] = $url;

$domain = '';
$tld = '';

// Manual Settings
$_SETTINGS['LIMITHISTORY'] = 0;
if (!isset($_SETTINGS['TRANSCRIPTVISITORALERTS'])) {
	$_SETTINGS['TRANSCRIPTVISITORALERTS'] = false;
}

// Future updates - http://en.wikipedia.org/wiki/List_of_Internet_TLDs
$gTlds = explode(',', str_replace(' ', '', 'aero, biz, com, cat, coop, edu, gov, info, int, jobs, mil, mobi, museum, name, net, org, pro, tel, travel, ltd, asia')); 
$cTlds = explode(',', str_replace(' ', '', 'ac, ad, ae, af, ag, ai, al, am, an, ao, aq, ar, as, at, au, aw, az, ax, ba, bb, bd, be, bf, bg, bh, bi, bj, bm, bn, bo, br, bs, bt, bv, bw, by, bz, ca, cc, cd, cf, cg, ch, ci, ck, cl, cm, cn, co, cr, cs, cu, cv, cx, cy, cz, de, dj, dk, dm, do, dz, ec, ee, eg, eh, er, es, et, eu, fi, fj, fk, fm, fo, fr, ga, gb, gd, ge, gf, gg, gh, gi, gl, gm, gn, gp, gq, gr, gs, gt, gu, gw, gy, hk, hm, hn, hr, ht, hu, id, ie, il, im, in, io, iq, ir, is, it, je, jm, jo, jp, ke, kg, kh, ki, km, kn, kp, kr, kw, ky, kz, la, lb, lc, li, lk, lr, ls, lt, lu, lv, ly, ma, mc, md, mg, mh, mk, ml, mm, mn, mo, mp, mq, mr, ms, mt, mu, mv, mw, mx, my, mz, na, nc, ne, nf, ng, ni, nl, no, np, nr, nu, nz, om, pa, pe, pf, pg, ph, pk, pl, pm, pn, pr, ps, pt, pw, py, qa, re, ro, ru, rw, sa, sb, sc, sd, se, sg, sh, si, sj, sk, sl, sm, sn, so, sr, st, sv, sy, sz, tc, td, tf, tg, th, tj, tk, tl, tm, tn, to, tp, tr, tt, tv, tw, tz, ua, ug, uk, um, us, uy, uz, va, vc, ve, vg, vi, vn, vu, wf, ws, ye, yt, yu, za, zm, zw'));
$tldarray = array_merge($gTlds, $cTlds); 

$url = parse_url(trim($url)); 
$host = $url['host']; 
  
$domainarray = explode('.', $host);
$top = count($domainarray);

for ($i = 0; $i < $top; $i++) { 
	$domainsection = array_pop($domainarray); 
	if (in_array($domainsection, $tldarray)) { 
		$tld = '.' . $domainsection . $tld;
	} 
	else {
		$domain = $domainsection;
		break;
	} 
}

// Set cookie domain - blank for localhost
if (strpos($_SERVER['HTTP_HOST'], '.') === false) {
	$cookie_domain = '';
}
elseif ($_REQUEST['COOKIE'] != '') {
	$cookie_domain = '.' . $_REQUEST['COOKIE'];
}
elseif ($domain != '') {
	$cookie_domain = '.' . $domain . $tld;
}
else {
	$cookie_domain = '.' . $_SETTINGS['DOMAIN'];
}

// Remove .www. if at the start of string
if (substr($cookie_domain, 0,5) == '.www.') {
	$cookie_domain = substr($cookie_domain, 4);
}

// Timers and Settings (shown in seconds)
$visitor_refresh = 10;
$chat_refresh = 2;
$security_code = true;

// DO NOT CHANGE BELOW
$visitor_timeout = $visitor_refresh * 4.5;
$connection_timeout = 30;
$guest_timeout = 60;
$user_refresh = 10;

if ($_REQUEST['SERVER'] != '' && $_SERVER['HTTP_HOST'] != 'localhost') {
	$server = $_REQUEST['SERVER'];
	if ($server == '//') {
		$server = '';
	}
}
else {
	// Modify the protocol dependant on the current server port
	$protocols = array("http://", "https://"); 
	if ($_SERVER['SERVER_PORT'] == '443') {
		$protocol = 'https://';
		$server = $protocol . $_SERVER['HTTP_HOST']; 
	}
	else {
		$protocol = 'http://';
		$server = str_replace($protocols, $protocol, $_SETTINGS['URL']); 
	}
}

// Retrieve COOKIE variables and unserialize
if (isset($_COOKIE['LiveHelpSession'])) {
	$COOKIE = new Cookie;
	$session = $COOKIE->decode($_COOKIE['LiveHelpSession']);
	
	if (!isset($session['GUEST_LOGIN_ID'])){ $session['GUEST_LOGIN_ID'] = 0; }
	if (!isset($session['GUEST_USERNAME'])){ $session['GUEST_USERNAME'] = ''; }
	if (!isset($session['MESSAGE'])){ $session['MESSAGE'] = 0; }
	if (!isset($session['SECURITY'])){ $session['SECURITY'] = ''; }
	if (!isset($session['OPERATOR'])){ $session['OPERATOR'] = ''; }
	if (!isset($session['TOTALOPERATORS'])){ $session['TOTALOPERATORS'] = 0; }
	if (!isset($session['DOMAIN'])){ $session['DOMAIN'] = ''; }
	
	$request_id = $session['REQUEST'];
	$guest_login_id = $session['GUEST_LOGIN_ID'];
	$guest_username = $session['GUEST_USERNAME'];
	$guest_message = $session['MESSAGE'];
	$operator_username = $session['OPERATOR'];
	$total_operators = $session['TOTALOPERATORS'];
	$security = $session['SECURITY'];
	$locale = $session['LANGUAGE'];
	
	if ($session['DOMAIN'] != '') {
		$cookie_domain = $session['DOMAIN'];
	}
	
	unset($session);	
}

if (!isset($request_id)){ $request_id = ''; }
if (!isset($locale)){ $locale = ''; }

// Make language type constant and overide default if set manually
if (!isset($_REQUEST['LANGUAGE'])){ $_REQUEST['LANGUAGE'] = ''; }
if (isset($_REQUEST['LANGUAGE']) && strlen($_REQUEST['LANGUAGE']) == 2) {
	$locale = $_REQUEST['LANGUAGE'];
}
else {
	$locale = $_SETTINGS['LOCALE'];
}
define('LANGUAGE_TYPE', $locale);

$language_directory = '/livehelp/locale/' . LANGUAGE_TYPE . '/images/';
if (isset($_REQUEST['IMAGES']) && $_REQUEST['IMAGES'] !=''){ $language_directory = $_REQUEST['IMAGES']; }

$_SETTINGS['LOGO'] = preg_replace('%/livehelp/locale/[a-zA-Z]{2}/images/%', $language_directory, $_SETTINGS['LOGO']);
$_SETTINGS['CAMPAIGNIMAGE'] = preg_replace('%/livehelp/locale/[a-zA-Z]{2}/images/%', $language_directory, $_SETTINGS['CAMPAIGNIMAGE']);
$_SETTINGS['OFFLINELOGO'] = preg_replace('%/livehelp/locale/[a-zA-Z]{2}/images/%', $language_directory, $_SETTINGS['OFFLINELOGO']);
$_SETTINGS['ONLINELOGO'] = preg_replace('%/livehelp/locale/[a-zA-Z]{2}/images/%', $language_directory, $_SETTINGS['ONLINELOGO']);
$_SETTINGS['OFFLINEEMAILLOGO'] = preg_replace('%/livehelp/locale/[a-zA-Z]{2}/images/%', $language_directory, $_SETTINGS['OFFLINEEMAILLOGO']);
$_SETTINGS['BERIGHTBACKLOGO'] = preg_replace('%/livehelp/locale/[a-zA-Z]{2}/images/%', $language_directory, $_SETTINGS['BERIGHTBACKLOGO']);
$_SETTINGS['AWAYLOGO'] = preg_replace('%/livehelp/locale/[a-zA-Z]{2}/images/%', $language_directory, $_SETTINGS['AWAYLOGO']);

if (ini_get('date.timezone') == '') {
	if (function_exists('date_default_timezone_set')) {
		if ($_SETTINGS['TIMEZONE'] == 0) {
			$timezone = 'GMT';
		} else {
			$sign = substr($_SETTINGS['TIMEZONE'], 0, 1);
			$hours = substr($_SETTINGS['TIMEZONE'], 1, 2);
			
			if ($sign == '+') { $sign = '-'; } else { $sign = '+';}
			$timezone = 'Etc/GMT' . $sign . sprintf("%01d", $hours);
		}
		date_default_timezone_set($timezone);
		unset($timezone);
	}
}
$_SETTINGS['SERVERTIMEZONE'] = date('O');

$sign = substr($_SETTINGS['TIMEZONE'], 0, 1);
$hours = substr($_SETTINGS['TIMEZONE'], 1, 2);
$minutes = substr($_SETTINGS['TIMEZONE'], 3, 4);
if ($minutes != 0) { $minutes = ($minutes / 0.6); }
$local = $sign . $hours . $minutes;

$timezone = date('O');
$sign = substr($timezone, 0, 1);
$hours = substr($timezone, 1, 2);
$minutes = substr($timezone, 3, 4);
if ($minutes != 0) { $minutes = ($minutes / 0.6); }
$remote = $sign . $hours . $minutes;

// Convert to eg. +/-0430 format
$hours = substr(sprintf("%04d", $local - $remote), 0, 2);
$minutes = substr(sprintf("%04d", $local - $remote), 2, 4);
if ($minutes != 0) { $minutes = ($minutes * 0.6); }

// Calculate difference between decimal LOCAL time and REMOTE time and CONVERT to eg. +/-0430 format
$timezonehours = $hours;
$timezoneminutes = $minutes;

return true;

?>