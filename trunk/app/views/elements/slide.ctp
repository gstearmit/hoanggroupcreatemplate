   <?php $setting=$this->requestAction('comment/setting');
   foreach($setting as $setting) {
   ?>
   <div id='slide'>
       
            <img src="<?php echo DOMAINAD.$setting['Setting']['image_header'];?>" alt="">
            
        </div>
        <?php }?>