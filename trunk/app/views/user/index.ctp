<?php echo $html->css('register-news'); ?>
<?php echo $javascript->link('jquery.validate', true); ?>
<script>
function reload()
{
	var random1= Math.random()*5
	jQuery.ajax({
		type: "GET", 
		url: "<?php echo DOMAIN;?>"+'user/create_image1/'+random1,
		data: null,
		success: function(msg){	
		jQuery('#abc').find('img').remove().end();
		 jQuery('#abc').append('<img alt="" id="captcha" src="<?php echo DOMAIN?>user/create_image1/'+random1+'" />');				
		}
	});	
}

function keypress(e){
 //Hàm dùng d? ngan ngu?i dùng nh?p các ký t? khác ký t? s? vào TextBox
 var keypressed = null;
 if (window.event)
 {
 keypressed = window.event.keyCode; //IE
 }
 else
 { 
 keypressed = e.which; //NON-IE, Standard
 }
 if (keypressed < 48 || keypressed > 57)
 { //CharCode c?a 0 là 48 (Theo b?ng mã ASCII)
 //CharCode c?a 9 là 57 (Theo b?ng mã ASCII)
 if (keypressed == 8 || keypressed == 127)
 {//Phím Delete và Phím Back
 return;
 }
 if (keypressed == 45 || keypressed == 32)
 {//Phím Delete và Phím Back
 return true;
 }
 return false;
 }
 }
jQuery(document).ready(function($) {
	
	$("#myform").validate({
		rules: {
			name: {
				required: true,
				minlength:8
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},	
			
			email: {
				required: true,
				email: true
			},
			security: {
				required: true,
				minlength: 5,
				maxlength:5
			},
			district:{
				required: true
			},
			member:{
				required: true
			},
			
			phone: {
				required: true,
				 minlength: 7,
				 maxlength: 15
			},
			
		},
		messages: {
			name: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập vào họ tên!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>Họ tên bao gồm ít nhất 8 kí tự!</span>"
			},
			email: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập vào Email!</span>",
				email: " <br><span style='color:#FF0000; padding-left:148px;'>Email không đúng!</span>"
			},
			password: {
				required: "<br><span style='color:#FF0000;padding-left:148px ' >Xin vui lòng nhập password !</span>",
				minlength: "<br><span style='color:#FF0000; padding-left:140px;' > Xin vui lòng nhập password có chiều dài hơn 5 ký tự !</span>"
			},
			security: {
				required: " <br><span style='color:#FF0000;padding-left:148px ' >Xin vui lòng nhập mã bảo vệ!</span>",
				minlength: "<br><span style='color:#FF0000;padding-left:148px ' > Mã bảo vệ chỉ bao gồm ít nhất 5 kí tự!</span>",
				maxlength: "<br><span style='color:#FF0000;padding-left:148px ' > Mã bảo vệ chỉ bao gồm ít nhất 5 kí tự!</span>"
			},
			confirm_password: {
				required: "<br><span style='color:#FF0000;padding-left:148px ' >Xin vui lòng nhập lại password !</span>",
				minlength: "<br><span style='color:#FF0000; padding-left:140px;' >Xin vui lòng nhập password có chiều dài hơn 5 ký tự !</span>",
				equalTo: "<br><span style='color:#FF0000; padding-left:148px;' > password không đúng !</span>"
			},
			
			district: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng chọn tỉnh thành phố và quận huyện!</span>"
				
			},
			member: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng chọn kiểu thành viên!</span>"
				
			},
			phone: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập số điện thoại!</span>",
				number: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại chỉ bao gồm các số từ 0 - 9!</span>",
				minlength: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại ít nhất 7 ký tự!</span>",
				maxlength: "<br><span style='color:#FF0000; padding-left:148px;'>Số điện thoại lớn nhất 15 ký tự!</span>"
			},
			
			
		}
	});	
});
jQuery(document).ready(function($){
		$("#register-email").change(function(){
			var email=$("#register-email").val();
			$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'user/ck_mail_register/',
				data: 'email='+email,
				success: function(msg){	
					//alert (msg);	
					$('#validate-emai-register').find('span').remove().end();										
					$('#validate-emai-register').append(msg);					
				}
			});
			
		});
		$("#city").change(function(){			
			
			var citiesId = $("#city").val();			
			
			$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'user/district/',
				data: 'citiesId='+ citiesId ,
				success: function(msg){	
					//alert (msg);	
					$('#district').find('option').remove().end();										
					$('#district').append(msg);					
				}
			});			
			
			});
		
	});
