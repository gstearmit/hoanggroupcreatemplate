 
<div style="padding: 5px;">
         <div id="gray-title-box">
        <div class="t3"><div class="t3"><div class="t3">
        	<span style="float: right; position: relative; top: 5px; right: 5px;">
        		<a href="javascript:history.go(-1)" onclick="">
        			<img border="0" align="absmiddle" src="<?php echo DOMAIN?>images/back_1.png" alt="Quay lại"/>        			 
        			Quay lại
        		</a>
        	</span>
        </div> </div></div>
        <div class="title">
              <strong>Sản phẩm trong giỏ hàng</strong>
        </div>
        <div class="m3">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                     <div class="text-main" style="padding-top:20px; padding-bottom:20px;">
             <table class="shoping" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="100">Hình ảnh</td>
                    <td width="200">Tên sản phẩm</td>
                    <td width="100">Số lượng</td>
                    <td width="100">Giá</td>
                    <td width="100">Thành tiền</td>
                    <td width="100">Xử lý</td>
                </tr>
                <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
                <tr>       
                    <td><img width="100" height="100" src="<?php echo $product['images']; ?>" /></td>
                    <td><?php echo $product['name']; ?></td>
                    <td>
                    <form name="view<?php echo $i; ?>" action="<?php echo DOMAIN;?>products/updateshopingcart/<?php echo $key;?>" method="post">
                    <input style="width:50px;" type="text" name="soluong" value="<?php echo $product['sl']; ?>" />
                    </form>
                    </td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['total']; ?></td>
                    <td>
                    <input onclick="document.view<?php echo $i; ?>.submit();"  type="button" value="Sửa" />
                    <a href="<?php echo DOMAIN;?>products/deleteshopingcart/<?php echo $key;?>"><input type="button" value=" Xoá " /></a>
                    </td>        
                </tr>
                <?php $total +=$product['total']; $i++; } ?>   
            </table>
            
             <div style="float:left; padding-top:15px; padding-right:15px;">Tổng tiên phải thanh toán : <?php echo $total;?> </div>
            <div style="float:left; padding-top:15px; padding-right:20px;"><a href="<?php echo DOMAIN?>products/index"><input type="button" value="Tiếp tục mua" /></a></div>
            <div style="float:left; padding-top:15px;"><a href="<?php echo DOMAIN?>lien-he-mua-hang"><input type="button" value="Hoàn tất" /></a></div>
          </div>
                </div>                  
             </div>            
             <div class="clearfix"></div>
        </div> 
        <div class="b3"><div class="b3"><div class="b3"></div></div></div>
    </div>
    
 </div>



