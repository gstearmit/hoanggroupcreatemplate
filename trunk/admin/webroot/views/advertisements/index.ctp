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
      <h1>Danh sách liên kết website</h1>
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
                <table border="1" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                     <th class="table-header-repeat line-left minwidth-01" width="10"><a href="">STT</a><?php //echo $this->Paginator->sort('Stt','id');?></th>
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Tên website</a><?php //echo $this->Paginator->sort('Tên website','name');?></th>   
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Link website</a><?php //echo $this->Paginator->sort('Đường dẫn đến website','link');?></th> 
             
                     <th class="table-header-options line-left"><a href="">Xử lý</a></th>
                  </tr>
                  <?php $k=0 ; foreach ($Advertisements as $key =>$Advertisement) { $n=$k++;$m=$n%2;?>
                  <tr class="<?php if($m!=0 ){ echo "alternate-row";}?>">
                    <td width="10"><?php $j=$key+1; echo $j;?></td>
                    <td><?php echo $html->link($Advertisement['Advertisement']['name'], '/Advertisements/view/'.$Advertisement['Advertisement']['id'],array('title'=>'Xem chi tiết'));?></td>                   
                
                    <td><?php echo $Advertisement['Advertisement']['link']; ?></td>
                    <td class="options-width">
                    <?php if($Advertisement['Advertisement']['status']==0){?>  
                    <a href="<?php echo DOMAINAD?>Advertisements/edit/<?php echo $Advertisement['Advertisement']['id'] ?>" title="S?a" class="icon-1 info-tooltip"><input type="button" value="Sửa" /></a>
                    <a href="<?php echo DOMAINAD?>Advertisements/active/<?php echo $Advertisement['Advertisement']['id'] ?>" title="Kích ho?t" class="icon-5 info-tooltip"><input type="button" value="Active" /></a>
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>advertisements/delete/<?php echo $Advertisement['Advertisement']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"><input type="button" value="Xóa" /></a>
                    <?php  } else {?>                  
                    <a href="<?php echo DOMAINAD?>Advertisements/edit/<?php echo $Advertisement['Advertisement']['id'] ?>" title="S?a" class="icon-1 info-tooltip"><input type="button" value="Sửa" /></a>
                    <a href="<?php echo DOMAINAD?>Advertisements/close/<?php echo $Advertisement['Advertisement']['id'] ?>" title="Ðóng" class="icon-4 info-tooltip"><input type="button" value="Ngắt Active" /></a>
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>advertisements/delete/<?php echo $Advertisement['Advertisement']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"><input type="button" value="Xóa" /></a><?php }?>
                    </td>
                  </tr>
                <?php }?>
                </table>
                <!--  end product-table................................... -->
              </form>
            <div><a href="<?php echo DOMAINAD?>Advertisements/add"><img src="<?php echo DOMAINAD?>img/add.png" /></a></div>
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

