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
		<tr>
			<td colspan="6" style="text-align:center; font-weight:bold;font-size:14px;">
				Tồn kho <?php echo $branch_code;?> đến hết ngày <?php echo date('d/m/Y');?>
			</td>
		</tr>
		<tr id="titles">
        	<td class="tableTd">STT</td>
			<td class="tableTd">Nhóm</td>
            <td class="tableTd">Mã vạch</td>
			<td class="tableTd">Tên hàng</td>
            <td class="tableTd">Giá bán</td>
			
			<td class="tableTd">Số lượng tồn</td>
            
	   
		</tr>
               <tbody>
                   <?php  
					//pr($product); die;	
					$i=0;
                   foreach ($product as $key =>$value){
				   $row=$this->requestAction('products/get_product_by_code/'.$value['product_code']);
				   ?>
                    <tr>
					<td class="tableTdContent"><?php echo ++$i; ?></td>
					 <td class="tableTdContent"><?php echo $row['Product']['category_code'];?></td>
					 <td class="tableTdContent"><?php echo $row['Product']['barcode2']?></td>
                        
                        
                        <td class="tableTdContent"><?php echo $row['Product']['title']?></td>
						<td class="tableTdContent"><?php echo $row['Product']['retail_price']?></td>
						<td class="tableTdContent"><?php 
						$ton=$value['soluong']-$value['soluongban']+$value['soluongbantralai'] -$value['soluongmuatralai']+$value['dieuchinhthua'] - $value['dieuchinhthieu'];
						echo $ton;?></td>
						
                       
                    </tr>
                   <?php }?>
                </tbody>
	
               
            </table>



