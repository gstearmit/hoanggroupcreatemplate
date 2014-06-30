<link type="text/css" href="<?php echo DOMAIN?>css/new.css" rel="stylesheet" />
<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/style1.css"/>

  <?php if($session->read('lang')==1) {?>

            <div id="content">
            <div class="dd">
          <?php foreach ($category as $category){
          $n=$category['Category']['id'];
          	?>
            	<ul><li><a href="<?php echo DOMAIN?>">Trang chủ /</a></li>
            	<li><a href="<?php echo DOMAIN?>tin-tuc">Tin tức /</a></li>
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>tin-tuc/"><?php echo $category['Category']['name'];?> </a></li>
            	
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            		<div class="menu-left">
            		<div class="video-title"><h2>DANH MỤC TIN TỨC</h2></div>
            		<div class="mn-bd">
            		
            			<ul>
            			 <?php $row=$this->requestAction('/comment/category');
					  
					  foreach ($row as $row){
					  ?>
					  <li class="li-mn <?php if($n==$row['Category']['id']) echo "li-1";?>"><a href="<?php echo DOMAIN?>tin-tuc/<?php echo $row['Category']['id']?>"><?php echo $row['Category']['name']?></a></li>
					  <?php }?>
            			
            			
            				
            			</ul>
            			</div>
            		</div><!-- End menu-left -->
            		<div style="margin-top:20px;">
            		<?php echo $this->element('help');?>
            		</div> 	
            		<?php echo $this->element('video');?>
            		<?php echo $this->element('tigia');?>  	
            	</div><!-- End content-left -->
            	
            	
            	
            	<div class="content-right">
            		<div class="tit-right">
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;"><?php echo $category['Category']['name'];?></h2>
            		</div>
            		<?php }?>
            		<div class="bd-right">
            		
            		   <?php foreach($new as $new) {?>
                                    <div class="new" style="border-bottom:1px solid #f1e1bf; padding-bottom:10px;">
                                        <div class="new-img">
                                            <img src="<?php echo DOMAINAD.$new['New']['images'];?>" />
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#65390d; font-weight:bold; font-size:14px;">
                                                	<?php echo $new['New']['title'];?>
                                                </p></li>
                                                <li style="color:#65390d;"><?php echo $new['New']['introduction'];?></li>
                                                <li><a class="a-ct" href="<?php echo DOMAIN?>chi-tiet-tin/<?php echo $new['New']['id']?>">Chi tiết</a></li>
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
		
		<?php }?>
		
		
		  <?php if($session->read('lang')==2) {?>

            <div id="content">
            <div class="dd">
          <?php foreach ($category as $category){
          $n=$category['Category']['id'];
          	?>
            	<ul><li><a href="<?php echo DOMAIN?>">Home /</a></li>
            	<li><a href="<?php echo DOMAIN?>tin-tuc">News /</a></li>
            	
            	 <?php $row=$this->requestAction('/comment/category');
					  
					  foreach ($row as $row){
					  ?>
            	
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>tin-tuc/<?php echo $row['Category']['id']?>"><?php echo $category['Category']['name_eg'];?> </a></li>
            	<?php break;}?>
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            		<div class="menu-left">
            		<div class="video-title"><h2>NEWS LIST</h2></div>
            		<div class="mn-bd">
            		
            			<ul>
            			 <?php $row=$this->requestAction('/comment/category');
					  
					  foreach ($row as $row){
					  ?>
					  <li class="li-mn <?php if($n==$row['Category']['id']) echo "li-1";?>"><a href="<?php echo DOMAIN?>tin-tuc/<?php echo $row['Category']['id']?>"><?php echo $row['Category']['name_eg']?></a></li>
					  <?php }?>
            			
            			
            				
            			</ul>
            			</div>
            		</div><!-- End menu-left -->
            		<div style="margin-top:20px;">
            		<?php echo $this->element('help');?>
            		</div> 	
            		<?php echo $this->element('video');?>
            		<?php echo $this->element('tigia');?>  	
            	</div><!-- End content-left -->
            	
            	
            	
            	<div class="content-right">
            		<div class="tit-right">
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;"><?php echo $category['Category']['name_eg'];?></h2>
            		</div>
            		<?php }?>
            		<div class="bd-right">
            		
            		   <?php foreach($new as $new) {?>
                                    <div class="new" style="border-bottom:1px solid #f1e1bf; padding-bottom:10px;">
                                        <div class="new-img">
                                            <img src="<?php echo DOMAINAD.$new['New']['images'];?>" />
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#65390d; font-weight:bold; font-size:14px;">
                                                	<?php echo $new['New']['title_eg'];?>
                                                </p></li>
                                                <li style="color:#65390d;"><?php echo $new['New']['introduction_eg'];?></li>
                                                <li><a class="a-ct" href="<?php echo DOMAIN?>chi-tiet-tin/<?php echo $new['New']['id']?>">Details</a></li>
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
		
		<?php }?>