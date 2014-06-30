<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $setting = $this -> requestAction('/comment/setting');?>
<?php foreach($setting as $settings){?>
<link href="http://<?php echo $settings['Setting']['url'];?>/feed" title="<?php echo $settings['Setting']['title'];?> » Feed" type="application/rss+xml" rel="alternate">
<link href="http://<?php echo $settings['Setting']['url'];?>/comments/feed" title="<?php echo $settings['Setting']['title'];?> » Comments Feed" type="application/rss+xml" rel="alternate">
<link href="http://<?php echo $settings['Setting']['url'];?>" title="<?php echo $settings['Setting']['title'];?>" rel="index">
<meta content="<?php echo $settings['Setting']['keyword'];?>" name="keywords">
<meta content="<?php echo $settings['Setting']['description'];?>" name="description">
<title><?php if(!isset($title)) echo $settings['Setting']['title']; else echo $title;?></title>

<meta content="noodp,noydir" name="robots">
<link href="<?php echo DOMAIN ?>images/logo.png" type="images/png" rel="icon">
<?php }?>

 <link type="text/css" href="<?php echo DOMAIN ?>css/style.css" rel="stylesheet" /> 
  <link type="text/css" href="<?php echo DOMAIN ?>css/header.css" rel="stylesheet" /> 
<script src="<?php echo DOMAIN?>js/jquery-latest.js" type="text/javascript"></script>

	<script type="text/javascript">
	function test(){		
	    emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
		
		var email = document.getElementById("text-search-email").value;
		
	    if(!emailRegExp.test(email)){
			alert('Email không hợp lệ');
			$('#text-search-email').focus();
			return false;			
	        }
		else
		
			return true;
		
	        }
	
//jQuery.noConflict();
jQuery(document).ready(function(){
				jQuery(function () {
			var scrollDiv = document.createElement('div');
			
			jQuery(window).scroll(function () {
			        if (jQuery(this).scrollTop() != 0) {
			            jQuery('#toTop').fadeIn();
			        } else {
			            jQuery('#toTop').fadeOut();
			        }
			    });
			    jQuery('#toTop').click(function () {
			        jQuery('body,html').animate({
			            scrollTop: 0
			        },
			        800);
			    });
			});

			});
			


  </script>
  <style>
  #toTop{position: fixed; bottom: 5px; right: 5px; opacity: 1; cursor: pointer;}
  </style>
  
 <div id="toTop"><img src="<?php echo DOMAIN?>images/totop.png"/></div>


 <link rel="stylesheet" href="<?php echo DOMAIN ?>css/jquery-ui-1.8.20.custom.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo DOMAIN ?>js/jquery-ui-1.8.20.custom.min.js"></script>

<?php echo $javascript->link('jquery.validate', true); ?>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/checkform.js"></script>


		 				<script>
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	$(function() {
		
		

		$( "#dialog1" ).dialog({
			autoOpen: false,
			show: "blind",
			hide: "explode",
			modal: true
		});
		
	$( "#dangnhap" ).click(function() {
			 
			
			$( "#dialog1" ).dialog( "open" );
			return false;
		});



	$( "#dialog2" ).dialog({
		autoOpen: false,
		show: "blind",
		hide: "explode",
		modal: true
	});
	
$( "#dangky" ).click(function() {

		$( "#dialog2" ).dialog( "open" );
		return false;
	});

$( ".dangky" ).click(function() {
	 
	$( "#dialog1" ).dialog( "close" );
		$( "#dialog2" ).dialog( "open" );
		return false;
	});
	
	
		
	});


	jQuery(document).ready(function($){
		$("#register-email").change(function(){
			var email=$("#register-email").val();
			$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'userscms/ck_mail_register/',
				data: 'email='+email,
				success: function(msg){	
					//alert (msg);	
					$('#validate-emai-register').find('span').remove().end();										
					$('#validate-emai-register').append(msg);					
				}
			});
			
		});



		$(".txt-email").change(function(){
			var email1=$(".txt-email").val();
			$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'login/check_email/',
				data: { email:email1 },
				success: function(msg){	
					//alert (msg);	
					$('.validate-emai-register').find('span').remove().end();										
					$('.validate-emai-register').append(msg);					
				}
			});
			
		});


		$(".txt-pass").change(function(){
			var password1=$(".txt-pass").val();
			var email1=$(".txt-email").val();
			$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'login/check_password/',
				data: {password:password1,
					

				},
				success: function(msg){	
					//alert (msg);	
					$('.password-error').find('span').remove().end();										
					$('.password-error').append(msg);					
				}
			});
			
		});

		
	});
	
	</script>
   
