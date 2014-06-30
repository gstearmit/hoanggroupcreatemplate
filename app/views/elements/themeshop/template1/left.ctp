<?php 
/*
$sangurl = $_SERVER['REQUEST_URI'];
$url = explode("/", $sangurl);
$url_shop=$url[2];
*/
?>
<div class="wrapper_left">
    <div class="left_module">
        <div class="title_module">
            <div class="left_icon"></div>
            <div class="title"><span>Danh mục sản phẩm</span></div>
            <div class="right_icon"></div>
        </div>
        <div class="content_module">
            <div class="arrowsidemenu">
                  <?php 
				    $categoryproduct = $this->requestAction('/'.$url_shop.'/categoryproduct');
					$i=0; foreach($categoryproduct as $categoryproduct) {
                 ?>
                  <div class="menuheaders" headerindex="0h"><a href="<?php echo DOMAIN;?><?php echo $url_shop;?>/danh_sach_san_pham/<?php echo $categoryproduct['Categoryshop']['id'];?>"><?php echo $categoryproduct['Categoryshop']['name'];?></a></div>
                    <ul class="menucontents" contentindex="1c" style="display: none;">
                        <?php $categoryproductsub = $this->requestAction('/'.$url_shop.'/categoryproductsub/'.$categoryproduct['Categoryshop']['id']); ?>
						<?php  foreach($categoryproductsub as $categoryproductsubs){
                          if ( $categoryproductsubs['Categoryshop']['parent_id']== $categoryproduct['Categoryshop']['id']){?>
                        <li><a href=""><?php echo $categoryproductsubs['Categoryshop']['name'];?></a></li>
                        <?php } }?>
                    </ul>
                   <?php }?>
             </div>
                
        </div>
    </div>
    <div class="left_module">
        <div class="title_module">
            <div class="left_icon"></div>
            <div class="title"><span>Thống kê</span></div>
            <div class="right_icon"></div>
        </div>
        <div class="content_module">
            <div class="thongke">
                <p>Tham gia từ: 20/08/2011</p>
                <p>Lượt xem: 3252465</p>
                <p>Đánh giá: <img src="<?php echo DOMAIN;?>tem/images/5stars.gif" /></p>
            </div>
        </div>
    </div>
</div>	