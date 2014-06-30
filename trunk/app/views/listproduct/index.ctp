
 <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
<div id='body'>
     
        <?php echo $this->element('slide');?>
       <?php echo $this->element('menu_top');?>
       
       <div class="d-d">
     <ul>
			
			<li><a href="<?php echo DOMAIN?>">Trang chủ</a></li>
			
		 			
		 			<?php
					$catid=$this->passedArgs[0];
						if(isset($this->passedArgs[0])){
						
						$row1 = $this->requestAction ( '/listproduct/getnameproduct/' . $this->passedArgs [0] );
						foreach ($row1 as $row1){
							$id=$row1['ParentCat'] ['id']; 
						
						}
						
						
						$row1 = $this->requestAction ( '/listproduct/getnameproduct/' . $id );
						foreach ($row1 as $row1){
							$id=$row1['ParentCat'] ['id'];
							if ($row1['ParentCat'] ['name'] != '') {
								echo '<li class="l-i">  <a href="' . DOMAIN . 'danh-muc-san-pham/' . $row1['ParentCat'] ['id'] . '"> ' . $row1['ParentCat'] ['name'] . '</a></li>';
							}
							
						}
						
						
						$row1 = $this->requestAction ( '/listproduct/getnameproduct/' . $this->passedArgs [0] );
						foreach ($row1 as $row1){
							$id=$row1['ParentCat'] ['id'];
							if ($row1['ParentCat'] ['name'] != '') {
								echo '<li class="l-i">  <a href="' . DOMAIN . 'danh-muc-san-pham/' . $row1['ParentCat'] ['id'] . '"> ' . $row1['ParentCat'] ['name'] . '</a></li>';
							}
							if ($row1['Catproduct'] ['name'] != '') {
								echo '<li class="l-i"> <a href="' . DOMAIN . 'danh-muc-san-pham/' . $row1['Catproduct'] ['id'] . '"> ' . $row1['Catproduct'] ['name'] . '</a></li>';
						
							}
						}
						
						
						
						
						
						
						}
						?>
		 		</ul>
       </div>

       
       
        <?php
		$time=1;
		 //pr($row); die;
			if(isset($row['Product'])) {
			 ?>
        <div id='ad'>
       		 <a href="<?php echo DOMAIN?>chi-tiet-san-pham/<?php echo $row['Product']['id'],'/'.$row['Product']['title_seo']?>">
            <img id='ad-img' src="<?php echo DOMAINAD.$row['Product']['images']?>" title="<?php echo $row['Product']['title']?>">
            </a>
            <div id='ha-gia'> <p>
            <?php echo round(($row['Product']['price_old']-$row['Product']['price'])*100/$row['Product']['price_old'])?>
            
            %</p></div>
            <div id='conten-ha-gia'>
                <span id='title-ad'>
                <?php echo $row['Product']['title'];?>
                <p>( 
                <?php echo $row['Product']['title1']?>
                 )</p></span>
                <div id="content-ad" style="height:80px; overflow:hidden;">
                <?php $s= strip_tags($row['Product']['introduction']);
	 				$tr=$s;
	 			    $tr=$this->Help->catchu($s,160);

	 				echo $tr;

	 				?>
                
                
                </div>
                <div id='price-ad'>
				<div style="float:left; overflow:hidden;">
				<?php echo number_format($row['Product']['price'],0,'.','.');?> VNĐ 
                </div>
                <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" style="padding-left:21px; padding-top:8px; overflow:hidden">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>

</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502395995846f2e1"></script>
<!-- AddThis Button END -->
                </div>
                <p id='price-old-ad' style="text-decoration:line-through;">Giá gốc: <?php echo number_format($row['Product']['price_old'],0,'.','.');?> VNĐ</p>
                <div class="div-tg">
                    <p id='tiet-kiem'>Tiết kiệm<span></br>  <?php echo round(($row['Product']['price_old']-$row['Product']['price'])*100/$row['Product']['price_old'])."%"?></span></p>
                    <p id='so-nguoi-mua'>Số người đã mua <span></br>
                    <?php echo $row['Product']['daban'];?>
                    </span></p>
                    <div id='time' style="margin-top:1px;">Thời gian còn lại<span></br>
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
								  <?php }else {?>
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
                        
                        
                        
                    </span></div>
                </div>
                <a id='mua' href="<?php echo DOMAIN?>mua-hang/<?php echo $row['Product']['id'];?>">Mua</a>
            </div>
            <div class="clear"></div>
        </div><!--end #ad-->
        <?php }?>
     
      <?php
	  
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
                    } 
                    else{
                    $list_page='';
                    }
                     ?>
					 
					<?php $n=0;
					//pr($product); die;
					//echo $page_start; echo $page_end;
                        for($i=($page_start);$i<$page_end;$i++){
							
						if(isset($product[$i])) {
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
            
            
             <a href="<?php echo DOMAIN?>chi-tiet-san-pham/<?php echo $product[$i]['Product']['id'],'/'.$product[$i]['Product']['title_seo']?>">
           				 <img class='img-product' src="<?php echo DOMAINAD.$product[$i]['Product']['images']?>"/>
                         </a>
            </div>
            <div class='content-product' style="height:40px; overflow:hidden;margin-top:5px; text-align:justify;">
               <?php $s= strip_tags($product[$i]['Product']['introduction']);
	 				$tr=$s;
	 			    $tr=$this->Help->catchu($s,140);

	 				echo $tr;

	 				?>
            
            </div>
            <div class='price-product'>
            <div style="float:left; overflow:hidden">
			<?php echo number_format($product[$i]['Product']['price'],0,'.','.');?> VNĐ
            </div>
            

            
             <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style" style="padding-left:10px; overflow:hidden">
			<a class="addthis_button_preferred_1"></a>

			</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502397d931063477"></script>
			<!-- AddThis Button END -->

			
             </div>
            <a class='buy' href="<?php echo DOMAIN?>mua-hang/<?php echo $product[$i]['Product']['id'];?>">MUA</a>
            <span class='old-price-product' style="text-decoration:line-through;">Giá gốc : <?php echo number_format($product[$i]['Product']['price_old'],0,'.','.');?> VNĐ</span>
            <div class="time">
                <p style="width:70px;">Tiết kiệm<span></br>
                <?php echo round(($product[$i]['Product']['price_old']-$product[$i]['Product']['price'])*100/$product[$i]['Product']['price_old'])."%"?>
                </span></p>
                <p>Số người đã mua<span class="so-nguoi-mua"></br>
                <?php echo $product[$i]['Product']['daban']?>
                </span></p>
                <div class="conlai">Thời gian còn lại<span></br>
                 <h3 style=" font-size:16px; color:#000;">
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
                                </span></div>
            </div>
        </div><!--end #product-->
       <?php if($n==3) $n=0; } }?>
       
       
     <ul id='paging'>
       			<?php echo $list_page; ?>
                
            </ul>
       
    

           
        <div class="clear margin"></div>
    </div><!--end #body-->
    
