<div id="page-heading">
      <h1>Thêm mới Danh Mục</h1>
    </div>
<!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
      
      <tr>
        <td id="tbl-border-left"></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div id="content-table-inner">
            <!--  start table-content  -->
            <div id="table-content">

               
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'Catproducts/add','type' => 'post')); ?>	
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td>Tên Danh mục</td>
                    <td>
                    <?php echo $form->input('Catproduct.name',array( 'label' => '','style'=>'width:250px;height:25px;'));?>
                    </td>
                  </tr>
                     <tr  class="alternate-row">
                    <td>Tên Danh mục cha</td>
                
                   <td >
                    <?php 
							echo $form->select('Catproduct.parent_id', $Catproductlist, null,array('empty'=>'Chọn danh mục','style'=>'height:25px;width:150px;'));
						?>    
                    </td>
                  </tr>
                  
                  <tr >
                    <td>Trạng thái</td>
                    <td>
                          <?php echo $form->radio('Catproduct.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                    </td>
                  </tr>
                 <tr>
                    <td colspan="2"><input type="submit" class="submit-login" value="Thêm"  /></td>
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
