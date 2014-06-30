<STYLE type="text/css">
	.tableTd {
	   	border-width: 0.5pt; 
		border: solid; 
		font:Arial;
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
		font:Arial;
	}
	#titles{
		font-weight: bolder;
	}
   
</STYLE>
			  <table>
             
			  
			  <tr  id="titles" >
			    <td colspan="5" style="text-align:center; text-transform:uppercase;" class="alternate-row">ĐƠN ĐẶT HÀNG CỦA <?php echo $rows['Order']['name'].'(Ngày: '.date('d/m/Y',strtotime($rows['Order']['created'])).')';?>  </td>
				               
              </tr>
             
		
              <tr  id="titles">
			    <td class="tableTd"> Stt</td>
				<td class="tableTd">Tên sản phẩm</td>
				<td class="tableTd">Số lượng</td>
				<td class="tableTd">Đơn giá</td>
				<td class="tableTd">Thành tiền</td>
              </tr>
			  
			   <?php
          
                                $product=$rows['Order']['product'];
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
			    <td class="tableTd"> <?php echo $i+1;?></td>
				<td class="tableTd"><?php echo $product_title;?></td>
				
				
				
				<td class="tableTd">
				<?php echo $product_soluong=$chuoi1[2];?>
				</td>
				<td class="tableTd">
				<?php $pr=$this->requestAction('orders/get_product/'.$product_id);
				echo number_format($pr['Product']['price']);
				?>
				</td>
				<td class="tableTd"><?php $tong=$tong+$product_soluong*$pr['Product']['price']; echo number_format($product_soluong*$pr['Product']['price']);?></td>
              </tr>
			  
          
			  <?php }?>
			   
              <tr >
			
                <td colspan="4" style="text-align:right" class="tableTd">Tổng tiền</td>
                <td class="tableTd">
              	 <?php   echo number_format($rows['Order']['tongtien'],0,'.','.')."đ"; ?>
						
                </td>
              </tr>
           
            </table>