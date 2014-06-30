<?php
/*
stardevelop.com Live Help
International Copyright stardevelop.com

You may not distribute this program in any manner,
modified or otherwise, without the express, written
consent from stardevelop.com

You may make modifications, but only for your own 
use and within the confines of the License Agreement.
All rights reserved.

Selling the code for this program without prior 
written consent is expressly forbidden. Obtain 
permission before redistributing this program over 
the Internet or in any other medium.  In all cases 
copyright and header must remain intact.  
*/

$query = "SELECT * FROM " . $table_prefix . "messages AS messages WHERE `session` = '$guest_login_id' AND `status` >= '0' ORDER BY `datetime`";
$rows = $SQL->selectall($query);
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {

			$username = addslashes($row['username']);
			$message = addslashes($row['message']);
			$status = $row['status'];
			$align = $row['align'];
		
			// Search and replace smilies with images if smilies are on
			if ($_SETTINGS['SMILIES'] == true) {
				$message = htmlSmilies($message, '../images/');
			}
		
			if ($align == '1') { $align = 'left'; } elseif ($align == '2') { $align = 'center'; } elseif ($align == '3') { $align = 'right'; }
		
			// Outputs sent message
			if ($status == 0){
?>
<table width="100%" border="0" align="center">
	<tr>
		<td><div align="<?php echo($align); ?>" style="color: <?php echo($_SETTINGS['RECEIVEDFONTCOLOR']); ?>;"><?php if ($row['username'] != '') { ?><strong><?php echo($username); ?></strong>: <?php } echo($message); ?><br></div></td>
	</tr>
</table>
<?php
			}
			// Outputs received message
			if ($status > 0){
?>
<table width="100%" border="0" align="center">
	<tr>
		<td><div align="<?php echo($align); ?>" style="color: <?php echo($_SETTINGS['SENTFONTCOLOR']); ?>;"><?php if ($row['username'] != '') { ?><strong><?php echo($username); ?></strong>: <?php } echo($message); ?><br></div></td>
	</tr>
</table>
<?php 
			}
		}
	}
}
?> 