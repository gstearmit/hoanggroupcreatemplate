<div id="text-news">
    <div id="view-detail">
         <div class="title-news">
            <div class="left">
              <p>Hướng dẫn đăng tin VIP</p>
             </div>
             <div class="right"></div>
         </div>
         <?php if($postingvip){?>
          <div id="detail-text">
            <?php foreach($postingvip as $postingvip){ ?>  
             <div id="detail-text">
                <?php echo $postingvip['News']['content'];?> 
             </div>
          <?php } ?>  
         </div>
         <?php }else{?>
         <div id="detail-text">
            <p>Đang cập nhật</p>
         </div>
          <?php } ?>    
    </div>
 </div>