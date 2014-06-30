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
<div id="main-content">
	 
	 <div class="content-top">
	 <?php echo $this->element('menu_top');?>
	 <div class="content-top-body">
	 
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div id="title-1">Danh mục sản phẩm</div>
			
			<div style="float:right; width:130px; padding:20px 10px"><input onclick='setVisibility("j_idt187")' type="submit" value=" Thêm mới "/></div>
			<div style="padding: 10px;">
				<table width="750px" border="0">
					<tr id="title-1">
						<td width="52" style="width:25px;">STT</td>
						<td width="238" style="width:200px;">Tên danh mục</td>
                        <td width="238" style="width:100px;">Thứ tự hiển thị</td>
						<td width="119" style="width:50px;">Xử lý</td>
					</tr>
                    <?php $i=1; foreach($categoryshop as $key =>$value){?>
                    <tr>
						<td width="52" style="width:25px; text-align:center; padding:0px;"><?php echo $i;?></td>
						<td width="238" style="width:200px; text-align:center;"><?php echo $value['Categoryshop']['name'];?></td>
                        <td width="238" style="width:100px; text-align:center;"><?php echo $value['Categoryshop']['order'];?></td>
						<td width="119" style="width:50px; text-align:center; padding:0px;">
                           <a href="<?php echo DOMAIN?>sua-danh-muc/<?php echo $value['Categoryshop']['id'] ?>"><img src="<?php ?>images/pencil.png"/>Sửa</a> <br /> <a href="javascript:confirmDelete('<?php echo DOMAIN?>categoryshops/delete/<?php echo $value['Categoryshop']['id'] ?>')"><img src="<?php ?>images/icon_delete.gif"/>Xóa</a>
                        </td>
					</tr>
                    <?php $i++; }?>
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
				<div style="width:370px; float:left"><span class="ui-dialog-title">Thêm mới danh mục trên HOICHOGIARE</span></div>
					<div style="width:4px; float:right"><a href='javascript:setVisibility("j_idt187")'>X</a></div>
				</div>
				<div class="ui-dialog-content ui-widget-content">
				<span id="catTreeArea">
						<div style="padding:5px 0px 10px 0px; ">
							<span class="lbBlue lbBold">Vui lòng thêm mới danh mục cần đăng sản phẩm.</span>
						</div>
						<div style="height: 240px;width:100%; float: left;">
							<div class="ui-dialog-content ui-widget-content" style="height: auto;">
                                <form enctype="multipart/form-data" action="<?php echo DOMAIN;?>categoryshop/add" method="post" name="updateCatForm" id="updateCatForm">
                                        <input type="hidden" value="updateCatForm" name="updateCatForm">
                                            <div><input type="hidden" value="" name="updateCatForm:updateMessage" id="updateCatForm:updateMessage"><div id="updateCatForm:j_idt197"></div>
                                            </div>
                                            
                                            <table>
                                                <tr>
                                                    <td class="fieldName">Tên danh mục :</td>
                                                    <td class="fieldValue">
                                                      <?php echo $this->Form->input('Categoryshop.name',array('class'=>'textField','label'=>'','style' => 'width:300px;','id' => 'updateCatForm:scName'));?>
                                                        <div><div id="updateCatForm:j_idt213"></div>
                                                        </div>		
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fieldName">Tên danh mục :</td>
                                                    <td class="fieldValue">
                                                        <?php echo $form->select('Categoryshop.parent_id', $list_cat, null,array('empty'=>'Chọn danh mục','class'=>'small-input')); ?>
                                                        <div><div id="updateCatForm:j_idt213"></div>
                                                        </div>		
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fieldName">Thứ tự:</td>
                                                    <td class="fieldValue">
                                                     <?php echo $this->Form->input('Categoryshop.order',array('class'=>'textField','label'=>'','style' => 'width:50px;','id' => 'updateCatForm:scOrder'));?>
                                                        <div><div id="updateCatForm:j_idt222"></div>
                                                        </div>		
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fieldName">Kích hoạt:</td>
                                                    <td class="fieldValue">
                                                      <?php echo $form->radio('Categoryshop.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                                                 
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <td></td>
                                                    <td><button type="submit" onclick="PrimeFaces.ab({formId:'updateCatForm',source:'updateCatForm:j_idt227',process:'@all',update:'mainForm updateCatForm'});return false;" name=`"updateCatForm:j_idt227" id="updateCatForm:j_idt227" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Thêm mới</span></button>
                                                        &nbsp;
                                                        <div style="background: none repeat scroll 0 0 #E2E2E2; border: 1px solid #AED0EA; border-radius: 6px 6px 6px 6px; color: #4C4C4C; padding-bottom: 3px; padding-top: 3px; text-align: center; float: right;margin-right: 180px; width: 60px;"><a href='javascript:setVisibility("j_idt187")'> Đóng </a></div>
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
	 
	 
	 		
	</div><!-- End content-top-body -->
	</div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->




