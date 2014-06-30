<style>
.catalog{margin-left:10px;}

</style>

<link type="text/css" href="<?php echo DOMAIN?>css/new.css" rel="stylesheet" />

<div id="content">
            			<div id="content-left">
                        		<?php echo $this->element('content_left')?>
                        </div><!-- End content-left-->
                        
                        
                        
                       <div id="content-center">
                       
                           <?php if($session->read('lang')==1) {?>
            				
                 <div id="new-product">
                                    <div class="new-product-tit">
                                    <p style="color:white; margin-left:20px;padding-top:5px;">CATALOG</p></div><!--End about-tit-->
                                
                                
                                <div class="new-body">
                               	<?php
				
				foreach ( $Catalog as $cat ) {
					?>
			
					<div class="catalog">
					<ul>
						<li style="border-left:3px solid #A9A9A9;margin-top:30px;padding-left:5px;font-size:16px;"><?php echo $cat['Catalog']['title'] ?> <a style="color:black;font-size:16px;"href="<?php echo DOMAINAD.$cat['Catalog']['link']?>">Download <img src="<?php echo DOMAIN?>images/save.png"/></a> </li>
					<li style="border-top:1px dotted;margin-top:10px;">
						<img style="width:80px; height:110px; margin-top:10px;" src="<?php echo DOMAINAD.$cat['Catalog']['images'];?>" /> 
						
					</li>
					</ul>
					
						
						
						</div>
				
		 		<?php }?>
                                  
                                    <div class="pt">
                                   	<div class="pt-pagi">
		 									<?php echo $paginator->numbers();?>
                                      </div><!-- End pt-pagi-->
                                     </div><!-- End pt-->
                                    
                                   </div><!-- End new-body -->
                            
                </div><!-- End news-->
                
                
                <?php }?>
                
                
                <?php if($session->read('lang')==2) {?>
            				
                 <div id="new-product">
                                    <div class="new-product-tit">
                                    <p style="color:white; margin-left:20px;padding-top:5px;">CATALOG</p></div><!--End about-tit-->
                                
                                
                                <div class="new-body">
                                	<?php
				
				foreach ( $Catalog as $cat ) {
					?>
			
					<div class="catalog">
					<ul>
						<li style="border-left:3px solid #A9A9A9;margin-top:30px;padding-left:5px;font-size:16px;"><?php echo $cat['Catalog']['title_eg'] ?> <a style="color:black;font-size:16px;"href="<?php echo DOMAINAD.$cat['Catalog']['link']?>">Download <img src="<?php echo DOMAIN?>images/save.png"/></a> </li>
					<li style="border-top:1px dotted;margin-top:10px;">
						<img style="width:80px; height:110px; margin-top:10px;" src="<?php echo DOMAINAD.$cat['Catalog']['images'];?>" /> 
						
					</li>
					</ul>
					
						
						
						</div>
				
		 		<?php }?>
                                  
                                  
                                    <div class="pt">
                                   	<div class="pt-pagi">
		 									<?php echo $paginator->numbers();?>
                                      </div><!-- End pt-pagi-->
                              </div><!-- End pt-->
                                    
                                   </div><!-- End new-body -->
                            
                </div><!-- End news-->
                
                
                <?php }?>
            
            
            </div><!-- End content-center-->
                        
                        <div id="content-right">
                        
           						<?php echo $this->element('content_right')?>       
                        </div><!-- End content-right-->
                        
            </div><!-- End content-->


