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
 
 <link type="text/css" href="<?php echo DOMAIN ?>css/new.css" rel="stylesheet" />
 <div id="content">
 
    <div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div><!-- end content-left-->
 
 	<div id="content-center">
 	  <div class="slider1">
                        			<?php echo $this->element('slide')?>
                        		</div>
 	
 	    <?php if($session->read('lang')==1) {?>
 				
                 <div id="new-product">
                                      <h2 style="color:#37B633;margin-left:20px; padding-top:20px;">TUYỂN DỤNG</h2>
                                           
                                
 	
 			<div class="content-center-body">
 				
 					<?php foreach ($Recruitment as $Recruitment){$id=$Recruitment['Recruitment']['id'];?>
 					<div class="border-new ctnew">
		 					
		 					<div class="n-c">
				 				<ul class="content-new">
				 						<li><p style="color:#2B6AB2; font-weight:bold; font-size:20px;"><?php echo $Recruitment['Recruitment']['name']?></p> <p style="color:red;">(Ngày: <?php echo $Recruitment['Recruitment']['created']?>)</p></li>
				 						<li><?php echo $Recruitment['Recruitment']['content'];?></li>
				 							
				 				</ul>
				 				
				 			</div><!--  End -n-c -->
				 			
				 			
				 			<div class="tin-moi">
                                    		
                                            	<div class="td-timmoi"><p style="color:#1B7AA8;float:left">CÁC TIN TUYỂN DỤNG MỚI</p></div>								<ul>
                                                
                                               
                                                    <?php 
													$row= $this->requestAction("recruitment/recruitment2/$id");
													foreach($row as $row){
													?>
                                
                                                <li class="li-news">
                                                	
                                                    <a style="float:left;" href="<?php echo DOMAIN?>recruitment/ctrecruitment/<?php echo $row['Recruitment']['id']?>">
                                                    <?php echo $row['Recruitment']['name'];?></a>
                                                     <p style="color:#6D6D6D;float:left;padding-left:5px;">(<?php echo $row['Recruitment']['created'];?>)<img src="<?php echo DOMAIN?>images/Recruitment.png"></p>
                                                     
                                                </li>
                                                <?php }?>
                                               
                                            </ul>
                                    </div><!--End tin-moi-->
				 			
		 			</div><!-- End border-Recruitment -->
		 			
		 			<?php }?>
 			</div><!-- End content-center-body -->
 			</div>
 			
 			<?php }?>
 			
 			
 			   <?php if($session->read('lang')==2) {?>
 				
                 <div id="new-product">
                                    <div class="new-product-tit">
                                    <p style="color:white; margin-left:20px;padding-top:5px;">Recruitment</p></div><!--End about-tit-->
                                
                             
 	
 			<div class="content-center-body">
 				
 					<?php foreach ($Recruitment as $Recruitment){$id=$Recruitment['Recruitment']['id'];?>
 					<div class="border-new ctnew">
		 					
		 					<div class="n-c">
				 				<ul class="content-new ">
				 						<li><p style="color:#2B6AB2; font-weight:bold; font-size:20px;"><?php echo $Recruitment['Recruitment']['name_eg']?></p> <p style="color:red;">(Ngày: <?php echo $Recruitment['Recruitment']['created']?>)</p></li>
				 						<li><?php echo $Recruitment['Recruitment']['content_eg'];?></li>
				 						
				 				</ul>
				 				
				 			</div><!--  End -n-c -->
				 			
				 			
				 			<div class="tin-moi">
                                    		
                                            	<div class="td-timmoi"><p style="color:#1B7AA8;float:left">Recruitment</p></div>								<ul>
                                                
                                               
                                                    <?php 
													$row= $this->requestAction("recruitment/recruitment2/$id");
													foreach($row as $row){
													?>
                                
                                                <li class="li-Recruitments">
                                                	
                                                    <a style="float:left;" href="<?php echo DOMAIN?>recruitment/ctrecruitment/<?php echo $row['Recruitment']['id']?>">
                                                    <?php echo $row['Recruitment']['name_eg'];?></a>
                                                     <p style="color:#6D6D6D;float:left;padding-left:5px;">(<?php echo $row['Recruitment']['created'];?>)<img src="<?php echo DOMAIN?>images/Recruitment.png"></p>
                                                     
                                                </li>
                                                <?php }?>
                                               
                                            </ul>
                                    </div><!--End tin-moi-->
				 			
		 			</div><!-- End border-Recruitment -->
		 			
		 			<?php }?>
 			</div><!-- End content-center-body -->
 			</div>
 			
 			<?php }?>
 			
 			
 	</div><!-- End content-center -->
 
 <div id="content-right">
		 <?php echo $this->element('content_right')?>
 </div><!-- end content-right-->

   </div><!-- end content-->
 