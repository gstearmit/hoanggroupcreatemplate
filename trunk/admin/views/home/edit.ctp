<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<style>
	label {
	display:none;
	}
</style>
 <div id="news">
              <div style="top:180px;" id="title-news" style="top:180px;"><p>Sửa</p></div>
                 <div  class="list-news" >
                    
				 <?php echo $form->create(null, array( 'url' => DOMAINAD.'news/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>             
                <table style="text-align:left;" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                
                    <td>Tiêu đề</td>
                    <td>  
                    	<?php echo $form->input('News.title',array('label' => '','style'=>'width:600px;height:25px;'));?>                    
                    </td>
                  </tr>
                  <tr class="alternate-row">
                    <td width="100">Nội dung tóm tắt</td>
                    <td >                   
                       	 <?php 	echo $this->Form->input('introduction',array('type'=>'textarea')).$this->TvFck->create('News.introduction',array('height'=>'100px','width'=>'640')); ?>
						
					</td>
                  </tr>
				  <tr >
                    <td>Nội dung </td>
                    <td>                      
                       	 <?php echo $this->Form->input('content').$this->TvFck->create('News.content',array('toolbar'=>'extra','height'=>'400px','width'=>'640')); ?>
						
					</td>
                  </tr>
                  <tr class="alternate-row">
                    <td>Danh mục</td>
                    <td>
                        <?php  echo $form->select('News.category_id', $list_cat,null,array('empty'=>'Danh mục cha','style'=>'height:25px;width:200px;')); ?>   
                    </td>
                  </tr>
				   <tr>
                    <td>Ảnh đại diện</td>
                    <td>                      
                  <input type="text" size="80" style="height:25px;" name="userfile"  value="<?php echo $edit['News']['images']?>"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </td>
                  </tr>
                   <tr  class="alternate-row">
                    <td>Nguồn bài viết</td>
                    <td>                      
                         <?php echo $form->input('News.source',array( 'label' => '','style'=>'width:320px;height:25px;'));?>
                    </td>
                  </tr>
                    <tr>
                    <td>Trạng thái</td>
                    <td>
                    	<?php echo $form->radio('News.status',array(0=>'Chưa Active',1=>'Đã Active'),array('legend'=>'')) ?>                      
                    </td>
                       
                        <?php echo $form->input('News.id',array('label'=>''));?>
                  </tr>
                 <tr>
                    <td colspan="2">
					<input type="submit" class="submit-login" value="Sửa"  />					
					</td>
		</tr>
                </table>
                <!--  end product-table................................... -->
              <?php echo $form->end(); ?>	
            </div>
              </div>
</div>
