<!--  start page-heading -->
    <div id="page-heading">
      <h1>Các tin đã đăng</h1>
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
              <form id="mainform" action="">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Stt</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Tên đăng nhập</a></th>   
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Email khôi phục mật khẩu</a></th>                
                    <th class="table-header-repeat line-left"><a href="">Ngày tạo</a></th>
                    <th class="table-header-options line-left"><a href="">Xử lý</a></th>
                  </tr>
                  <?php foreach ($users as $key =>$value){?>
                  <tr class="alternate-row">
                    <td width="10"><?php $j=$key+1; echo $j;?></td>
                    <td><?php echo $value['User']['name'];?></td>                   
                    <td><?php echo $value['User']['email'];?></td>
                    <td><?php echo date('d-m-Y', strtotime($value['User']['created'])); ?></td>
                    <td class="options-width">
					<a href="<?php echo DOMAINAD?>accounts/edit_pass/<?php echo $value['User']['id'] ?>">Sửa tài khoản</a>
                    </td>
                  </tr>
                <?php }?>
                </table>
                <!--  end product-table................................... -->
              </form>
            </div>
            <!--  end content-table  -->
            <!--  start paging..................................................... -->
            <!--  end paging................ -->
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
    <div class="clear">&nbsp;</div>

