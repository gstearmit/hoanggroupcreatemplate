<div id='footer'>
        <div id='waper-footer'>
            <ul id='help'>
                <h4>Trợ giúp</h4>
                <?php $category=$this->requestAction('comment/tintuc/206');
                foreach($category as $category){
                ?>
                <li><a href="<?php echo DOMAIN?>chi-tiet-tin/<?php echo $category['News']['id']?>"><?php echo $category['News']['title']; ?></a></li>
              <?php }?> 
            </ul>
            <ul id='received-news'>
                <h4>Nhận tin</h4>
                <?php $category=$this->requestAction('comment/tintuc/205');
                foreach($category as $category){
                ?>
                <li><a href="<?php echo DOMAIN?>chi-tiet-tin/<?php echo $category['News']['id']?>"><?php echo $category['News']['title']; ?></a></li>
              <?php }?> 
            </ul>
            <ul id='cooperation'>
                <h4>Hợp tác</h4>
              <?php $category=$this->requestAction('comment/tintuc/207');
                foreach($category as $category){
                ?>
                <li><a href="<?php echo DOMAIN?>chi-tiet-tin/<?php echo $category['News']['id']?>"><?php echo $category['News']['title']; ?></a></li>
              <?php }?> 
            </ul>
            <ul id='company-footer'>
                <h4>Công ty</h4>
               <?php $category=$this->requestAction('comment/tintuc/208');
                     foreach($category as $category){
                ?>
                <li><a href="<?php echo DOMAIN?>chi-tiet-tin/<?php echo $category['News']['id']?>"><?php echo $category['News']['title']; ?></a></li>
              <?php }?> 
            </ul>
            <div class='lineketmang'>
                <img src="<?php echo DOMAIN?>images/hotline.png" alt="">
                <div id='link'>
                    <h2>Liên kết</h2>
                    <li><a href="#"><img src="<?php echo DOMAIN?>images/face.jpg" alt=""/></a></li>
                    <li><a href="#"><img src="<?php echo DOMAIN?>images/t.jpg" alt=""/></a></li>
                    <li><a href="#"><img src="<?php echo DOMAIN?>images/in.jpg" alt=""/></a></li>
                    <li><a href="#"><img src="<?php echo DOMAIN?>images/t,.jpg" alt=""/></a></li>
                    <li><a href="#"><img src="<?php echo DOMAIN?>images/you.jpg" alt=""/></a></li>
                    <li><a href="#"><img src="<?php echo DOMAIN?>images/e.jpg" alt=""/></a></li>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div id='footer-footer'>
            <div>
                <p id='copy'>© Copyright 2009-2012 Tân Việt .Info </p>
                <p id='development'>Thiết kế và phát triển bởi Hoàng Group	  	</p>
            </div>
            <div class="clear"></div>

        </div>

    </div><!--end #footer-->
</body>
</html>