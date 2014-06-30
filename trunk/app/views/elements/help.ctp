  <?php if($session->read('lang')==1) {?>

<div class="help">
	            				<h2>HỖ TRỢ KHÁCH HÀNG</h2>
	            				<ul>
	            				<?php 
	            				$setting=$this->requestAction('comment/setting');
	            				foreach ($setting as $row){
	            				?>
	            					<li>
	            					Hotline: <span style="font-size:16px; color:white;">
	            					<?php echo $row['Setting']['phone'];?>
	            					</span>
	            					</li>
	            					<li>Email: <?php echo $row['Setting']['email'];?></li>
	            					<?php }
	            				$help=$this->requestAction('comment/helpsonline');
	            				foreach ($help as $row){
	            				?>
	            					<li style="float:left;">
	            					
	            						 <a class="a-ya" href="ymsgr:sendIM?<?php echo $row['Helps']['yahoo'];?>" border="0">
	            						<img src="<?php echo DOMAIN?>images/yahoo.png"/>
	            						</a>
	            				
	            						 <a href="skype:<?echo $row['Helps']['skype']?>?call">
	            						 	<img src="<?php echo DOMAIN?>images/skype.png" style="border: none;"/>
	            						 </a>
	            						 </li><li style="padding-left:10px; overflow:hidden;">
	            						 <p style="color:#f1e1bf;">
	            						 <?echo $row['Helps']['name']?>
	            						 <br>
	            						 Tel: <?echo $row['Helps']['sdt']?>
	            						 </p>
                            		
	            					</li>
	            					<?php }?>
	            				</ul>
	            			</div><!-- ENd  help-->
	            			
<?php }?>	  


  <?php if($session->read('lang')==2) {?>

<div class="help">
	            				<h2>CUSTOMER SUPPORT</h2>
	            				<ul>
	            				<?php 
	            				$setting=$this->requestAction('comment/setting');
	            				foreach ($setting as $row){
	            				?>
	            					<li>
	            					Hotline: <span style="font-size:16px; color:white;">
	            					<?php echo $row['Setting']['phone'];?>
	            					</span>
	            					</li>
	            					<li>Email: <?php echo $row['Setting']['email'];?></li>
	            					<?php }
	            				$help=$this->requestAction('comment/helpsonline');
	            				foreach ($help as $row){
	            				?>
	            					<li style="float:left;">
	            					
	            						 <a class="a-ya" href="ymsgr:sendIM?<?php echo $row['Helps']['yahoo'];?>" border="0">
	            						<img src="<?php echo DOMAIN?>images/yahoo.png"/>
	            						</a>
	            				
	            						 <a href="skype:<?echo $row['Helps']['skype']?>?call">
	            						 	<img src="<?php echo DOMAIN?>images/skype.png" style="border: none;"/>
	            						 </a>
	            						 </li><li style="padding-left:10px; overflow:hidden;">
	            						 <p style="color:#f1e1bf;">
	            						 <?echo $row['Helps']['name']?>
	            						 <br>
	            						 Tel: <?echo $row['Helps']['sdt']?>
	            						 </p>
                            		
	            					</li>
	            					<?php }?>
	            				</ul>
	            			</div><!-- ENd  help-->
	            			
<?php }?>	
	            			
	            			