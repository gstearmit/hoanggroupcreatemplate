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
</style>
 <!--main-->
   <div id="main">
   
      <div class="title_top_news_detail"><p><?php /// echo $cat['Product']['name'];?></p></div>
               <div id="text-main">
                 
                   
                       <table border="1" cellpadding="0" cellspacing="0">
                 <tr>
                    <td>STT</td>
                    <td>Ảnh sản phẩm</td>
                    <td>Tên sả phẩm</td>
                    <td>Số lượng</td>
<!--                    <td>Giá</td>
                    <td>Thành tiền</td>
-->                    <td>Hãng sản xuất</td>
                    <td>Xử lý</td>
                 </tr>
                  <?php $i=0; foreach ($views as $view){ $j=$i +1 ;?>
                   <?php echo $form->create(null, array( 'url' => DOMAIN.'buy_carts/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
                 <tr>
                    <td><?php echo $j;?></td>
                    <td><img width="100" height="100" src="<?php echo DOMAINAD;?><?php echo $view['Cart']['images']?>"></td>
                    <td><?php echo $view['Cart']['title'];?></td>
                    <td>
                    	<input type="text" name="mumber" value="<?php echo $view['Cart']['number'];?>" />
                      	<input type="hidden" name="id"  value="<?php echo $view['Cart']['id'];?>"/>
                        <input type="hidden" name="name"  value="<?php echo $view['Cart']['title'];?>"/>
                        <input type="hidden" name="manufacturers"  value="<?php echo $view['Cart']['producer'];?>"/>
                        <input type="hidden" name="images"  value="<?php echo $view['Cart']['images'];?>"/>
                        <input type="hidden" name="id_product"  value="<?php echo $view['Cart']['id_product'];?>"/>
                        <input type="submit" value="thêm" />
                    </td>
                    <td><?php echo $view['Cart']['number'];?></td>
                    <td><?php echo $view['Cart']['number'];?></td>
                    <td><?php echo $view['Cart']['producer'];?></td>
                    <td><a href="<?php echo DOMAIN?>buy_carts/delete/<?php echo $view['Cart']['id'];?>">Xóa</a></td>
                 </tr>
                 <?php echo $form->end(); ?>
                 <?php }?>
               </table>
                  </div>
               

   </div>
   <p style="float:none !important"
 <!--end-->