</script>
<style>
  #uploadcontent {
    color: #333333;
    height: 20px;
	float:right;
    width: 372px;
}
#uploadcontent a {
    color: #258294;
    text-decoration: none;
}
</style>

<div id="div-contentcenter">
<div id="div-producttop">
    <div class="div-title-content"><p>ĐĂNG KÝ THÀNH VIÊN</p></div>
    <div class="div-center">
     <div class="text-main">
         <div id="main-register">
             <form method="post" action="<?php echo DOMAIN?>user/add"  id="myform" name="image" enctype="multipart/form-data">
            <center><h2><i>ĐĂNG KÝ THÀNH VIÊN</i></h2></center>
            <div class="content-register" id="email-register">
               <label for="email"><i>Địa chỉ email</i> </label><input id="register-email" class="text-input-register" name="email" type="text" />
               <div id="validate-emai-register"><span id="error"></span></div>
            </div>
            <div class="content-register" id="name-register">
                 <label for="email"><i>Tên đầy đủ </i> </label><input id="name" class="text-input-register" name="name" type="text" />
            </div>
            <div class="content-register"id="pass-register">
               <label for="email"><i>Mật khẩu </i> </label><input id="password" class="text-input-register" name="password" type="password" />
             </div>
            <div class="content-register" id="confirmed-register">
               <label for="confirm_password"><i>Xác nhận mật khẩu </i> </label><input id="confirm_password" class="text-input-register" name="confirm_password" type="password" />
            </div>
            <div class="content-register" id="confirmed-register">
               <label for="email"><i>Chọn ảnh đại diện</i> </label>
                <div id="uploadcontent">
                        <div id="swfu_container">
                            <div>
                                <span id="spanButtonPlaceholder"></span>
                            </div>
                      <div id="divFileProgressContainer">
                            <input type="text" name="images"  readonly="readonly"/><a href="javascript:window.open('<?php echo DOMAIN; ?>liblary/upload_images1.php','new_page','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font>(jpg, jpeg, gif, png)
                            </div>
                            <div id="thumbnails">
                            </div>
                        </div>
                    </div>
            </div> 
            <div class="content-register" id="phone-register">
               <label for="email"><i>Điện thoại  </i> </label><input id="phone" class="text-input-register" name="phone" onkeypress="return keypress(event);" />
             </div>
            <div class="content-register" id="phone-register">
               <label for="email"><i>Ngày sinh</i> </label>
                     <select name="date">
                            <option selected="">--Ngày --</option>
                            <?php for($i=1;$i<=31;$i++ ){?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php }?>
                       </select>
                       <select name="month">
                            <option selected="">--Tháng --</option>
                            <?php for($i=1;$i<=12;$i++){?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php }?>
                       </select>
                       <select name="years">
                            <option selected="">-- Năm --</option>
                            <?php for($i=1950;$i<=date('Y');$i++ ){?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php }?>
                       </select>
             </div> 
             <div class="content-register" id="name-register">
               <label for="email"><i>Giới tính</i> </label>
                 <select size="1" style="width:150px; margin-left:15px;" name="sex" id="sex" title="Giới tính" >
                    <option selected="selected" value="-1" title="- Chọn -">- Chọn -</option>
                    <option value="1" title="Nam">Nam</option>
                    <option value="0" title="Nữ">Nữ</option>
                </select>
             </div>
            <div class="content-register" id="code-register">
               <label for="email"><i>Mã bảo mật   </i> </label><a1 id="abc">
               <img alt="" id="captcha" src="<?php echo DOMAIN?>user/create_image" /></a1>&nbsp;&nbsp;<a href="javascript: reload()"><img src="<?php echo DOMAIN?>images/change-image.gif"/></a>
            </div>
            <div class="content-register" id="privacy-register">
                <label for="email"><i>Nhập vào mã bảo mật   </i> </label><input id="security" class="text-input-register" name="security" />
            </div> 
            <div id="input-register">
                <input class="ok-register" type="image" src="<?php echo DOMAIN?>images/register.png"  name=""  />
                <input class="no-register" id="reset" type="reset" name=""  value=""/>
            </div>
           </form>
        </div>
     </div>
        <div class="clear"></div>
    </div>

</div>
<div class="clear"></div>
</div>