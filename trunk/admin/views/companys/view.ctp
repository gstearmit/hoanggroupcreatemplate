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
   <div id="title-news"><p>Xem sản phẩm</p></div>
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
                    <td width="250">Bảo hành</td>
                    <td>                      
                         <?php echo $views['Product']['warranty'];?>
                    </td>
                  </tr>
				  <tr>
                    <td width="250">Hãng sản xuất</td>
                    <td>                      
                         <?php echo $views['Product']['manufacturer'];?>
                    </td>
                  </tr>
				  <tr class="alternate-row">
                    <td width="250">Mô tả tóm tắt</td>
                    <td>                      
                         <?php echo $views['Product']['introduction'];?>
                    </td>
                  </tr>
				  <tr>
                    <td>Nội dung </td>
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




