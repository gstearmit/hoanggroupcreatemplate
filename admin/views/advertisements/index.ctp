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
        
        <h3>Banner quảng cáo</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Banner</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                       <th>STT</th>
                       <th><?php echo $this->Paginator->sort('Tên website','id');?></th>
                       <th>Link website</th> 
                       <th>Ảnh</th>  
                       <th>Ngày tạo</th>                         
                       <th>Xử lý</th>
                    </tr>
                    
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Lựa chọn</option>
                                    <option value="option2">Active</option>
                                    <option value="option2">Hủy Active</option>
                                    <option value="option3">Delete</option>
                                </select>
                                <a class="button" href="#">Thực hiện</a>
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
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php  foreach ($Advertisements as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php  echo $value['Advertisement']['name'];?></td>
                        <td><?php  echo $value['Advertisement']['link'];?></td>
                        <td><img src="<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $value['Advertisement']['images']; ?>&amp;h=70&amp;w=140&amp;zc=1" alt="thumbnail" /></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Advertisement']['created'])); ?></td>
                        <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINAD?>advertisements/edit/<?php echo $value['Advertisement']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>advertisements/delete/<?php echo $value['Advertisement']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="#" title="Edit Meta"><img src="<?php echo DOMAINAD?>images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
            
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>


