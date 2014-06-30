<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<script language="javascript">
function check()
{
	
var i=0;
var strtopic=document.myform.txtTopic.value;
//Check noi dung
var kiemtra=0;
var i=0;
if(strheader == 0)
if(strheader.substring(i,i+1)== " ")
while(strheader.substring(i,i+1)== " ")
{
alert("Kí tự đầu tiên không được nhập khoảng trắng !!!");
document.form1.txtHeader.focus();
return false;
}
i++;
for(i=0;i<strheader.length;i++)
{
if(strheader.length< 5)
{
alert("Nội dung ít nhất là 5 kí tự !!!!");
alert("Xin nhập lai ^_^ ");
document.myform.txtHeader.focus();
return false;
}
//Xử lý khoảng trắng giữa chuỗi
if(strheader.substring(i,i+1)==" " && strheader.substring(i+1,i+2)== " ")
{
alert("Khoảng trắng tối đa là 1 kí tự !!!")
alert("Xin nhập lai ???");
document.form1.txtHeader.focus();
return false;
}
continue;

}
return true;

}
</script>
<script>
function reload()
{
	var random1= Math.random()*5
	jQuery.ajax({
		type: "GET", 
		url: "<?php echo DOMAIN;?>"+'userscms/create_image1/'+random1,
		data: null,
		success: function(msg){	
		jQuery('#abc').find('img').remove().end();
		 jQuery('#abc').append('<img alt="" id="captcha" src="<?php echo DOMAIN?>userscms/create_image1/'+random1+'" />');				
		}
	});	
}
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
.error span{
	padding-left:0px !important;
	
	}
</style>
 <?php echo $form->create(null, array( 'url' => DOMAIN.'registrationshop/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image','id'=>'myform')); ?> 
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
        <div class="ui-widget-header">Giới thiệu về công ty</div>
		<div style="padding-left: 10px;padding-right: 10px; padding-top:10px;">
            <?php foreach($edit as $edit){?>
            <table>
               
                <tr>
                    <td align="left" width="30%" valign="top" style="padding-top:20px;">
                        Địa chỉ gian hàng <font color="red">(*)</font>
                    </td>
                    <td align="left" width="70%" style="padding-top:20px;">
                        <p class="lbBold"><a target="_blank" href="<?php echo DOMAIN;?><?php echo $edit['Shops']['name'];?>"><?php echo DOMAIN;?><?php echo $edit['Shops']['name'];?></a>
                        </p>
                         <div style="float:right; padding-right: 55px;" id="validate-usershop-register"><span id="error"></span></div>
                        
                        <div><span id="mainForm:validateNickName"><div id="mainForm:nickName1"></div>
                        <span class="lbComment">Địa chỉ gian hàng phải là các ký tự 0-9,a-z.</span>
                        <span class="lbComment"> - Ví dụ: nếu tên công ty của bạn là Hưng Phong, bạn nên chọn Địa chỉ gian hàng: hungphong</span></span>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td align="left">
                        Logo công ty
                    </td>
                    <td>
                       <p> 
                             <input type="text" readonly="true" size="60" style="height:18px;" name="userfile"  value=""/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Lĩnh vực kinh doanh 
                    </td>
                    <td>
                        <textarea style="width:400px;height:50px;" rows="3" cols="50"  name="business" id="mifield">
                         <?php echo $edit['Shops']['business'];?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Giới thiệu về công ty
                    </td>
                    <td>
                       <?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Shops.content',array('toolbar'=>'extra','height'=>'300px','width'=>'550','id'=>'myArea1','class'=>'validate[required]','name'=>'content')); ?>
                        
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
                        <input type="text" style="width:400px;" class="textField" name="namecompany" value="<?php echo $edit['Shops']['namecompany'];?>" id="micompanyname">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Địa chỉ<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:400px;" class="textField" value="<?php echo $edit['Shops']['address'];?>"  name="address" id="miaddress">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Điện thoại di động<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:200px; " value="<?php echo $edit['Shops']['phone'];?>" class="textField" name="phone" id="miphone">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Điện thoại cố định<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:200px;" class="textField" value="<?php echo $edit['Shops']['mobile'];?>" name="mobile" id="mitell">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Fax
                    </td>
                    <td>
                        <input type="text" style="width:200px;" value="<?php echo $edit['Shops']['fax'];?>" class="textField" name="fax" id="mifax">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Email liên hệ<font color="red">(*)</font>
                    </td>
                    <td>
                        <input type="text" style="width:200px;" class="textField" value="<?php echo $edit['Shops']['email'];?>"  name="email" id="miemail">
                        <input type="hidden" value="<?php echo $edit['Shops']['id'];?>"  name="id" >
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        Website
                    </td>
                    <td>
                        <input type="text" style="width:200px;" value="<?php echo $edit['Shops']['link'];?>" class="textField" name="link" id="miweb" value="http://">
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
            <?php }?>
        </div>
	</div>
	<div class="clr"></div>
</div>
</form>