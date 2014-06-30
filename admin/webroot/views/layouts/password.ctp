<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administractor</title>
<link rel="stylesheet" href="<?php echo DOMAINAD?>css/screen.css" type="text/css" media="screen" title="default" />
</head>
<body>

<div class="clear"></div>
<div id="content-outer">
  <!-- start content -->
  <div id="content">
    <!--  start page-heading -->
    <div id="page-heading">
      <h1>Lấy lại mật khẩu</h1>
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
            <div id="table-content2">
              
              
              <div id="dumpcsv">
                 <?php echo $form->create(null, array( 'url' => DOMAINAD.'login/check_pass','type' => 'post')); ?>	
                  <label style="padding-left:250px;" for="file">Nhập địa chỉ Email của bạn để lấy lại mật khẩu</label>
                  <br /><br />
                <label style="padding-left:250px;" for="file">Email này là email đã được đăng ký với hệ thống lúc khởi tạo tài khoản admin.</label>
                 <?php echo $form->input('Category.name',array( 'label' => '','style'=>'width:250px;height:25px;margin:20px 0px 20px 250px;'));?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input style="margin-left:235px; width:50px;"type="submit" name="submit" value="Gửi" />
                 <?php echo $form->end(); ?>	

              </div>
            
            
            </div>
            <!--  end content-table  -->
            <!--  start paging..................................................... -->
            <table border="0" cellpadding="0" cellspacing="0" id="paging-table">
              <tr>
                <td><div class="clear"></div></td>
                <td>&nbsp;</td>
              </tr>
            </table>
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
  </div>
  <!--  end content -->
  <div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->
<div class="clear">&nbsp;</div>
<!-- start footer -->
<div id="footer">
  <!--  start footer-left -->
  <div id="footer-left">VTM IT</div>
  <!--  end footer-left -->
  <div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
</body>
</html>