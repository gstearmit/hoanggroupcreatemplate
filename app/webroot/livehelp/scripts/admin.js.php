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


if (file_exists('../locale/' . LANGUAGE_TYPE . '/admin.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/admin.php');
}
else {
	include('../locale/en/admin.php');
}

?>
<!--

$(function(){
	
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
	// fix css background pngs in all ie versions
	$(".popup td").each(function(){
		var bgIMG = jQuery(this).css('background-image');
		if(bgIMG.indexOf(".png")!=-1){
			var iebg = bgIMG.split('url("')[1].split('")')[0];
			jQuery(this).css('background-image', 'none');
			jQuery(this).get(0).runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + iebg + "',sizingMethod='scale')";
		}
	});
}

});

//-->