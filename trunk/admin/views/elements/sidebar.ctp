    <div id="sidebar">
       <div id="sidebar-wrapper"> 
        
        <h1 id="sidebar-title"><a href="#"></a></h1>
        <a href="#"><img id="logo" src="<?php echo DOMAINAD?>images/logo.png" alt="Doan Nam" /></a>
      
        <div id="profile-links">
             Xin chào, <a href="#" title="Edit your profile"><?php echo $this->Session->read('name'); ?></a><br />
            <br />
            <a href="<?php echo DOMAIN;?>" title="View the Site">Xem trang chủ</a> | <a href="<?php echo DOMAINAD?>login/logout" title="Sign Out">Sign Out</a>
        </div>        
        <div id="list">
          <ul id="main-nav"> 
            
            <li id="arrayorder_1">
                <a href="<?php echo DOMAINAD?>home" class="nav-top-item no-submenu">
                    Trang chủ
                </a>       
            </li>
            
            <li id="arrayorder_2">
                <a href="#" class="nav-top-item"> 
                  Sản phẩm
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINAD?>catproducts/index">Danh mục sản phẩm</a></li>
                    <li><a href="<?php echo DOMAINAD?>catproducts/add">Thêm danh mục</a></li>
                    <li><a href="<?php echo DOMAINAD?>products/index">Danh sách sản phẩm</a></li>
                    <li><a href="<?php echo DOMAINAD?>products/add">Thêm mới sản phẩm</a></li>
                  
                </ul>
            </li>
            <li id="arrayorder_3">
                <a href="#" class="nav-top-item"> 
                  Tin tức
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINAD?>category/index">Danh mục tin tức</a></li>
                    <li><a href="<?php echo DOMAINAD?>category/add">Thêm mới danh mục</a></li>
                    <li><a href="<?php echo DOMAINAD?>news/index">Danh sách tin tức</a></li>
                    <li><a href="<?php echo DOMAINAD?>news/add">Thêm mới tin</a></li>
                </ul>
            </li>
           
           <li id="arrayorder_4">
                <a href="#" class="nav-top-item"> 
                  Quản lý khách hàng
                </a>
                <ul>
				
              
					<li><a href="<?php echo DOMAINAD?>userscms/index">Danh sách khách hàng</a></li>
					
					
                    
                </ul>
            </li>
           
              <li id="arrayorder_5">
                <a href="#" class="nav-top-item"> 
                  Quản lý gian hàng
                </a>
                <ul>
                    
                    <li><a href="<?php echo DOMAINAD?>shop/index">Danh sách đăng ký</a></li>
					 <li><a href="<?php echo DOMAINAD?>shop/add">Thêm gian hàng</a></li>
                    <li><a href="<?php echo DOMAINAD?>products/index1">Danh sách sản phẩm</a></li>
                    <li><a href="<?php echo DOMAINAD?>products/add1">Thêm sản phẩm gian hàng</a></li>
                </ul>
            </li>
             <li id="arrayorder_5">
                <a href="#" class="nav-top-item"> 
                  Thống kê + Báo cáo
                </a>
                <ul>
                    
                    <li><a href="<?php echo DOMAINAD?>products/buy">Hàng nhập</a></li>
					
                    <li><a href="<?php echo DOMAINAD?>products/sales">Hàng bán</a></li>
                    <li><a href="<?php echo DOMAINAD?>products/stocks">Tồn kho</a></li>
                </ul>
            </li>
           
            <li id="arrayorder_6">
                <a href="#" class="nav-top-item"> 
                  Quản lý đặt hàng
                </a>
                <ul>
                    
                    <li><a href="<?php echo DOMAINAD?>orders/index">Danh sách</a></li>
                    
                </ul>
            </li>
          
          
             <li id="arrayorder_7">
                <a href="#" class="nav-top-item">Cấu hình</a>
                <ul>
                    <li><a href="<?php echo DOMAINAD?>settings/edit/1">Cầu hình website</a></li>
				
                </ul>
            </li> 
            
            <li id="arrayorder_8">
                <a href="#" class="nav-top-item">Tài khoản</a>
                <ul>
                    <li><a href="<?php echo DOMAINAD?>accounts">Tài khoản</a></li>
                    <li><a href="<?php echo DOMAINAD?>accounts/add">Tạo tài khoản</a></li>
                </ul>
            </li>   
            
            <li id="arrayorder_9">
                <a href="#" class="nav-top-item">Hỗ trợ trực tuyến</a>
                <ul>
                    <li><a href="<?php echo DOMAINAD?>helps">Danh sách</a></li>
                    <li><a href="<?php echo DOMAINAD?>helps/add">Thêm mới</a></li>
                </ul>
            </li>
            
           
             
            
            
        </ul> 
        </div>
    </div>
    </div>
