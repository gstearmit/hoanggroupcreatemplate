<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
 <?php echo $form->create(null, array( 'url' => DOMAINAD.'products/search_kho','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend>Tìm kiếm</legend>

        <div class="field required">
            <label for="field1c">Chọn kho</label>
             <?php echo $this->Form->input('list_cat',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn kho','class'=>'select-search','label'=>''));?>
        </div>
      
        <p style="text-align:center;"> <input type="submit" name="" value="Tìm kiếm" class="button" /></p>
       
    </fieldset>
     <?php echo $form->end(); ?>
    
<div class="content-box">
    <div class="content-box-header">
        
        <h3>Tồn kho <?php echo $branch_code;?> đến hết ngày <?php echo date('d/m/Y');?></h3>
        
      
        
        <div class="clear"></div>
        
    </div>
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                <form action="<?php echo DOMAINAD; ?>products/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th>Nhóm</th>
                       <th>Mã vạch</th>
                       <th>Tên hàng</th>
                       <th>Giá bán</th>
                       <th>Số lượng tồn</th>
                       
                    </tr>
                </thead>
             
               
                <tbody>
                   <?php  
					//pr($product); die;	
                   foreach ($product as $key =>$value){
				   $row=$this->requestAction('products/get_product_by_code/'.$value['product_code']);
				   ?>
                    <tr>
					 <td><?php echo $row['Product']['category_code'];?></td>
					 <td><?php echo $row['Product']['barcode2']?></td>
                        
                        
                        <td><?php echo $row['Product']['title']?></td>
						<td><?php echo $row['Product']['retail_price']?></td>
						<td><?php 
						$ton=$value['soluong']-$value['soluongban']+$value['soluongbantralai'] -$value['soluongmuatralai']+$value['dieuchinhthua'] - $value['dieuchinhthieu'];
						echo $ton;?></td>
						
                       
                    </tr>
                   <?php }?>
                </tbody>
               </form>
            </table>
            
				<p><a href="<?php echo DOMAINAD;?>products/ton_xls">Xuất ra excel</a></p> 
				<p><a href="<?php echo DOMAINAD;?>products/ton_txt">Xuất ra txt</a></p> 	
	</div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>


