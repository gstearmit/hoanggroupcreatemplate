<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin</title>
<link rel="stylesheet" href="<?php echo DOMAINAD?>css/screen.css" type="text/css" media="screen" title="default" />
</head>
<body>
<div id="page-top-outer">
  <div id="page-top">

    <div id="top-search">
      <table border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td><input type="text" value="検索する" onblur="if (this.value=='') { this.value='検索する'; }" onfocus="if (this.value=='Search') { this.value=''; }" class="top-search-inp" /></td>
          <td><input type="image" src="<?php echo DOMAINAD?>images/shared/top_search_btn.gif"  /></td>
        </tr>
      </table>
    </div>
    <div class="clear"></div>
  </div>
</div>

<div class="nav-outer-repeat">
  <!--  start nav-outer -->
  <div class="nav-outer">
    <!-- start nav-right -->
    <div id="nav-right">
      <div class="nav-divider">&nbsp;</div>
      <a href="<?php echo DOMAINAD?>login/logout" id="logout"><img src="<?php echo DOMAINAD?>images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
      <div class="clear">&nbsp;</div>
      <!--  start account-content -->
      <div class="account-content">
        <div class="account-drop-inner"> <a href="" id="acc-settings">Settings</a>
          <div class="clear">&nbsp;</div>
          <div class="acc-line">&nbsp;</div>
          <a href="" id="acc-details">Personal details </a>
          <div class="clear">&nbsp;</div>
          <div class="acc-line">&nbsp;</div>
          <a href="" id="acc-project">Project details</a>
          <div class="clear">&nbsp;</div>
          <div class="acc-line">&nbsp;</div>
          <a href="" id="acc-inbox">Inbox</a>
          <div class="clear">&nbsp;</div>
          <div class="acc-line">&nbsp;</div>
          <a href="" id="acc-stats">Statistics</a> </div>
      </div>
      <!--  end account-content -->
    </div>
    <!-- end nav-right -->
    <!--  start nav -->
    <div class="nav">
      <div class="table">
        <ul class="select">
          <li><a href="<?php echo DOMAINAD?>home""><b>Trang chủ</b></a>
            <!--[if IE 7]><!--></a><!--<![endif]-->
          </li>
        </ul>
        <div class="nav-divider">&nbsp;</div>
        <ul class="select">
          <li><a href="<?php echo DOMAINAD?>category"><b>Danh mục</b></a> </li>
        </ul>
		<div class="nav-divider">&nbsp;</div>
        <ul class="select">
          <li><a href="<?php echo DOMAINAD?>products"><b>Sản phẩm</b></a> </li>
        </ul>
        <div class="nav-divider">&nbsp;</div>
        <ul class="select">
          <li><a href="<?php echo DOMAINAD?>projects"><b>Công trình</b></a> </li>
        </ul>
        <div class="nav-divider">&nbsp;</div>
        <ul class="select">
          <li><a href="<?php echo DOMAINAD?>news"><b>Tin tức</b></a> </li>
        </ul>
        <div class="nav-divider">&nbsp;</div>
        <ul class="select">
          <li><a href="<?php echo DOMAINAD?>partners"><b>Đối tác</b></a> </li>
        </ul>
        <div class="nav-divider">&nbsp;</div>
        <ul class="select">
          <li><a href="<?php echo DOMAINAD?>gallery"><b>Thư viện ảnh</b></a> </li>
        </ul>
         <div class="nav-divider">&nbsp;</div>
        <ul class="select">
          <li><a href="<?php echo DOMAINAD?>contacts"><b>Liên hệ</b></a> </li>
        </ul>
        <div class="nav-divider">&nbsp;</div>
         <ul class="select">
          <li><a href="<?php echo DOMAINAD?>accounts"><b>Tài Khoản</b></a> </li>
        </ul>
        <div class="nav-divider">&nbsp;</div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <!--  start nav -->
  </div>
  <div class="clear"></div>
  <!--  start nav-outer -->
</div>
<div class="clear"></div>
<div id="content-outer">
  <!-- start content -->
    <?php echo $content_for_layout; ?>
  <!--  end content -->
  <div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->
<div class="clear">&nbsp;</div>
<!-- start footer -->
<div id="footer">
  <!--  start footer-left -->
  <div id="footer-left"> 東京の中古マンション・都内の中古マンション購入ならマンション東京　Copyright マンション東京 Co.,Ltd. All Rights Reserved.</div>
  <!--  end footer-left -->
  <div class="clear">&nbsp;</div>

</div>
<!-- end footer -->
</body>
</html>