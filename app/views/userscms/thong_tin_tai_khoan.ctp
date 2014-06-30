


<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/new.css"/>



 
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
				$('.hinhthucthanhtoan').val(0);
				$('#hinhthucthanhtoan' +id).val(1);
				//$('.bg-active').addClass('bg-active');
				$('.div').hide();
				$('#div-'+id).show();
				});
				
			
	});
</script>
 



 <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
<div id='body'>
        <div id='slide'>
       
            <img src="<?php echo DOMAIN?>images/slide.jpg" alt="">
            
        </div>
       <?php echo $this->element('menu_top');?>
       
     
    
    <div id="main-center">
<div id="sanphams" style="min-height: 500px !important;">


    <div class="tieude">
<p> Thông tin tài khoản</p></div>


<div class="left">
<ul>
<li class="li-chon"><a href="<?php echo DOMAIN?>thong-tin-tai-khoan">Thông tin tài khoản</a></li>
<li><a href="<?php echo DOMAIN?>thong-tin-don-hang">Thông tin đơn hàng</a></li>
<li><a href="<?php echo DOMAIN?>doi-mat-khau">Đổi mật khẩu</a></li>


</ul>

</div><!-- End left -->


<div class="right">
<div class="div-ttkh">
<p class="tttk">Thông tin tài khoản</p>

<?php if($d!=1){?>
	<table class="tb3">
	<tr>
	<td width="100px;" style="text-align:right;padding-top:10px;padding-right:5px;">Họ tên:</td>
	<td><?php 
	
	echo $user['Userscms']['name'];?></td>
	<td style="text-align:right;"><a class="a-edit" href="<?php echo DOMAIN?>thong-tin-tai-khoan/1">
	Chỉnh sửa
	</a></td>
	
	</tr>
	
	
	<tr>
	<td width="100px;" style="text-align:right;padding-right:5px;">Điện thoại:</td>
	<td colspan="2"><?php echo  $user['Userscms']['phone'];?></td>
	
	
	</tr>
	
	<tr>
	<td width="100px;" style="text-align:right;padding-right:5px;">Giới tính:</td>
	<td colspan="2"><?php   if($user['Userscms']['sex']==1) echo "Nam"; else echo "Nữ";?></td>
	
	
	</tr>
	
	<tr>
	<td width="100px;" style="text-align:right;padding-right:5px;">Ngày sinh:</td>
	<td colspan="2"><?php echo  $user['Userscms']['birth_date'];?></td>
	
	
	</tr>
	<tr>
	<td width="100px;" style="text-align:right;padding-right:5px;">Email:</td>
	<td colspan="2"><?php echo  $user['Userscms']['email'];?></td>
	
	
	</tr>
	</table>
	<?php } else {?>
	<form  action="<?php echo DOMAIN?>userscms/luu" method="POST" name="myform" id="myform2">
	<table class="tb3">
	<tr>
	<td width="100px;" style="text-align:right;padding-top:10px;padding-right:5px;">Họ tên:</td>
	<td> <input class="text" name="name" value="<?php echo  $user['Userscms']['name'];?>" type="text"/></td>
	<td style="text-align:right;"><input type="submit" value="Lưu lại" class="sub-luu"/></td>
	
	</tr>
	
	
	<tr>
	<td width="100px;" style="text-align:right;padding-right:5px;">Điện thoại:</td>
	<td colspan="2">
	<input class="text" name="phone" value="<?php echo  $user['Userscms']["phone"];?>" type="text"/>
	</td>
	
	
	</tr>
	
	<tr>
	<td width="100px;" style="text-align:right;padding-right:5px;">Giới tính:</td>
	<td colspan="2">
	<select name="sex">
	<?php if($user['Userscms']['sex']==1){?>
	<option value="1">Nam</option>
	<option value="0">Nữ</option>
	
	<?php } else{?>
	<option value="0">Nữ</option>
	<option value="1">Nam</option>
	<?php }?>
	</select>
	
	</td>
	
	
	</tr>
	
	<tr>
	<td width="100px;" style="text-align:right;padding-right:5px;">Ngày sinh:</td>
	<td colspan="2">
	<input class="text" name="birth_date" value="<?php echo  $user['Userscms']["birth_date"];?>" type="text"/>
	</td>

	
	
	</tr>
	<tr>
	<td width="100px;" style="text-align:right;padding-right:5px;">Email:</td>
	<td colspan="2"><?php echo  $user['Userscms']['email'];?></td>
	
	<input type="hidden" name="email" value="<?php echo  $user['Userscms']['email'];?>" />
	<input type="hidden" name="id" value="<?php echo  $user['Userscms']['id'];?>" />
	
	</tr>
	</table>
	
	</form>
	<?php }?>
	</div>


</div><!-- End right -->
    
 </div>


</div>
           
        <div style="width:20px;"></div>
    </div><!--end #body-->
    











	










