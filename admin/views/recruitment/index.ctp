<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>

 <p><a href="<?php echo DOMAINAD;?>recruitment/add"> <input type="submit" name="" value="Thêm mới" class="button" /></a></p>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Danh sách tuyển dụng</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tuyển dụng</a></li> <!-- href must be unique and match the id of target div -->
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
                       <th><a href="">Stt</a></th>
                       <th><a href="">Hình ảnh</a></th>   
                       <th><a href="">Tên</a></th>                
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
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php  
//                    echo '<pre>';
//                print_r($service); die();
                   
                   foreach ($Recruitment as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><img class="adm-dv"src="<?php echo DOMAINAD.$value['Recruitment']['images'];?>" alt="thumbnail" /></td>
                        <td><?php echo $value['Recruitment']['name'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Recruitment']['created'])); ?></td>
                        <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINAD?>recruitment/edit/<?php echo $value['Recruitment']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>recruitment/delete/<?php echo $value['Recruitment']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
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