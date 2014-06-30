
 <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
<div id='body'>
     
        <?php echo $this->element('slide');?>
       <?php echo $this->element('menu_top');?>
       
       <div class="d-d">
     <ul>
			
			<li><a href="<?php echo DOMAIN?>">Trang chủ</a></li>
            <li class="l-i"><a href="<?php echo DOMAIN?>">Gian hàng</a></li>
			
		 			
		 		
		 		</ul>
       </div>
       
     
      
	  
	   
	<?php 
    $n=0;
    foreach($shop as $row){ $n++;?>				
     
        <div class='product <?php if($n==2) echo "center";?>'>
        	<div style="height:50px; overflow:hidden;">
            <h2 style="margin-top:5px; margin-bottom:2px; padding:1px;"><?php echo $row['Shop']['name']?></h2>
            <h3>( <?php echo $row['Shop']['namecompany']?> )</h3>
            </div>
            <div class="div-img">
            
            
             <a href="<?php echo DOMAIN?>san-pham-gian-hang/<?php echo $row['Shop']['id']?>">
           				 <img class='img-product' src="<?php echo DOMAINAD.$row['Shop']['images']?>"/>
                         </a>
            </div>
            <div class='content-product' style=" overflow:hidden;margin-top:5px; text-align:justify;">
              <ul>
              <?php if($row['Shop']['address']!=''){?>
                <li>Địa chỉ: <?php echo $row['Shop']['address'];?></li>
                <?php }?>
                <?php if($row['Shop']['phone']!=''){?>
                <li>Điện thoại: <?php echo $row['Shop']['phone'];?></li>
                <?php }?>
              <?php if($row['Shop']['mobile']!=''){?>
                <li>Điện thoại cố định: <?php echo $row['Shop']['mobile'];?></li>
                <?php }?>
                <?php if($row['Shop']['email']!=''){?>
                <li>Email: <?php echo $row['Shop']['email'];?></li>
                <?php }?>
                
                <?php if($row['Shop']['business']!=''){?>
                <li>Lĩnh vực kinh doanh: <?php echo $row['Shop']['business'];?></li>
                <?php }?>  
              </ul>
            </div>
         
          
        </div><!--end #product-->
       <?php if($n==3) $n=0;  }?>
       
       
     <div class="pt">
                                   	<div class="pt-pagi">
                                   	     
							    
							     <?php 
							echo $paginator->numbers();
							     
							     
                                   	
		 							?>		
                                      </div><!-- End pt-pagi-->
                                     </div><!-- End pt-->
    
    

           
        <div class="clear margin"></div>
    </div><!--end #body-->
    
