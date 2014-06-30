<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Thăm dò</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tin</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
      <tr>
        <th rowspan="3" class="sized"><img src="<?php echo DOMAINAD?>images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
        <th class="topleft"></th>
        <td id="tbl-border-top">&nbsp;</td>
        <th class="topright"></th>
        <th rowspan="3" class="sized"><img src="<?php echo DOMAINAD?>images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
      </tr>
      <tr>
        <td id="tbl-border-left"></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div id="content-table-inner">
            <!--  start table-content  -->
            <div id="table-content">
              <form id="mainform" action="">
               <?php //pr($products);  die;?>
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Stt</a></th>
                      <th class="table-header-repeat line-left minwidth-1"><a href="">Tên</a></th>
					  <th class="table-header-repeat line-left minwidth-1"><a href="">Số lần chọn </a></th>
                  
                                 
                      <th class="table-header-repeat line-left minwidth-1"><a href="">Ngày tạo</a></th>    
                  </tr>
                  
                  <?php foreach ($polls as $key =>$value){?>
                  <tr class="alternate-row">
                    <td width="10"><?php $j=$key+1; echo $j;?></td>
                   
                    <td>  <?php echo $value['Poll']['name'];?></td> 
					<td><?php echo $value['Poll']['count'];  ?></td>           
                   
                    <td><?php echo date('d-m-Y', strtotime($value['Poll']['created'])); ?></td>
                  </tr>
                <?php }?>
                </table>
                <!--  end product-table................................... -->
              </form>
            </div>
            <!--  end content-table  -->
            <!--  start paging..................................................... -->
            
            <!--  end paging................ -->
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
            
        </div> <!-- End #tab1 -->
        <div><a href="<?php echo DOMAINAD?>polls/add" title="Thêm Mới"><img src="<?php echo DOMAINAD?>images/folder-new.png" /><b>Thêm mới tin</b></a></div>
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>