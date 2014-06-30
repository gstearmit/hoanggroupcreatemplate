<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>

<div id="page-heading">
      <h1>Gủi thư phản hồi</h1>
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
           
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'contacts/send','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td width="300">Tiêu đề</td>
                    <td>                      
                         <?php echo $form->input('Contact.title',array( 'label' => '','value'=>$feedback['Contact']['title'],'style'=>'width:550px;height:25px;border:none;','readonly'=>'true'));?>
                         <?php echo $form->input('Contact.id',array( 'label' => '','value'=>$feedback['Contact']['id'],'style'=>'width:550px;height:25px;border:none;','readonly'=>'true'));?>
                    </td>
                  </tr>
				  
				  <tr class="alternate-row1">
                    <td width="300">Họ và tên người gửi</td>
                    <td>                      
                          <?php echo $form->input('Contact.name',array( 'label' => '','value'=>$feedback['Contact']['name'],'style'=>'width:550px;height:25px;border:none;','readonly'=>'true'));?>
                    </td>
                  </tr>
				  <tr>
                    <td width="300">Emai người gửi</td>
                    <td>                      
                         <?php echo $form->input('Contact.email',array( 'label' => '','value'=>$feedback['Contact']['email'],'style'=>'width:550px;height:25px;border:none;','readonly'=>'true'));?>
                    </td>
                  </tr>
				  
				   <tr class="alternate-row1">
                    <td width="100">Nội dung thư</td>
                    <td >                     
                      <?php echo $form->textarea('content', array('id' => 'field','cols'=>'98','rows'=>'8','style'=>'border:none','readonly'=>'true','value'=>$feedback['Contact']['content'])); ?>						
					</td>
                  </tr>
				  <tr >
                    <td>Nội dung thư phản hồi</td>
                    <td>                      
                       	 <?php  echo $this->Form->input('content_send',array('label'=>'')).$this->TvFck->create('Contact.contentSend',array('toolbar'=>'extra','height'=>'200px','width'=>'800px;')); ?>
                      
						
					</td>
                  </tr>
				  <tr>
                    <td colspan="2">
					<input style="margin-left:300px;" type="submit" class="submit-login" value="Gửi"  />
					
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