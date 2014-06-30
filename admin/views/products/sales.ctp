
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                <form action="<?php echo DOMAINAD; ?>products/export_ban" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th>STT</th>
                       <th>Ngày chứng từ</th>
                       
                       <th> Số chứng từ gốc</th>
                    
                        
                         <th>Khách hàng</th>
                       <th>Chi nhánh</th>
					   
                         <th>Người bán</th>
                       <th>Tổng trị giá</th>
                       
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
						
                            <div class="bulk-actions align-left">
                              
                                <a class="button" href="#" onclick="document.form1.submit();">Xuất excel</a>
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
                   <?php  
                   
                   foreach ($Sale_document as $key =>$value){?>
                    <tr>
                        
						 <td><input type="checkbox" name="<?php echo $value['Sale_document']['id'] ?>"/></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td>
                        <?php echo $html->link( $value['Sale_document']['document_post_date'], '/products/view_hoadonban/'.$value['Sale_document']['uuid']);?>
                        
                        </td>
							<td><?php echo $value['Sale_document']['internal_document_number'];?></td>
                      
                        <td><?php  echo $value['Sale_document']['customer_code'];?></td>
                        <td><?php echo  $value['Sale_document']['branch_code'] ?></td>
						
						 <td><?php  echo $value['Sale_document']['sale_by'];?></td>
                        <td><?php echo  $value['Sale_document']['total_for_payment'] ?></td>
                        
                    </tr>
                   <?php }?>
                </tbody>
               </form>
			    
            </table>
           
        </div> <!-- End #tab1 -->
                
    </div> <!-- End .content-box-content -->
 </div>


