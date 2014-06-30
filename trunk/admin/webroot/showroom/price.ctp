<div id="text-news">
    <div id="view-detail">
         <div class="title-news">
            <div class="left">
              <p>Bảng giá</p>
             </div>
             <div class="right"></div>
         </div>
         <?php if($price){?>
          <div id="detail-text">
            <?php foreach($price as $price){ ?>  
             <div id="detail-text">
                <?php echo $price['News']['content'];?> 
             </div>
          <?php } ?>  
         </div>
         <?php }else{?>
         <div id="detail-text">
            <p>Đang cập nhật bảng giá</p>
         </div>
          <?php } ?>    
    </div>
 </div>