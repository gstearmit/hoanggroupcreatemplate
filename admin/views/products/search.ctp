<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
  <?php echo $form->create(null, array( 'url' => DOMAINAD.'products/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend>Tìm kiếm</legend>

        <div class="field required">
            <label for="field1c">Danh mục</label>
             <?php echo $this->Form->input('list_cat',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','class'=>'select-search','label'=>''));?>
        </div>
        <div class="field">
            <label for="field2c">Tiêu đề</label>
            <input type="text" id="field2c" name="keyword" class="text-search">
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="Tìm kiếm" class="button" /></p>
       
    </fieldset>
     <?php echo $form->end(); ?>
<div class="content-box">
    <div class="content-box-header">
        
        <h3>Danh sách </h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách</a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div>
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                <form action="<?php echo DOMAINAD; ?>products/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th>STT</th>
                       <th><?php echo $this->Paginator->sort('Tên bài viết','id');?></th>
                       <th>Hình ảnh</th>
                       <th>Danh mục cha</th>
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
                            </div> 
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php  foreach ($product as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td> <?php echo $html->link( $value['Product']['title'], '/products/view/'.$value['Product']['id']);?></td>
                           <td><img src="<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $value['Product']['images'];?>&amp;h=70&amp;w=100&amp;zc=1" alt="thumbnail" /></td>
                 
                        <td><?php  echo $value['Catproduct']['name'];?></td>
                        
                        <td><?php echo date('d-m-Y', strtotime($value['Product']['created'])); ?></td>
                        <td>
                           <?php if($value['Product']['status']==0){?>
                                 <a href="<?php echo DOMAINAD?>products/edit/<?php echo $value['Product']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>products/delete/<?php echo $value['Product']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>products/active/<?php echo $value['Product']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
                                 <a href="<?php echo DOMAINAD?>products/edit/<?php echo $value['Product']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>news/delete/<?php echo $value['Product']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>products/close/<?php echo $value['Product']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>

                            <?php }?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
               </form>
            </table>
            
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>


