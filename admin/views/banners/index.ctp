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
            <li><a href="#tab1" class="default-tab">Ảnh banner</a></li> <!-- href must be unique and match the id of target div -->
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
                       <th>Ảnh đại diện</th>
                       <th>Ngày tạo</th>
                       <th>Xử lý</th>
                    </tr>
                    
                </thead>
                <tbody>
                   <?php $i=1; foreach ($banners as $key => $value){?>
                    <tr>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $value['Banner']['name'];?></td>
                        <td><?php echo $value['Banner']['images'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Banner']['created'])); ?></td>
                        <td>
                            <?php if($value['Banner']['status']==0){?>
                                 <a href="<?php echo DOMAINAD?>banners/edit/<?php echo $value['Banner']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>banners/delete/<?php echo $value['Banner']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>banners/active/<?php echo $value['Banner']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
                                 <a href="<?php echo DOMAINAD?>banners/edit/<?php echo $value['Banner']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>banners/delete/<?php echo $value['Banner']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>banners/close/<?php echo $value['Banner']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                            <?php }?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
            </table>
         
        </div> 
    </div> 