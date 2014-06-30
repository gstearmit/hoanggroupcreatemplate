<script type="text/javascript">
$(function() {
	$('.popupDatepicker').datepick();
	});
</script>
<script>
function keypress(e){
 //Hàm dùng d? ngan ngu?i dùng nh?p các ký t? khác ký t? s? vào TextBox
 var keypressed = null;
 if (window.event)
 {
 keypressed = window.event.keyCode; //IE
 }
 else
 { 
 keypressed = e.which; //NON-IE, Standard
 }
 if (keypressed < 48 || keypressed > 57)
 { //CharCode c?a 0 là 48 (Theo b?ng mã ASCII)
 //CharCode c?a 9 là 57 (Theo b?ng mã ASCII)
 if (keypressed == 8 || keypressed == 127)
 {//Phím Delete và Phím Back
 return;
 }
 if (keypressed == 45 || keypressed == 32)
 {//Phím Delete và Phím Back
 return true;
 }
 return false;
 }
 }
 </script>
<div id="page-heading">
      <h1>Thêm mới liên kết website</h1>
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
                               	
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td width="30%">Tên website</td>
                    <td><?php echo $views['Weblink']['name']?></td>
                  </tr>  
                  <tr class="alternate-row">
                    <td width="30%">Link website</td>
                     <td><?php echo $views['Weblink']['link']?> </td>
                  </tr>  
                  <tr class="alternate-row">
                    <td>Trạng thái</td>
                    <td>   <?php if($views['Weblink']['status']==1){
								echo 'Đã kích hoạt';
							}else echo 'Chưa kích hoạt';?></td>
                  </tr>
                 <tr>
                    <td colspan="2"><input class="submit" type="button" name = "" value="Quay lại" onclick ="history.go(-1);" /></td>
		</tr>
                </table>
                <!--  end product-table................................... -->
               	
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
