<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">  
        
        <h3>Catalog</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Sửa</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'catalog/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tiêu đề (VN)</label>
                           <?php echo $form->input('Catalog.title',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Tiêu đề (ENG)</label>
                           <?php echo $form->input('Catalog.title_eg',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
					
					<p>
                        <label>Ảnh đại diện</label>
                        <input type="text" size="80" style="height:25px;" name="userfile"  value="<?php echo $edit['Catalog']['images']?>"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic1.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
					
                     <p>
                        <label>Sách download</label>
                   <input type="text" size="80" style="height:25px;" name="pdffile"  value="<?php echo $edit['Catalog']['link']?>"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_file.php','pdffile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(doc, pdf , docx)    </p>
                    
                    <p>

                    
                    <p>
                        <label>Trạng thái</label>
                         <?php echo $form->radio('Catalog.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>  
                         <?php echo $form->input('Catalog.id',array('label'=>''));?>
                    </p>
                    <p>
                        <input class="button" type="submit" value=" Sửa " />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>