</head>

<body>
    
  <div id="dialog1" title="Đăng nhập trên Hoàng Group">
      <form method="post" action="<?php echo DOMAIN?>login/check_login"  id="myform1" name="image" enctype="multipart/form-data">
      <div class="member_register">
            
                <div class="right">
                                   <table style="margin-left:70px;color:#58595B; font-size:12px;">
                    	 <tr>
                        	<td align="left">
								Email<font color="red">(*)</font>
							</td>
                            <td>
                            	<input name="email1" type="text"  class="text-input-register textField text txt-email"/>
                                <div class="validate-emai-register"><span id="error"></span></div>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Mật khẩu<font color="red">(*)</font>
							</td>
                            <td>
                            	<input id="password1" class="textField text txt-pass" name="password1" type="password" />
                            	<div class="password-error"><span id="error"></span></div>
                            </td>
                        </tr>
                     
                       
                    </table>
                    <table width="450" align="center" style="padding-top:20px;margin:auto;color:#58595B;font-size:12px;">
                    
                    <tr>
							<td colspan="5">
                            <p><input type="checkbox" name="mainForm:agreeTerm" id="mainForm:agreeTerm" checked> Nhớ trạng thái đăng nhập | <a style="color:black;"href="">Quên mật khẩu</a></p>
                        
							</td>
						</tr>
                    
						<tr>
							<td colspan="5" align="center">
                            	<br />
                            	<input style="cursor:pointer;"type="submit" name="btsub" value="Đăng nhập" class="submit"/>
							</td>
						
						</tr>
					</table>
					
					<div class="taotk">
                	<p style="color:#58595B;float:left; width:300px; margin-top:30px;margin-left:50px;">Nếu bạn chưa có tài khoản vui lòng tạo tài khoản</p>
                	<a class="dangky" style="cursor:pointer;">
                	<p class="p-ttk" style="float:left; width:124px;height:43px;margin-top:20px;">
                	
                	Tạo tài khoản
                	
                	</p>
                	</a>
                </div>
					
                </div><!-- ENd right -->
                
                <div class="clr"></div>
            </div>
       </form>
	
    </div><!-- End dialog -->
    
     <div id="dialog2" title="Tạo tài khoản trên Hoàng Groups">
      <form method="post" action="<?php echo DOMAIN?>userscms/add"  id="myform" name="image" enctype="multipart/form-data">
<div class="member_register">
            
                <div class="right">
                                   <table style="margin-left:70px; color:#58595B; font-size:12px;">
                    	 <tr>
                        	<td align="left">
								Email<font color="red">(*)</font>
							</td>
                            <td>
                            	<input name="email" type="text"  id="register-email" class="text-input-register textField text"/>
                                <div id="validate-emai-register"><span id="error"></span></div>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Mật khẩu<font color="red">(*)</font>
							</td>
                            <td>
                            	<input id="password" class="textField text" name="password" type="password" />
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Xác nhận mật khẩu<font color="red">(*)</font>
							</td>
                            <td>
                            	<input id="confirm_password" class="textField text" name="confirm_password" type="password" />
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Họ tên<font color="red">(*)</font>
							</td>
                            <td>
                            	<input id="name" class="textField  text" name="name" type="text"  />
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Điện thoại di động<font color="red">(*)</font>
							</td>
                            <td>
                            	<input name="phone" type="text"  id="phone" class="text-input-register textField text"/>
                                
                            </td>
                        </tr>
						 <tr>
                        	<td align="left">
								Địa chỉ<font color="red">(*)</font>
							</td>
                            <td>
                            	<input name="address" type="text"  id="address" class="text-input-register textField text"/>
                                
                            </td>
                        </tr>
                      
                        <tr>
                        	<td align="left">
								Giới tính
							</td>
                            <td>
                            	<select size="1" name="sex" id="sex" title="Giơi thính" style="width:123px; height:28px;">
                                   
                                    <option value="1" title="Nam"> Nam </option>
                                    <option value="0" title="Nữ" > Nữ </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Ngày sinh
							</td>
                            <td>
                             <?php
                          	   $date=date('d-m-Y');
                       		 ?>
                          <input type="text" value="<?php echo $date;?>" name="date" class="text"/>
                            </td>
                        </tr>
                       
                    </table>
                    <table width="450" align="center" style="padding-top:20px;margin:auto;font-size:12px; color:#58595B;">
                    	<tr>
							<td colspan="5">
                            <p><input type="checkbox" name="mainForm:agreeTerm" id="mainForm:agreeTerm"> Tôi đã xem và đồng ý với <a class="quyche" href="">Quy chế sàn giao dịch</a> của Tiến thời</p>
                        
							</td>
						</tr>
						
						
						<tr>
							<td colspan="5" align="center">
                            	<br />
                            	<input style="cursor:pointer;"type="submit" name="btsub" value="Đăng ký" class="submit"/>
							</td>
						
						</tr>
					</table>
                </div>
                <div class="clr"></div>
            </div>
