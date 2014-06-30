<style>
 table{
	 text-align:left !important;
	 border:1px solid #999 !important;
	 }
 table td{
	 border:1px solid #999 !important;
	 }
</style>
<div id="news">
  <div class="list-news">
   <div id="title-news"><p>CHI TIẾT HÓA ĐƠN NHẬP</p></div>
        <div id="table-content">
           
                
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
					<td>Stt</td>
                    <td width="250">Nhóm</td>
                    <td>                      
                         Sản phẩm
                    </td>
					<td>Số lượng</td>
					<td>Đơn giá</td>
					<td>Tổng sau triết khấu</td>
                  </tr>
                 
			
				 <?php foreach($Purchasing_document_item as $key=>$value) {?>
				 
				 <tr>
					<td><?php echo $key+1;?></td>
                    <td width="250"><?php echo $value['Purchasing_document_item']['parnert_code_in']?></td>
                    <td>                      
                        <?php echo $value['Purchasing_document_item']['product_code']?>
                    </td>
					<td><?php echo $value['Purchasing_document_item']['total_unit']?></td>
					<td><?php echo $value['Purchasing_document_item']['unit_price']?></td>
					<td><?php echo $value['Purchasing_document_item']['total_value_after_tax']?></td>
                  </tr>
				 
				 <?php }?>
				 
				 
				 
                 <tr>
                    <td colspan="2">
					<input class="submit" type="button" name = "" value="Quay lại" onclick ="history.go(-1);" />
					
					</td>
		</tr>
                </table>
                <!--  end product-table................................... -->
              
            </div>
			
			   <p><a href="<?php echo DOMAINAD;?>products/export_xls_ctnhap/<?php echo $uuid;?>">Xuất ra excel</a></p> 
			
  </div>
</div>




