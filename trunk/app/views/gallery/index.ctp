﻿<style>
.p-p {
    margin-left: 30px;
    margin-top: 5px;
}
.p-p a {
    color: #2A6BB5;
}
.p-p a:hover {
    color: red;}
    
 .new-Gallery-body{height:600px;}
 table{margin-left:20px;}
 .listGallery_name{padding-top:10px;}

 
.d-d{width:600px; height:40px; overflow:hidden;}
.d-d ul{margin-top:10px; margin-left:20px;}
.d-d ul a{margin-left:10px;color:#837F7E; font-size:14px;}
.d-d ul a:hover{color:black;}

.new{width:650px; overflow:hidden; margin-top:10px;}
.new-img{width:150px;float:left;overflow:hidden;margin-left:10px;}
.new-img img{width:150px; height:120px;}


.new-content{width:410px;overflow:hidden;padding-left:20px;}
.new-content li{margin-top:10px;}
.new-content li a{color:#1A79A9;}
.new-content li a:hover{color:red;}
.new-body{background:white; overflow:hidden;}

.new li{margin-top:10px;}

</style>
          <?php if($session->read('lang')==1) {?>  
 <div id="content">
 
    <div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div><!-- end content-left-->
 
 	<div id="content-center">
 	 <div class="slider1">
                        			<?php echo $this->element('slide')?>
                        		</div>
 	
 	<div class="new-Gallery">
       <h2 style="color:#37B633;margin-left:20px; padding-top:20px;">Ảnh</h2>
                                           
                                                             <div class="new-Gallery-body">
                       
							                          
                      
                             <?php
                             foreach($Gallery as $row){
                             	
                             	?>
                             
                           <div class="new" style="border-bottom:1px solid #B9B9B9; padding-bottom:10px;">
                           			<ul>
                           			<li><p style="color:#1B7AAA; font-weight:bold; font-size:16px; margin-left:20px;">
                                                	<?php echo $row['Gallery']['name'];?>
                                                </p></li>
                                                
                                                <li style="margin-left:20px;"><img style="width:450px; height:250px;" src="<?php echo DOMAINAD.$row['Gallery']['images'];?>" /></li>
                                                       
                           			</ul>
                                    </div><!-- End new-->
                            
                              
                              <?php }?>
                              
                              
                                </div><!--End new-Gallery-body-->
                                
                                
                          </div><!--End new-Gallery-->
                               
 	</div><!-- End content-center -->
 
 <div id="content-right">
		 <?php echo $this->element('content_right')?>
 </div><!-- end content-right-->

   </div><!-- end content-->
   <?php }?>
 
 
 
    <?php if($session->read('lang')==2) {?>  
 <div id="content">
 
    <div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div><!-- end content-left-->
 
 	<div id="content-center">
 	 <div class="slider1">
                        			<?php echo $this->element('slide')?>
                        		</div>
 	
 	<div class="new-Gallery">
       <h2 style="color:#37B633;margin-left:20px; padding-top:20px;font-size:20px;">Gallery</h2>
                                           
                                                             <div class="new-Gallery-body">
                       
							                          
                      
                             <?php
                             foreach($Gallery as $row){
                             	
                             	?>
                             
                           <div class="new" style="border-bottom:1px solid #B9B9B9; padding-bottom:10px;">
                           			<ul>
                           			<li><p style="color:#1B7AAA; font-weight:bold; font-size:16px; margin-left:20px;">
                                                	<?php echo $row['Gallery']['name_eg'];?>
                                                </p></li>
                                                
                                                <li style="margin-left:20px;"><img style="width:450px; height:250px;" src="<?php echo DOMAINAD.$row['Gallery']['images'];?>" /></li>
                                                    
                           			</ul>
                                    </div><!-- End new-->
                            
                              
                              <?php }?>
                              
                              
                                </div><!--End new-Gallery-body-->
                                
                                
                          </div><!--End new-Gallery-->
                               
 	</div><!-- End content-center -->
 
 <div id="content-right">
		 <?php echo $this->element('content_right')?>
 </div><!-- end content-right-->

   </div><!-- end content-->
   <?php }?>