 <link type="text/css" href="<?php echo DOMAIN ?>css/product.css" rel="stylesheet" /> 
 
 <script type="text/javascript" src="<?php echo DOMAIN?>js/verticaltabs.pack.js"></script> 
<link rel="stylesheet" href="<?php echo DOMAIN?>/css/verticaltabs.css" />
   <?php echo $javascript->link('jquery.validate', true); ?>
   
 



<style>
  #goi-thieu h1,h2,h3{
	  font-size:12px;
	  font-weight:normal;
	  }

    #main-register input, .text-main input, .a-delete {
    border: 1px solid #CCC;
    border-radius: 5px;
	 padding: 3px;
    margin-bottom: 10px;
    font-size: 14px;
    color: #333;
    }
.a-delete{padding-top:5px;}
</style>
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có chắc muốn xóa sản phẩm này không?"))
{
	document.location = delUrl;
}
}
</script> 


 <script type="text/javascript">
	$(document).ready(function(){
		$("#textExample").verticaltabs({speed: 500,slideShow: false,activeIndex: 2});

		$("#ckform").validate({
			rules: {
					email: {
					required: true,
					email:true
					
							},
					name: {
					required: true,
					minlength: 5
							},
				
					
					phone: {
								required: true,
								number: true,
								minlength: 9
							},
				address: {
					required: true,
					minlength: 5
							}
			
			},
			messages: {
					name: {
					required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập họ tên của bạn	</span>",
					minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Họ tên phải ít nhất 5 ký tự!</span>"
				},
				
				
				email:{
						required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập email của bạn!</span>",
							email: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;' >Email không chính xác </span> "
							
				},
				
				phone: {
					required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập điện thoại!</span>",
					
					number: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;' >Số điện thoại phải là các số 0-9</span> ",
					minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Số điện thoại phải ít nhất 9 ký tự!</span>"
				},
		
					address: {
					required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập địa chỉ của bạn</span>",
					minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Địa chỉ phải ít nhất 5 ký tự!</span>"
			
						}
					
				
			}
		});



		$("#ckform1").validate({
			rules: {
					email: {
					required: true,
					email:true
					
							},
					name: {
					required: true,
					minlength: 5
							},
				
					
					phone: {
								required: true,
								number: true,
								minlength: 5
							},
				address: {
					required: true,
					minlength: 5
							}
		
			
			},
			messages: {
					name: {
					required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập họ tên của bạn!	</span>",
					minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Họ tên phải ít nhất 5 ký tự!</span>"
				},
				
				
				email:{
						required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập email của bạn!</span>",
							email: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;' >Email không chính xác </span> "
							
				},
				
				phone: {
					required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập điện thoại!</span>",
					
					number: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;' >Số điện thoại phải là các số 0-9</span> ",
					minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Họ tên phải ít nhất 5 ký tự!</span>"
				},
		
					address: {
					required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập địa chỉ của bạn!</span>",
					minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Địa chỉ phải ít nhất 5 ký tự!</span>"
			
						}
				
				
				
			}
		});

		function tt(tien){
			var n=0;
			var t=0;
			var mang='';
			a=''+tien;
			


			//alert(tien.length);
			for(i=a.length-1;i>=0;i--){
			
			if(t==3){t=0;
			mang+='.';
			}
			t++;
			mang+=a[i];
			}
			n=0;var b='';
				for(i=mang.length-1;i>=0;i--){
				b+=mang[i];
				}
			return b+'đ';
			}
			
			$('#soluong').change(
			function(){
			
			var tien=$('#soluong').val() *$('#tt').val();
		
			var tongtien=parseInt(tien) + parseInt($('#tienphi').val());
			
			$('#tien').html(tt(tien));

			$('#tongtien').html(tt(tongtien));

			$('#product_soluong').val($('#soluong').val());
			$('#product_soluong1').val($('#soluong').val());
			$('#tienphaitra').val(tongtien);
			$('#tienphaitra1').val(tongtien);
			
			}
			);
			

			$('.thongtin ul li').click(function(){
				
				var id = $(this).attr('id');
				$('.li').removeClass('yes');
				$('.li').addClass('no');
				$(this).addClass('yes');
				//$('.bg-active').addClass('bg-active');
				$('.div').hide();
				$('#div-'+id).show();
				});
			
	});
</script>
 

 <script>
							  $(function(){
							  $('.sl').change(function (){
									window.location.href="<?php echo DOMAIN;?>product/updateshopingcart1/"+$(this).attr('nam')+"/"+$(this).val();
							  }) ;
							  
							  })
							  </script>

 <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
