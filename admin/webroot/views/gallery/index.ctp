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
      <h1>Thư viện ảnh</h1>
    </div>
    <!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">      
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
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Hình ảnh</a></th>   
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Tiêu đề</a></th>                
                    <th class="table-header-repeat line-left"><a href="">Ngày tạo</a></th>
                    <th class="table-header-options line-left"><a href="">Xử lý</a></th>
                  </tr>
                  <?php foreach ($gallerys as $key =>$value){?>
                  <tr class="alternate-row">
                    <td width="10"><?php $j=$key+1; echo $j;?></td>
                    <td><img src="<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $value['Gallery']['images'];?>&amp;h=70&amp;w=100&amp;zc=1" alt="thumbnail" /></td>                   
                    <td><?php echo $value['Gallery']['name'];?></td>
                      <td><?php echo date('d-m-Y', strtotime($value['Gallery']['created'])); ?></td>  
                    <td class="options-width">
					<?php if($value['Gallery']['status']==0){?>  
                   	<a href="<?php echo DOMAINAD?>Gallery/edit/<?php echo $value['Gallery']['id'] ?>" title="Sủa" class="icon-1 info-tooltip"><input type="button" value="Sửa" /></a>
                    <a href="<?php echo DOMAINAD?>Gallery/active/<?php echo $value['Gallery']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><input type="button" value="Kích hoạt" /></a>
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>Gallery/delete/<?php echo $value['Gallery']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"><input type="button" value="Xóa" /></a>
					<?php } else {?>                  
                    <a href="<?php echo DOMAINAD?>Gallery/edit/<?php echo $value['Gallery']['id'] ?>" title="Sủa" class="icon-1 info-tooltip"><input type="button" value="Sửa" /></a>
                    <a href="<?php echo DOMAINAD?>Gallery/close/<?php echo $value['Gallery']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><input type="button" value="Ngắt kích hoạt" /></a>
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>Gallery/delete/<?php echo $value['Gallery']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"><input type="button" value="Xóa" /></a><?php }?>
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
              <tr>
			  	<td><div><a href="<?php echo DOMAINAD?>gallery/add" title="Thêm Mới"<img src="<?php echo DOMAINAD?>images/folder-new.png" /><b>Thêm mới ảnh</b></a></div>
                </td>
                </tr>
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

