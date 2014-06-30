<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<div id="news">
              <div id="title-news"><p>Tin tức</p></div>
                 <div class="list-news">
                    <table border="1" width="694" cellpadding="0" cellspacing="0">
                         <tr class="title_news">
                             <td>STT</td>
                             <td><?php echo $this->Paginator->sort('Tên bài viết','id');?></td>
                             <td>Danh mục</td>
                             <td><?php echo $this->Paginator->sort('Ngày tạo','created');?></td>
                             <td>Xử lý</td>
                         </tr>                         
								  <?php $i=1; foreach ($news as $key =>$value){?>
                          <tr class="<?php if($i%2==0) echo('chan'); else echo('le'); $i++;?>" >
                            <td width="10"><?php $j=$key+1; echo $j;?></td>
                            <td>  <?php echo $html->link( $value['News']['title'], '/news/view/'.$value['News']['id']);?></td>                   
                            <td><?php  echo $value['Category']['name'];?>
                             </td>
                            <td><?php echo date('d-m-Y', strtotime($value['News']['created'])); ?></td>
                            <td class="options-width">
                            <?php if($value['News']['status']==0){?>  
                            <a href="<?php echo DOMAINAD?>news/edit/<?php echo $value['News']['id'] ?>" title="Sủa" class="icon-1 info-tooltip"><input type="button" value="Sửa" /></a>
                            <a href="<?php echo DOMAINAD?>news/active/<?php echo $value['News']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><input type="button" value="Active" /></a>
                            <a href="javascript:confirmDelete('<?php echo DOMAINAD?>news/delete/<?php echo $value['News']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"><input type="button" value="Xóa" /></a>
                            <?php } else {?>                  
                            <a href="<?php echo DOMAINAD?>news/edit/<?php echo $value['News']['id'] ?>" title="Sủa" class="icon-1 info-tooltip"><input type="button" value="Sửa" /></a>
                            <a href="<?php echo DOMAINAD?>news/close/<?php echo $value['News']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><input type="button" value="Ngắt active" /></a>
                            <a href="javascript:confirmDelete('<?php echo DOMAINAD?>news/delete/<?php echo $value['News']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"><input type="button" value="Xóa" /></a><?php }?>
                            </td>
                          </tr>
                        <?php }?>                        
                    </table>
                     <div style="margin-top:10px;"><a href="<?php echo DOMAINAD?>news/add" title="Thêm Mới"<img src="<?php echo DOMAINAD?>images/folder-new.png" /><b>Thêm mới tin</b></a></div>
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
</div>
