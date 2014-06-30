<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Thêm bài viết</h3>
       <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
        
        <div class="tab-content" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'news/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tên bài viết</label>
                           <?php echo $form->input('News.title',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                            <br /><small>Nhập tiêu đề bài viết</small>
                    </p>
                    <p>
                        <label>Danh mục</label>              
                        <?php echo $this->Form->input('category_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','class'=>'small-input','label'=>''));?>
                    </p>
                    <p>
                        <label>Nội dung tóm tắt</label>
                         <?php 	echo $this->Form->input('introduction',array('type'=>'textarea','label' => '')).$this->TvFck->create('News.introduction',array('height'=>'100px','width'=>'540')); ?>
                    </p>
                    <p>
                        <label>Nội dung bài viết</label>
                        <?php  echo $this->Form->input('content',array('label' => '','class'=>'text-input textarea wysiwyg','id'=>'textarea','cols'=>'79','rows'=>'15')).$this->TvFck->create('News.content',array('toolbar'=>'extra','height'=>'400px','width'=>'540')); ?>
                    </p>
                    <p>
                        <label>Ảnh đại diện</label>
                         <input type="text" size="50" class="text-input medium-input datepicker" name="userfile" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
                    <p>
                        <label>Nguồn bài viết </label>
                         <?php echo $form->input('News.source',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
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