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
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div id="title-1">Quản lý banner</div>
			<div style="padding: 10px;">
               <p style="float:right; padding-right:20px; padding-bottom:15px;"><a href="<?php echo DOMAIN;?>banner/add"><input onclick="removeArea2();" type="submit" name="save" value="Cài đặt"/></a></p>
				<table width="750px" border="0">
					<tr id="title-1">
						<td style="width:7px;">STT</td>
						<td style="width:60px;">Ảnh đại diện</td>
						<td style="width:50px;">Xử lý</td>
					</tr>
					<?php $i = 1; foreach($banner as $Banner){?>
					<tr>
						<td align="center" style="text-align:center;"><?php echo $i; ?></td>
						<td align="center" style="text-align:center; width:90px;">
                           <div id="img-gian-hang">
				  			<img width="80" height="" src="<?php echo DOMAIN;?><?php echo $Banner['Banner']['images'];?>"/>
                            </div>
						</td>
						<td align="center" style="text-align:center;">
                          <a href="<?php echo DOMAIN?>banner/edit/<?php echo $Banner['Banner']['id'] ?>"><img src="<?php ?>images/pencil.png"/>Sửa</a><br />
                          <a href="javascript:confirmDelete('<?php echo DOMAIN?>banner/delete/<?php echo $Banner['Banner']['id'] ?>')"><img src="<?php ?>images/icon_delete.gif"/>Xóa</a>
                        </td>
					</tr>
					<?php $i++; } ?>
					
				</table>
			</div>
	</div>
</div>