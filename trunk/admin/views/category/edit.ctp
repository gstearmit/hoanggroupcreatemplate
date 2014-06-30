<div class="content-box">
    <div class="content-box-header">
        
        <h3>Sửa tin</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> 
            <li><a href="#tab2" class="default-tab">Sửa tin</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> 
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1">
        </div>
        
        <div class="tab-content default-tab" id="tab2">
        
              <?php echo $form->create(null, array( 'url' => DOMAINAD.'category/edit','type' => 'post')); ?>	     
                
                <fieldset>
                    <p>
                        <label>Tên Danh mục</label>
                        <?php echo $form->input('Category.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Tên Danh mục cha</label>              
                         <?php  echo $form->select('Category.parent_id', $list_cat,null,array('empty'=>'Danh mục cha (lớn nhất)','class'=>'small-input')); ?> 
                    </p>
                    <p>
                        <label>Số thứ tự</label>   
                          <?php echo $form->input('Category.tt',array( 'label' => '','style'=>'width:100px !important;','class'=>'text-input medium-input datepicker'));?>        
                    </p>
                    <p>
                        <label>Trạng thái</label>
                        <?php echo $form->radio('Category.status',array(0=>'Chưa Active',1=>'Đã Active'),array('legend'=>'')) ?> 
                        <?php echo $form->input('Category.id',array('label'=>''));?>
                    </p>
                    <p>
                        <input class="button" type="submit" value=" Sửa " />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div>
                
            <?php echo $form->end(); ?>
            
        </div>   
        
    </div>
 </div>
