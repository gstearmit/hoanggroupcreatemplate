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
      <h1>Các danh mục trong hệ thông</h1>
    </div>
    <!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">      
      <tr>
        <td ></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div >
            <!--  start table-content  -->
            <div >
              <form id="mainform" action="">
                <table border="1" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <th><a href="">Stt</a></th>
                    <th><a href="">Tên danh mục</a></th>   
                     <th><a href="">Danh cha</a></th>                
                    <th><a href="">Ngày tạo</a></th>
                    <th ><a href="">Xử lý</a></th>
                  </tr>
                  <?php foreach ($category as $key =>$value){?>
                  <tr >
                    <td width="10"><?php $j=$key+1; echo $j;?></td>
                    <td><?php echo $value['Category']['name'];?></td>                   
                    <td><?php echo $value['ParentCat']['name'];?></td>
                    <td><?php echo $value['Category']['created']; ?></td>
                    <td class="options-width">
					<?php if($value['Category']['status']==0){?>  
                   	<a href="<?php echo DOMAINAD?>category/edit/<?php echo $value['Category']['id'] ?>" title="Sủa" class="icon-1 info-tooltip">Sửa</a>
                    <a href="<?php echo DOMAINAD?>category/active/<?php echo $value['Category']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip">Kích hoạt</a>
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>category/delete/<?php echo $value['Category']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip">Xóa</a>
					<?php } else {?>                  
                    <a href="<?php echo DOMAINAD?>category/edit/<?php echo $value['Category']['id'] ?>" title="Sủa" class="icon-1 info-tooltip">Sủa</a>
                    <a href="<?php echo DOMAINAD?>category/close/<?php echo $value['Category']['id'] ?>" title="Đóng" class="icon-4 info-tooltip">Ngắt kích hoet</a>
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>category/delete/<?php echo $value['Category']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip">Xóa</a><?php }?>
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
			  	<td><div><a href="<?php echo DOMAINAD?>category/add" title="Thêm Mới"<img src="<?php echo DOMAINAD?>images/folder-new.png" /><b>Thêm mới danh mục</b></a></div>
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

