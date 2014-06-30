
<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/style1.css"/>


  <?php if($session->read('lang')==1) {?>
            <div id="content">
            <div class="dd">
            <?php foreach ($About as $About)
            {$n=$About['About']['id'];
            
            ?>
            	<ul><li><a href="<?php echo DOMAIN?>">Trang chủ /</a></li>
            	<li><a href="<?php echo DOMAIN?>gioithieu">Giới thiệu /</a></li>
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>gioi-thieu/<?php echo $About['About']['id'];?>"><?php echo $About['About']['name'];?></a></li>
            	
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            		<div class="menu-left">
            		<div class="video-title"><h2>DANH MỤC GIỚI THIỆU</h2></div>
            		<div class="mn-bd">
            		
            			<ul>
            			 <?php $row=$this->requestAction('/comment/about');
					  
					  foreach ($row as $row){
					  ?>
					  <li class="li-mn <?php if($n==$row['About']['id']) echo "li-1"?>"><a href="<?php echo DOMAIN?>gioi-thieu/<?php echo $row['About']['id']?>"><?php echo $row['About']['name']?></a></li>
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
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;"><?php echo $About['About']['name'];?></h2>
            		</div>
            		
            		<div class="bd-right">
            		<?php echo $About['About']['content'];?></div>
            		
            		<?php }?>
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
		<?php }?>
		
		
		  <?php if($session->read('lang')==2) {?>
            <div id="content">
            <div class="dd">
            <?php foreach ($About as $About)
            {$n=$About['About']['id'];
            
            ?>
            	<ul><li><a href="<?php echo DOMAIN?>">Home /</a></li>
            	<li><a href="<?php echo DOMAIN?>gioithieu">About /</a></li>
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>gioi-thieu/<?php echo $About['About']['id'];?>"><?php echo $About['About']['name_eg'];?></a></li>
            	
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            		<div class="menu-left">
            		<div class="video-title"><h2>ABOUT THE LIST</h2></div>
            		<div class="mn-bd">
            		
            			<ul>
            			 <?php $row=$this->requestAction('/comment/about');
					  
					  foreach ($row as $row){
					  ?>
					  <li class="li-mn <?php if($n==$row['About']['id']) echo "li-1"?>"><a href="<?php echo DOMAIN?>gioi-thieu/<?php echo $row['About']['id']?>"><?php echo $row['About']['name_eg']?></a></li>
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
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;"><?php echo $About['About']['name_eg'];?></h2>
            		</div>
            		
            		<div class="bd-right">
            		<?php echo $About['About']['content_eg'];?></div>
            		
            		<?php }?>
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
		<?php }?>