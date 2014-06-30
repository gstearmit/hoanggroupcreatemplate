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
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'banners/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> 
                    <p>
                        <label>Tên công ty</label>
                           <?php echo $form->input('Banner.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Ảnh banner</label>
                        <input type="text" size="50" style="height:25px;" name="userfile" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>gallery.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png,swf)
                    </p>
                   
                     <p>
                        <label>Trạng thái</label>
                         <?php echo $form->radio('Banner.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>  
                    </p>
                    <p>
                        <input class="button" type="submit" value="Thêm mới" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>

