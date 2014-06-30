<style>
.p-p {
    margin-left: 30px;
    margin-top: 5px;
}
.p-p a {
    color: #2A6BB5;
}
.p-p a:hover {
    color: red;}
    
 .new-product-body{height:600px;}
 table{margin-left:20px;}
 .listproduct_name{padding-top:10px;}

 
.d-d{width:600px; height:40px; overflow:hidden;}
.d-d ul{margin-top:10px; margin-left:20px;}
.d-d ul a{margin-left:10px;color:#837F7E; font-size:14px;}
.d-d ul a:hover{color:black;}

.new{width:590px; overflow:hidden; margin-top:10px;}
.new-img{width:150px;float:left;overflow:hidden;margin-left:10px;}
.new-img img{width:150px; height:120px;}


.new-content{width:410px;overflow:hidden;padding-left:20px;}
.new-content li{margin-top:10px;}
.new-content li a{color:#1A79A9;}
.new-content li a:hover{color:red;}
.new-body{background:white; overflow:hidden;}

.pt {
	margin-top:10px;
    margin-bottom: 10px;
    margin-left: 10px;
    overflow: hidden;
}
.pt-pagi {
   text-align:center;
}
.pt-pagi > span {
    background: none repeat scroll 0 0 #ACACAC;
    padding: 5px;
}
.pt-pagi span a {
    color: #006600;text-align:center;
}
.current {
    color: red;
}

</style>


<!-- lightbox -->



<script src="<?php echo DOMAIN?>js/fancybox/jquery.fancybox-1.3.2.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo DOMAIN?>js/stickytooltip.js">
</script>

<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>css/stickytooltip.css" />

<!-- End lightbox -->
<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>css/lightbox.css" />

<script src="<?php echo DOMAIN?>js/lightbox.js"></script>

<script>
  jQuery(document).ready(function($) {
      $('a').smoothScroll({
        speed: 1000,
        easing: 'easeInOutCubic'
      });

      $('.showOlderChanges').on('click', function(e){
        $('.changelog .old').slideDown('slow');
        $(this).fadeOut();
        e.preventDefault();
      })
  });

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2196019-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


 <?php if($session->read('lang')==1) {?>  
 <div id="content">
 
    <div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div><!-- end content-left-->
 
 	<div id="content-center">
 	 <div class="slider1">
                        			<?php echo $this->element('slide')?>
                        		</div>
 	
 	<div class="new-product">
       <h2 style="color:#37B633;margin-left:20px; padding-top:20px;">KẾT QUẢ TÌM KIẾM </h2>
                                           
                                                             <div class="new-product-body">
                       
							                        
                                
                                
                      
                             <?php $i=0; 
                             foreach($prod as $row){$i++;
                             	
                             	?>
                             
                           <div class="new" style="border-bottom:1px solid #B9B9B9; padding-bottom:10px;">
                                        <div class="new-img">
                                        <a href="<?php echo DOMAIN?>product/index/<?php echo $row['Product']['id']?>">
                                            <img data-tooltip="sticky<?php echo $i?>" src="<?php echo DOMAINAD.$row['Product']['images'];?>" />
                                            </a>
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#1B7AAA; font-weight:bold; font-size:14px;">
                                            	<a href="<?php echo DOMAIN?>product/index/<?php echo $row['Product']['id']?>">
                                                	<?php echo $row['Product']['title'];?>
                                                	</a>
                                                </p></li>
                                                <li><?php echo $row['Product']['introduction'];?></li>
                                            </ul>
                                        </div><!-- End new-content-->
                                    
                                    </div><!-- End new-->
                            
                              
                              <?php }?>
                              
                              
                             
                                 <div id="mystickytooltip" class="stickytooltip" style="border:none;">
                                 
                                   <?php $i=0; 
                             foreach($prod as $row){$i++;
                             	
                             	?>
               
					                   <div id="sticky<?php echo $i?>" class="atip" style="width:300px; heidht:250px;border:none;">
                                       <img  style="width:300px; heidht:250px;border:none;" src="<?php echo DOMAINAD.$row['Product']['images']?>" />
                                       </div>
                                       <?php }?>
                                       
                                </div><!--End mystickytooltip-->
                             
                             
                             
                             
                    
                             
                                </div><!--End new-product-body-->
                                
                                
                          </div><!--End new-product-->
     
                                                <div class="pt">
												 			<div class="pt-pagi">
												 					<?php echo $paginator->numbers();?>
												            </div>
		 										</div><!--  End pt -->
		 										
                                         
                               
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
 	
 	<div class="new-product">
       <h2 style="color:#37B633;margin-left:20px; padding-top:20px;">SEARCH RESULT </h2>
                                           
                                                             <div class="new-product-body">
                       
							                      
                                
                      
                             <?php $i=0; 
                             foreach($prod as $row){$i++;
                             	
                             	?>
                             
                           <div class="new" style="border-bottom:1px solid #B9B9B9; padding-bottom:10px;">
                                        <div class="new-img">
                                        <a href="<?php echo DOMAIN?>product/index/<?php echo $row['Product']['id']?>">
                                            <img data-tooltip="sticky<?php echo $i?>" src="<?php echo DOMAINAD.$row['Product']['images'];?>" />
                                            </a>
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#1B7AAA; font-weight:bold; font-size:14px;">
                                            	<a href="<?php echo DOMAIN?>product/index/<?php echo $row['Product']['id']?>">
                                                	<?php echo $row['Product']['title_eg'];?></a>
                                                </p></li>
                                                <li><?php echo $row['Product']['introduction_eg'];?></li>
                                            </ul>
                                        </div><!-- End new-content-->
                                    
                                    </div><!-- End new-->
                            
                              
                              <?php }?>
                              
                              
                             
                                 <div id="mystickytooltip" class="stickytooltip" style="border:none;">
                                 
                                   <?php $i=0; 
                             foreach($prod as $row){$i++;
                             	
                             	?>
               
					                   <div id="sticky<?php echo $i?>" class="atip" style="width:300px; heidht:250px;border:none;">
                                       <img  style="width:300px; heidht:250px;border:none;" src="<?php echo DOMAINAD.$row['Product']['images']?>" />
                                       </div>
                                       <?php }?>
                                       
                                </div><!--End mystickytooltip-->
                             
                             
                             
                             
                    
                             
                                </div><!--End new-product-body-->
                                
                                
                          </div><!--End new-product-->
     
                                                <div class="pt">
												 			<div class="pt-pagi">
												 					<?php echo $paginator->numbers();?>
												            </div>
		 										</div><!--  End pt -->
		 										
                                         
                               
 	</div><!-- End content-center -->
 
 <div id="content-right">
		 <?php echo $this->element('content_right')?>
 </div><!-- end content-right-->

   </div><!-- end content-->
   <?php }?>
 
 
 
 
 