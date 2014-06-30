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
.error span{
	padding-left:0px !important;
	
	}
</style>
<form method="post" action="<?php echo DOMAIN?>registrationshop/add"  id="myform" name="image" enctype="multipart/form-data">
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
        <div class="ui-widget-header">Đăng ký mở gian hàng</div>
		<div style="padding-left: 10px;padding-right: 10px; padding-top:10px;">
            
            <table>
                <tr>
                   <td colspan="2" style="border-bottom:1px solid lightgrey; font-weight:bold; padding-bottom:2px;">Đăng ký mở gian hàng</td>
                </tr>
                <tr>
                    <td align="left" width="30%" valign="top" style="padding-top:20px;">
                        Địa chỉ gian hàng <font color="red">(*)</font>
                    </td>
                    <td align="left" width="70%" style="padding-top:20px;">
                        <span class="lbBold">http://vinamax.com.vn/</span><input type="text" class="textField" value="<?php echo $this->Session->read('slug');?>" name="tengianhang" id="register-usershop" style="width:150px;" class="text-input-register textField">

                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Lĩnh vực kinh doanh 
                    </td>
                    <td>
                        <textarea style="width:400px;height:50px;" rows="3" cols="50" name="business" id="mifield"></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Tỉnh/TP<font color="red">(*)</font>
                    </td>
                    <td>
                        <select name="city" id="miprovince">
                            <option value=""> -- Chọn tỉnh -- </option>
                            <?php foreach($city as $citys){?>
                             <option value="<?php echo $citys['City']['id'];?>"><?php echo $citys['City']['name'];?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Tên công ty<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:400px;" class="textField" name="namecompany" id="micompanyname">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Địa chỉ<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:400px;" class="textField" name="address" id="miaddress">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Điện thoại di động<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:200px;" class="textField" name="phone" id="miphone">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Điện thoại cố định<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:200px;" class="textField" name="mobile" id="mitell">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Fax
                    </td>
                    <td>
                        <input type="text" style="width:200px;" class="textField" name="fax" id="mifax">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Email liên hệ<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:200px;" class="textField" name="email" id="miemail">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Website
                    </td>
                    <td>
                        <input type="text" style="width:200px;" class="textField" name="link" id="miweb" value="http://">
                    </td>
                </tr>
            </table>
            <br /><br /><br /><br />
            <table width="400" align="center">
                <tr>
                    <td colspan="2">
                    <p><input type="checkbox" name="mainForm:agreeTerm" id="mainForm:agreeTerm"> Chấp nhận các điều khoản về thành viên trên VinaMax </p>
                    <p style="padding-left:20px; padding-top:5px;">
                    (<a href="/pages/help/memberPolicy.page" target="_blank">Xem điều khoản thành viên</a>)
                    </p>
                    </td>
                </tr>
                <tr>
                    <td align="left" width="120">
                        Nhập mã an toàn 
                        <input type="text" style="width: 100px;" class="textField" name="security" id="security">
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
                        <input type="submit" name="btsub" value="Đăng ký" />
                    </td>
                </tr>
            </table>
        </div>
	</div>
	<div class="clr"></div>
</div>
</form>
