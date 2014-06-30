
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                <form action="<?php echo DOMAINAD; ?>products/export_nhap" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th>STT</th>
                       <th>Ngày chứng từ</th>
                       
                       <th> Số chứng từ gốc</th>
                    
                        
                         <th>Nhà cung cấp</th>
                       <th>Chi nhánh</th>
                       
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
						
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Lựa chọn</option>
                                  
                                    <option value="delete">Delete</option>
                                    <option value="xuat">Xuất excel</option>
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
                   <?php  
                   
                   foreach ($Purchasing_document as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Purchasing_document']['id'] ?>"/></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td>
                        <?php echo $html->link( $value['Purchasing_document']['document_post_date'], '/products/view_hoadonnhap/'.$value['Purchasing_document']['uuid']);?>
                        
                        </td>
							<td><?php echo $value['Purchasing_document']['internal_document_number'];?></td>
                      
                        <td><?php  echo $value['Purchasing_document']['supplier_code'];?></td>
                        <td><?php echo  $value['Purchasing_document']['branch_code'] ?></td>
                        
                    </tr>
                   <?php }?>
                </tbody>
               </form>
			    
            </table>
		
		
        </div> <!-- End #tab1 -->
                
    </div> <!-- End .content-box-content -->
 </div>


