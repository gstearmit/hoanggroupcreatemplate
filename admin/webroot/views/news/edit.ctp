<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<style>
	label {
	display:none;
	}
</style>
<div id="page-heading">
      <h1>Sửa thông tin</h1>
    </div>
<!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
      
      <tr>
        <td id="tbl-border-left"></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div id="content-table-inner">
            <!--  start table-content  -->
            <div id="table-content">
				 <?php echo $form->create(null, array( 'url' => DOMAINAD.'news/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>             
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                
                    <td>Tiêu đề</td>
                    <td>  
                    	<?php echo $form->input('News.title',array('label' => '','style'=>'width:600px;height:25px;'));?>                    
                    </td>
                  </tr>
                  <tr class="alternate-row">
                    <td width="100">Nội dung tóm tắt</td>
                    <td ><div style="width:800px;">                      
                       	 <?php 	echo $this->Form->input('introduction',array('type'=>'textarea')).$this->TvFck->create('News.introduction',array()); ?>
						</div>	
					</td>
                  </tr>
				  <tr >
                    <td>Nội dung </td>
                    <td>                      
                       	 <?php echo $this->Form->input('content').$this->TvFck->create('News.content',array('toolbar'=>'extra')); ?>
						
					</td>
                  </tr>
                  <tr class="alternate-row">
                    <td>Danh mục</td>
                    <td>
                        <?php  echo $form->select('News.category_id', $list_cat,null,array('empty'=>'Danh mục cha','style'=>'height:25px;width:150px;')); ?>   
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