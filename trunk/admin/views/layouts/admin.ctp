<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administractor</title>
<?php echo $this->Html->css("reset");?>
<?php echo $this->Html->css("style");?>
<?php echo $this->Html->css("invalid");?>
<?php echo $javascript->link('jquery-1.3.2.min'); ?>
<?php echo $javascript->link('simpla.jquery.configuration'); ?>
<?php echo $javascript->link('facebox'); ?>
<?php echo $javascript->link('jquery.wysiwyg'); ?>
<?php echo $javascript->link('jquery.datePicker'); ?>
<?php echo $javascript->link('jquery.date'); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function(){ 	

	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable("serialize") + '&update=update'; 
			$.post("", order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});	
</script>
</head>
	<body>
      <div id="body-wrapper"> 
		<?php echo $this->element('sidebar'); ?>
		<div id="main-content"> 
			<noscript> 
				<div class="notification error png_bg">
					<div>
						
					</div>
				</div>
			</noscript>
			
			<div class="clear"></div> 
			<?php echo $content_for_layout; ?>
			
			<div id="footer">
				<small>
						&#169; Copyright 2011 </a>
				</small>
			</div>
			
		</div> 
	</div></body>
</html>
