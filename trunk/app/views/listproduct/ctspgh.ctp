<link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
<link type="text/css" href="<?php echo DOMAIN ?>css/ctspgh.css" rel="stylesheet" /> 
<div id='body'>
     
        <?php echo $this->element('slide');?>
        <?php echo $this->element('menu_top');?>
       
       <div class="d-d">
            <ul>
    			
    			<li><a href="<?php echo DOMAIN?>">Trang chủ</a></li>
    			<li class="l-i"><a href="<?php echo DOMAIN?>gian-hang">Gian hàng</a></li>
    		 	
    			<li class="l-i"><a href="<?php echo DOMAIN?>san-pham-gian-hang/<?php echo $this->Session->read('shop_id');?>">Sản phẩm gian hàng</a></li>			
    		 	<li class="l-i"><a href="<?php echo DOMAIN?>chi-tiet-san-pham-gian-hang/<?php echo $idprod?>">Chi tiết sản phẩm gian hàng</a></li>				
    		 	
     		</ul>
       </div>
       
        <?php
		   $time=1;
		 //pr($row); die;
			if(isset($row['Product'])) {
			 $idsp=$row['Product']['id'];
			 ?>
        <div id='ad'>
                   <a href="<?php echo DOMAIN?>chi-tiet-san-pham/<?php echo $row['Product']['id'],'/'.$row['Product']['title_seo']?>">
                   <img id='ad-img' src="<?php echo DOMAINAD.$row['Product']['images']?>" title="<?php echo $row['Product']['title']?>"/></a>
                   
           <div id='ha-gia'> 
               <p>
                    <?php echo round(($row['Product']['price_old']-$row['Product']['price'])*100/$row['Product']['price_old'])?>   
                  %
               </p>
           </div> <!-- id='ha-gia' -->
           <div id='conten-ha-gia'>
                 <span id='title-ad'>
                    <?php echo $row['Product']['title'];?>
                    <p>( <?php echo $row['Product']['title1']?> )</p>
                 </span>
                 
                  <div id="content-ad" style="height:80px; overflow:hidden;">
                  <!-- bao quanh hết khung sản phẩm mô tả bên : tiêu đề+ chi tiết + giảm giá -->
                         <?php  $s= strip_tags($row['Product']['introduction']);
     	 				        $tr=$s;
          	 			        $tr=$this->Help->catchu($s,160);
                        
                        	 	echo $tr;
                        
                       	?>        
                  </div><!-- id="content-ad" -->
                  
                  <div id='price-ad'> 
       				   <div style="float:left; overflow:hidden;">
          				  <?php echo number_format($row['Product']['price'],0,'.','.');?> VNĐ 
                       </div>
                       
                  <!-- AddThis Button BEGIN :face book -->
                       
                         <div class="addthis_toolbox addthis_default_style " style="padding-left:21px; padding-top:8px; overflow:hidden">
                                                <a class="addthis_button_preferred_1"></a>
                                                <a class="addthis_button_preferred_2"></a>
                                                <a class="addthis_button_preferred_3"></a>
                                                <a class="addthis_button_preferred_4"></a>
                                                <a class="addthis_button_compact"></a>
                                                <a class="addthis_counter addthis_bubble_style"></a>
                         </div>
                         <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507b97c86755c349"></script>
                   <!-- AddThis Button END -->
                         
                </div><!-- id='price-ad' -->
                
                <p id='price-old-ad' style="text-decoration:line-through;">
                   Giá gốc: <?php echo number_format($row['Product']['price_old'],0,'.','.');?> VNĐ
                </p>
                 
                 <div class="div-tg">
                  <!--- thong ke so nguoi da mua - tiet kiem - thoi gian con lại  -->
                   <p id='tiet-kiem'>Tiết kiệm<span><br/>  <?php echo round(($row['Product']['price_old']-$row['Product']['price'])*100/$row['Product']['price_old'])."%"?></span></p>
                   <p id='so-nguoi-mua'>Số người đã mua <span><br/> <?php echo $row['Product']['daban'];?> </span></p>
                   
                   <div id='time' style="margin-top:1px;">Thời gian còn lại
                   <span><br/>
                   <h3 style="margin-top:-10px; font-size:18px;">
                           <?php
                                         $date2 = $row['Product']['date_ketthuc'];
       									  //echo $date2;
       									  $dayend = strtotime($date2);
                        				  //so sanh ngay thang
       									  $date1 = date("Y-m-d");
       									  $datenow = strtotime($date1);
       									  //echo time();
						    ?>
                                                          
                            <?php if($dayend <= $datenow ){ ?>
                                             Hết hạn
			                 <?php   }else {     ?>
                               <script type="text/javascript">
                        				$(document).ready(function(){
              						            var i = <?php echo $dayend;?> - <?php echo time();?>;
                        										$(function() {
                        											setInterval(function(){
                        												var h = parseInt(i / 3600);
                        												var m = parseInt((i- (3600 * h)) / 60);
                        												var s = parseInt(i - ((3600 * h) + (60 * m)));
                        												$('#clock<?php echo $time;?>').html(h+' : '+m+' : '+s);
                        												i--;
                        											}, 1000);
                        										});
                        									});	
                        									</script>
                                                              <div id="clock<?php echo $time; $time++;?>"></div>
                                       <?php }?>
                                                              
                                                           
                    </h3><!-- Thời gian còn lại -->
                    </span>
                    </div> <!-- Thời gian còn lại -->
                    
                    
                    </div> <!-- class="div-tg" -->
                    
                    <a id='mua' href="<?php echo DOMAIN?>mua-hang/<?php echo $row['Product']['id'];?>"> Mua </a>
                    
           </div><!-- id='conten-ha-gia' -->
           <div class="clear"></div>
           
        </div><!--end #ad-->
        <?php }?>
     
     
       <div id='list-product2'>
       <?php foreach($product as $row){?>
            <img style="width:279px; height:268px;" src="<?php echo DOMAINAD.$row['Product']['images']?>" alt="">
            <div id='content-detail'>
                <h4><?php echo $row['Product']['introduction']?></h4>
                <div id='content'>
                    <?php echo $row['Product']['content']?>
                    </div>
                <p id='price'><?php echo number_format($row['Product']['price']);?> VNĐ</p>
                <a href="<?php echo DOMAIN?>">Mua</a>
            </div>
           <?php }?>
            
   
                                     
            <div class="clear"></div>

        </div><!--end list-product-->

        <div id='menu-right'>
            <div class='ban-chay'>
                <h4> DEAL CHẠY NHẤT</h4>
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
                <h4>DEAL MỚI </h4>
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
 </div> <!--End body-->   
     
     
     
     
     
     
     
     
     
     
    
