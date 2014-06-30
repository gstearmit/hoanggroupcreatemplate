<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>

<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Danh sách hỗ trợ</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Thêm mới</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'service/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tiêu đề (VN)</label>
                        <?php echo $form->input('Service.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                     <p>
                        <label>Tiêu đề (ENG)</label>
                        <?php echo $form->input('Service.name_eg',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                   <p>
                        <label>Nội dung tóm tắt (VN)</label>
                         <?php 	echo $this->Form->input('introduction',array('type'=>'textarea','label' => '')).$this->TvFck->create('Service.introduction',array('height'=>'100px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label>Nội dung tóm tắt ( ENG )</label>
                         <?php 	echo $this->Form->input('introduction_eg',array('type'=>'textarea','label' => '')).$this->TvFck->create('Service.introduction_eg',array('height'=>'100px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label>Nội dung bài viết (VN)</label>
                        <?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Service.content',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label>Nội dung bài viết (ENG)</label>
                        <?php  echo $this->Form->input('content_eg',array('label' => '','type'=>'textarea')).$this->TvFck->create('Service.content_eg',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                   
                    <p>
                        <label>Ảnh hiển thị</label>              
                          <input type="text" size="50" class="text-input medium-input datepicker" name="userfile" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic1.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
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
