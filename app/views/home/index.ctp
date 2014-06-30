<link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 

       <div class="d-d"> 
             <ul>   <?php //pr($catid); die();?>
        			<li><a href="<?php echo DOMAIN?>">Trang chủ</a></li>
        			<?php foreach($catid as $catid)
					              {  //ket noi lay danh muc menu ?>
                    	<li class="l-i"> 
                            <a href="<?php echo DOMAIN?>danh-muc-san-pham/<?php echo $catid['Catproduct']['id'] ?>">
                               <?php echo $catid['Catproduct']['name']; ?>
                        	</a>
                        </li> 
                   <?php }?>
            </ul>
       </div>








       
       
       
        <?php
		$time=1;
		 //pr($row); die;
         // hieent thị 1 sản phẩm đươc  quan tâm nhất
		if(isset($row['Product']))  { 
	    ?>
                <div id='ad'> 
                    <!-- hiển thị sản phẩm -->
               		 <a href="<?php echo DOMAIN?>chi-tiet-san-pham/<?php echo $row['Product']['id'],'/'.$row['Product']['title_seo']?>">
                          <img id='ad-img' src="<?php echo DOMAINAD.$row['Product']['images']?>" title="<?php echo $row['Product']['title']?>">
                      </a>
                    <div id='ha-gia'> 
                      <p>
                        <?php echo round(($row['Product']['price_old']-$row['Product']['price'])*100/$row['Product']['price_old'])?>
                    
                         %</p>
                    </div><!-- id='ha-gia' -->
                    
                    <div id='conten-ha-gia'>
                                <span id='title-ad'>
                                         <?php echo $row['Product']['title'];?>  <!-- tieu de -->
                                        <p>(  <?php echo $row['Product']['title1']?>  )</p> <!-- mota trong ngoac kep-->
                                 </span> 
                                    
                                <div id="content-ad" style="height:80px; overflow:hidden;"> <!-- noi dung ha gia-->
                                     <?php $s= strip_tags($row['Product']['introduction']);
                    	 				$tr=$s;
                    	 			    $tr=$this->Help->catchu($s,160);// cắt lấy 160 ki tu thui - de mo ta
                    	 				echo $tr;
                    	 				?>
                                </div><!-- id="content-ad" -->
                                
                               <div id='price-ad'>
                           				<div style="float:left; overflow:hidden;">
                                        				<?php echo number_format($row['Product']['price'],0,'.','.');?> VNĐ 
                                        </div>
                   
                                        <!-- AddThis Button BEGIN -->
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
                                </div> <!-- id='price-ad' -->
                                
                                <div id='price-old-ad' style="text-decoration:line-through;">Giá gốc: <?php echo number_format($row['Product']['price_old'],0,'.','.');?> VNĐ</div>
                                <!-- thong ke giam - so nguoi da mua - Nút Mua - bao nhieu nhuoi da mua deal-->
                                <div class="div-tg">
                                    <p id='tiet-kiem'>Tiết kiệm<span><br/>  <?php echo round(($row['Product']['price_old']-$row['Product']['price'])*100/$row['Product']['price_old'])."%"?></span></p>
                                    <p id='so-nguoi-mua' >Số người đã mua <span><br/><?php echo $row['Product']['daban'];?></span></p>
                					<div class='time' style="margin-top:1px;">Thời gian còn lại
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
                    								  <?php }else {   ?>
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
                                               </h3>
                                      </span>
                                    </div> <!-- id='time' thoi gian con lại-->
                                </div><!-- class="div-tg" -->
                                
                                <a id='mua' href="<?php echo DOMAIN?>mua-hang/<?php echo $row['Product']['id']?>">Mua</a>
                    </div> <!-- id='conten-ha-gia' -->
                    <div class="clear"></div>
                    
                </div><!--id='ad' hien thi san pham -->
        
        <?php }     // kêt thuc hien thi 1 san pham duoc quan tam nhat   ?> 
     
      
      
       <?php
	  //phan trang 
	  //pr($product); die;
                    $page = isset ( $_GET["page1"] ) ? intval ( $_GET["page1"] ) : 1; 
                    $rows_per_page = 9; 
					
                    $page_start = ( $page - 1 ) * $rows_per_page; 
                    $page_end = $page * $rows_per_page; 
					//echo $page_start.'/'.$page_end; die;
                    
                    $number_of_page = ceil ( count($product) / $rows_per_page ); 
					//echo count($product); die;
                    if ( $number_of_page > 1 ) 
                     { 
                        $list_page = ""; 
                        for ( $i = 1; $i <= $number_of_page; $i++ ) 
                        { 
                        	if ( $i == $page ) 
                        	{ 
                        		$list_page .= '<li class="active"><b>'.$i.'</b></li>'; 
                        	} 
                        	else 
                        	{ 
                        		$list_page .= '
    							<li>
    							<a href="'.DOMAIN.'danh-muc-san-pham/'.$this->Session->read('catid').'/?page1='.$i.'">'.$i.'</a></li>';
    							
    						
                        	} 
                        }
                        $next=++$page;
                    
                    } else { $list_page='';  }
      ?>
					 
      <?php 
      $n=0;
		//pr($product); die;
		//echo $page_start; echo $page_end;
      for($i=($page_start); $i < $page_end ; $i++)  
      {
     	if(isset($product[$i])) 
         {
            // nếu tôn tại sản phẩm thứ nhất - hiển thị đinh dang nhu sau cho tui 
		    //pr($product[$i]); 
	        $n++;
		    //echo $j; 
							
       ?>   
               <div class='product <?php if($n==2) echo "center";?>'>
                    	<div style="height:50px; overflow:hidden;">
                            <h2 style="margin-top:5px; margin-bottom:2px; padding:1px;"><?php echo $product[$i]['Product']['title']?></h2>
                            <h3>( <?php echo $product[$i]['Product']['title1']?> )</h3>
                        </div>
                        
                        <div class="div-img">
                            <a href="<?php echo DOMAIN?>chi-tiet-san-pham/<?php echo $product[$i]['Product']['id'],'/'.$product[$i]['Product']['title_seo']?>"> <img class='img-product' src="<?php echo DOMAINAD.$product[$i]['Product']['images']?>"/></a>
                        </div>
                        
                        <div class='content-product' style="height:40px; overflow:hidden;margin-top:5px; text-align:justify;">
                           <?php $s= strip_tags($product[$i]['Product']['introduction']);
            	 				$tr=$s;
            	 			    $tr=$this->Help->catchu($s,140);
            	 				echo $tr;
            	 				?>
                        </div>
                        
                        <div class='price-product'>
                               <div style="float:left; overflow:hidden"> <?php echo number_format($product[$i]['Product']['price'],0,'.','.');?> VNĐ </div>
                              <!-- AddThis Button BEGIN -->
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
            
            
                       </div> <!-- class='price-product' -->
                       
                        <a class='buy' href="<?php echo DOMAIN?>mua-hang/<?php echo $product[$i]['Product']['id'];?>">MUA</a>
                        <span class='old-price-product' style="text-decoration:line-through;">Giá gốc : <?php echo number_format($product[$i]['Product']['price_old'],0,'.','.');?> VNĐ</span>
                        
                        <div class="time">
                            <p style="width:70px;">Tiết kiệm<span> <br/> <?php echo round(($product[$i]['Product']['price_old']-$product[$i]['Product']['price'])*100/$product[$i]['Product']['price_old'])."%"?></span></p>
                            <p style="float:left;">Số người đã mua<span class="so-nguoi-mua"> <br/><?php echo $product[$i]['Product']['daban']?></span></p>
                           
                            <div class="conlai">Thời gian còn lại
                             <span></br>
                                <h3 style="font-size:16px; color:#000;">
                                             <?php $date2= $product[$i]['Product']['date_ketthuc'];
            								  
            									  //echo $date2;
            									  $dayend = strtotime($date2);
            								 
            								 ?>
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
                                            </h3>
                               </span>
                          </div> <!-- class="conlai">Thời gian còn lại -->
                        </div> <!-- class="time" -->
      </div><!--end #product --ket thuc dinh dang cho 1 san pham-->
            
                   <?php if($n==3) $n=0; 
       
       } // enf if(isset($product[$i])) 
  } // end for($i=($page_start); $i < $page_end ; $i++)     ?> 
       
       <!-- hien thi so trang -->
       <ul id='paging'> <?php echo $list_page; ?> </ul>
       <div class="clear margin"></div>
</div><!--end #body-->
    