<div id='body'>
        <div id='slide'>
       
            <img src="<?php echo DOMAIN?>images/slide.jpg" alt="">
            
        </div>
       <?php echo $this->element('menu_top');?>
       
     
    
    <div id="main-center">
<div id="sanphams" style="min-height: 1022px !important;">


    	<div class="top">Sản phẩm trong giỏ hàng
        </div>
        <div class="m3" style="padding-left: 20px;">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                     <div class="text-main" style="padding-top:20px; padding-bottom:20px;">
                         <table  class="tblGrid wf" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse">
                            <tr>
                                <th width="100">Hình ảnh</th>
                                <th width="200">Tên sản phẩm</th>
                                <th width="70">Số lượng</th>
                                <th width="130">Giá</th>
                                <th width="130">Tổng giá</th>
                                <th width="50">Xử lý</th>
                            </tr>
                            <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
                            <?php if($product['name']!=null){?>
                            <tr>       
                                <td class="tal" align="center"><img width="70"src="<?php echo DOMAINAD.'timthumb.php?src='.$product['images']?>&amp;h=50&amp;w=70&amp;zc=1" /></td>
                                <td style="padding-left: 5px;"><?php echo $product['name']; ?></td>
                                <td class="tal">
                                
                             	 <select name="soluong" class="sl" nam="<?php echo $key?>">
                                <option value="<?php echo $product['sl'];?>"><?php echo $product['sl']; ?></option>
                                <?php
                                $prod=$this->requestAction('comment/get_product/'.$product['pid']);
								
								for($i=1; $i<=$prod['Product']['conlai']; $i++) {
								if($i!=$product['sl']){
								?>
                                
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } }?>
                                </select>
                                </td>
                               
                                <td class="tal" align="center"><font color="red"><?php echo number_format( $product['price']); ?> VNĐ</font></td>
                                <td class="tal" align="center"><font color="red"><?php echo number_format($product['total']); ?> VNĐ</font></td>
                                <td class="tal" align="center">
                                <input onclick="document.view<?php echo $i; ?>.submit();"  type="image" src="<?php echo DOMAIN?>images/refresh.png" alt="Cập nhật" style="float:left; margin-left:5px;margin-top:"/>
                                <p style="padding-top:3px;">
                                <a class="a-delete" href="javascript:confirmDelete('<?php echo DOMAIN;?>product/deleteshopingcart/<?php echo $key;?>')"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a></p>
                                </td>        
                            </tr>
                            <?php $total +=$product['total']; $i++; }} 
							
							?> 
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Tổng tiền phải trả:</td>
                            <td><?php echo number_format($total);?> VNĐ</td>
                            </tr> 
                        </table>
                        <?php if($i==0){ echo"<br/><b>Chưa có sản phẩm nào trong giỏ hàng!</b><br/>";}?>
                       
                       
                       
                      </div>
                </div>                  
             </div>            
             <div class="clearfix"></div>
           <div class="tt">  
             <img style="margin-top:20px;margin-left:36px;" src="<?php echo DOMAIN?>images/steps_01.png"/>
