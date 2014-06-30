<div id="main">	
    <div class="bg">
      <div class="summary">
           <img style="float:left; margin-left:10px; margin-right:10px; margin-top:10px; margin-bottom:10px;" alt="<?php echo $views['Product']['title'];?>" src="<?php echo DOMAINAD?><?php echo $views['Product']['images'];?>" width="348" height="268" />
            <div class="sp-noidung">
                <p <span style="font-weight:bold;"> Tên sản phẩm:<?php echo $views['Product']['title'];?></span>	<br />
                - Hãng sản xuất :<?php echo $views['Product']['origin'];?> <br>
				<span  style="margin-left:0px; ">- Giá  : <?php echo $views['Product']['price'];?></span>
				 </p>
                  <p style="font-style:italic;"><a href="<?php echo DOMAIN; ?>them-vao-gio-hang/<?php echo $views['Product']['id']; ?>" alt="Cho vào giỏ hàng"><img src="<?php echo DOMAIN; ?>images/icon-giohang.png" border="0"/> </a>Cho vào giỏ hàng</p>
                  <p style="font-style:italic; color:#F00;"><a href="<?php echo DOMAIN; ?>listproducts/viewshoping"><img alt="Cho vào giỏ hàng" src="<?php echo DOMAIN; ?>images/icon-giohang.png" border="0"/> Hiện giỏ hàng giỏ hàng của mặt hàng này</a></p>
      		 </div>
         </div>
       <div style="clear:both;">
       		<p style="font-weight:bold;">Chi tiết sản phẩm <br /><?php echo $views['Product']['content'];?></p>
           <p style="margin-left:670px;"><br /><input type="button" value=" Quay lai " onclick="javascript: window.back();" style="float:left;"></p>
       </div>
	</div>
</div>
