<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Sửa chữa</h3>
        
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
        
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'companys/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
              <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tên công ty (VN)</label>
                           <?php echo $form->input('Company.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Tên công ty (ENG)</label>
                           <?php echo $form->input('Company.name_eg',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                   
                    <p>
                        <label>Website</label>
                           <?php echo $form->input('Company.website',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                 
                      <p>
                        <label>Vị trí</label>
                           <?php echo $form->input('Company.char',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                    <p>
                        <label>Trạng thái</label>
                         <?php echo $form->radio('Company.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                    </p>
                       
                      
                       
                       
                         <?php echo $form->input('Company.id',array( 'label' => ''));?>
                            </p>
                    <p>
                        <input class="button" type="submit" value=" Sửa" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>

