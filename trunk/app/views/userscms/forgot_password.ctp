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

.right table span{
	padding-left:0px !important;
	padding-top:4px;
	}
.error{
	padding-left:30px;
	}
</style>
<script type="text/javascript">
function reload()
{
	var random1= Math.random()*5
	$.ajax({
		type: "GET", 
		url: "<?php echo DOMAIN;?>"+'userscms/create_image1/'+random1,
		data: null,
		success: function(msg){	
		$('#abc').find('img').remove().end();
		 $('#abc').append('<img alt="" id="captcha" src="<?php echo DOMAIN?>user/create_image1/'+random1+'" />');				
		}
	});	
}

</script>

<div class="member_register">
	<?php echo $this->element('contactleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
        <div class="ui-widget-header">Cấp lại mật khẩu</div>
		<div style="padding-left: 10px;padding-right: 10px; padding-top:10px;">
            <div style="border-bottom:1px solid lightgrey; font-weight:bold; padding-bottom:2px;">Bạn hãy nhập địa chỉ email đã dùng để đăng ký tài khoản trên website.</div>
             <div id="container">
               <form id="myform" method="POST" action="<?php echo DOMAIN?>userscms/processor_forgot_password">
                     <div id="text-news">
                        <table width="400" align="center" style="padding-top:20px;">
                            <tr>
                                <td align="left" width="30%" valign="top" style="padding-top:6px;">
                                    Địa chỉ email <font color="red">(*)</font>
                                </td>
                                <td align="left" width="70%">
                                    <input type="text" id="register-email" class="text-input-register textField" name="email" style="width:200px;" class="login-new-input">
                                </td>
                            </tr>
                        </table>
                        <table width="400" align="center" style="padding-top:15px;">
                            <tr>
                                <td align="left" width="150">
                                    Nhập mã an toàn 
                                    <input type="text" style="width: 100px; margin-left:21px;" class="textField" name="security" id="security">
                                </td>	
                                <td align="left" width="100">
                                  <a id="abc">
                                   <img alt="" id="captcha" src="<?php echo DOMAIN?>userscms/create_image" /></a1>&nbsp;&nbsp;<a href="javascript: reload()"><img src="<?php echo DOMAIN?>images/change-image.gif"/>
                                 </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <br />
                                    <input type="submit" name="btsub" value=" Chấp nhận " />
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
             </div>
           </div>
        </div>
	</div>
	<div class="clr"></div>
</div>

