<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>

<div id="page-heading">
      <h1>Thêm mới</h1>
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
           
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'products/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td width="250">Tiêu đề</td>
                    <td>                      
                         <?php echo $views['Product']['title'];?>
                    </td>
                  </tr>
				  
				  <tr class="alternate-row">
                    <td width="250">Loại</td>
                    <td>                      
                         <?php echo $views['Product']['type'];?>
                    </td>
                  </tr>
				  <tr>
                    <td width="250">Hãng sản xuất</td>
                    <td>                      
                         <?php echo $views['Product']['producer'];?>
                    </td>
                  </tr>
				  <tr class="alternate-row">
                    <td width="250">Chất liệu</td>
                    <td>                      
                         <?php echo $views['Product']['material'];?>
                    </td>
                  </tr>
				  <tr>
                    <td width="250">Kiểu dáng</td>
                    <td>                      
                         <?php echo $views['Product']['style'];?>
                    </td>
                  </tr>
                    
				  <tr class="alternate-row">
                    <td width="250">Xuất xứ</td>
                    <td>                      
                         <?php echo $views['Product']['origin'];?>
                    </td>
                  </tr>
				  <tr>
                    <td width="250">Gía</td>
                    <td>                      
                         <?php echo $views['Product']['price'];?>
                    </td>
                  </tr>
                    
				  <tr >
                    <td>Nội dung </td>
                    <td>                      
                       	 <?php echo $views['Product']['content'];?>
						
					</td>
                  </tr>
				 
                  <tr class="alternate-row">
                    <td>Danh mục</td>
                    <td>
                    <?php echo $views['Category']['name'];?>
                    </td>
                  </tr>
				   <tr>
                    <td>Ảnh đại diện</td>
                    <td>  
                   <?php echo $views['Product']['images'];?>
                    </td>
                  </tr>
                   
                   <tr class="alternate-row">
                    <td>Trạng thái</td>
                    <td>
                        <?php if($views['Product']['status']==1){
								echo 'Đã active';
							}else echo 'Chưa ative';?>
                    </td>
                  </tr>
                 <tr>
                    <td colspan="2">
					<input class="submit" type="button" name = "" value="Quay lại" onclick ="history.go(-1);" />
					
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