</form>
	
    </div><!-- End dialog -->  

 <div id='header'>
        <div id='waper'>
            <ul id='menu-top'>
                <li><a href="#">Trang chủ</a></li>
                <li>|</li>
                <li><a href="#">Email</a></li>
                <li>|</li>
                <li><a href="#">Quy chế sàn giao dịch</a></li>
                <li>|</li>
                <li><a href="#">Site map</a></li>
            </ul>

                <img src="<?php echo DOMAIN?>images/logo.png" alt="">
                <form action="<?php echo DOMAIN?>tim-kiem" method="POST" id='search'>
                    <input type='text' name='search' id='text-search' value="Nhập từ khóa tìm kiếm" onclick="this.value=''" onblur="if (this.value == '')  {this.value = 'Nhập từ khóa tìm kiếm';}"/>
                    <input style="width:38px; height:29px; float:left;"  type="image" src="<?php echo DOMAIN?>images/text-search.png"/>
                </form>
                <p id="test"></p>
                <form action="<?php echo DOMAIN?>dang-ky" method="post" onsubmit="return test();" id='search-email'>
           			<input type="hidden" name="url" value="<?php echo $this->params['url']['url'];?>">
                    <input type='text' name='email' id='text-search-email' value="Nhập địa chỉ Email của bạn" onclick="this.value=''" onblur="if (this.value == '')  {this.value = 'Nhập địa chỉ Email của bạn';}"/>
                    <input style="width:65px; height:29px;" type="image" src="<?php echo DOMAIN?>images/text-search-email.png"/>
                </form>

            <ul id='menu-top-footer'>
				<li><a href="<?php echo DOMAIN?>">Trang chủ</a></li>
                <li><a href="<?php echo DOMAIN?>deal-hot">Deal hot</a></li>
               
                
                <li><a href="<?php echo DOMAIN?>gian-hang">Gian hàng</a></li>
                <li><a href="<?php echo DOMAIN?>dang-ky-mo-gian-hang">Đăng ký mở gian hàng</a></li>
            </ul>
            <div class="bor-dk">
            <ul id='regiter'>
            	<li><a href="<?php echo DOMAIN?>gio-hang">
                <p class="p-gh">
                Giỏ hàng
                </p>
               
                <p style="float:left;">
                (
                <?php 
				if($this->Session->read('email')){
				$a=$this->Session->read('shopingcart');
				echo count($a); //pr($a); die;
				}
				else echo "0";
				?>)
                </p>
                </a>
                </li>
                <li>|</li>
                <?php if(!$this->Session->check('name1')){?>
                <li><a  id="dangnhap">Đăng nhập</a></li>
                <li>|</li>
                <li><a id="dangky">Tạo tài khoản</a></li>
              
                <?php } else {?>
	
  					<li>Xin chào:<?php echo $this->Session->read('name1');?></li>
                <li>|</li>
                <li><a href="<?php echo DOMAIN?>thong-tin-tai-khoan">Tài khoản</a></li>
				
				<li>|</li>
                <li><a href="<?php echo DOMAIN?>login/logout">Thoát</a></li>
                   </ul>
                </div>
                
                  <?php }?>
           
        </div><!--end waper-->
    </div><!--end #header-->
