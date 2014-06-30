<link type="text/css" href="<?php echo DOMAIN?>css/new.css" rel="stylesheet" />
<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/style1.css"/>

            <div id="content">
            <div class="dd">
        	<ul><li><a href="<?php echo DOMAIN?>">Trang chủ /</a></li>
            	
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>doi-tac">Đối tác</a></li>
            	
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            		<div style="margin-top:16px;">
            		<?php echo $this->element('help');?>
            		</div> 	
            		<?php echo $this->element('video');?>
            		<?php echo $this->element('tigia');?>  	
            	</div><!-- End content-left -->
            	
            	
            	
            	<div class="content-right">
            		<div class="tit-right">
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;">ĐỐI TÁC</h2>
            		</div>
            		
            		<div class="bd-right">
            		
            		   <?php foreach($Partner as $row) {?>
                                    <div class="new" style="border-bottom:1px solid #f1e1bf; padding-bottom:10px;">
                                        <div class="new-img">
                                        
                                            <img src="<?php echo DOMAINAD.$row['Partner']['images'];?>" />
                                         
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#65390d; font-weight:bold; font-size:14px;">
                                                	<?php echo $row['Partner']['name'];?>
                                                </p></li>
                                                <li style="color:#65390d;">Website: <a class="a-web" href="<?php echo $row['Partner']['website'];?>" target="_blank">
                                                <?php echo $row['Partner']['website'];?></a>
                                                </li>
                                                  <li style="color:#65390d;">
                                                  Lĩnh vực hoạt động:
                                                <?php echo $row['Partner']['area'];?>
                                                </li>
                                              </ul>
                                        </div><!-- End new-content-->
                                    
                                    </div><!-- End new-->
                                    
                                  <?php }?>  
                                  
                                  
                                    <div class="pt">
                                   	<div class="pt-pagi">
                                   	     
							    
							     <?php 
							echo $paginator->numbers();
							     
							     
                                   	
		 							?>		
                                      </div><!-- End pt-pagi-->
                                     </div><!-- End pt-->
            		</div>
            	
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
		