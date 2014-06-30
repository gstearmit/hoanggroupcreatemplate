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
        
        <h3>Nội dung</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tin</a></li> <!-- href must be unique and match the id of target div -->
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
                       <th><a href="">Stt</a></td> 
                       <th><?php echo $this->Paginator->sort('Tiêu đề','id');?></th>
                       <th><a href="">Nội dung câu hỏi</a></th>
                       <th><a href="">Trả Lời</a></th>
                       <th><?php echo $this->Paginator->sort('Ngày đăng tin','created');?></th>
                       <th><a href="">Xử lý</a></th>
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
                   <?php $i=1; foreach ($answerquestions as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><a  href="<?php echo $html->url('/answerquestions/view/'.$value['Answerquestion']['id']); ?>"> <?php echo $value['Answerquestion']['title']; ?></a></td>
                        <td><?php echo $value['Answerquestion']['content']; ?></td>
                        <td><?php echo $value['Answerquestion']['answer']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Answerquestion']['created'])); ?></td>
                        <?php if($value['Answerquestion']['status']==0){?>  
                          <td>
                            <!-- Icons -->
                            <a href="<?php echo DOMAINAD?>answerquestions/edit/<?php echo $value['Answerquestion']['id'] ?>" title="Trả lời" class="icon-1 info-tooltip"><input type="button" value="Trả lời" /></a>
                             <a href="<?php echo DOMAINAD?>answerquestions/edit/<?php echo $value['Answerquestion']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                            <a href="javascript:confirmDelete('<?php echo DOMAINAD?>answerquestions/delete/<?php echo $value['Answerquestion']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="#" title="Edit Meta"><img src="<?php echo DOMAINAD?>images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
                             <a href="<?php echo DOMAINAD?>answerquestions/active/<?php echo $value['Answerquestion']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><input type="button" value="Active" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                            <a href="<?php echo DOMAINAD?>answerquestions/edit/<?php echo $value['Answerquestion']['id'] ?>" title="Trả lời" class="icon-1 info-tooltip"><input type="button" value="Trả lời" /></a>
                             <a href="<?php echo DOMAINAD?>answerquestions/edit/<?php echo $value['Answerquestion']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>answerquestions/delete/<?php echo $value['Answerquestion']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="#" title="Edit Meta"><img src="<?php echo DOMAINAD?>images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
                        </td>
                        <?php }?>
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
            
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>
