<?php echo $javascript->link('jquery.validate', true); ?>
<script type="text/javascript">
$().ready(function() {
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
				password: {
				required: true,
				minlength: 5
			},
			
			shopname: {
				required: true,
				
			},
			
			agree: "required"
		},
		messages: {
				password: {
				required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập password!</span>",
				minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Password lớn hơn 5 ký tự!</span>"
			},
			
			shopname:{
						required: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;' >Xin vui lòng nhập tên đăng nhập</span> ",
						
			}
		}
	});
});
</script>
<style>
.member_login {
    border: 1px solid #CDCDCD;
    padding: 20px;
    background:#ffffff;
}
h3.page-title, h2.title-backend {
    border-bottom: 1px solid #EA6F1F;
    color: #222222;
    font-size: 18px;
    font-weight: normal;
    margin-bottom: 20px;
    padding-bottom: 8px;
    position: relative;
    text-transform: uppercase;
}
.form-login {
    padding-left: 40px;
}
.boxmodule-cont p, .quick-search-postitem p, .search-model p {
    margin-bottom: 10px;
    position: relative;
}
div.col-regis div.col-430 {
    float: none;
    margin: 0 auto;
    width: 540px;
}
div.col-regis div.col-430 div.boxModule {
    margin-top: 20px;
    padding: 10px 20px;
}
.form-login input {
    float: left;
    margin: 0;
    padding: 3px 0 3px 5px;
    vertical-align: top;
    width: 340px;
}

.clearfix:after, .clear, .clr {
    clear: both;
    content: ".";
    display: block;
    height: 0;
    overflow: hidden;
    visibility: hidden;
}

.hint, .show-log {
    color: #808080;
    font-size: 11px;
}

.form-login label {
    float: left;
    font-weight: bold;
    margin-right: 20px;
    padding-top: 6px;
    text-align: right;
    width: 100px;
}


.form-login .remember-checkbox {
    margin: 0 5px 20px 0;
    width: auto;
}

.form-login input {
    float: left;
    margin: 0;
    padding: 3px 0 3px 5px;
    vertical-align: top;
    width: 340px;
}
.member_login a{
color: #024382;}

.error{width:300px !important;overflow:hidden;
	margin-left:20px;
	
}
</style>

<div id="text-main">
     <div class="text-main">
    <form class="cmxform" id="signupForm" method="POST" action="<?php echo DOMAIN?>login/check_login">
     <div class="member_login">
        <div class="col-regis">
    
            <h3 class="page-title">Đăng nhập hệ thống</h3>
            <p>Nếu bạn đã từng đăng ký thành viên nhưng quên mật khẩu đăng nhập, hãy yêu cầu hệ thống gửi lại <a rel="notfollow" href="">mật khẩu mới</a></p>
            <div class="col-430">
                <div class="boxModule">
                    <div class="boxmodule-cont">
                        <div class="form-login">
                            <input type="hidden" value="1511" name="form_module_id">
                            <p class="clearfix"><label for="">&nbsp;</label><span class="red-bold"></span></p>
                            <p class="clearfix">
                                <label>Tên đăng nhập</label>
                                <input type="text" tabindex="1" style="width: 230px;" name="shopname" class="login-new-input" >
                            </p>
                            <p class="clearfix">
                                <label>Mật khẩu</label>
                                <input type="password" tabindex="2" style="width: 230px;" name="password" class="login-new-input">
                            </p>
                              
                            <p style="width: 360px;" class="clearfix">
                                <label>&nbsp;</label>
                                <input type="checkbox" tabindex="5" name="remember_me" value="" class="remember-checkbox">
                                <span class="show-log">Ghi nhớ mật khẩu (Không check nếu bạn dùng máy tính công cộng)</span></p>
                            <p class="clearfix">
                                <label>&nbsp;</label>
                                <span style="margin-left: 55px;" class="btn-center">
                                	<button type="submit" class="submit-button-orange">Đăng nhập</button>
                                </span>
                                   
                            </p>
                            <p class="clearfix">
                                <label for="">&nbsp;</label>
                                <span style="margin-left: 30px;"><a href="quen-mat-khau.html" class="red-bold">Quên mật khẩu?</a> | <a href="<?php echo DOMAIN;?>dang-ky">Đăng ký mới</a></span>
                                  
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
     </form>    
        
     </div>
</div>