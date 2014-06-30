 <style>
    #input{
		width:250px;
		border: 1px solid #C2C2C2;
		height:22px;
		background:#fcf9f2;
		}
   .guimail tr td{
	   padding-top:10px;
	   padding-right:20px;
	   }
	.guimail textarea{
		border: 1px solid #C2C2C2;
		background:#fcf9f2;
		}
		.bd-right p{color:#65390d;
		
		}
		.title-content{border-bottom:1px solid #f1e1bf;
		overflow:hiden;
		
		}	
		
</style>
 
<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/style1.css"/>
 
 	<?php echo $this->Html->css('validationEngine.jquery');?>

<script src="<?php echo DOMAIN?>js/fancybox/jquery.fancybox-1.3.2.js" type="text/javascript"></script>
  <link rel="stylesheet" href="<?php echo DOMAIN?>css/jquery-ui-1.8.20.custom.css">
	
	<script src="<?php echo DOMAIN?>js/jquery-ui-1.8.20.custom.min.js"></script>
	

	<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validationEngine.js"></script>
<script>
  $(document).ready(function(){
    $("#check_form").validationEngine();
  });
</script>

  <?php if($session->read('lang')==1) {?>

            <div id="content">
            <div class="dd">

            	<ul><li><a href="<?php echo DOMAIN?>">Trang chủ /</a></li>
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>lien-he">Liên hệ </a></li>
            	
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            		<div style="margin-top:16px">
            		<?php echo $this->element('help');?>
            		</div>  	
            		<?php echo $this->element('video');?>
            		<?php echo $this->element('tigia');?>  	
            	</div><!-- End content-left -->
            	
            	
            	
            	<div class="content-right">
            		<div class="tit-right">
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;">LIÊN HỆ</h2>
            		</div>
            		
            		<div class="bd-right">
            		
  
 
 

<div class="title-content" >
<?php $setting=$this->requestAction('comment/setting');
foreach ($setting as $setting){
?>
   <p style="font-weight:bold;">
   <?php echo $setting['Setting']['name'];?>
      </p>
   <p style="margin-top:5px;margin-bottom:10px;">

    Địa chỉ: <?php echo $setting['Setting']['address'];?>
    <br>
    Điện thoại: <?php echo $setting['Setting']['phone'];?> - Fax: <?php echo $setting['Setting']['fax'];?>
    <br>
    Email: <?php echo $setting['Setting']['email'];?><br>
     </p>
     
   <?php }?>
</div>
<p style="font-weight:bold;margin-top:10px;">Để gửi thư cho chúng tôi, bạn vui lòng điền thông tin chi tiết vào form sau: </p>
        <form method="post" id="check_form" action="<?php echo DOMAIN; ?>contacts/send">
                <table class="guimail">
                    <tr><td>Họ và tên (*): </td><td><input id="input" name="name" class="validate[required] name" type="text"></td></tr>
					<tr><td>Email (*):</td><td><input id="input" type="text"  class="validate[required,custom[email]] email" name="email"></td></tr>
                      <tr><td>Số điện thoại(*):</td><td><input id="input" type="text" class="validate[required,custom[telephone]]" name="phone_dd"></td></tr>
                     <tr><td>Tiêu đề (*) :</td><td><input id="input" type="text" class="validate[required] title" name="title"></td></tr>
                    <tr><td>Nội dung (*) :</td><td><textarea name="content" class="validate[required] nd" cols="50" rows="10"></textarea></td></tr>
                   <tr><td></td><td>Chú ý: Bạn phải điền đủ thông tin vào các ô có dấu *</td></tr>
                    <tr><td></td>
                    <td>
                    <input class="nut gui" type="submit" value=" GỬI ĐI ">
                    <input type="reset" value=" LÀM LẠI " class="nut" >
                    </td></tr>
                </table>
           </form>
   </div>

            		
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
		
 
 <?php }?>
 
 
 <?php if($session->read('lang')==2) {?>

            <div id="content">
            <div class="dd">

            	<ul><li><a href="<?php echo DOMAIN?>">Home /</a></li>
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>lien-he">Contact </a></li>
            	
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            		<div style="margin-top:16px">
            		<?php echo $this->element('help');?>
            		</div>  	
            		<?php echo $this->element('video');?>
            		<?php echo $this->element('tigia');?>  	
            	</div><!-- End content-left -->
            	
            	
            	
            	<div class="content-right">
            		<div class="tit-right">
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;">CONTACT</h2>
            		</div>
            		
            		<div class="bd-right">
            		
  
 
 

<div class="title-content" >
<?php $setting=$this->requestAction('comment/setting');
foreach ($setting as $setting){
?>
   <p style="font-weight:bold;">
   <?php echo $setting['Setting']['name_eg'];?>
      </p>
   <p style="margin-top:5px;margin-bottom:10px;">

    Address <?php echo $setting['Setting']['address_eg'];?>
    <br>
    Tel: <?php echo $setting['Setting']['phone'];?> - Fax: <?php echo $setting['Setting']['fax'];?>
    <br>
    Email: <?php echo $setting['Setting']['email'];?><br>
     </p>
     
   <?php }?>
</div>
<p style="font-weight:bold;margin-top:10px;">To send a message to us, please enter your details into the form below: </p>
        <form method="post" id="check_form" action="<?php echo DOMAIN; ?>contacts/send">
                <table class="guimail">
                    <tr><td>Full name (*): </td><td><input id="input" name="name" class="validate[required] name" type="text"></td></tr>
					<tr><td>Email (*):</td><td><input id="input" type="text"  class="validate[required,custom[email]] email" name="email"></td></tr>
                      <tr><td>Tel(*):</td><td><input id="input" type="text" class="validate[required,custom[telephone]]" name="phone_dd"></td></tr>
                     <tr><td>Title (*) :</td><td><input id="input" type="text" class="validate[required] title" name="title"></td></tr>
                    <tr><td>Content (*) :</td><td><textarea name="content" class="validate[required] nd" cols="50" rows="10"></textarea></td></tr>
                   <tr><td></td><td>Note: You must enter enough information in the fields marked *</td></tr>
                    <tr><td></td>
                    <td>
                    <input class="nut gui" type="submit" value=" SEND ">
                    <input type="reset" value=" RESET " class="nut" >
                    </td></tr>
                </table>
           </form>
   </div>

            		
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
		
 
 <?php }?>
 
 