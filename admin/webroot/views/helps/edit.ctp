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
 if (keypressed == 45 )
 {//Phím Delete và Phím Back
 return true;
 }
 return false;
 }
 }
 </script>
<div id="page-heading">
      <h1>Sửa</h1>
    </div>
<!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
      
      <tr>
        <td id="tbl-border-left"></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div id="content-table-inner">
            <!--  start table-content  -->
            <div id="table-content">               
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'Helps/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>   
                  	
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td width="30%">Họ tện</td>
                    <td><?php echo $form->input('Help.name',array( 'label' => '','style'=>'width:367px;height:27px;',));?></td>
                  </tr>  
                  <tr class="alternate-row">
                    <td width="30%">Nick Yahoo</td>
                     <td><?php echo $form->input('Help.yahoo',array( 'label' => '','style'=>'width:367px;height:27px;',));?></td>
                   </tr>
                   <tr>
                    <td width="30%">Nick Skype</td>
                    <td><?php echo $form->input('Help.skype',array( 'label' => '','style'=>'width:367px;height:27px;',));?></td>
                  </tr>  
                  <tr class="alternate-row">
                    <td width="30%">Điện thoại</td>
                     <td><?php echo $form->input('Help.sdt',array( 'label' => '','style'=>'width:367px;height:27px;',));?></td>
                   </tr>  
                   <tr>
                    <td>Trạng thái</td>
                    <td><?php echo $form->radio('Help.status', array(0 => 'Chưa kích hoạt &nbsp;&nbsp;', 1 => 'Đã kích hoạt'), array('value' => '1','legend'=>'')); ?>              </td>
                  </tr>
                 <tr>
               		  <?php echo $form->input('Help.id',array('label'=>''));?>
                    <td colspan="2"><input type="submit" class="submit-login" value="Sửa"  /></td>
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
