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
 <div id="news">
  <div id="title-news"><p>Chi tiết đăng ký gian hàng</p></div>
     <div class="list-news">
    
        <?php
            echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
        ?>
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'news/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			 <tr>
                <td width="250">Mã nhóm</td>
                <td>                      
                     <?php echo $views['Shop']['category_code']?>
                </td>
              </tr>
              
			
              <tr>
                <td width="250">Tên gian hàng</td>
                <td>                      
                     <?php echo $views['Shop']['name']?>
                </td>
              </tr>
              
              
               <tr class="alternate-row">
                <td width="100">Lĩnh vực kinh doanh</td>
                <td ><?php echo $views['Shop']['business']; ?></td>
              </tr>
              <tr >
                <td>Tên công ty/ cửa hàng </td>
                <td>                      
                    <?php echo $views['Shop']['namecompany']; ?>
                  
                    
                </td>
              </tr>
             
              <tr class="alternate-row">
                <td>Email</td>
                <td>
               <?php echo $views['Shop']['email']; ?>
                </td>
              </tr>
               <tr>
                <td>Ảnh đại diện</td>
                <td><img src="<?php echo DOMAINAD;?>/timthumb.php?src=<?php echo $views['Shop']['images'];?>&amp;h=70&amp;w=100&amp;zc=1" alt="thumbnail" />
                </td>
              </tr>
			  <tr>
                <td width="250">Điện thoại di động</td>
                <td>                      
                     <?php echo $views['Shop']['phone']?>
                </td>
              </tr>
              
              
               <tr class="alternate-row">
                <td width="100">Điện thoại cố định</td>
                <td ><?php echo $views['Shop']['mobile']; ?></td>
              </tr>
			  
			  
			  
               <tr  class="alternate-row">
                <td>Ngày đăng ký</td>
                <td>                      
                     <?php echo $views['Shop']['created'];?>
                </td>
              </tr>
              
               <tr>
                <td>Trạng thái</td>
                <td>
                    <?php if($views['Shop']['status']==1){
                            echo 'Đã cho phép mở';
                        }else echo 'Chưa cho phép mở';?>
                </td>
              </tr>
             <tr>                 
                 <td colspan="2"><input class="submit" type="button" name = "" value="Quay lại" onclick ="javascript: window.history.go(-1);" /></td>
                
            </tr>
            </table>
            <!--  end product-table................................... -->
          <?php echo $form->end(); ?>
  </div>
</div>       