<div class="tieude">
		<p  class="titleleft">Thông tin người nhận</p>
		<p class="titleright"></p>
	</div>
	<?php 
	$name1=$this->RequestAction('comment/get_user/'.$this->Session->read('email'));
	//pr($name); die;
	$n=$this->Session->read('thongtin',null);
		$name=isset($n['name']) ? $n['name']:$name1['Userscm']['name'];
		
		$email=isset($n['email']) ? $n['email']:$name1['Userscm']['email'];
		$phone=isset($n['phone']) ? $n['phone']:$name1['Userscm']['phone'];
		$diadiem=isset($n['diadiem']) ? $n['diadiem']:'';
		$address=isset($n['address']) ? $n['address']:$name1['Userscm']['address'];
		$ghichu=isset($n['ghichu']) ? $n['ghichu']:'';
		$thongtinkhachhang=isset($n['thongtinkhachhang']) ? $n['thongtinkhachhang']: 2;
	
	?>
	
	<div class="thongtin">
	<ul>
		<li class="li <?php if($thongtinkhachhang==1) echo "yes"; else "no";?>" id="1">
				<p class="p-t">Nhận hàng tại Tiến Thời</p>
				<p class="p-s">Vui lòng đến cửa hàng Tiến Thời nhận sản phẩm trực tiếp</p>
		 </li>
			<div class="div" id="div-1">
				<form class="cmxform" id="ckform" method="POST" action="<?php echo DOMAIN?>dat-mua-b2">
				<table style="color:#58595B;" class="tb-ttkh"> 
				<tr>
					<td style="text-align:right;">Họ tên(<span style="color:red;">*</span>)</td>
					<td colspan="2" style="padding-left:10px;">
					<input name="name" id="name" class="text" type="text" value="<?php echo $name?>"/>
					</td>
				</tr>
				
				<tr>
					<td style="text-align:right">Email(<span style="color:red;">*</span>)</td>
					<td colspan="2" style="padding-left:10px;"><input name="email" class="text" type="text" value="<?php echo $email?>"/></td>
				</tr>
				
				<tr>
					<td style="text-align:right">Điện thoại di động(<span style="color:red;">*</span>)</td>
					<td colspan="2" style="padding-left:10px;"><input name="phone" class="text" type="text" value="<?php echo $phone?>"/></td>
				</tr>
				
				
				<tr>
					<td style="text-align:right">Địa chỉ nhận hàng tại:</td>
					<td colspan="2" style="padding-left:10px;">
                    <?php $setting=$this->requestAction('comment/setting');
					foreach ($setting as $setting){
					?>
					
                    <?php echo $setting['Setting']['address']; }?>
					<input name="address"  id="diachi" class="text" type="hidden" value="Số 15A, 111 Xuân Diệu, Quảng Nam, Tây Hồ, Hà Nội"/></td>
				</tr> 
		
				<tr>
					<td style="text-align:right">Ghi chú</td>
					<td colspan="2" style="padding-left:10px;">
					
					
					<textarea rows="2" name="ghichu" id="ghichu" cols="20" class="ghichu">
					<?php echo $ghichu?>
					</textarea>
					
				</tr>
				<tr>
				<td colspan="3">
				
				
                     
				<input type="image" src="<?php echo DOMAIN?>images/submit_TT.png"  style="margin-left:175px;"/>
				</a>
				</td>
				</tr>
				</table>
				</form>
			</div>
		
		
		<li class="li <?php if($thongtinkhachhang==2) echo "yes"; else "no";?>" id="2">
		<p class="p-t">Giao hàng tận nơi</p>
				<p class="p-s">Vui lòng cho biết địa chỉ giao sản phẩm</p>
		</li>
			<div class="div" id="div-2">
				<form class="cmxform" id="ckform1" method="POST" action="<?php echo DOMAIN?>dat-mua-b2">
			<table style="color:#58595B;" class="tb-ttkh"> 
				<tr>
					<td style="text-align:right">Họ tên(<span style="color:red;">*</span>)</td>
					<td colspan="2" style="padding-left:10px;"><input name="name"  class="text" type="text" value="<?php echo $name?>"/></td>
				</tr>
				
				<tr>
					<td style="text-align:right">Email(<span style="color:red;">*</span>)</td>
					<td colspan="2" style="padding-left:10px;"><input name="email"  class="text" type="text" value="<?php echo $email?>"/></td>
				</tr>
				
				<tr>
					<td style="text-align:right">Di động(<span style="color:red;">*</span>)</td>
					<td colspan="2" style="padding-left:10px;"><input name="phone"  class="text" type="text" value="<?php echo $phone?>"/></td>
				</tr>
				
				<tr>
					<td style="text-align:right">Giao hàng tại(<span style="color:red;">*</span>)</td>
					<td style="padding-left:10px; width:80px;">
							<input type="radio" name="diadiem" value="Nhà riêng" <?php if($diadiem=='Nhà riêng') echo"checked"?>>
							Nhà riêng
							</td>
							<td>
							<input type="radio" name="diadiem" value="Công ty quý khách" <?php if($diadiem!='Nhà riêng') echo"checked"?> >
							Công ty quý khách
					</td>
				</tr>
				
				<tr>
					<td style="text-align:right">Địa chỉ giao sản phẩm(<span style="color:red;">*</span>)</td>
					<td colspan="2" style="padding-left:10px;"><input name="address" id="diachi" class="text" type="text" value="<?php echo $address?>"/></td>
				</tr> 
		
				<tr>
					<td style="text-align:right">Ghi chú</td>
					<td colspan="2" style="padding-left:10px;">
					
					
					<textarea rows="2" name="ghichu" id="ghichu" cols="20" class="ghichu">
					<?php echo $ghichu?>
					</textarea>
					
				</tr>
				<tr>
				<td colspan="3">
				
					
                 
				
				<input type="image" src="<?php echo DOMAIN?>images/submit_TT.png"  style="margin-left:175px;"/>
				</td>
				</tr>
				</table>
				</form>
			</div>
             </div>
             
        </div> 
        <div class="b3"><div class="b3"><div class="b3"></div></div></div>
    </div>
    
    
    
    
 </div>



           
        <div class="clear margin"></div>
    </div><!--end #body-->
    











	
