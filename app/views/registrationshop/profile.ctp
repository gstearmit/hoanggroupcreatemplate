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
.ui-widget {
    color: #333333;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    line-height: 18px;
}
.right tr .td_l{
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: -moz-use-text-color -moz-use-text-color lightgrey;
    border-style: none none dotted;
    border-width: medium medium 1px;
    font-weight: bold;
    width: 130px;
	 padding: 5px;
}
.right tr .td_r{
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: -moz-use-text-color -moz-use-text-color lightgrey;
    border-style: none none dotted;
	padding: 5px;
    border-width: medium medium 1px;
}
</style>
<form method="post" action="<?php echo DOMAIN?>registrationshop/add"  id="myform" name="image" enctype="multipart/form-data">
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
        <div class="ui-widget-header">Đăng ký mở gian hàng</div>
		<div style="padding-left: 10px;padding-right: 10px; padding-top:10px;">
            
            <table class="merInfo" width="100%">
                <tr>
                   <td colspan="2" style="border-bottom:1px solid lightgrey; font-weight:bold; padding-bottom:2px;">Đăng ký mở gian hàng</td>
                </tr>
                <tr>
                    <td class="td_l" style="padding-top:20px;">
                        Địa chỉ gian hàng 
                    </td>
                    <td class="td_r">
                        <span class="lbBold"><a target="_blank" href="<?php echo DOMAIN;?><?php echo $edit['Shops']['name'];?>"><?php echo DOMAIN;?><?php echo $edit['Shops']['name'];?></a></span>
                    </td>
                </tr>
                <tr>
                    <td  class="td_l" >
                        Lĩnh vực kinh doanh 
                    </td>
                    <td class="td_r">
                        <span class="lbBold"><?php echo $edit['Shops']['business'];?></span>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        Tỉnh/TP
                    </td>
                    <td class="td_r">
                        <?php echo $edit['Shops']['city'];?>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        Tên công ty
                    </td>
                    <td class="td_r">
                        <?php echo $edit['Shops']['namecompany'];?>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        Địa chỉ
                    </td>
                    <td class="td_r">
                        <?php echo $edit['Shops']['address'];?>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        Điện thoại di động
                    </td>
                    <td class="td_r">
                        <?php echo $edit['Shops']['phone'];?>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        Điện thoại cố định
                    </td>
                    <td class="td_r">
                        <?php echo $edit['Shops']['mobile'];?>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        Fax
                    </td>
                    <td class="td_r">
                        <?php echo $edit['Shops']['fax'];?>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        Email liên hệ
                    </td>
                    <td class="td_r">
                        <?php echo $edit['Shops']['name'];?>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        Website
                    </td>
                    <td class="td_r">
                        <?php echo $edit['Shops']['link'];?>
                    </td>
                </tr>
                <tr>
                    <td class="td_l" >
                        
                    </td>
                    <td class="td_r">
                        <span id="nav"><a class="ui-commandlink icon_edit" href="<?php echo DOMAIN;?>thay-doi-thong-tin" id="merchantInfo:j_idt249">Thay đổi thông tin</a>
								</span>
                    </td>
                </tr>
            </table>
        </div>
	</div>
	<div class="clr"></div>
</div>
</form>
