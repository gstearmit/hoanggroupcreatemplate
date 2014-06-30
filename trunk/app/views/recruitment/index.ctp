<style>
.new{width:650px; overflow:hidden; margin-top:10px;}
.new-img{width:50px;float:left;overflow:hidden;margin-left:10px;}
.new-img img{width:50px; height:50px;}


.new-content{width:445px;overflow:hidden;padding-left:20px;}
.new-content li{margin-top:10px;}
.new-content li a{ color:#1A79A9;}
.new-content li a:hover{color:red;}
.new-body{background:white; overflow:hidden;}
.pt {
	margin-top:10px;
    margin-bottom: 10px;
    margin-left: 10px;
    overflow: hidden;
}
.pt-pagi {
    margin-right: 10px;
    text-align: right;
}
.pt-pagi > span {
    background: none repeat scroll 0 0 #ACACAC;
    padding: 5px;
}
.pt-pagi span a {
    color: #006600;
}
.current {
    color: red;
}


</style>

<div id="content">
            			<div id="content-left">
                        		<?php echo $this->element('content_left')?>
                        </div><!-- End content-left-->
                        
                        
                        
                       <div id="content-center">
                       
                           <?php if($session->read('lang')==1) {?>
                           
                           <div class="slider1">
                        			<?php echo $this->element('slide')?>
                        		</div>
            				
                 <div id="new-product">
                                    <h2 style="color:#37B633;margin-left:20px; padding-top:20px;">TUYỂN DỤNG</h2>
                                           
                                
                                <div class="new-body">
                                <?php foreach($Recruitment as $Recruitment) {?>
                                    <div class="new" style="border-bottom:1px solid #B9B9B9; padding-bottom:10px;">
                                        <div class="new-img">
                                            <img src="<?php echo DOMAINAD.$Recruitment['Recruitment']['images'];?>" />
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#1B7AAA; font-weight:bold; font-size:14px;">
                                            	<a href="<?php echo DOMAIN?>recruitment/ctrecruitment/<?php echo $Recruitment['Recruitment']['id']?>">
                                                	<?php echo $Recruitment['Recruitment']['name'];?>
                                                	</a>
                                                </p></li>
                                                
                                            </ul>
                                        </div><!-- End new-content-->
                                    
                                    </div><!-- End new-->
                                    
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
                                     <h2 style="color:#37B633;margin-left:20px; padding-top:20px;">NEWS</h2>
                                 
                                
                                <div class="new-body">
                                <?php foreach($new as $new) {?>
                                    <div class="new" style="border-bottom:1px solid #B9B9B9; padding-bottom:10px;">
                                        <div class="new-img">
                                            <img src="<?php echo DOMAINAD.$new['New']['images'];?>" />
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#1B7AAA; font-weight:bold; font-size:14px;">
                                                	<?php echo $new['New']['title_eg'];?>
                                                </p></li>
                                                <li><?php echo $new['New']['introduction_eg'];?></li>
                                                <li><a href="<?php echo DOMAIN?>news/ctnews/<?php echo $new['New']['id']?>">Chi tiết >></a></li>
                                            </ul>
                                        </div><!-- End new-content-->
                                    
                                    </div><!-- End new-->
                                    
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