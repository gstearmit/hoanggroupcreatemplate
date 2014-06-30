
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<!--  start page-heading -->
    <div id="page-heading">
      <h1>Khách hàng gửi</h1>
    </div>
    <!-- end page-heading -->
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
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Stt</a></th>
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Tiêu đề thư gửi</a></th>   
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Tên người gửi</a></th>  
                     <th class="table-header-repeat line-left"><a href="">Ngày gửi</a></th>              
                     <th class="table-header-repeat line-left"><a href="">Trạng thái</a></th>
                     <th class="table-header-options line-left"><a href="">Xử lý</a></th>
                  </tr>
                  <?php foreach ($contacts as $key =>$value){?>
                  <tr class="alternate-row">
                    <td width="10"><?php $j=$key+1; echo $j;?></td>
                    <td><a href="<?php echo DOMAINAD?>contacts/feedback/<?php echo $value['Contact']['id']?>"><?php echo $value['Contact']['title'];?></a></td>
                    <td><?php echo $value['Contact']['name'];?></td>  
                    <td><?php echo date('d-m-Y', strtotime($value['Contact']['created'])); ?></td>                  
                    <td><?php  
						if($value['Contact']['status']==0){
							echo "Chưa phản hồi";
						}elseif($value['Contact']['status']==1){
							echo "Đã phản hồi";
						}
						
						?>
                     </td>
                    <td class="options-width">				  
                  
                   				<a href="<?php echo DOMAINAD?>contacts/feedback/<?php echo $value['Contact']['id'] ?>" title="Feedback"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Feedback" /></a>
                                <a href="javascript:confirmDelete('<?php echo DOMAINAD?>contacts/delete/<?php echo $value['Contact']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                              
                    </td>
                  </tr>
                <?php }?>
                </table>
                <!--  end product-table................................... -->
              </form>
            </div>
            <!--  end content-table  -->
            <!--  start paging..................................................... -->
            <table border="0" cellpadding="0" cellspacing="0" id="paging-table">
                <tr height="30"></tr>
                <tr>
                <td><div class="main">

                    <div id='link_page'>
                      <?php
                               $paginator->options(array('url' => $this->passedArgs));
                                echo "<span class='page_link'><b>Trang :</b> &nbsp;";
                                echo $paginator->prev('Về trước');echo "&nbsp;&nbsp;&nbsp;";
                                echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
                                echo $paginator->next('Tiếp theo');
                                echo "</span>";
                        ?>
                    </div>
                  </div>
                  <div class="clear"></div></td>
                <td>&nbsp;</td>
              </tr>
            </table>
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
    <div class="clear">&nbsp;</div>

