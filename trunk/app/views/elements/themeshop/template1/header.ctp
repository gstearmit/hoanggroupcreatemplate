<?php 
/*
$pizza = $_GET['url'];
$urlshop = explode("/", $pizza);
$geturl=$urlshop[0];
*/
?>
 <?php 
	$bannerheader = $this->requestAction('/'.$url_shop.'/bannerheader');
	foreach($bannerheader as $banners) {
 ?>
 
<div class="wrapper_banner"><?php ?>
    <embed height="200" width="990" src="<?php echo DOMAIN;?><?php echo $banners['Banner']['images'];?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" wmode="transparent" type="application/x-shockwave-flash" scale="exactFit" allowfullscreen="true" allowscriptaccess="sameDomain">
</div>
<?php }?>