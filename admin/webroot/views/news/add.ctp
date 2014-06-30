<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>

<div id="page-heading">
      <h1>Thêm mới</h1>
    </div>
<!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
     
      <tr>
        <td id="tbl-border-left"></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div id="content-table-inner">
            <!--  start table-content  -->
            <div id="table-content">
           
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'news/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td width="250">Tiêu đề</td>
                    <td>                      
                         <?php echo $form->input('News.title',array( 'label' => '','style'=>'width:550px;height:25px;'));?>
                    </td>
                  </tr>
				  
				  
				   <tr class="alternate-row">
                    <td width="100">Nội dung tóm tắt</td>
                    <td >                     
                       	 <?php 	echo $this->Form->input('introduction',array('type'=>'textarea','label'=>false)).$this->TvFck->create('News.introduction',array('height'=>'100px','width'=>'690')); ?>
						
					</td>
                  </tr>
				  <tr >
                    <td>Nội dung </td>
                    <td>                      
                       	 <?php  echo $this->Form->input('content',array('label'=>false)).$this->TvFck->create('News.content',array('toolbar'=>'extra','height'=>'400px','width'=>'690')); ?>
                      
						
					</td>
                  </tr>
				 
                  <tr class="alternate-row">
                    <td>Danh mục</td>
                    <td>
                    <?php echo $this->Form->input('category_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','style'=>'width:150px;height:25px;','label'=>''));?>
                    </td>
                  </tr>
				   <tr>
                    <td>Ảnh đại diện</td>
                    <td>  
                   <input id="NewsSource" type="text" name="userfile" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </td>
                  </tr>
                   <tr  class="alternate-row">
                    <td>Nguồn bài viết</td>
                    <td>                      
                         <?php echo $form->input('News.source',array( 'label' => '','class' =>'title-text','style'=>'width:320px;height:25px;'));?>
                    </td>
                  </tr>
				  
                   <tr>
                    <td>Trạng thái</td>
                    <td>
                        <?php echo $form->radio('News.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                    </td>
                  </tr>
                 <tr>
                    <td colspan="2">
					<input type="submit" class="submit-login" value="Thêm"  />
					
					</td>
		</tr>
                </table>
                <!--  end product-table................................... -->
              <?php echo $form->end(); ?>
            </div>
            <!--  end content-table  -->
            <div class="clear"></div>
          </div>
          <!--  end content-table-inner ............................................END  --></td>
        <td id="tbl-border-right"></td>
      </tr>
      <tr>
        <th class="sized bottomleft"></th>
        <td id="tbl-border-bottom">&nbsp;</td>
        <th class="sized bottomright"></th>
      </tr>
    </table>