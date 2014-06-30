<div id="page-heading">
      <h1>Sửa</h1>
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
           
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'partners/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td>Tên đối tác</td>
                    <td>                      
                         <?php echo $form->input('Partner.name',array( 'label' => '','style'=>'width:320px;height:25px;'));?>
                    </td>
                  </tr>
                  <tr>
                    <td>Điên thoại</td>
                    <td>                      
                         <?php echo $form->input('Partner.phone',array( 'label' => '','style'=>'width:320px;height:25px;'));?>
                    </td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>                      
                         <?php echo $form->input('Partner.email',array( 'label' => '','style'=>'width:320px;height:25px;'));?>
                    </td>
                  </tr>
                  <tr>
                    <td>Địa chỉ</td>
                    <td>                      
                         <?php echo $form->input('Partner.address',array( 'label' => '','style'=>'width:320px;height:25px;'));?>
                    </td>
                  </tr>
				   <tr>
                   <tr>
                    <td>Website</td>
                    <td>                      
                         <?php echo $form->input('Partner.website',array( 'label' => '','style'=>'width:320px;height:25px;'));?>
                    </td>
                  </tr>
                    <td>Ảnh </td>
                    <td>  
                   <input type="text" size="50" style="height:25px;"  value="<?php echo $edit['Partner']['images']?>" name="userfile" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>gallery.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </td>
                  </tr>
                   <tr>
                    <td>Trạng thái</td>
                    <td>
               <?php echo $form->radio('Partner.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                <?php echo $form->input('Partner.id',array('label'=>''));?>
                    </td>
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