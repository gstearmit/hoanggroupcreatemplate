<?php
echo $this->element('header');
echo $this->element('menu');
echo $this->element('sidebar'); ?>
<div id="content">
<?php echo $content_for_layout; ?>
</div>
<?php
echo $this->element('footer');
?>
