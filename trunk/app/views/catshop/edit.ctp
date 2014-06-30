<?php echo $html->css('classifiedss'); ?>
<?php echo $html->css('theme'); ?>
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div id="title-1">Danh mục sản phẩm</div>
			<div style="padding: 10px;">
				<form enctype="multipart/form-data" action="<?php echo DOMAIN;?>categoryshop/edit" method="post" name="updateCatForm" id="updateCatForm">
                    <table>
                       <tr>
                            <td class="fieldName">Tên danh mục :</td>
                            <td class="fieldValue">
                              <?php echo $this->Form->input('Categoryshop.name',array('class'=>'textField','label'=>'','style' => 'width:300px;','id' => 'updateCatForm:scName'));?>
                               <?php echo $this->Form->input('Categoryshop.id',array());?>
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
                            <td class="fieldValue">
                              <?php echo $form->radio('Categoryshop.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                         
                            </td>
                        </tr>
                    
                        <tr>
                            <td></td>
                            <td><button type="submit" onclick="PrimeFaces.ab({formId:'updateCatForm',source:'updateCatForm:j_idt227',process:'@all',update:'mainForm updateCatForm'});return false;" name=`"updateCatForm:j_idt227" id="updateCatForm:j_idt227" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"> Sửa </span></button>
                                &nbsp;
                                <button type="submit" onclick="panelUpdate.hide(); return false;;PrimeFaces.ab({formId:'updateCatForm',source:'updateCatForm:j_idt230',process:'@all'});return false;" name="updateCatForm:j_idt230" id="updateCatForm:j_idt230" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Đóng</span></button>
                            </td>
                        </tr>
                    
                  </table>
				</form>
			</div>
		
	</div>
</div>