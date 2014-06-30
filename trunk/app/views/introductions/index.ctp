<div class="center-main">
  <div class="title-content">
   <p>About us</p>
  </div>
  <div class="list-news">
       <div class="detail">
        <?php foreach($about as $gt){ ?>
        <p><?php echo $gt['News']['content'];?> </p>
       <?php } ?>
       </div>
    </div>
</div>