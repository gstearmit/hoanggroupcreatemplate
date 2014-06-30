   <div id='menu-right'>
            <div class='ban-chay'>
                <h4>SẢN PHẨM BÁN CHẠY </h4>
                <?php $prod=$this->requestAction('comment/sanphambanchay/'.$idsp);
                foreach($prod as $prod) {
                ?>
                <div class="content">
                    <img style="width:216px; height:118px;"src="<?php echo DOMAINAD.$prod['Product']['images']?>" alt="">
                    <div class="conten-aq">
                        <p class="price">Giá: <span><?php echo number_format($prod['Product']['price'])?></span>
                        <a href="<?php echo DOMAIN?>mua-hang/<?php echo $prod['Product']['id'] ?>">MUA NGAY</a></p>
                        <p class="price-old">Giá gốc : <?php echo number_format($prod['Product']['price_old']);?>  giảm : <?php 
                        $gia=($prod['Product']['price_old']-$prod['Product']['price'])*100/$prod['Product']['price_old'];
                        echo round($gia); ?> %</p>
                    </div>
                </div>
                <?php }?>
                

            </div>
            <div class='ban-chay'>
                <h4>SẢN PHẨM MỚI </h4>
                 <?php $prod=$this->requestAction('comment/sanphammoi/'.$idsp);
                foreach($prod as $prod) {
                ?>
                <div class="content">
                    <img style="width:216px; height:118px;" src="<?php echo DOMAINAD.$prod['Product']['images']?>" alt="">
                    <div class="conten-aq">
                        <p class="price">Giá: <span><?php echo number_format($prod['Product']['price'])?></span>
                         <a href="<?php echo DOMAIN?>mua-hang/<?php echo $prod['Product']['id'] ?>">MUA NGAY</a></p>
                        <p class="price-old">Giá gốc : <?php echo number_format($prod['Product']['price_old']);?>  giảm : <?php 
                        $gia=($prod['Product']['price_old']-$prod['Product']['price'])*100/$prod['Product']['price_old'];
                        echo round($gia); ?> %</p>
                    </div>
                </div>
                <?php }?>

            </div>
     
    
     
     
     
     
     
 </div>   <!--eng menu-right--> 