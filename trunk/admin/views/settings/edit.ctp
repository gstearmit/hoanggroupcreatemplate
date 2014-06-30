<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>


<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Cấu hình website</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Cấu hình</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'settings/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tên công ty</label>
                           <?php echo $form->input('Setting.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                 
                    <p>
                        <label>Địa chỉ</label>
                           <?php echo $form->input('Setting.address',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                   
                    <p>
                        <label>Điện thoại</label>
                            <?php echo $form->input('Setting.phone',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Di động</label>
                           <?php echo $form->input('Setting.mobile',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                     <p>
                        <label>Fax</label>
                           <?php echo $form->input('Setting.fax',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                    <p>
                        <label>Email</label>  
                          <?php echo $form->input('Setting.email',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>link website</label>  
                          <?php echo $form->input('Setting.url',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Title (tiêu đề website)</label>
                       <?php echo $form->input('Setting.title',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                  
                     <p>
                        <label>Bản quền</label>
                        <?php echo $form->input('Setting.info_other',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Từ khóa (SEO)</label>
                        <?php echo $form->input('Setting.keyword',array('label' => '','cols'=>70,'rows'=>3));?> 
                    </p>
                    <p>
                        <label>Mô tả (SEO)</label>
                         <?php echo $form->input('Setting.description',array('label' => '','cols'=>70,'rows'=>5));?> 
                    </p>
                    
                    	<p>
                        <label>Giới thiệu về công ty (VN)</label>
                        <?php  echo $this->Form->input('about',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.about',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label>Giới thiệu về công ty (ENG)</label>
                        <?php  echo $this->Form->input('about_eg',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.about_eg',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
					
					  
                    <p>
                        <label>Ảnh khuyến mại </label>
                         <input value="<?php echo $edit['Setting']['image_header'];?>" type="text" size="50" class="text-input medium-input datepicker" name="userfile1" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=1','userfile1','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
                
					
                     <p>
                       
                        <?php echo $form->input('Setting.id',array('label' => '','type'=>'hidden'));?>
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

