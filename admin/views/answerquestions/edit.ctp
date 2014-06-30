    
<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Hỏi đáp</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Trả lời</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
               <?php echo $form->create(null, array( 'url' => DOMAINAD.'answerquestions/edit','type' => 'post')); ?>	
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tiêu đề</label>
                       <?php echo $form->input('Answerquestion.title',array('label' => '','style'=>'width:500px;height:25px;'));?>     
                    </p>
                    <p>
                        <label>Nội dung Thư</label>              
                         <?php 	echo $this->Form->input('content',array('type'=>'textarea')).$this->TvFck->create('Answerquestion.content',array('toolbar'=>'extra','height'=>'300px','width'=>'900px')); ?>
                    </p>
                     <p>
                        <label>Trả Lời</label>              
                          <?php echo $this->Form->input('answer').$this->TvFck->create('Answerquestion.answer',array('toolbar'=>'extra','height'=>'300px','width'=>'900px')); ?>
                    </p>
                    <p>
                        <label>Trạng thái</label>
                        <?php echo $form->radio('Catproduct.status',array(0=>'Chưa Active',1=>'Đã Active'),array('legend'=>'')) ?> 
                        <?php echo $form->input('Answerquestion.id',array('label'=>''));?>
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
