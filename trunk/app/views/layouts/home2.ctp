<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/checkform.js"></script>
<?php echo $this->element('header')?>

<div id="main-content">
	 <div class="content-top">
	 <?php echo $this->element('menu_top');?>
	 <div class="content-top-body">
			<?php echo $content_for_layout; ?>	
	 </div><!-- End content-top-body -->
	 </div><!-- End content-top -->	 
</div><!-- ENd main content -->
<?php echo $this->element('footer')?>

