<style>
.content-new {margin:0px 10px 0px 10px;}
.content-center-body{background:white;}
.content-new li{margin-top:10px;}
.tin-moi {
    margin-bottom: 30px;
    margin-left: 20px;
    overflow: hidden;
    padding-top: 20px;
    width: 550px;
}
.tin-moi ul {
    margin-top: 10px;
}
.tin-moi li {
    float: left;
    margin-top: 5px;
    width: 550px;
}
.tin-moi li a {
    color: black;
}
.tin-moi li a:hover {
    color: red;
}

.td-timmoi{border-bottom:1px dotted; overflow:hidden;padding-bottom:10px;}
</style>
 <div id="content">
 
    <div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div><!-- end content-left-->
 
 	<div id="content-center">
 	
 	    <?php if($session->read('lang')==1) {?>
 	
 	  <div id="new-product">
                                    <div class="new-product-tit">
                                    <p style="color:white; margin-left:20px;padding-top:5px;">DỊCH VỤ</p></div><!--End about-tit-->
                                
                        
 			
 			<div class="content-center-body">
 				
 					<?php foreach ($Service as $Service){ $id=$Service['Service']['id'];?>
 					<div class="border-new ctnew">
		 					
		 					<div class="n-c">
				 				<ul class="content-new ">
				 						<li>
                                        <p style="color:#2B6AB2; font-weight:bold; font-size:20px;">
										<?php echo $Service['Service']['name']?>
                                        </p></li>
				 						<li><?php echo $Service['Service']['content'];?></li>
				 						
				 						
				 				</ul>
				 				<?php } ?>
				 			</div><!--  End -n-c -->
				 			
				 			
				 				
				 			<div class="tin-moi">
                                    		
                                            	<div class="td-timmoi"><p style="color:#1B7AA8;float:left">DANH SÁCH DỊCH VỤ</p></div>								<ul>

                                                    <?php 
													$row= $this->requestAction("service/service1/$id");
													foreach($row as $row){
													?>
                                
                                                <li class="li-news">
                                                	
                                                    <a style="float:left;" href="<?php echo DOMAIN?>service/ctservice/<?php echo $row['Service']['id']?>">
                                                    <?php echo $row['Service']['name'];?></a>
                                                     
                                                </li>
                                                <?php }?>
                                               
                                            </ul>
                                    </div><!--End tin-moi-->
				 			
		 			</div><!-- End border-new -->
		 			
 			</div><!-- End content-center-body -->
 			</div>
 			
 			<?php }?>
 			
 			
 			
 	    <?php if($session->read('lang')==2) {?>
 	
 	  <div id="new-product">
                                    <div class="new-product-tit">
                                    <p style="color:white; margin-left:20px;padding-top:5px;">SERVICE</p></div><!--End about-tit-->
                                
                        
 			
 			<div class="content-center-body">
 				
 					<?php foreach ($Service as $Service){ $id=$Service['Service']['id'];?>
 					<div class="border-new ctnew">
		 					
		 					<div class="n-c">
				 				<ul class="content-new ">
				 						<li>
                                        <p style="color:#2B6AB2; font-weight:bold; font-size:20px;">
										<?php echo $Service['Service']['name_eg']?>
                                        </p></li>
				 						<li><?php echo $Service['Service']['content_eg'];?></li>
				 						
				 						
				 				</ul>
				 				<?php } ?>
				 			</div><!--  End -n-c -->
				 			
				 			
				 				
				 			<div class="tin-moi">
                                    		
                                            	<div class="td-timmoi"><p style="color:#1B7AA8;float:left">SERVICE LIST</p></div>								<ul>

                                                    <?php 
													$row= $this->requestAction("service/service1/$id");
													foreach($row as $row){
													?>
                                
                                                <li class="li-news">
                                                	
                                                    <a style="float:left;" href="<?php echo DOMAIN?>service/ctservice/<?php echo $row['Service']['id']?>">
                                                    <?php echo $row['Service']['name_eg'];?></a>
                                                     
                                                </li>
                                                <?php }?>
                                               
                                            </ul>
                                    </div><!--End tin-moi-->
				 			
		 			</div><!-- End border-new -->
		 			
 			</div><!-- End content-center-body -->
 			</div>
 			
 			<?php }?>
 	</div><!-- End content-center -->
 
 <div id="content-right">
		 <?php echo $this->element('content_right')?>
 </div><!-- end content-right-->

   </div><!-- end content-->
 