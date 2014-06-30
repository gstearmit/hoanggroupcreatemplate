<?php //pr($news[0]['Category']['name']);die();?>
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
      <h1><?php $news[0]['Category']['name'];?></h1>
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
                    <th class="table-header-repeat line-left minwidth-1"><?php echo $this->Paginator->sort('Tên bài viết','id');?></th>   
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Danh mục</a></th>                
                    <th class="table-header-repeat line-left"><?php echo $this->Paginator->sort('Ngày tạo','created');?></th>
                    <th class="table-header-options line-left"><a href="">Xử lý</a></th>
                  </tr>
                  <?php foreach ($news as $key =>$value){?>
                  <tr class="alternate-row">
                    <td width="10"><?php $j=$key+1; echo $j;?></td>
                    <td>  <?php echo $html->link( $value['News']['title'], '/news/view/'.$value['News']['id']);?></td>                   
                    <td><?php  echo $value['Category']['name'];?>
                     </td>
                    <td><?php echo date('d-m-Y', strtotime($value['News']['created'])); ?></td>
                    <td class="options-width">
					<?php if($value['News']['status']==0){?>  
                   	<a href="<?php echo DOMAINAD?>news/edit/<?php echo $value['News']['id'] ?>" title="Sủa" class="icon-1 info-tooltip"></a>
                    <a href="<?php echo DOMAINAD?>news/active/<?php echo $value['News']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"></a>				 <?php if($value['News']['category_id']!=94){?>
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>news/delete/<?php echo $value['News']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"></a>
					<?php }} else {?>                  
                    <a href="<?php echo DOMAINAD?>news/edit/<?php echo $value['News']['id'] ?>" title="Sủa" class="icon-1 info-tooltip"></a>
                    <a href="<?php echo DOMAINAD?>news/close/<?php echo $value['News']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"></a>
                   <?php if($value['News']['category_id']!=94){?>
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>news/delete/<?php echo $value['News']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"></a><?php }}?>
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
			  	<td><div><a href="<?php echo DOMAINAD?>news/add" title="Thêm Mới"<img src="<?php echo DOMAINAD?>images/folder-new.png" /><b>Thêm mới tin</b></a></div>
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

