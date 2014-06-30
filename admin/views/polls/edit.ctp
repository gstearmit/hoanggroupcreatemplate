<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<style>
	label {
	display:block;
	}
</style>
<div id="page-heading">
      <h1>Sửa thông tin</h1>
    </div>
<!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
      <tr>
        <th rowspan="3" class="sized"><img src="<?php echo DOMAINAD?>images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
        <th class="topleft"></th>
        <td id="tbl-border-top">&nbsp;</td>
        <th class="topright"></th>
        <th rowspan="3" class="sized"><img src="<?php echo DOMAINAD?>images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
      </tr>
      <tr>
        <td id="tbl-border-left"></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div id="content-table-inner">
            <!--  start table-content  -->
            <div id="table-content">
				 <?php echo $form->create(null, array( 'url' => DOMAINAD.'polls/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>             
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                
                    <td>Tiêu đề</td>
                    <td>  
                    	<?php echo $form->input('Poll.name',array('label' => '','style'=>'width:600px;height:25px;'));?>                    
                    </td>
                  </tr>
                   <tr>
                
                    <td>Tiêu đề tiếng anh</td>
                    <td>  
                    	<?php echo $form->input('Poll.nameeng',array('label' => '','style'=>'width:600px;height:25px;'));?>                    
                    </td>
                  </tr>
                    <tr>
                    <td>Trạng thái</td>
                  <td><?php echo $form->radio('Poll.status', array(0 => 'Chưa kích hoạt &nbsp;&nbsp;', 1 => 'Đã kích hoạt'), array('value' => '1','legend'=>'')); ?>              </td>
                       
                       <?php echo $form->input('Poll.id',array('label'=>''));?>
                  </tr>
                 <tr>
                    <td colspan="2">
					<input type="submit" class="submit-login" value=""  />					
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