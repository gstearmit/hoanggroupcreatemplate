<style>
  #goi-thieu h1,h2,h3{
	  font-size:12px;
	  font-weight:normal;
	  }
	table {
	border: 1px solid #FFFFFF;
    border-collapse: collapse;
    border-spacing: 0;
}
</style>
<link type="text/css" href="<?php echo DOMAIN;?>css/Standard.css" rel="stylesheet" />
<div id="content-body">
   <div id="content-main">
       <div style="overflow:hidden; width:100%; height:auto;">
         <div class="title_top_news_detail"><p>Sản phẩm trong giỏ hàng</p></div>
         <div class="text-main" style="padding-top:20px; padding-bottom:20px;">
             <table class="tblGrid wf" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="100">Hình ảnh</th>
                    <th width="200">Tên sản phẩm</th>
                    <th width="100">Số lượng</th>
                    <th width="100">Giá</th>
                    <th width="100">Thành tiền</th>
                    <th width="100">Xử lý</th>
                </tr>
                <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
                <tr>       
                    <td class="tal"><img width="100" height="100" src="<?php echo $product['images']; ?>" /></td>
                    <td class="tal"><?php echo $product['name']; ?></td>
                    <td class="tal">
                    <form name="view<?php echo $i; ?>" action="<?php echo DOMAIN;?>products/updateshopingcart/<?php echo $key;?>" method="post">
                    <input style="width:50px;" type="text" name="soluong" value="<?php echo $product['sl']; ?>" />
                    </form>
                    </td>
                    <td class="tal"><?php echo $product['price']; ?></td>
                    <td class="tal"><?php echo $product['total']; ?></td>
                    <td class="tal">
                    <input onclick="document.view<?php echo $i; ?>.submit();"  type="button" value="Sửa" />
                    <a href="<?php echo DOMAIN;?>news/deleteshopingcart/<?php echo $key;?>"><input type="button" value=" Xoá " /></a>
                    </td>        
                </tr>
                <?php $total +=$product['total']; $i++; } ?>   
            </table>
             <div style="float:left; padding-top:15px; padding-right:15px;">Tổng tiên phải thanh toán : <?php echo $total;?> </div>
            <div style="float:left; padding-top:15px; padding-right:20px;"><a href="<?php echo DOMAIN?>"><input type="button" value="Tiếp tục mua" /></a></div>
            <div style="float:left; padding-top:15px;"><a href="<?php echo DOMAIN?>lien-he-mua-hang"><input type="button" value="Hoàn tất" /></a></div>
          </div>
       </div>
 </div>
</div>
