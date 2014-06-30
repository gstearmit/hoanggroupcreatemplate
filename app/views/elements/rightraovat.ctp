<div id="title-news-raovat">
    <div class="title-raovat">
	     <p>Tin rao vặt bạn vừa đăng </p>
	</div>
	<div class="content-news-raovat">
	   <div class="center-raovat">
	      <?php $newsraovat_userid = $this->requestAction('/comment/newsraovat_userid');
	      
	      ?>
      <?php foreach($newsraovat_userid as $newsraovat_userid){?>
	     <p>- <a href="<?php echo DOMAIN;?>rao-vat/chi-tiet-tin-rao-vat/<?php echo $newsraovat_userid['Classifiedss']['id']; ?>"><?php echo $this->Text->truncate($newsraovat_userid['Classifiedss']['title'],30,array('ending' => '...','exact' => true));?></a></p>
	  <?php }?>
	   </div>
	</div>

<div style="padding: 5px;" class="infoDiv">
	 <div class="lbRed lbBold">
		- Lưu ý khi đăng tin:  
	 </div>
	 <div class="comment">
		- Những tin rao vặt sau khi đăng sẽ được Giá Nhanh kiểm duyệt lại và sẽ bị xoá khỏi hệ thống nếu có các vi phạm:   
		  <br>&nbsp;&nbsp;+ Tin mang tính chất SPAM( gửi cùng nội dung nhiều lần trong 1 khoảng thời gian ngắn hơn 1 phút )
		  <br>&nbsp;&nbsp;+ Tin đăng sai danh mục
		  <br>&nbsp;&nbsp;+ Tin không chính xác , thô tục
		  <br>&nbsp;&nbsp;+ Viết Tiếng Việt không dấu   
	 </div>
	 
</div>
</div>