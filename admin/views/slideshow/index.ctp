<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>

<p><a href="<?php echo DOMAINAD;?>slideshow/add"> <input type="submit" name="" value="Thêm mới" class="button" /></a></p>
<div class="content-box">
    <div class="content-box-header">
        
        <h3>Danh sách tin</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tin</a></li>
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> 
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1">
            <table>
                
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                       <th><a href="">Stt</a></th>
                       <th><a href="">Hình ảnh</a></th>   
                       <th><a href="">Tiêu đề</a></th>                
                       <th><a href="">Ngày tạo</a></th>
                       <th><a href="">Xử lý</a></th>
                    </tr>
                    
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Choose an action...</option>
                                    <option value="option2">Edit</option>
                                    <option value="option3">Delete</option>
                                </select>
                                <a class="button" href="#">Apply to selected</a>
                            </div>
                             <div class="pagination">
                                <a href="#" title="First Page">
                                   <?php
                                        $paginator->options(array('url' => $this->passedArgs));
                                       echo "&laquo "; echo $paginator->prev('Về trước');
							       ?> 
                                </a>
							     <?php 
								   echo $paginator->numbers();
                                   echo $paginator->next('Tiếp theo'); echo "&raquo";
                                ?>
                              </div>
                            </div> 
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php  foreach ($slideshow as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><img src="<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $value['Slideshow']['images'];?>&amp;h=70&amp;w=100&amp;zc=1" alt="thumbnail" /></td>
                        <td><?php echo $value['Slideshow']['name'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Slideshow']['created'])); ?></td>
                        <td>
                             <a href="<?php echo DOMAINAD?>slideshow/edit/<?php echo $value['Slideshow']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>slideshow/delete/<?php echo $value['Slideshow']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
            
        </div> 
        
    </div>
 </div>