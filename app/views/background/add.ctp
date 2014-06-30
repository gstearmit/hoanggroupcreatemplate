
<?php echo $html->css('classifiedss'); ?>
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
        <div id="title-1">Cài đặt Background</div>
			<div>
             <?php echo $form->create(null, array( 'url' => DOMAIN.'background/add','type' => 'post','enctype'=>'multipart/form-data','id'=>'check_form','name'=>'image')); ?>       
                <table width="100%" border="0" style="padding-top:15px;">
					   <tr>
                             <td class="fieldName lbGrey lbBold"><label>Background</label><span class="lbRed">(*)</span>:</td>
                             <td valign="top" width="80%" class="fieldValue">
                                 <span id=":raovatArea">
                                     <?php echo $this->Form->input('Background.name',array('class'=>'validate[required] title-raovat','label'=>'','style' => 'font-weight: bold;'));?>
                                 </span>  
                             </td>
					   </tr>
                       <tr>
                             <td class="fieldName lbGrey lbBold"><label>Màu Background</label></td>
                             <td valign="top" width="80%" class="fieldValue">
                                 <span id="jPicker">
                                     <?php echo $this->Form->input('Background.color',array('class'=>'title-raovat','label'=>'','id' => 'Binded','value'=>'#fff'));?>
                                 </span>
                             </td>
					   </tr>
					   <tr>
						 <td valign="top" class="fieldName lbGrey lbBold" style="padding-right: 5px;"><label>Upload ảnh</label>
						</td>
						 <td valign="top" class="fieldValue">                         	  	 
							   <p> 
								  <input type="text" readonly="true" size="60" style="height:18px;" name="userfile"  value=""/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAIN; ?>upload_pic_shop.php?id=<?php echo $nameshop[0]['Shop']['name']?>','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
								</p>
						  </td>
					   </tr>
					   <tr>
						 <td align="left"></td>
						 <td><input onclick="removeArea2();" type="submit" name="save" value="Cài đặt"/>
						 </td>
					   </tr>
				  </table>
                  <?php echo $form->end(); ?>
            </div>
			
	    </div>
   </div>