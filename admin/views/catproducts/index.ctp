<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $form->create(null, array( 'url' => DOMAINAD.'catproducts/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend>Tìm kiếm</legend>

        <div class="field required">
            <label for="field1c">Danh mục</label>
             <?php echo $this->Form->input('parent_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','class'=>'select-search','label'=>''));?>
        </div>
        <div class="field">
            <label for="field2c">Tiêu đề</label>
            <input type="text" id="field2c" name="name" class="text-search">
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="Tìm kiếm" class="button" /></p>
       
    </fieldset>
 <?php echo $form->end(); ?>
  <p><a href="<?php echo DOMAINAD;?>catproducts/add"> <input type="submit" name="" value="Thêm mới" class="button" /></a></p>
<div class="content-box">
    <div class="content-box-header">
        
        <h3>Nội dung</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách</a></li> <!-- href must be unique and match the id of target div -->
           
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
           
         
                 <table>
                <form action="<?php echo DOMAINAD;?>catproducts/processing" name="form1" method="post">
              
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                       <th>STT</th>
                       <th><?php echo $this->Paginator->sort('Tên danh mục','id');?></th>
                       <th>Danh mục cha</th>
                       <th>Vị trí</th>
                       <th><?php echo $this->Paginator->sort('Ngày tạo','created');?></th>
                       <th>Xử lý</th>
                    </tr>
                    
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Lựa chọn</option>
                                    <option value="active">Active</option>
                                    <option value="notactive">Hủy Active</option>
                                    <option value="delete">Delete</option>
                                </select>
                                <a class="button" href="#" onclick="document.form1.submit();">Thực hiện</a>
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
                   <?php $i=1; foreach ($Catproduct as $key =>$value){?>
                    <tr>
                         <td><input type="checkbox" name="<?php echo $value['Catproduct']['id'] ?>"/></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td> <?php echo $value['Catproduct']['name'];?></td>
                        <td><?php echo $value['ParentCat']['name'];?></td>
                        <td> <?php echo $value['Catproduct']['char'];?></td>
                      
                        <td><?php echo date('d-m-Y', strtotime($value['Catproduct']['created'])); ?></td>
                        <td>
                           <?php if($value['Catproduct']['status']==0){?>
                                 <a href="<?php echo DOMAINAD?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>catproducts/delete/<?php echo $value['Catproduct']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>catproducts/active/<?php echo $value['Catproduct']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
                                 <a href="<?php echo DOMAINAD?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>catproducts/delete/<?php echo $value['Catproduct']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>catproducts/close/<?php echo $value['Catproduct']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>

                            <?php }?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
               </form>    
            </table>
            
            
        </div> <!-- End #tab1 -->
         
        
    </div> <!-- End .content-box-content -->
 </div>
