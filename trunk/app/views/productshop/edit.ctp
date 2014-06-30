<?php echo $html->css('classifiedss'); ?>
<?php echo $html->css('theme'); ?>
<div id="leftraovat">
<div id="classifiedsadd" style="border: none;">

	<div id="j_idt143">
		<div id="j_idt143_header" class="ui-panel-titlebar ui-widget-header ui-corner-all">
			<span class="ui-panel-title">Cập nhật sản phẩm</span>
		</div>
		<div id="j_idt143_content" class="ui-panel-content ui-widget-content"> 
            <?php echo $form->create(null, array( 'url' => DOMAIN.'productshop/edit','type' => 'post','enctype'=>'multipart/form-data','id'=>'check_form','name'=>'image')); ?>       
				<input type="hidden" name="category_id" value="<?php echo $nameproduct['Category']['id']; ?>" /> 
					<table width="100%" border="0" style="padding-top:15px;">
					   <tr>
							 <td><label>Tên sản phẩm</label><span class="lbRed">(*)</span>:
							 </td>
							 <td valign="top" width="80%" class="fieldValue">
							     <span id=":raovatArea">
                                     <?php echo $this->Form->input('Productshop.title',array('class'=>'validate[required] title-raovat','label'=>'','style' => 'font-weight: bold;'));?>
                                     <?php echo $this->Form->input('Productshop.id',array('class'=>'title-raovat','label'=>''));?>
                                 </span>  
							 </td>
					   </tr>
                       <tr>
                             <td><label>Danh mục sản phẩm</label><span class="lbRed">(*)</span>:</td>
                             <td valign="top" width="80%" class="fieldValue">
                                 <span id=":raovatArea">
                                     <?php echo $this->Form->input('categoryshop_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','style'=>'width:200px;height:25px;','label'=>'','class'=>'validate[required]'));?>
                                     
                                 </span>  
                             </td>
					   </tr>
					   <tr>
						 <td valign="top" class="fieldName lbGrey lbBold" style="padding-right: 5px;"><label>Upload ảnh</label><span class="lbRed">(*)</span>: 
						</td>
						 <td valign="top" class="fieldValue">                         	  	 
							   <p> 
									  <input type="text" readonly="true" size="60" class="validate[required]" style="height:18px;" name="userfile" value="<?php echo $edit['Productshop']['images']?>"/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAIN; ?>upload_pic_shop.php?id=<?php echo $nameshop[0]['Shop']['name']?>','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
								</p>
						  </td>
					   </tr>
                       <tr>
                         <td width="20%" class="fieldName lbGrey lbBold" valign="top">Nhập hãng sản xuất:</td>
                         <td width="80%" align="left" class="fieldValue" style="height: 25px;">
                         <span id="updateProdForm:chooseManufacture" class="ui-autocomplete" style="width: 200px;">
                         <?php echo $this->Form->input('Productshop.maker',array('class'=>'ui-autocomplete-input ui-inputfield ui-widget ui-state-default','label'=>'','style' => 'font-weight: bold;','id'=>'updateProdForm:chooseManufacture_inpu'));?>
                         </span><div id="updateProdForm:j_idt220"></div>
                         </td>
                       </tr>
					   <tr>
						 <td class="fieldName lbBold lbGrey"><label>Giá</label><span class="lbRed"></span>:</td>
						 <td class="fieldValue">
                            <?php echo $this->Form->input('Productshop.price',array('class'=>'textField textField100','label'=>'','style' => 'font-weight: bold;'));?>
							<select size="1" name="money" style="width: 70px;font-weight: bold;">
							<option value="VND">VND</option>
							<option value="USD">USD</option>
							</select>
						 </td>
					   </tr> 
					   <tr>
                         <td valign="top" class="fieldName lbGrey lbBold">Trong kho<span class="lbRed">(*)</span>:</td>
                         <td class="fieldValue">
                            <?php echo $this->Form->input('Productshop.number',array('class'=>'validate[required] textField textField100','label'=>'','style' => 'font-weight: bold;'));?>
                            
							 &nbsp;
							 <div id="updateProdForm:j_idt235"></div>
						 </td>
                       </tr>
                       <tr>
                         <td valign="top" class="fieldName lbGrey lbBold">Chất lượng:</td>
                         <td class="fieldValue">
                         <select style="width: 150px;font-weight: bold;" size="1" name="quality">	
                                <option value="Vui lòng liên hệ">Vui lòng liên hệ</option>
                                <option selected="selected" value="Mới">Mới</option>
                                <option value="Đã qua sử dụng">Đã qua sử dụng</option>
                          </select>
                          
						 </td>
                       </tr>
                       <tr>
                         <td valign="top" class="fieldName lbGrey lbBold">Xuất xứ:</td>
                         <td class="fieldValue">
                            <?php echo $this->Form->input('Productshop.made',array('class'=>'textField textField100','label'=>'','style' => 'font-weight: bold;'));?>
							 &nbsp;
							 <div id="updateProdForm:j_idt243"></div>
						 </td>
                       </tr>
                       <tr>
                         <td valign="top" class="fieldName lbGrey lbBold">Bảo hành:</td>
                         <td class="fieldValue">
                             <?php echo $this->Form->input('Productshop.warranty',array('class'=>'textField textField100','label'=>'','style' => 'font-weight: bold;','id'=>'updateProdForm:scpWarrantyMonth'));?>
							 &nbsp;
							 <div id="updateProdForm:j_idt246"></div>
						 </td>
                       </tr>
                       <tr>
                         <td valign="top" class="fieldName lbGrey lbBold">Link sản phẩm:</td>
                         <td class="fieldValue">
                           <?php echo $this->Form->input('Productshop.link',array('class'=>'textField','label'=>'','value'=>'http://','style' => 'font-weight: bold; width: 331px;','id'=>'updateProdForm:website'));?>
							 <div class="lbGrey">
							 	<i>(Link đến sản phẩm này trên website của bạn)</i>
							 </div><div id="updateProdForm:j_idt249"></div>
						 </td>
                       </tr>
					   <tr>
						 <td class="fieldName">
							<span class="lbBold lbGrey"><label>Nội dung</label><span class="lbRed">(*)</span>:</span><br />
						 </td>
						 <td class="fieldValue">
							<div style="background-color: white;">
                                 <?php echo $this->Form->textarea('Productshop.content',array('class'=>'validate[required]','label'=>'','style' => 'width: 550px; height: 300px;','id'=>'myArea1'));?>
							</div>
							<?php echo $javascript->link('nicEdit-latest', true); ?> 
                            <script type="text/javascript">
                            //<![CDATA[
                            var area1, area2;
                             
                            function toggleArea1() {
                            if(!area1) {
                            area1 = new nicEditor({fullPanel : true}).panelInstance('myArea1',{hasPanel : true});
                            } else {
                            area1.removeInstance('myArea1');
                            area1 = null;
                            }
                            }
                             
                            function addArea2() {
                            area2 = new nicEditor({fullPanel : true}).panelInstance('myArea2');
                            }
                            function removeArea2() {
                            area2.removeInstance('myArea2');
                            }
                             
                            bkLib.onDomLoaded(function() { toggleArea1(); });
                            //]]>
                            </script>	

						 </td>
					   </tr>   
                       <tr>
                         <td valign="top" class="fieldName lbGrey lbBold">Khuyến mãi:</td>
                         <td class="fieldValue">
                           <?php echo $this->Form->textarea('Productshop.promotion',array('class'=>'textField','label'=>'','style' => 'width: 546px;height: 30px;','id'=>'updateProdForm:scpProductDes'));?>
                         <div id="updateProdForm:j_idt258"></div>
						 </td>
                       </tr>                       
					   <tr>
						 <td align="left"></td>
						 <td><input onclick="removeArea2();" type="submit" name="save" value="Lưu rao vặt"/>
						 </td>
					   </tr>
				  </table> 
			<?php echo $form->end(); ?>
		</div>
	</div>
</div> 
</div> 
<div id="rightraovat">
<?php echo $this->element('rightraovat');?>
</div>