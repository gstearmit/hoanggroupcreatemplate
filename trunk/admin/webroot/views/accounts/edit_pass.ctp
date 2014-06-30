<div id="page-heading">
      <h2>Thay đổi tài khoản</h2>
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

               
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'accounts/check_pass','type' => 'post')); ?>	
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td>Tên đăng nhập</td>
                    <td>
                    <?php echo $form->input('User.id',array( 'label' => '','type'=>'hidden','style'=>'width:250px;height:25px;'));?> 
                    <?php echo $form->input('User.name',array( 'label' => '','style'=>'width:250px;height:25px;'));?>
                    </td>
                  </tr>
                   <tr  class="alternate-row">
                    <td>Email lấy lại mật khâu</td>
                    <td > <?php echo $form->input('User.email',array( 'label' => '','style'=>'width:250px;height:25px;'));?> </td>
                  </tr>
                  <tr >
                    <td>Mật khẩu cũ</td>
                    <td>
                      <?php echo $form->input('User.pass_old',array( 'label' => '','type'=>'password','style'=>'width:250px;height:25px;'));?>
                    </td>
                  </tr>
                  <tr  class="alternate-row">
                    <td>Mật khẩu mới</td>
                    <td > <?php echo $form->input('User.pass_new',array( 'label' => '','type'=>'password','style'=>'width:250px;height:25px;'));?> 					                    </td>
                  </tr>
                                   
                 <tr>
                    <td colspan="2"><input type="submit" class="submit-login" value=""  /></td>
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
