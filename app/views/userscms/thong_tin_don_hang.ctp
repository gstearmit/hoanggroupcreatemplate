
<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/phantrang.css"/>

<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/new.css"/>
<div id="body">

  <div id='slide'>
       
            <img src="<?php echo DOMAIN?>images/slide.jpg" alt="">
            
        </div>
       <?php echo $this->element('menu_top');?>
       
     
    
    <div id="main-center">
<div id="sanphams" style="min-height: 500px !important;">

<div class="tieude">
<p> Thông tin đơn hàng</p></div>


<div class="left">
<ul>
<li ><a href="<?php echo DOMAIN?>thong-tin-tai-khoan">Thông tin tài khoản</a></li>
<li class="li-chon"> <a href="<?php echo DOMAIN?>thong-tin-don-hang">Thông tin đơn hàng</a></li>

<li><a href="<?php echo DOMAIN?>doi-mat-khau">Đổi mật khẩu</a></li>

</ul>

</div><!-- End left -->


<div class="right">
<div class="div-ttkh" style="border: none;">

<table  class="tblGrid wf" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width:100%;">
                            <tr>
                            <th width="50">Ngày đặt</th>
                                <th width="100">Hình ảnh</th>
                                <th width="200">Tên sản phẩm</th>
                                <th width="70">Số lượng</th>
                                <th width="130">Giá</th>
                                <th width="130">Tổng giá</th>
                                <th width="50">Thanh toán</th>
                                <th width="50">Trạng thái</th>
                            </tr>
                            <?php 
                            //pr($order); die;
                             foreach($order as $row) {
                                $product=$row['Order']['product'];
                                //echo $product;
                                $chuoi=explode('/',$product);
                                $n=count($chuoi);
                                
                                for($i=0;$i<$n-1;$i++){
                                    $chuoi1=explode('|',$chuoi[$i]);
                                    $product_id=$chuoi1[0];
                                    $product_title=$chuoi1[1];
                                    $product_soluong=$chuoi1[2];
                                    
                                    $prod=$this->requestAction('comment/get_product/'.$product_id);
                             
                                ?>
                          
                            <tr> 
                            <td><?php echo $row['Order']['created']?></td>      
                                <td class="tal" align="center"><img width="70"src="<?php echo DOMAINAD.'timthumb.php?src='.$prod['Product']['images']?>&amp;h=50&amp;w=70&amp;zc=1" /></td>
                                <td style="padding-left: 5px;"><?php echo $product_title; ?></td>
                                <td class="tal"><?php echo $product_soluong;?></td>
                               
                                <td class="tal" align="center"><font color="red"><?php echo number_format( $prod['Product']['price']); ?> VNĐ</font></td>
                                <td class="tal" align="center"><font color="red"><?php echo number_format($prod['Product']['price']*$product_soluong); ?> VNĐ</font></td>
                                <td class="tal" align="center">
                                <?php if($row['Order']['status']==0) echo "Chưa thanh toán"; else echo "Đã thanh toán"; ?>
                                 </td>   
                                 <td class="tal" align="center">
                                <?php if($row['Order']['tinhtrang']==0) echo "Chờ giao"; else echo "Đã giao"; ?>
                                 </td>         
                            </tr>
                           <?php }  ?>
                            <tr>
                          
                            <td colspan="5" style="text-align:right"><b style="font-size:14px;">Tổng tiền phải trả:</b></td>
                            <td colspan="3" style="text-align:left"><b style="font-size:14px;"><?php echo number_format($row['Order']['tongtien']);?> VNĐ</b></td>
                           
                           
                            </tr> 
                            
                            <?php }?>
                        </table>
                        
                       <div class="pt">
                       	<div class="pt-pagi"> <?php echo $paginator->numbers();?> </div><!-- End pt-pagi-->
                       </div><!-- End pt-->

	</div>


</div><!-- End right -->
</div>
</div>
<div style="height:20px;"></div>
</div><!-- End content -->