<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>themeshop/template1/css/style.css" />
<script type="text/javascript" src="<?php echo DOMAIN?>themeshop/template1/js/jquery-1.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>themeshop/template1/css/visuallightbox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>themeshop/template1/css/colorbox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>themeshop/template1/css/validationEngine.jquery.css" />
<script type="text/javascript" src="<?php echo DOMAIN?>themeshop/template1/js/jquery.validationEngine.js"></script>
<script>
  $(document).ready(function(){
    $("#check_form").validationEngine();
  });
</script>

<script type="text/javascript" src="<?php echo DOMAIN?>themeshop/template1/js/ddaccordion.js"></script>
<script type="text/javascript">

//Initialize Arrow Side Menu:
ddaccordion.init({
	headerclass: "menuheaders", //Shared CSS class name of headers group
	contentclass: "menucontents", //Shared CSS class name of contents group
	revealtype: "clickgo", //Reveal content when user clicks or onmouseover the header? Valid value: "click", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["unselected", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: 500, //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script>
<style>
.menu_footer ul li{
	float:left;
	padding-left:5px;
	padding-right:5px;
	}
.menu_footer ul li a{
    color:#FFF;
	font-weight:bold;
	}
.bg-shop{
	<?php 
	 $background = $this->requestAction('/'.$url_shop.'/background');
	 
	 foreach($background as $backgrounds) {
	 if($backgrounds['Background']['color']){
	 ?>
	 background:#<?php echo $backgrounds['Background']['color'];?>;
	<?php }else{?>
		background:<?php echo $backgrounds['Background']['images'];?>;
	<?php }
	}
	?>
	}
</style>
</head>

<body id="bd" class="bg-shop">
	<div class="wrapper">
    	<?php echo $this->element('themeshop/template1/header');?>
        <?php echo $this->element('themeshop/template1/menu');?>
        <div class="wrapper_ad">
        </div>
        <div class="wrapper_main">
        	<?php echo $this->element('themeshop/template1/left');?>
            <?php echo $content_for_layout;?>
            <?php if(($this->params['action']!='chi_thiet_san_pham')&&($this->params['action']!='chi_thiet_raovat')) {?>
            <?php echo $this->element('themeshop/template1/right');?>
            <?php }?>
            <div class="clr"></div>
        </div>
        <div class="wrapper_footer">
        	<div class="content">
            	<div class="menu_footer">
                	<ul>
                    <li>
                        <a href="<?php echo DOMAIN;?><?php echo $url_shop;?>"class="m_selected">Trang chủ </a>
                    </li>
                    <li>
                        <a href="<?php echo DOMAIN;?><?php echo $url_shop;?>/gioi_thieu">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="<?php echo DOMAIN;?><?php echo $url_shop;?>/san_pham">Sản phẩm</a>
                    </li>
                    <li>
                        <a href="<?php echo DOMAIN;?><?php echo $url_shop;?>/raovat">Raovat</a>
                    </li>
                    <li>
                        <a href="<?php echo DOMAIN;?><?php echo $url_shop;?>/tin_tuc">Tin tức</a>
                    </li>
                    <li>
                        <a href="<?php echo DOMAIN;?><?php echo $url_shop;?>/lien_he">Liên hệ</a>
                    </li>
                </ul>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
