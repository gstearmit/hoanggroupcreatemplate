<div class="left">
        <h3 class="title">Quản lý sản phẩm</h3>
		<div>
			<ul>
			   <?php 
			      $shops= $this->requestAction('/comment/shops');
			     if(!$shops){
			   ?>
				<li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>dang-ky-mo-gian-hang">- Đăng ký mở gian hàng</a></li>
				<?php 
				  }
				?>
				<li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>quan-ly-danh-muc-san-pham">- Danh mục sản phẩm</a></li>
                <li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>quan-ly-san-pham">- Quản lý sản phẩm</a></li>
               
			</ul>
		</div>
        <h3 class="title">Công ty</h3>
		<div>
			<ul>
				<li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>thong-tin-cong-ty">- Thông tin công ty</a></li>
                <li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>gioi-thieu-cong-ty">- Giới thiệu công ty</a></li>
                <li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>tin-tuc-khuyen-mai">- Tin tức khuyến mãi</a></li>
                <li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>tin-tuc-cong-ty">- Tin tức công ty</a></li>
                
			</ul>
		</div>
        <h3 class="title">Cài đặt giao diện</h3>
		<div>
			<ul>
				<li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>cai-dat-banner">- Cài đặt banner</a></li>
                <li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>cai-dat-background">- Cài đặt background</a></li>
                <li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>cai-dat-giao-dien">- Cài đặt giao diện</a></li>
			</ul>
		</div>
		<h3 class="title">Tin nhắn</h3>
		<div>
			<ul>
				<li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>tin-nhan-tu-bqt">- Tin nhắn từ BQT</a></li>
			</ul>
		</div>
        <h3 class="title">Trang chủ</h3>
		<div>
			<ul>
				<li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>thong-tin-cong-ty">- Trang chủ</a></li>
			</ul>
		</div>
        <h3 class="title">Rao vặt</h3>
		<div>
			<ul>
				<li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>quan-ly-tin-rao-vat">- Quản lý tin rao vặt</a></li>
			</ul>
		</div>
        <h3 class="title">Xem/Sửa hồ sơ</h3>
		<div>
			<ul>
				<li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>ho-so">- Hồ sơ</a></li>
                <li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>thay-doi-mat-khau">- Thay đổ mật khẩu</a></li>
                <li style="padding-bottom: 5px;"><a href="<?php echo DOMAIN;?>cai-dat">- Cài đặt</a></li>
			</ul>
		</div>
        
	</div>