
 <link type="text/css" href="<?php echo DOMAIN ?>css/ctproduct.css" rel="stylesheet" /> 

<div id='body'>
        <?php echo $this->element('slide');?>
       <?php echo $this->element('menu_top');?>
       
       <?php $i=0; foreach($product as $row){
        $idsp=$row['Product']['id'];
        $i++;?>
       
        <div id='list-product'>
            <h2 style="margin-bottom:5px;padding:0px;"><span style="float: left;"><?php echo $row['Product']['title']?> :</span> 
            <?php echo $row['Product']['introduction']?>
            </h2>
            <div id='left'>
                <h3><?php echo number_format($row['Product']['price'])?> VNĐ </h3>
                <p id='gia-goc' style="text-decoration:line-through;"><?php echo number_format($row['Product']['price_old'])?> VNĐ</p>
                <p class='giam-gia'>Giảm giá </br> <?php echo round(($row['Product']['price_old']-$row['Product']['price'])*100/$row['Product']['price_old'])." %";?></p><p class="giam-gia" style="border-right: 1px solid #ade3f9;">Tiết kiệm </br> <?php echo number_format($row['Product']['price_old']-$row['Product']['price'])." vnđ";?></p>
                <h2> <div style="float: left;margin-left:10px;">Thời gian còn lại : </div>  <?php
                                      $date2 = $row['Product']['date_ketthuc'];
									  $dayend = strtotime($date2);
									  //so sanh ngay thang
									  $date1 = date("Y-m-d");
									  $datenow = strtotime($date1);
									  //echo time();
								  ?>
                                  
                                  <?php if($dayend <= $datenow ){ ?>
                                           Hết hạn
								  <?php }else {?>
                                      <script type="text/javascript">
									$(document).ready(function(){
										var i = <?php echo $dayend;?> - <?php echo time();?>;
										$(function() {
											setInterval(function(){
												var h = parseInt(i / 3600);
												var m = parseInt((i- (3600 * h)) / 60);
												var s = parseInt(i - ((3600 * h) + (60 * m)));
												$('#clock<?php echo $i;?>').html(h+' : '+m+' : '+s);
												i--;
											}, 1000);
										});
									});	
									</script>
                                      <div id="clock<?php echo $i; $i++;?>" style="font-weight: bold;"></div>
                                  <?php }?></h2>
                <h1></h1>
                <a href="<?php echo DOMAIN?>mua-hang/<?php echo $row['Product']['id'] ?> "> </a>
            </div>
            <div id='right'>
                <img id='img-conten' src="<?php echo DOMAINAD.$row['Product']['images']?>" alt="">
                <h1>Điểm nổi bật </h1>
              <div class="n-d">
              <?php echo $row['Product']['content'];?>
              </div>

               <div class="like">
           <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-5022314e4d89c2df"></script>
<!-- AddThis Button END -->
               </div>
            </div>
        </div><!--end list-product-->
<?php }?>
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
     
    
     
     
     
     
     
 </div>   <!--eng menu-right--> 
           
        <div class="clear margin"></div>
    </div><!--end #body-->
    