<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>

<div id="page-heading">
      <h1>Xem tin đã đăng</h1>
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
           
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'answerquestions/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td width="250">Tiêu đề</td>
                    <td>    
					<?php //pr($views); die; ?>                  
                         <?php echo $views['Answerquestion']['title']?>
                    </td>
                  </tr>
				  
				  
				   <tr class="alternate-row">
                    <td width="100">Nội dung tóm tắt</td>
                    <td ><?php echo $views['Answerquestion']['introduction']; ?></td>
                  </tr>
				  <tr >
                    <td>Nội dung </td>
                    <td>                      
                       	<?php echo $views['Answerquestion']['content']; ?>
                      
						
					</td>
                  </tr>
				 
                  <tr class="alternate-row">
                    <td>Danh mục</td>
                    <td>
                   <?php echo $views['Answerquestion']['name']; ?>
                    </td>
                  </tr>
				   <tr>
                    <td>Ảnh đại diện</td>
                    <td><img src="<?php echo DOMAINAD;?>/timthumb.php?src=<?php echo $views['Answerquestion']['images'];?>&amp;h=70&amp;w=100&amp;zc=1" alt="" />
                    </td>
                  </tr>
                   <tr  class="alternate-row">
                    <td>Nguồn bài viết</td>
                    <td>                      
                         <?php echo $views['Answerquestion']['source'];?>
                    </td>
                  </tr>
				  
                   <tr>
                    <td>Trạng thái</td>
                    <td>
                        <?php if($views['Answerquestion']['status']==1){
								echo 'Đã active';
							}else echo 'Chưa ative';?>
                    </td>
                  </tr>
                 <tr>                 
					 <td colspan="2"><input class="submit" type="button" name = "" value="Quay lại" onclick ="history.go(-1);" /></td>
					
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