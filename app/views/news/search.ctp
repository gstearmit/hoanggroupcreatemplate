                        
<div id="text-main">
   <div class="title-news"><p>Kết quả tìm kiếm</p></div>
         <div class="text-news">
           <ul>
             <?php foreach($listsearch as $listnews){ ?>
              <li>
                 <?php if ($listnews['News']['images']!=""){?>
                  <a href="<?php echo DOMAIN;?>chi-tiet-tin/<?php echo $listnews['News']['id'];?>"><img alt="<?php echo $listnews['News']['title'];?>" src="<?php echo DOMAINAD;?><?php echo $listnews['News']['images'];?>" /></a>
                 <?php }?>
                <a href="<?php echo DOMAIN;?>chi-tiet-tin/<?php echo $listnews['News']['id'];?>"><span><?php echo $listnews['News']['title'];?></span></a>
                <div class="pindex">
                  <p><?php echo strip_tags($this->Text->truncate( $listnews['News']['introduction'],500,array('ending' => '...','exact' => false)));?></p>
                </div>
               </li>
               <?php } ?>
           </ul>
     </div>
</div>              