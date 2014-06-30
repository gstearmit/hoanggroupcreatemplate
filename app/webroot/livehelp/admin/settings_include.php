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
if (!isset($_REQUEST['SAVE'])){ $_REQUEST['SAVE'] = ''; }

if ($_REQUEST['SAVE'] == true) {

	if ($current_privilege > 2) {
		$save_label = $settings_access_denied_label;
	}
	else {
		//for every post value check all the lines and update them.
		foreach ($_REQUEST as $key => $value) {
			//discard the unused post values ie submit buttons and save indict.
			if ($key != 'SAVE' && $key != 'Submit') { 
				$key = strtolower($key);
				$query = "UPDATE " . $table_prefix . "settings SET `value` = '$value' WHERE `name` = '$key'";
				$SQL->miscquery($query);
			}
		}
		$save_label = $settings_saved_label;
		
		$query = "SELECT `name`, `value` FROM " . $table_prefix . "settings";
		$rows = $SQL->selectall($query);
		if (is_array($rows)) {
			foreach ($rows as $key => $row) {
				if (is_array($row)) {
					$variable = $row['name'];
					$$variable = $row['value'];
				}
			}
		}
	}
}


if ($current_privilege > 2) {
	$save_label = $settings_access_denied_label;
}

?>
