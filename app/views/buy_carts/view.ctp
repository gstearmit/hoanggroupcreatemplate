<style type="text/css">
   .img{
	   width:200px;
	   height:200px;
	   float:left;
	   margin-right:15px;
	   }
 .detail_view{
    display: block;
    overflow: hidden;
    width: 325px;
}
.detail_view h2{
	font-size:14px;
    color: #236A11;
}
.detail_view h2 span{
	color:#000;
	
	}
.jcart .button {
    margin: 20px;
    padding: 5px;
}
.table {
    border-collapse: collapse;
    color: #000000;
    font-size: 12px;
    line-height: 20px;
    width: 100%;
	text-align:center;
}
</style>
 <!--main-->
 <?php if($views){ ?>
<div id="tour_halong"><!--tour_halong-->
                	<div class="title_tour_halong">
                    	<span>GIỎ HÀNG</span>
                    </div>
            <div id="main_tour_halong"><!--main_tour_halong-->
               <div id="text-main">
               
              
                <table class="table" border="1" cellpadding="0" cellspacing="0">
                 <tr>
                    <td>STT</td>
                   <!-- <td>Ảnh sản phẩm</td>-->
                    <td>Tên sả phẩm</td>
                    <td>Số lượng</td>
                    <!--<td>Giá</td>
                    <td>Thành tiền</td>-->
                    <td>Hãng sản xuất</td>
                    <td>Xử lý</td>
                 </tr>
                  <?php $i=0;  foreach ($views as $view) { $i = $i + 1 ;?>
                  
                  
                   <tr style="line-height:30px;">
                   
                     <td ><?php echo $i;?></td>
                     <td ><?php echo $view['Cart']['title'];?></td>
                     <td>
                     <?php echo $form->create(null, array( 'url' => DOMAIN.'buy_carts/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
                     <input style="width:80px; height:20px; margin-top:4px; margin-bottom:4px;" onKeyPress="return keypress(event);" type="text" name="mumber" value="<?php echo $view['Cart']['number'];?>" />
                     <input type="hidden" name="id"  value="<?php echo $view['Cart']['id'];?>"/>
                      <input type="submit" value="Thêm" />
                     <?php echo $form->end(); ?>
                     </td>
                    <!-- <td ><?php //echo $view['Cart']['price'];?></td>
                     <td ><?php //$cost=$view['Cart']['price'] * $view['Cart']['number']; echo $cost; ?></td>-->
                     <td ><?php echo $view['Cart']['producer'];?></td>
                     <td ><a href="<?php echo DOMAIN?>buy_carts/delete/<?php echo $view['Cart']['id'];?>">Xóa</a></td>
                   </tr>
                 		
                 <?php }?>
                  <tr>
                      <td colspan="3">
                        <a href="<?php echo DOMAIN?>listproducts"><b style="color:#000;">Tiếp tục</b></a>
                      </td>
                  
                      <td colspan="4"><a href="<?php echo DOMAIN?>dat-mua">Đặt mua</a></td>
                    </tr>
               </table>
                  </div>
               
<?php }else echo "<script>location.href='".DOMAIN."listproducts'</script>";?>
   </div>
</div>
 <!--end-->
