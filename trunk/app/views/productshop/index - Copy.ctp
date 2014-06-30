<script language="JavaScript">
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $html->css('classifiedss'); ?>
<?php echo $html->css('theme'); ?>
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div id="title-1">Quản lý tin rao vặt</div>
			
			<div style="float:right; width:130px; padding:20px 10px"><input onclick='setVisibility("j_idt187")' type="submit" value=" Thêm mới "/></div>
			<div style="padding: 10px;">
				<table width="750px" border="0">
					<tr id="title-1">
						<td width="52" style="width:25px;">STT</td>
						<td width="238" style="width:200px;">Tên danh mục</td>
						<td width="119" style="width:50px;">Xử lý</td>
					</tr>
				</table>
			</div>
		<script language="JavaScript">
		function setVisibility(div) {
			var div1 = document.getElementById(div)
			if (div1.style.display == 'none') {
				div1.style.display = 'block'
			} else {
				div1.style.display = 'none'
			}
			}
		</script>
		<div id="j_idt187" class="ui-dialog ui-widget ui-corner-all ui-helper-hidden ui-draggable ui-resizable" style="width: 510px; height: auto; display: none; top: 66px; right: 213px;z-index: 1024; border:1px solid #AED0EA; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;">
			<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix">
				<div style="width:370px; float:left"><span class="ui-dialog-title">Danh mục rao vặt trên Giá Nhanh</span></div>
					<div style="width:4px; float:right"><a href='javascript:setVisibility("j_idt187")'>X</a></div>
				</div>
				<div class="ui-dialog-content ui-widget-content">
				<span id="catTreeArea">
						<div style="padding:5px 0px 10px 0px; ">
							<span class="lbBlue lbBold">Vui lòng chọn danh mục cần đăng sản phẩm.</span>
						</div>
						<div style="height: 240px;width:100%; float: left;">
							<div class="ui-dialog-content ui-widget-content" style="height: auto;">
<form enctype="multipart/form-data" action="<?php echo DOMAIN;?>categorycms/add" method="post" name="updateCatForm" id="updateCatForm">
                            <input type="hidden" value="updateCatForm" name="updateCatForm">
	                    		<div><input type="hidden" value="" name="updateCatForm:updateMessage" id="updateCatForm:updateMessage"><div id="updateCatForm:j_idt197"></div>
								</div>
								
								<table>
								
									<tbody><tr>
										<td class="fieldName">Tên danh mục :</td>
										<td class="fieldValue"><input type="text" style="width:300px" class="textField" name="name" id="updateCatForm:scName">
								  			<div><div id="updateCatForm:j_idt213"></div>
								  			</div>		
										</td>
									</tr>
									
									<tr>
										<td class="fieldName">Thứ tự:</td>
										<td class="fieldValue"><input type="text" style="width:50px" class="textField" name="order" id="updateCatForm:scOrder">
								  			<div><div id="updateCatForm:j_idt222"></div>
								  			</div>		
										</td>
									</tr>
									
									<tr>
										<td class="fieldName">Hiển thị:</td>
										<td class="fieldValue"><input type="checkbox" name="status" id="updateCatForm:showHome">
											<label for="updateCatForm:showHome">Hiển thị trang chủ</label>
											&nbsp;&nbsp;
											<input type="checkbox" name="updateCatForm:showChild" id="updateCatForm:showChild">
											<label for="updateCatForm:showChild">Hiển thị danh mục con</label>
										</td>
									</tr>
									
									<tr>
										<td class="fieldName">Kích hoạt:</td>
										<td class="fieldValue"><input type="checkbox" name="status" id="updateCatForm:valid">
										</td>
									</tr>
								
									<tr>
										<td></td>
										<td><button type="submit" onclick="PrimeFaces.ab({formId:'updateCatForm',source:'updateCatForm:j_idt227',process:'@all',update:'mainForm updateCatForm'});return false;" name=`"updateCatForm:j_idt227" id="updateCatForm:j_idt227" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Thêm mới</span></button>
											&nbsp;
											<button type="submit" onclick="panelUpdate.hide(); return false;;PrimeFaces.ab({formId:'updateCatForm',source:'updateCatForm:j_idt230',process:'@all'});return false;" name="updateCatForm:j_idt230" id="updateCatForm:j_idt230" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Đóng</span></button>
										</td>
									</tr>
								
							</tbody></table>
<input type="hidden" autocomplete="off" value="8256027185883911802:4241455926540200840" id="javax.faces.ViewState" name="javax.faces.ViewState"></form></div> 
						</div> 
				</span>
			</div>
		</div>	
	</div>
</div>