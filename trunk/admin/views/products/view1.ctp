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
   <div id="title-news"><p>CHI TIẾT SẢN PHẨM</p></div>
        <div id="table-content">
           
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'products/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td width="250">Tên sản phẩm</td>
                    <td>                      
                         <?php echo $views['Product']['title'];?>
                    </td>
                  </tr>
                  
                  <tr class="alternate-row">
                    <td width="250">Tên seo</td>
                    <td>                      
                         <?php echo $views['Product']['title1'];?>
                    </td>
                  </tr>
                  
                   <tr>
                    <td width="250">Thuộc shop</td>
                    <td>                      
                         <?php echo $views['Shop']['name'];?>
                    </td>
                  </tr>
                  
                  <tr class="alternate-row">
                    <td width="250">Thuộc danh mục</td>
                    <td>                      
                         <?php echo $views['Catproduct']['name'];?>
                    </td>
                  </tr>
				  <tr>
                    <td width="250">Ngày hết hạn</td>
                    <td>                      
                         <?php echo $views['Product']['date_ketthuc'];?>
                    </td>
                  </tr>
                  
				  
                  <tr class="alternate-row">
                    <td width="250">Giá bán</td>
                    <td>                      
                         <?php echo number_format($views['Product']['price'])." VNĐ";?>
                    </td>
                  </tr>
				  <tr>
                    <td width="250">Giá gốc</td>
                    <td>                      
                         <?php echo number_format($views['Product']['price_old'])." VNĐ";?>
                    </td>
                  </tr>
                  
				  <tr class="alternate-row">
                    <td width="250">Số lượng</td>
                    <td>                      
                         <?php echo $views['Product']['soluong'];?>
                    </td>
                  </tr>
				  <tr>
                    <td width="250">Đã bán</td>
                    <td>                      
                         <?php echo $views['Product']['dabanthat'];?>
                    </td>
                  </tr>
                  
                  
                  
				  <tr class="alternate-row">
                    <td width="250">Mô tả tóm tắt</td>
                    <td>                      
                         <?php echo $views['Product']['introduction'];?>
                    </td>
                  </tr>
				  <tr>
                    <td>Chi tiết sản phẩm</td>
                    <td>                      
                       	 <?php echo $views['Product']['content'];?>
						
					</td>
                  </tr>
				 
                  <tr class="alternate-row">
                    <td>Danh mục</td>
                    <td>
                    <?php echo $views['Catproduct']['name'];?>
                    </td>
                  </tr>
                   <tr class="alternate-row">
                    <td>Trạng thái</td>
                    <td>
                        <?php if($views['Product']['status']==1){
								echo 'Đã active';
							}else echo 'Chưa ative';?>
                    </td>
                  </tr>
                  
                   <tr class="alternate-row">
                    <td>Được phép lên trang chủ tiến thời</td>
                    <td>
                        <?php if($views['Product']['chophep']==1){
								echo 'Yes';
							}else echo 'No';?>
                    </td>
                  </tr>
                  
                 <tr>
                    <td colspan="2">
					<input class="submit" type="button" name = "" value="Quay lại" onclick ="history.go(-1);" />
					
					</td>
		</tr>
                </table>
                <!--  end product-table................................... -->
              <?php echo $form->end(); ?>
            </div>
  </div>
</div>




