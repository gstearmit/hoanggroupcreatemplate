<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<div class="content-box">
    <div class="content-box-header">
        
        <h3>Tài khoản</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> 
            <li><a href="#tab2" class="default-tab">Tạo mới</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div>
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> 
        </div>
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'accounts/add','type' => 'post')); ?>     
                
                <fieldset>
                    <p>
                        <label>Tên đăng nhập</label>
                         <?php echo $form->input('User.name',array( 'label' => '','style'=>'width:250px;height:25px;'));?>
                    </p>
                    <p>
                        <label>Email lấy lại mật khâu</label>              
                         <?php echo $form->input('User.email',array( 'label' => '','style'=>'width:250px;height:25px;'));?>
                    </p>
                    <p>
                        <label>Mật khẩu</label>   
                        <?php echo $form->input('User.password',array( 'label' => '','type'=>'password','style'=>'width:250px;height:25px;'));?>
                    </p>
                    <p>
                        <label>Nhập lại mật khẩu</label>   
                        <?php echo $form->input('User.pass2',array( 'label' => '','type'=>'password','style'=>'width:250px;height:25px;'));?>
                    </p>
                    <p>
                        <input class="button" type="submit" value="Thêm mới" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div>
                
            <?php echo $form->end(); ?>
            
        </div>  
        
    </div> 
 </div>