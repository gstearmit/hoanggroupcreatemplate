

<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/new.css"/>



<div id='body'>
        <div id='slide'>
       
            <img src="<?php echo DOMAIN?>images/slide.jpg" alt="">
            
        </div>
       <?php echo $this->element('menu_top');?>

   <div id="main-center" style="overflow: hidden;">
<div id="sanphams" style="min-height: 500px !important;">
<?php foreach ($new as $row){?>
<div class="tieude">
<p> <?php echo $row['New']['title']; ?></p></div>


<div class="left">
<ul>
<?php foreach($listnew as $listnew) {?>
<li class="<?php if($listnew['New']['id']==$row['New']['id']) echo "li-chon";?>"><a href="<?php echo DOMAIN?>chi-tiet-tin/<?php echo $listnew['New']['id'];?>"><?php echo $listnew['New']['title'];?></a></li>
<?php }?>
</ul>

</div><!-- End left -->


<div class="right">
<?php echo $row['New']['content'];?>


</div><!-- End right -->
<?php }?>
</div><!-- End content -->
</div>
</div>