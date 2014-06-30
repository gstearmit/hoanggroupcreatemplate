<?php
if($districts){
 ?>
    <option value="0" > Quận / Huyện</option>
<?php
	foreach ($districts as $index => $value){
?>																				
	<option value="<?php echo $value['District']['id']?>" > <?php echo $value['District']['name']?> </option>
<?php }
}else{ ?>
	<option value="0" > Quận / Huyện</option>
<?php
}	
?>