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
        <div class="ui-widget-header">Trang thành viên</div>
		<div style="padding-left: 10px;padding-right: 10px; padding-top:10px;">
             <div style="border-bottom:1px solid lightgrey; font-weight:bold; padding-bottom:2px;">Chọn theme gian hàng:</div>
             <div class="ui-datagrid ui-widget" id="mainForm:themeList">
                <div class="ui-datagrid-content" id="mainForm:themeList_content" style="padding-top:20px;">
                   <table class="ui-datagrid-data">
             			<tr class="ui-datagrid-row">
                            <td class="ui-datagrid-column">
                                    <table>
                                        <tr>
                                            <td width="5%">
                                                    <input type="radio" value="team_1" name="themeRadio" id="themeRadio">
                                            </td> 
                                            <td width="95%">
                                               <p><img width="180" height="180" src="<?php echo DOMAIN;?>images/themes/1.jpg"></p>
                                               <p style="text-align:center; font-weight:bold; padding-top:5px;">Giao diện 1</p>
                                            </td>
                                        </tr>
                                    </table>
                               </td>
                            <td class="ui-datagrid-column">
                                    <table>
                                        <tr>
                                            <td width="5%">
                                                    <input type="radio" value="team_2" name="themeRadio" id="themeRadio">
                                            </td> 
                                            <td width="95%">
                                               <p><img width="180" height="180" src="<?php echo DOMAIN;?>images/themes/2.jpg"></p>
                                               <p style="text-align:center; font-weight:bold; padding-top:5px;">Giao diện 2</p>
                                            </td>
                                        </tr>
                                    </table>
                               </td>
                            <td class="ui-datagrid-column">
                                    <table>
                                        <tr>
                                            <td width="5%">
                                                    <input type="radio" value="team_3" name="themeRadio" id="themeRadio">
                                            </td> 
                                            <td width="95%">
                                               <p><img width="180" height="180" src="<?php echo DOMAIN;?>images/themes/4.jpg"></p>
                                               <p style="text-align:center; font-weight:bold; padding-top:5px;">Giao diện 3</p>
                                            </td>
                                        </tr>
                                    </table>
                               </td>
                          </tr>
                     </table>
                 </div>
                 <div style="padding-top:30px; padding-left:10px; padding-bottom:20px;"> <input type="submit" name="btsub" value="Đăng ký" /></div>
              </div>
        </div>
	</div>
	<div class="clr"></div>
</div>
</form>
