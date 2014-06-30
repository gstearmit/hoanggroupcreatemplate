<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
  <link type="text/css" href="<?php echo DOMAINAD?>css/jquery.datepick.css" rel="stylesheet" /> 
<!-- Chon ngay -->
		<script type="text/javascript" src="<?php echo DOMAINAD?>js/date.js"></script>

<script type="text/javascript" src="<?php echo DOMAINAD?>js/jquery.datePicker.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.datepick.js"></script>	
		<script type="text/javascript" charset="utf-8">
	            $(function()
	            {
			$('.date-pick').datePicker({clickInput:true})
	            });
				
				
				$(function() {
	$('.popupDatepicker').datepick();

			});
				$(function() {
	$('.popupDatepicker1').datepick();

			});
			
			$(function() {
	$('.popupDatepicker2').datepick();

			});
			$(function() {
	$('.popupDatepicker3').datepick();

			});
			$(function() {
	$('.popupDatepicker4').datepick();

			});
			$(function() {
	$('.popupDatepicker5').datepick();

			});

		</script>
		
		<!-- datePicker required styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo DOMAINAD?>css/datePicker.css">
	
<!-- End chon ngay -->

 <?php echo $form->create(null, array( 'url' => DOMAINAD.'orders/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend>Tìm kiếm</legend>

       
        <div class="field">
            <label for="field2c">Tên </label>
            <input type="text" id="field2c" name="name" class="text-search">
			  
                    <p>
              
                  <label for="date1">Từ ngày:</label>
                     <input type="text" name="date_batdau" class="popupDatepicker datepicker" style="width:319px;"/>
                        
                 </p>   
                 
                   <p>
              
                  <label for="date2">Đến ngày:</label>
                  <input type="text" name="date_ketthuc" class="popupDatepicker1 datepicker" style="width:319px;"/>
                   
             
                 </p>   
			
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="Tìm kiếm" class="button" /></p>
       
    </fieldset>
     <?php echo $form->end(); ?>
     
    
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Danh sách đặt hàng</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách đặt hàng</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                 <form action="<?php echo DOMAINAD; ?>Orders/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th>STT</th>
                       <th><?php echo $this->Paginator->sort('Tên khách hàng','created');?></th>
                       <th>Email</th>
						
						<th>Tổng tiền</th>		
							<th>DS ĐEN</th>   
                       <th><?php echo $this->Paginator->sort('Ngày đặt','created');?></th>
                       	<th>Thanh toán</th>
                       <th>Xử lý giao hàng</th>
                    </tr>
                    
                </thead>
           
                <tfoot>
                    <tr>
                        <td colspan="9">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Lựa chọn</option>
                                    <option value="active">Đã giao hàng</option>
                                    <option value="notactive">Chưa giao hàng</option>
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
                   <?php  
				  
				   foreach ($Order as $key =>$value){
				   
				   ?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Order']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td> <?php echo $html->link( $value['Order']['name'], '/orders/view/'.$value['Order']['id']);?></td>
                      
						
						 <td>
							<?php echo $value['Order']['email'];?>
						
						</td>
					
						 <td>
							<?php echo number_format( $value['Order']['tongtien'],'0','.','.')."đ";?>
						
						</td>
							 <td align="center">
							<?php 
							$a=$this->requestAction('orders/get_userscms/'.$value['Order']['userscm_id']);
							if(!$a) echo "NO"; else {
							foreach($a as $a){
							if($a['Userscms']['den']) echo "YES"; else echo "NO";
							}
							}
							?>
							
						
						</td>
						
						
                        <td><?php echo date('d-m-Y', strtotime($value['Order']['created'])); ?></td>
                         
                         	<td style="text-align:center">
                             <?php if($value['Order']['tinhtrang']==0){?>
							 
							    
                              	  
                           
                                 <a href="<?php echo DOMAINAD?>orders/active1/<?php echo $value['Order']['id'] ?>" title="Đã thanh toán" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
							 
                            
                                 <a href="<?php echo DOMAINAD?>orders/close1/<?php echo $value['Order']['id'] ?>" title="Chưa thanh toán" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>

                            <?php }?>
                        </td>
                         
                        <td>
                             <?php if($value['Order']['status']==0){?>
							 
							    
                              	    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>orders/delete/<?php echo $value['Order']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                           
                                 <a href="<?php echo DOMAINAD?>orders/active/<?php echo $value['Order']['id'] ?>" title="Đã giao hàng" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
							 
                             	  <a href="javascript:confirmDelete('<?php echo DOMAINAD?>orders/delete/<?php echo $value['Order']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                           
                                 <a href="<?php echo DOMAINAD?>orders/close/<?php echo $value['Order']['id'] ?>" title="Chưa giao hàng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>

                            <?php }?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                <?php echo $form->end(); ?>
            </table>
            
			  <p><a href="<?php echo DOMAINAD;?>orders/export_xls">Xuất ra excel</a></p> 
			<p><a href="<?php echo DOMAINAD;?>orders/export_txt">Xuất ra txt</a></p> 
			
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>