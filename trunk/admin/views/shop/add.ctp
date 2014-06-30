<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<?php echo $javascript->link('jquery1.7.js');?>
<script>
$(function(){

$('#companyname').change(function(){
var companyname=$('#companyname').val();
$.ajax({
type: "POST",
url: "<?php echo DOMAINAD?>"+'shop/get_cat',
data: { cat:companyname},
success: function(msg) {

var str=$.parseJSON(msg); var ok=0,test=0;
		$.each(str,function(i,chuoi){ test=1;
			if(ok==0) {
			
			$('#tbmanhom').html('<tr><td><label>'+chuoi['name']+'</label></td><td> <input type="checkbox" name="'+chuoi['id']+'" value="0"></td></tr>');
			
			ok=1;
			} 
			else {
			
			$('#tbmanhom').append('<tr><td><label>'+chuoi['name']+'</label></td><td> <input type="checkbox" name="'+chuoi['id']+'" value="0"></td></tr>');
			
			
			}
			
		
		});
		if(test==0)
		
		{
		$('#tbmanhom').html('<font color="red">Đại lý này chưa có nhóm hàng</font>');
		
		}

}
});
});




	
})
</script>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Thêm mới shop</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Thêm mới shop</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'Shop/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
				 
				
                    <p>
                        <label>Tên gian hàng(tên đăng nhập)</label>
                           <?php echo $form->input('Shop.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                          
                    </p>
                
                    
					 <p>
                        <label>Tên công ty</label>
                           <?php echo $form->input('Shop.namecompany',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                          
                    </p>
					
                    <p>
                        <label>Lĩnh vực kinh doanh </label>
                       <?php  echo $this->Form->input('Shop.business').$this->TvFck->create('Shop.business',array('height'=>'100px','width'=>'98%')); ?>
                    </p>
					
					
					
					 <p>
                        <label>Email</label>
                           <?php echo $form->input('Shop.email',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                          
                    </p>
					
					  <p>
                        <label>Ảnh đại diện </label>
                         <input type="text" size="50" class="text-input medium-input datepicker" name="userfile1" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=1','userfile1','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
					
                           
                   <p>
                        <label>Điện thoại di động</label>
                           <?php echo $form->input('Shop.phone',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                          
                    </p>
					
					  <p>
                        <label>Điện thoại cố định</label>
                           <?php echo $form->input('Shop.mobile',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                          
                    </p>
					
					<p>
                        <label>Chọn mã cửa hàng</label>
                          <select name="companyname" id="companyname">
						  <option value="" >Chọn cửa hàng</option>
						  <?php foreach($store as $store) {?>
							<option value="<?php echo $store['Store']['companyname']?>" ><?php echo $store['Store']['companyname']?></option>
							<?php }?>
						  </select>
                          
                    </p>
					
					
					<p>
                        <label>Chọn nhóm</label>
                           <table width="20%" style="width:20% !important;" border="0" id="tbmanhom">
						
                      </table>
                          
                    </p>
					
					
					
                 
                    <p>
                        <label>Trạng thái</label>
                         <?php echo $form->radio('Shop.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                    </p>
                    <p>
                        <input class="button" type="submit" value=" Thêm mới " />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>