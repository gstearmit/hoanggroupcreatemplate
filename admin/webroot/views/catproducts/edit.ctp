
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="page-heading">
      <h1>Sửa chi tiết</h1>
    </div>
<!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
     
      <tr>
        <td id="tbl-border-left"></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div id="content-table-inner">
            <!--  start table-content  -->
            <div id="table-content">

               
                 <?php echo $form->create(null, array( 'url' => DOMAINAD.'Catproducts/edit','type' => 'post')); ?>	
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td>Tên Danh mục</td>
                    <td>
                   <?php echo $form->input('Catproduct.name',array('label'=>'','style'=>'width:400px;hieght:25px;'));?>
                   </td>
                  </tr>
                   <tr  class="alternate-row">
                    <td>Tên Danh mục cha</td>
                
                   <td >
               <?php  echo $form->select('Catproduct.parent_id', $list_cat,null,array('empty'=>'Danh mục cha (lớn nhất)')); ?>    
                    </td>
                  </tr>
                  <tr>
                    <td>Trạng thái</td>
                    <td>
                    	<?php echo $form->radio('Catproduct.status',array(0=>'Chưa Active',1=>'Đã Active'),array('legend'=>'')) ?>                      
                    </td>
                       
                        <?php echo $form->input('Catproduct.id',array('label'=>''));?>
                  </tr>
                 <tr>
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
