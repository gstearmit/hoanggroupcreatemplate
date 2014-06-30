<div id="text-news">
    <div id="view-detail">
         <div class="title-news">
            <div class="left">
              <p>Quy định đăng tin</p>
             </div>
             <div class="right"></div>
         </div>
         <?php if($postingprovisions){?>
          <div id="detail-text">
            <?php foreach($postingprovisions as $postingprovisions){ ?>  
             <div id="detail-text">
                <?php echo $postingprovisions['News']['content'];?> 
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