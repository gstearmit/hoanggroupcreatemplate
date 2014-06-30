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
            <li><a href="#tab1" class="default-tab">Ảnh Video</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                <thead>
                    <tr>
                       <th>STT</th>
                       <th>Tiêu đề</th>
                       <th>Video</th>
                       <th>Ngày tạo</th>
                       <th>Xử lý</th>
                    </tr>
                    
                </thead>
                <tbody>
                   <?php $i=1; foreach ($videos as $key => $value){?>
                    <tr>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $value['Video']['name'];?></td>
                        <td><?php echo $value['Video']['video'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Video']['created'])); ?></td>
                        <td>
                            <?php if($value['Video']['status']==0){?>
                                 <a href="<?php echo DOMAINAD?>videos/edit/<?php echo $value['Video']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>videos/delete/<?php echo $value['Video']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>videos/active/<?php echo $value['Video']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
                                 <a href="<?php echo DOMAINAD?>videos/edit/<?php echo $value['Video']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>videos/delete/<?php echo $value['Video']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>videos/close/<?php echo $value['Video']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                            <?php }?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
            </table>
         
        </div> 
    </div> 