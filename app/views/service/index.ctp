<link type="text/css" href="<?php echo DOMAIN?>css/new.css" rel="stylesheet" />

<div id="content">
            			<div id="content-left">
                        		<?php echo $this->element('content_left')?>
                        </div><!-- End content-left-->
                        
                        
                        
                       <div id="content-center">
                       
                           <?php if($session->read('lang')==1) {?>
            				
                 <div id="new-product">
                                    <div class="new-product-tit">
                                    <p style="color:white; margin-left:20px;padding-top:5px;">DỊCH VỤ</p></div><!--End about-tit-->
                                
                                <div class="new-body">
                                <?php foreach($Service as $Service) {?>
                                
                                    <div class="new" style="border-bottom:1px solid #B9B9B9; padding-bottom:10px;">
                                        <div class="new-img">
                                            <img src="<?php echo DOMAINAD.$Service['Service']['images'];?>" />
                                        </div><!-- End Service-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#1B7AAA; font-weight:bold; font-size:14px;">
                                                	<?php echo $Service['Service']['name'];?>
                                                </p></li>
                                                <li><?php echo $Service['Service']['introduction'];?></li>
                                                <li><a href="<?php echo DOMAIN?>service/ctservice/<?php echo $Service['Service']['id']?>">Chi tiết >></a></li>
                                            </ul>
                                        </div><!-- End Service-content-->
                                    
                                    </div><!-- End Service-->
                                    
                                  <?php }?>  
                                  
                                    
                                   </div><!-- End Service-body -->
                      <div class="pt">
                                   	<div class="pt-pagi">
		 				<?php 
		 				
		                echo $paginator->numbers();
		                ?>
		              </div><!-- End pt-pagi-->
                   </div><!-- End pt-->
                </div><!-- End Services-->
                
                
                <?php }?>
                
                
                
                
                        <?php if($session->read('lang')==2) {?>
            				
                 <div id="new-product">
                                    <div class="new-product-tit">
                                    <p style="color:white; margin-left:20px;padding-top:5px;">SERVICE</p></div><!--End about-tit-->
                                
                                <div class="new-body">
                                <?php foreach($Service as $Service) {?>
                                
                                    <div class="new" style="border-bottom:1px solid #B9B9B9; padding-bottom:10px;">
                                        <div class="new-img">
                                            <img src="<?php echo DOMAINAD.$Service['Service']['images'];?>" />
                                        </div><!-- End Service-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#1B7AAA; font-weight:bold; font-size:14px;">
                                                	<?php echo $Service['Service']['name_eg'];?>
                                                </p></li>
                                                <li><?php echo $Service['Service']['introduction_eg'];?></li>
                                                <li><a href="<?php echo DOMAIN?>service/ctservice/<?php echo $Service['Service']['id']?>">Chi tiết >></a></li>
                                            </ul>
                                        </div><!-- End Service-content-->
                                    
                                    </div><!-- End Service-->
                                    
                                  <?php }?>  
                                  
                                    
                                   </div><!-- End Service-body -->
                      <div class="pt">
                                   	<div class="pt-pagi">
		 				<?php 
		 				
		                echo $paginator->numbers();
		                ?>
		              </div><!-- End pt-pagi-->
                   </div><!-- End pt-->
                </div><!-- End Services-->
                
                
                <?php }?>
            
            
            </div><!-- End content-center-->
                        
                        <div id="content-right">
                        
           						<?php echo $this->element('content_right')?>       
                        </div><!-- End content-right-->
                        
            </div><!-- End content-->