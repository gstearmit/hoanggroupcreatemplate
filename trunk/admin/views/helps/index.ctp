<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>

 <p><a href="<?php echo DOMAINAD;?>helps/add"> <input type="submit" name="" value="Thêm mới" class="button" /></a></p>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Danh sách hỗ trợ trực tuyến</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách</a></li> <!-- href must be unique and match the id of target div -->
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
                       <th>Tiêu đề</th>
                       <th><?php echo $this->Paginator->sort('Nhân viên','id');?></th>
                       <th>Yahoo</th>
                       <th>Skype</th>
                       <th>Điện thoại</th>
                       <th>Ngày tạo</th>
                       <th>Xử lý</th>
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
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php  foreach ($Helps as $key =>$Help){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $Help['Help']['title']; ?></td> 
                        <td><?php echo $Help['Help']['name']; ?></td> 
                        <td><?php echo $Help['Help']['yahoo']; ?></td>
                        <td><?php echo $Help['Help']['skype']; ?></td>
                        <td><?php echo $Help['Help']['sdt']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($Help['Help']['created'])); ?></td>
                        <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINAD?>helps/edit/<?php echo $Help['Help']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>helps/delete/<?php echo $Help['Help']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
            
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>