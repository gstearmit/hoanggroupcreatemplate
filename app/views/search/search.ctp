<div id="main">
     <div id="product-views" style="padding-bottom:5px;">
         <h2 class="style_h2"> </b> <span> SẢN PHẨM TÌM THẤY</span></h2>
            <ul>
             <?php foreach ($products as $productview):?>
                    <li>
                     <?php  if($productview['Product']['images']!='') {?>
                           <img src="<?php echo DOMAINAD.$productview['Product']['images'];?>"  alt="<?php echo $productview['Product']['title']?>"/>
                         <?php }
                         else {?>
                         <div class="style_img"></div>
                         <?php }?> 
                    <h1 class="style_h1"> <a href="<?php echo DOMAIN?>chi-tiet-san-pham/<?php echo $productview['Product']['id']?>">
                     <?php echo strip_tags($this->Text->truncate( $productview['Product']['title'],20,array('ending' => '...','exact' => false)));?></a></h1>
                    <h4 style="font-weight:bold; color:#cacaca;"><span style="float:left"> Giá: </span><span style="color:#FF5E24; float:left;"><?php echo $productview['Product']['price'];?></span></h4> 
                    </li>
            <?php endforeach; ?> 
            </ul>
         <p style="margin-left:658px; line-height:0px; padding:0px; margin-top:10px;"><input type="button" value=" Quay lai " onclick="javascript: window.back();" style="float:left;"></p>     
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