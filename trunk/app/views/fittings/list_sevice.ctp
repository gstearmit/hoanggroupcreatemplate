<div id="main">
   <div id="product-views">
         <h2 style="color:#FFF;"><?php echo $services[0]['Category2']['name'];?></h2>
          <ul>
              <?php if(!empty($services[0]['Product'])){?>
               <?php foreach ($services[0]['Product'] as $productview2){ ?>                  
                    <li>          
                           <?php  if($productview2['images']!='') { //pr($productview2['images']);die;?>
                               <img src="<?php echo DOMAINAD.$productview2['images'];?>" />
                             <?php }
                             else {?>
                             <div class="style_img"></div>
                             <?php }?> 
                        <h1 class="style_h1"> <a href="<?php echo DOMAIN?>listproducts/view/<?php echo $productview2['id']?>">
                         <?php echo strip_tags($this->Text->truncate( $productview2['title'],18,array('ending' => '...','exact' => false)));?>-<?php echo $productview2['code'];?> </a></h1>
                        <h4 style="font-weight:bold; color:#cacaca;"><span style="float:left"> Giá: </span><span style="color:#FF5E24; float:left;"><?php echo $productview2['price'];?></span></h4>                  
                  </li>             
             <?php } ?>             
         </ul>   
         <?php }  else {?>    
         <span style="color:#5484FF;  margin-left:100px;">
         <?php echo 'Chưa có sản phẩm '; ?>
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