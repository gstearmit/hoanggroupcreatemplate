 <style>
 table{
	 text-align:left !important;
	 border:1px solid #999 !important;
	 }
 table td{
	 border:1px solid #999 !important;
	 padding-left:20px;
	 }
</style>
<script>
  $(function(){
							  $('.sl').change(function (){
									window.location.href="<?php echo DOMAINAD;?>products/updateshopingcart1/"+$(this).attr('idpr')+"/"+$(this).val()+"/"+$(this).attr('nam');
							  }) ;
							  
						
							
							  });
							  
							  
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
 <div id="new">
  <div id="title-new"><p>Chi tiết đặt hàng: <span style="color:red;">
  <?php 
  //echo $views['Order']['userscm_id']; die;
  $a=$this->requestAction('orders/get_userscms/'.$views['Order']['userscm_id']); 
 // echo $views['Order']['userscm_id'];
  //pr($a); die;
  foreach( $a as $a) {
  if($a['Userscms']['den']==1) echo "(CHÚ Ý: ĐỐI TƯỢNG THUỘC DANH SÁCH ĐEN)";
  }
  ?></span></p></div>
     <div class="list-new">
    
        <?php
            echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
        ?>
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'Orders/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
              <tr>
                <td width="250">Tên khách hàng</td>
                <td>                      
                     <?php echo $views['Order']['name']?>
                </td>
              </tr>
			   <tr>
                <td class="alternate-row">Địa chỉ giao hàng</td>
                <td>                      
                     <?php echo $views['Order']['address'] ?>
                </td>
              </tr>
              
			    <tr >
                <td width="100">Email</td>
                <td ><?php echo $views['Order']['email']; ?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row">Số điện thoại </td>
				                <td>                      
			  <?php 
			  echo $views['Order']['phone'];
			 ?>

                </td>
			  
              
               <tr >
                <td width="100">Ngày đặt</td>
                <td ><?php echo $views['Order']['created']; ?></td>
              </tr>
              </table>
			  <table>
             
			  
			  <tr >
			    <td colspan="5" class="alternate-row">SẢN PHẨM ĐẶT HÀNG: </td>
				               
              </tr>
             
		
              <tr >
			    <td class="alternate-row"> Stt</td>
				<td>Tên sản phẩm</td>
				<td>Số lượng</td>
				<td>Đơn giá</td>
				<td>Thành tiền</td>
              </tr>
			  
			   <?php
          
                                $product=$views['Order']['product'];
                                //echo $product;
                                $chuoi=explode('/',$product);
                                $n=count($chuoi);
                                $tong=0;
                                for($i=0;$i<$n-1;$i++){
                                    $chuoi1=explode('|',$chuoi[$i]);
                                    $product_id=$chuoi1[0];
                                    $product_title=$chuoi1[1];
                                    $product_soluong=$chuoi1[2];
              
              ?>
			   <tr >
			    <td class="alternate-row"> <?php echo $i+1;?></td>
				<td><?php echo $product_title;?></td>
				
				
				
				<td><input onkeypress="return keypress(event);" name="soluong" class="sl" idpr="<?php echo $views['Order']['id'];?>" value="<?php echo $product_soluong=$chuoi1[2];?>" nam="<?php echo $chuoi[$i]?>" /></td>
				<td>
				<?php $pr=$this->requestAction('orders/get_product/'.$product_id);
				echo number_format($pr['Product']['price']);
				?>
				</td>
				<td><?php $tong=$tong+$product_soluong*$pr['Product']['price']; echo number_format($product_soluong*$pr['Product']['price']);?></td>
              </tr>
			  
          
			  <?php }?>
			   
              <tr >
			
                <td colspan="4" style="text-align:right" class="alternate-row">Tổng tiền</td>
                <td>
              	 <?php   echo number_format($views['Order']['tongtien'],0,'.','.')."đ"; ?>
						
                </td>
              </tr>
              
               <tr>
                <td colspan="4" style="text-align:right" >Trạng thái</td>
                <td>
                    <?php if($views['Order']['status']==1){
                            echo 'Đã giao hàng';
                        }else echo 'Chưa giao hàng';?>
					
                </td>
              </tr>
			 
             <tr>                 
                 <td colspan="2"><input class="submit" type="button" name = "" value="Quay lại" onclick ="javascript: window.history.go(-1);" /></td>
                
            </tr>
            </table>
			
			  <p><a href="<?php echo DOMAINAD;?>orders/export_xls1/<?php echo $views['Order']['id'];?>">Xuất ra excel</a></p> 
			<p><a href="<?php echo DOMAINAD;?>orders/export_txt1/<?php echo $views['Order']['id']; ?>">Xuất ra txt</a></p> 
			
            <!--  end product-table................................... -->
          <?php echo $form->end(); ?>
  </div>
</div>       