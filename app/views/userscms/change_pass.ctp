<script>
jQuery(document).ready(function($) {

	
	$("#password_old").change(function(){
		var password1=$("#password_old").val();
		
		$.ajax({
			type: "GET", 
			url: "<?php echo DOMAIN;?>"+'usercms/check_password/',
			data: {password:password1,
				

			},

			
			success: function(msg){	
				alert (msg);	
				if(msg=='true'){
					nameInfo.text("Đúng");
					return false;
					}
					else {
						nameInfo.text("Sai pass");
					return true;
					}
				
				$('.password-error').find('span').remove().end();										
				$('.password-error').append(msg);		
				
			}
		});
		
	});


	
$("#myform3").validate({
	rules: {

		password_old: {
			required: true,
			minlength: 5,
			
		},
		password: {
			required: true,
			minlength: 5
		},
		confirm_password: {
			required: true,
			minlength: 5,
			equalTo: "#password"
		}
		
		
	
	},
	messages: {

		password_old: {
			required: "<br><span style='color:#FF0000; ' >Xin vui lòng nhập password cũ !</span>",
			minlength: "<br><span style='color:#FF0000; ' > Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>",
		
		},

		password: {
			required: "<br><span style='color:#FF0000; ' >Xin vui lòng nhập password mới !</span>",
			minlength: "<br><span style='color:#FF0000; ' > Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>"
		},
		
		confirm_password: {
			required: "<br><span style='color:#FF0000;px ' >Xin vui lòng nhập lại password mới !</span>",
			minlength: "<br><span style='color:#FF0000; ' >Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>",
			equalTo: "<br><span style='color:#FF0000;' > Password không giống ở trên !</span>"
		}
		
	
		
	}
});	

});	
</script>


<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/new.css"/>


<div id='body'>
        <div id='slide'>
       
            <img src="<?php echo DOMAIN?>images/slide.jpg" alt="">
            
        </div>
       <?php echo $this->element('menu_top');?>
       
     
    
    <div id="main-center">
<div id="sanphams" style="min-height: 500px !important;">
<div class="tieude">
<p> Đổi mật khẩu</p></div>


<div class="left">
<ul>
<li><a href="<?php echo DOMAIN?>thong-tin-tai-khoan">Thông tin tài khoản</a></li>
<li><a href="<?php echo DOMAIN?>thong-tin-don-hang">Thông tin đơn hàng</a></li>



<li  class="li-chon"><a href="<?php echo DOMAIN?>doi-mat-khau">Đổi mật khẩu</a></li>


</ul>

</div><!-- End left -->


<div class="right">
<div class="div-ttkh">


	
	<form  action="<?php echo DOMAIN?>userscms/ck_change_pass" method="POST" name="myform" id="myform3">
	<table class="tb3">
	<tr>
	<td width="150px;" style="text-align:right;padding-top:10px;padding-right:5px;">Mật khẩu cũ:</td>
	<td> <input class="text" id="password_old" name="password_old"  type="password"/>
	<span id="nameInfo"></span>
	<div class="password-error"><span id="error"></span></div>
	</td>
	<td style="text-align:right;"></td>
	
	</tr>
	
	
	<tr>
	<td width="150px;" style="text-align:right;padding-right:5px;">Mật khẩu mới:</td>
	<td colspan="2">
	<input class="text" name="password" type="password" id="password"/>
	</td>
	
	
	</tr>
	
	<tr>
	<td width="150px;" style="text-align:right;padding-right:5px;">Nhập lại mật khẩu mới:</td>
	<td colspan="2">
	<input class="text" name="confirm_password" type="password"/>
	</td>
	
	
	</tr>
	
	
	
	<input type="hidden" name="email" value="<?php echo  $user['Userscms']['email'];?>" />
	<input type="hidden" name="id" value="<?php echo  $user['Userscms']['id'];?>" />
	<tr>
	<td colspan="3"><input type="submit" value="Cập nhật" class="capnhat"/></td>
	</tr>

	</table>
	
	</form>

	</div>


</div><!-- End right -->

</div>
</div>

    <div style="width:20px;"></div>
</div>

