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
 <div id="new">
  <div id="title-new"><p>Chi tiết tài khoản</p></div>
     <div class="list-new">
    
        <?php
            echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
        ?>
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'shops/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
              <tr>
                <td width="250"> Họ Tên </td>
                <td>                      
                     <?php echo $views['Userscm']['name']?>
                </td>
              </tr>
			   <tr>
                <td class="alternate-row">Tên gian hàng</td>
                <td>                      
                     <?php
					$cat= $this->requestAction('userscms/get_shop/'.$views['Userscm']['id']);
					$loai="NO";
					foreach($cat as $cat){
					$date=$cat['Shop']['created'];
					echo $cat['Shop']['name'];
					if($cat['Shop']['loai']) $loai="YES";
					}
					 ?>
                </td>
              </tr>
              
              
               <tr >
                <td width="100">Gian hàng nổi bật</td>
                <td ><?php echo $loai; ?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row">Ngày tạo gian hàng </td>
				                <td>                      
			  <?php 
			  echo $date;?>
			
            
                </td>
              </tr>
             
              <tr>
                <td >Email</td>
                <td>
                <?php echo $views['Userscm']['email']; ?>
                </td>
              </tr>
			  
			   
              <tr >
                <td class="alternate-row">Điện thoại</td>
                <td>
              	 <?php echo $views['Userscm']['phone']; ?>
						
                </td>
              </tr>
               <tr>
                <td >Giới tính</td>
                <td>
					<?php if($views['Userscm']['sex']==1) echo "Nam"; else echo "Nữ"; ?>
				</td>
              </tr>
               <tr  >
                <td class="alternate-row">Ngày đăng ký</td>
                <td>                      
                     <?php echo $views['Userscm']['created'];?>
                </td>
              </tr>
              
               <tr>
                <td >Trạng thái</td>
                <td>
                    <?php if($views['Userscm']['status']==1){
                            echo 'Đã active';
                        }else echo 'Chưa ative';?>
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