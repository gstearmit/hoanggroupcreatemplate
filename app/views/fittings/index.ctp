<div id="main">
   <div id="product-views">
            <h2 class="style_h2">PHỤ KIỆN</h2>
          <ul>
              <?php if(!empty($menshoes)){?>
               <?php foreach ($menshoes as $productview2){ ?>                  
                    <li>          
                           <?php  if($productview2['Product']['images']!='') {?>
                               <img src="<?php echo DOMAINAD.$productview2['Product']['images'];?>" alt="<?php echo $productview2['Product']['title'];?>" />
                             <?php }
                             else {?>
                             <div class="style_img"></div>
                             <?php }?> 
                        <h1 class="style_h1"> <a href="<?php echo DOMAIN?>chi-tiet-san-pham/<?php echo $productview2['Product']['id']?>">
                         <?php echo strip_tags($this->Text->truncate( $productview2['Product']['title'],18,array('ending' => '...','exact' => false)));?></a></h1>
                        <h4 style="font-weight:bold; color:#cacaca;"><span style="float:left"> Giá: </span><span style="color:#FF5E24; float:left;"><?php echo $productview2['Product']['price'];?></span></h4>                              
                  </li>             
             <?php } ?>             
         </ul>   
         <?php }  else {?>    
         <span style="color:#5484FF;  margin-left:100px;">
         <?php echo 'Chưa có tin'; ?>
         </span>
         <?php }?>                   
	</div> 
     <div id="page">        	
                <?php
                    $paginator->options(array('url' => $this->passedArgs));
                    echo $paginator->prev('Back', null, null, array('class' => 'disabled'));echo "&nbsp;&nbsp;&nbsp;";
                    echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
                    echo $paginator->next('Next' , null, null, array('class' => 'disabled'));
                    echo "</span>";
                ?>                
      </div> 
</div>