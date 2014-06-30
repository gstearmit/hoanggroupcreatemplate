<?php echo $html->css('login'); ?>
<?php echo $javascript->link('jquery.validate', true); ?>
<script type="text/javascript">
function reload()
{
	var random1= Math.random()*5
	$.ajax({
		type: "GET", 
		url: "<?php echo DOMAIN;?>"+'user/create_image1/'+random1,
		data: null,
		success: function(msg){	
		$('#abc').find('img').remove().end();
		 $('#abc').append('<img alt="" id="captcha" src="<?php echo DOMAIN?>user/create_image1/'+random1+'" />');				
		}
	});	
}
$().ready(function() {
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
				password: {
				required: true,
				minlength: 5,
				maxlength: 5
			},
			
			email: {
				required: true,
				email: true
			},
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"
		},
		messages: {
				password: {
				required: "<br><span style='color:#FFFF00; font-family:Arial, Helvetica, sans-serif; font-size:11px; margin:131px;' >Xin vui lòng nhập mã bảo vệ !</span>",
				minlength: "<br><span style='color:#FFFF00; font-family:Arial, Helvetica, sans-serif; font-size:11px; margin:131px;' >Mã bảo vệ gôm 5 ký tự !</span>",
				maxlength: "<br><span style='color:#FFFF00; font-family:Arial, Helvetica, sans-serif; font-size:11px; margin:131px;' >Mã bảo vệ gôm 5 ký tự !</span>"
			},
			
			email:{
						required: " <br><span style='color:#FFFF00; font-family:Arial, Helvetica, sans-serif; font-size:11px; float:right;padding-right:207px; ' >Xin vui lòng nhập Email</span> ",
                        email: "<br><span style='margin-letf:100px;color:#FFFF00; font-family:Arial, Helvetica, sans-serif; font-size:11px; margin:130px;' > Email không đúng định dạng !"

			}
		}
	});
});
$(document).ready(function(){
	$("#email-forgot-Password").change(function(){
		var email_forgot_password =$("#email-forgot-Password").val();
		//alert (email_forgot_password);
		$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'user/ck_email_forgot_pass/',
				data: 'email_forgot_password='+email_forgot_password,
				success: function(msg){	
					//alert (msg);	
					$('#validate-emai-forgot-Password').find('span').remove().end();										
					$('#validate-emai-forgot-Password').append(msg);					
				}
			});
	});
	$("#security").change(function(){
		var security =$("#security").val();
		//alert (security);
		$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'user/security_forgot_pass/',
				data: 'security='+security,
				success: function(msg){	
					//alert (msg);	
					$('#validate-security-forgot-Password').find('span').remove().end();										
					$('#validate-security-forgot-Password').append(msg);					
				}
			});
	});

});
</script>
 <div class="main-content">
    <div class="title-main"><p>Cấp lại mật khẩu</p></div>
       <div id="text-main">
          <form class="cmxform" id="signupForm" method="POST" action="<?php echo DOMAIN?>user/processor_forgot_password">
            <div id="login-new">
              <div id="login-new-main">
                
                    <p><span style=" color:#FFFF00; ">Bạn hãy nhập địa chỉ email đã dùng để đăng ký tài khoản trên website.</span></p>					
                <div id="login-new-email-forgot"><label>Email</label><input type="text" name="email" class="login-new-input" /></div>
                <div id="login-new-security"><label>Mã bảo vệ</label><a1 id="abc"><img alt="" id="captcha" src="<?php echo DOMAIN?>user/create_image" /></a1>&nbsp;&nbsp;<a href="javascript: reload()"><img src="<?php echo DOMAIN?>images/change-image.gif"/></a></div>
                
                <div id="login-new-forgot-remember"><label style="padding-right:10px;">Nhập vào mã bảo mật</label><input id="security" class="login-new-input" name="password" type="text" />
                <div id="validate-security-forgot-Password"><span id="error"></span></div>
                </div>
                
                <div id="login-new-input-forgot" style="padding-top:15px;">
                    <input type="submit" value="Lấy lại mật khẩu"/>				
                </div>
            </div>	
   			</div>
         </form>
        </div>
     </div>
    
 