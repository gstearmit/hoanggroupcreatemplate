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
include('../include/database.php');
include('../include/class.mysql.php');
include('../include/config.php');
include('../include/version.php');
include('../include/functions.php');

set_time_limit(0);
ignore_user_abort(true);

if (!isset($_REQUEST['Username'])){ $_REQUEST['Username'] = ''; }
if (!isset($_REQUEST['Password'])){ $_REQUEST['Password'] = ''; }
$_OPERATOR = array();

if (IsAuthorized() == true) {

	switch ($_SERVER['QUERY_STRING']) {
		case 'Login':
			Login();
			break;
		case 'Users':
			Users();
			break;
		case 'Visitors':
			Visitors();
			break;
		case 'Visitor':
			Visitor();
			break;
		case 'Version':
			Version();
			break;
		case 'Settings':
			Settings();
			break;
		case 'InitaliseChat':
			InitaliseChat();
			break;
		case 'Chat':
			Chat();
			break;
		case 'Chats':
			Chats();
			break;
		case 'Operators':
			Operators();
			break;
		case 'Statistics':
			Statistics();
			break;
		case 'History':
			History();
			break;
		case 'Send':
			Send();
			break;
		case 'EmailChat':
			EmailChat();
			break;
		case 'Calls':
			Calls();
			break;
		case 'Responses':
			Responses();
			break;
		default:
			if (strpos(php_sapi_name(), 'cgi') === false ) { header('HTTP/1.0 403 Forbidden'); } else { header('Status: 403 Forbidden'); }
			break;
	}
	
} else {

	switch ($_SERVER['QUERY_STRING']) {
		case 'Version':
			Version();
			break;
		case 'ResetPassword':
			ResetPassword();
			break;
	}
	
	if (strpos(php_sapi_name(), 'cgi') === false ) { header('HTTP/1.0 403 Forbidden'); } else { header('Status: 403 Forbidden'); }
}

exit();


function IsAuthorized() {

	global $_OPERATOR;
	global $SQL;
	global $table_prefix;

	$query = "SELECT `id`, `username`, `password`, `firstname`, `lastname`, `department`, `datetime`, `privilege`, `status` FROM `" . $table_prefix . "users` WHERE `username` LIKE BINARY '" . $_REQUEST['Username'] . "'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$length = strlen($row['password']);
		if ($row['password'] == $_REQUEST['Password']) {
			$_OPERATOR['ID'] = $row['id'];
			$_OPERATOR['USERNAME'] = $_REQUEST['Username'];
			$_OPERATOR['PASSWORD'] = $_REQUEST['Password'];
			$_OPERATOR['NAME'] = $row['firstname'] . ' ' . $row['lastname'];
			$_OPERATOR['DEPARMENT'] = $row['department'];
			$_OPERATOR['DATETIME'] = $row['datetime'];
			$_OPERATOR['PRIVILEGE'] = $row['privilege'];
			$_OPERATOR['STATUS'] = $row['status'];
			return true;
		} else {
			switch ($length) {
				case 40: // SHA1
					$version = '2.0';
					break;
				case 128: // SHA512
					$version = '3.0';
					break;
				default: // MD5
					$version = '1.0';
					break;
			}
			header('X-Authentication: ' . $version);
		}
	}
	return false;
}

function Login() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;
	
	// Automatic Database Upgrade
	$version = Upgrade();

	if (!isset($_SETTINGS['OPERATORVERSION'])){ $_SETTINGS['OPERATORVERSION'] = '3.28'; }
	if (!isset($_REQUEST['Action'])){ $_REQUEST['Action'] = ''; }
	if (!isset($_REQUEST['Device'])){ $_REQUEST['Device'] = ''; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }

	switch ($_REQUEST['Action']) {
		case 'Offline':
			$status = 0;
			break;
		case 'Hidden':
			$status = 0;
			break;
		case 'Online':
			$status = 1;
			break;
		case 'BRB':
			$status = 2;
			break;
		case 'Away':
			$status = 3;
			break;
		default:
			$status = -1;
			break;
	}
	
	if ($status != -1) {
		// Update operator session to database
		$query = "UPDATE " . $table_prefix . "users SET `datetime` = NOW(), `refresh` = NOW(), `status` = '$status'";
		
		// iPhone APNS (PUSH Notifications)
		if ($_REQUEST['Device'] != '') {
			$query .= ", `device` = '" . $_REQUEST['Device'] . "'";
		}
		$query .= " WHERE `id` = '" . $_OPERATOR['ID'] . "'";
		$SQL->miscquery($query);
		
		// Update Operator Status
		$_OPERATOR['STATUS'] = $status;
		
	} else {
		// iPhone APNS (PUSH Notifications)
		if ($_REQUEST['Device'] != '') {
			$query = "UPDATE " . $table_prefix . "users SET `device` = '" . $_REQUEST['Device'] . "' WHERE `id` = '" . $_OPERATOR['ID'] . "'";
			$SQL->miscquery($query);
		}
	}
	
	// Authentication
	$authentication = '1.0';
	if (function_exists('hash')) {
		if (in_array('sha512', hash_algos())) {
			$authentication = '3.0';
		}
		elseif (in_array('sha1', hash_algos())) {
			$authentication = '2.0';
		}
	}

	if ($_REQUEST['Format'] == 'xml') {
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Login xmlns="urn:LiveHelp" ID="<?php echo($_OPERATOR['ID']); ?>" Version="<?php echo($_SETTINGS['OPERATORVERSION']); ?>" Database="<?php echo($version); ?>" Authentication="<?php echo($authentication) ?>" Name="<?php echo(xmlattribinvalidchars($_OPERATOR['NAME'])); ?>" Access="<?php echo($_OPERATOR['PRIVILEGE']); ?>"/>
<?php
	} else {
		header('Content-type: application/json; charset=utf-8');
?>
{"Login": {"ID": <?php echo(json_encode($_OPERATOR['ID'])); ?>, "Version": <?php echo(json_encode($_SETTINGS['OPERATORVERSION'])); ?>, "Database": <?php echo(json_encode($version)); ?>, "Authentication": <?php echo(json_encode($authentication)) ?>, "Name": <?php echo(json_encode($_OPERATOR['NAME'])); ?>, "Access": <?php echo(json_encode($_OPERATOR['PRIVILEGE'])); ?>, "Status": <?php echo(json_encode($_OPERATOR['STATUS'])); ?>} }
<?php
	}

}

function Users() {
	
	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;
	global $connection_timeout;
	
	if (!isset($_REQUEST['Action'])){ $_REQUEST['Action'] = ''; }
	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['Transfer'])){ $_REQUEST['Transfer'] = ''; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }
	
	if (isset($_REQUEST['Device'])) {
		// Update iPhone APNS
		$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `device` = '" . $_REQUEST['Device'] . "' WHERE `id` = '" . $_OPERATOR['ID'] . "'";
		$SQL->miscquery($query);
	} else {
		$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW() WHERE `id` = '" . $_OPERATOR['ID'] . "'";
		$SQL->miscquery($query);
	}
	
	// Check for actions and process
	if ($_REQUEST['Action'] == 'Accept' && $_REQUEST['ID'] != '0') {
	
		// Check if already assigned to a Support operator
		$query = "SELECT `active` FROM " . $table_prefix . "sessions WHERE `id` = '" . $_REQUEST['ID'] . "'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			if ($row['active'] == '0' || $row['active'] == '-2') {
	
				// Update the active flag of the guest user to the ID of their supporter and update the support_user to the username of their supporter
				$query = "UPDATE " . $table_prefix . "sessions SET `active` = '" . $_OPERATOR['ID'] . "' WHERE `id` = '" . $_REQUEST['ID'] . "'";
				$SQL->miscquery($query);
	
			}
		}
	}
	elseif ($_REQUEST['Action'] == 'Close' && $_REQUEST['ID'] != '0') {
	
		// Update active of user to -3 to remove from users panel
		$query = "UPDATE " . $table_prefix . "sessions SET `active` = '-1' WHERE `id` = '" . $_REQUEST['ID'] . "'";
		$SQL->miscquery($query);
		
	}
	elseif ($_REQUEST['Action'] == 'Transfer' && $_REQUEST['ID'] != '0' && $_REQUEST['Transfer'] != '0') {
	
		$query = "UPDATE " . $table_prefix . "sessions SET `datetime` = NOW(), `active`= '-2', `transfer` = '" . $_REQUEST['Transfer'] . "' WHERE `id` = '" . $_REQUEST['ID'] . "'";
		$SQL->miscquery($query);
		
	}
	elseif ($_REQUEST['Action'] == 'Hide' && $_REQUEST['ID'] != '0') {
	
		// Update active of user to -3 to remove from users panel
		$query = "UPDATE " . $table_prefix . "sessions SET `active` = '-3' WHERE `id` = '" . $_REQUEST['ID'] . "'";
		$SQL->miscquery($query);
		
	}
	elseif ($_REQUEST['Action'] == 'Hidden' || $_REQUEST['Action'] == 'Offline') {
	
		if ($_REQUEST['ID'] != '') {
			$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `status` = '0' WHERE `id` = '" . $_REQUEST['ID'] . "'";
		} else {
			$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `status` = '0' WHERE `id` = '" . $_OPERATOR['ID'] . "'";
		}
		$SQL->miscquery($query);
	}
	elseif ($_REQUEST['Action'] == 'Online') {
	
		if ($_REQUEST['ID'] != '') {
			$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `status` = '1' WHERE `id` = '" . $_REQUEST['ID'] . "'";
		} else {
			$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `status` = '1' WHERE `id` = '" . $_OPERATOR['ID'] . "'";
		}
		$SQL->miscquery($query);
	}
	elseif ($_REQUEST['Action'] == 'BRB') {
	
		if ($_REQUEST['ID'] != '') {
			$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `status` = '2' WHERE `id` = '" . $_REQUEST['ID'] . "'";
		} else {
			$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `status` = '2' WHERE `id` = '" . $_OPERATOR['ID'] . "'";
		}
		$SQL->miscquery($query);
	}
	elseif ($_REQUEST['Action'] == 'Away') {
	
		if ($_REQUEST['ID'] != '') {
			$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `status` = '3' WHERE `id` = '" . $_REQUEST['ID'] . "'";
		} else {
			$query = "UPDATE " . $table_prefix . "users SET `refresh` = NOW(), `status` = '3' WHERE `id` = '" . $_OPERATOR['ID'] . "'";
		}
		$SQL->miscquery($query);
	}
	
	$lastcall = '0';
	$query = "SELECT MAX(`id`) FROM " . $table_prefix . "callback";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		if ($row['MAX(`id`)'] != '') {
			$lastcall = $row['MAX(`id`)'];
		}
	}
	
	if ($_REQUEST['Format'] == 'xml') {
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Users xmlns="urn:LiveHelp" LastCall="<?php echo($lastcall); ?>">
<?php
	} else {
		header('Content-type: application/json; charset=utf-8');
?>
{"Users": {
"LastCall": <?php echo(json_encode($lastcall)); ?>
<?php
	}
	
	// ONLINE ADMIN USERS QUERY
	$query = "SELECT `id`, `username`, `status` FROM " . $table_prefix . "users WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND (`status` = '1' OR `status` = '2' OR `status` = '3') ORDER BY `username`";
	$rows = $SQL->selectall($query);
	
	$total_users = count($rows);
	
	if (is_array($rows)) {
		if ($_REQUEST['Format'] == 'xml') {
?>
<Staff>
<?php
		} else {
?>
,"Staff": {
<?php
		}
	
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$id = $row['id'];
				$status = $row['status'];
				$username = $row['username'];
				
				// Count the total NEW messages that have been sent to the current login
				$query = "SELECT max(`id`) FROM " . $table_prefix . "administration WHERE `username` = '$username' AND `user` = '" . $_OPERATOR['ID'] . "' AND (UNIX_TIMESTAMP(`datetime`) - UNIX_TIMESTAMP('" . $_OPERATOR['DATETIME'] . "')) > '0'";
				$row = $SQL->selectquery($query);
				if (is_array($row)) {
					$messages = $row['max(`id`)'];
				}
				
				if ($_REQUEST['Format'] == 'xml') {
?>
<User ID="<?php echo($id); ?>" <?php if ($messages != '') { ?>Messages="<?php echo($messages); ?>" <?php } ?>Status="<?php echo($status); ?>"><?php echo(xmlelementinvalidchars($username)); ?></User>
<?php
				} else {
?>
<?php if ($key == 0) { echo('"User": ['); } ?>{
"ID": <?php echo(json_encode($id)); ?>,
"Name": <?php echo(json_encode($username)); ?>,
<?php if ($messages != '') { ?>"Messages": <?php echo(json_encode($messages)); ?>,<?php } ?>
"Status": <?php echo(json_encode($status)); ?>
}<?php if ($key + 1 < $total_users) { echo(','); } else { echo(']'); } ?>
<?php
				}

			}
		}
		
		if ($_REQUEST['Format'] == 'xml') {
?>
</Staff>
<?php
		} else {
?>
}
<?php
		}

	}
	
	// ONLINE GUEST USERS QUERY
	$query = "SELECT s.id, s.request, s.active, s.username, s.department, s.server, s.email, s.question, u.firstname, u.lastname FROM " . $table_prefix . "sessions AS s, " . $table_prefix . "users AS u WHERE s.active = u.id AND s.refresh > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND s.active > '0' ORDER BY s.username";
	$rows = $SQL->selectall($query);
	
	$total_users = count($rows);
	
	if (is_array($rows)) {
		if ($_REQUEST['Format'] == 'xml') {
?>
<Online>
<?php
		} else {
?>
,"Online": {
<?php
		}
		
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$id = $row['id'];
				$username = $row['username'];
				$request = $row['request'];
				$active = $row['active'];
				
				$department = '';
				if (isset($row['department'])) {
					$department = $row['department'];
				}
				
				$server = '';
				if (isset($row['server'])) {
					$server = $row['server'];
				}
				
				$email = '';
				if (isset($row['email'])) {
					$email = $row['email'];
				}
				
				$question = '';
				if (isset($row['question'])) {
					$question = $row['question'];
				}
				
				if ($_OPERATOR['PRIVILEGE'] <= 1 && $_OPERATOR['ID'] != $active) {
				
					$operator = '';
					if (isset($row['firstname']) && isset($row['lastname'])) {
						$operator = $row['firstname'] . ' ' . $row['lastname'];
					}
					
					if (isset($_REQUEST['Version'])) {
						if ($_REQUEST['Format'] == 'xml') {
?> 
<User ID="<?php echo($id); ?>" Active="<?php echo($active); ?>" Operator="<?php echo($operator); ?>" Visitor="<?php echo($request); ?>" Department="<?php echo(xmlattribinvalidchars($department)); ?>" Server="<?php echo(xmlattribinvalidchars($server)); ?>" Email="<?php echo(xmlattribinvalidchars($email)); ?>" Question="<?php echo(xmlattribinvalidchars($question)); ?>"><?php echo(xmlelementinvalidchars($username)); ?></User>
<?php
						} else {
?>
<?php if ($key == 0) { echo('"User": ['); } ?>{
"ID": <?php echo(json_encode($id)); ?>,
"Name": <?php echo(json_encode($username)); ?>,
"Active": <?php echo(json_encode($active)); ?>,
"Operator": <?php echo(json_encode($operator)); ?>,
"Visitor": <?php echo(json_encode($request)); ?>,
"Department": <?php echo(json_encode($department)); ?>,
"Server": <?php echo(json_encode($server)); ?>,
"Email": <?php echo(json_encode($email)); ?>,
"Question": <?php echo(json_encode($question)); ?>
}<?php if ($key + 1 < $total_users) { echo(','); } else { echo(']'); } ?>
<?php
						}
					}
				}
				else if ($_OPERATOR['ID'] == $active) {
				
					// Count the Total Messages
					$query = "SELECT max(`id`) FROM " . $table_prefix . "messages WHERE `session` = '$id' AND `status` <= '3' AND (UNIX_TIMESTAMP(`datetime`) - UNIX_TIMESTAMP('" . $_OPERATOR['DATETIME'] . "')) > '0'";
					$row = $SQL->selectquery($query);
					if (is_array($row)) {
						$messages = $row['max(`id`)'];
					}

					if ($_REQUEST['Format'] == 'xml') {
?> 
<User ID="<?php echo($id); ?>" Active="<?php echo($active); ?>" Visitor="<?php echo($request); ?>"<?php if ($messages != '') { ?> Messages="<?php echo($messages); ?>"<?php } ?> Department="<?php echo(xmlattribinvalidchars($department)); ?>" Server="<?php echo(xmlattribinvalidchars($server)); ?>" Email="<?php echo(xmlattribinvalidchars($email)); ?>" Question="<?php echo(xmlattribinvalidchars($question)); ?>"><?php echo(xmlelementinvalidchars($username)); ?></User>
<?php
					} else {
?>
<?php if ($key == 0) { echo('"User": ['); } ?>{
"ID": <?php echo(json_encode($id)); ?>,
"Name": <?php echo(json_encode($username)); ?>,
"Active": <?php echo(json_encode($active)); ?>,
"Visitor": <?php echo(json_encode($request)); ?>,
"Messages": <?php echo(json_encode($messages)); ?>,
"Department": <?php echo(json_encode($department)); ?>,
"Server": <?php echo(json_encode($server)); ?>,
"Email": <?php echo(json_encode($email)); ?>,
"Question": <?php echo(json_encode($question)); ?>
}<?php if ($key + 1 < $total_users) { echo(','); } else { echo(']'); } ?>
<?php
					}
				
				}
			}
		}
		
		if ($_REQUEST['Format'] == 'xml') {
?>
</Online>
<?php
		} else {
?>
}
<?php
		}
	}
		
	// PENDING USERS QUERY displays pending users not logged in on users users table depending on department settings
	if ($_SETTINGS['DEPARTMENTS'] == true) {
		$sql = departmentsSQL($_OPERATOR['DEPARMENT']);
		$query = "SELECT DISTINCT `id`, `request`, `username`, `department`, `server`, `email`, `question` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '0' AND $sql ORDER BY `username`";
	}
	else {
		$query = "SELECT DISTINCT `id`, `request`, `username`, `server`, `email`, `question` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '0' ORDER BY `username`";
	}
	$rows = $SQL->selectall($query);
	
	$total_users = count($rows);
	
	if (is_array($rows)) {
		if ($_REQUEST['Format'] == 'xml') {
?>
<Pending>
<?php
		} else {
?>
,"Pending": {
<?php
		}
		
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$id = $row['id'];
				$username = $row['username'];
				$request = $row['request'];
				
				$department = '';
				if (isset($row['department'])) {
					$department = $row['department'];
				}
				
				$server = '';
				if (isset($row['server'])) {
					$server = $row['server'];
				}
				
				$email = '';
				if (isset($row['email'])) {
					$email = $row['email'];
				}
				
				$question = '';
				if (isset($row['question'])) {
					$question = $row['question'];
				}
				
				if ($_REQUEST['Format'] == 'xml') {
?>
<User ID="<?php echo($id); ?>" Visitor="<?php echo($request); ?>" Department="<?php echo(xmlattribinvalidchars($department)); ?>" Server="<?php echo(xmlattribinvalidchars($server)); ?>" Email="<?php echo(xmlattribinvalidchars($email)); ?>" Question="<?php echo(xmlattribinvalidchars($question)); ?>"><?php echo(xmlelementinvalidchars($username)); ?></User>
<?php
				} else {
?>
<?php if ($key == 0) { echo('"User": ['); } ?>{
"ID": <?php echo(json_encode($id)); ?>,
"Name": <?php echo(json_encode($username)); ?>,
"Visitor": <?php echo(json_encode($request)); ?>,
"Department": <?php echo(json_encode($department)); ?>,
"Server": <?php echo(json_encode($server)); ?>,
"Email": <?php echo(json_encode($email)); ?>,
"Question": <?php echo(json_encode($question)); ?>
}<?php if ($key + 1 < $total_users) { echo(','); } else { echo(']'); } ?>
<?php
				}	
			}
		}
		if ($_REQUEST['Format'] == 'xml') {
?>
</Pending>
<?php
		} else {
?>
}
<?php
		}
	}
	
	// TRANFERRED USERS QUERY displays transferred users not logged in on users users table depending on department settings
	$query = "SELECT DISTINCT `id`, `request`, `username`, `department`, `server`, `email`, `question` FROM " . $table_prefix . "sessions WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $connection_timeout SECOND) AND `active` = '-2' AND `transfer` = '" . $_OPERATOR['ID'] . "' ORDER BY `username`";
	$rows = $SQL->selectall($query);
	
	$total_users = count($rows);
	
	if (is_array($rows)) {
		if ($_REQUEST['Format'] == 'xml') {
?>
<Transferred>
<?php
		} else {
?>
,"Transferred": {
<?php
		}
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$id = $row['id'];
				$request = $row['request'];
				$username = $row['username'];
				
				$department = '';
				if (isset($row['department'])) {
					$department = $row['department'];
				}
				
				$server = '';
				if (isset($row['server'])) {
					$server = $row['server'];
				}
				
				$email = '';
				if (isset($row['email'])) {
					$email = $row['email'];
				}
				
				$question = '';
				if (isset($row['question'])) {
					$question = $row['question'];
				}
				
				if ($_REQUEST['Format'] == 'xml') {
?> 
<User ID="<?php echo($id); ?>" Visitor="<?php echo($request); ?>" Department="<?php echo(xmlattribinvalidchars($department)); ?>" Server="<?php echo(xmlattribinvalidchars($server)); ?>" Email="<?php echo(xmlattribinvalidchars($email)); ?>" Question="<?php echo(xmlattribinvalidchars($question)); ?>"><?php echo(xmlelementinvalidchars($username)); ?></User>
<?php
				} else {
?>
<?php if ($key == 0) { echo('"User": ['); } ?>{
"ID": <?php echo(json_encode($id)); ?>,
"Name": <?php echo(json_encode($username)); ?>,
"Visitor": <?php echo(json_encode($request)); ?>,
"Department": <?php echo(json_encode($department)); ?>,
"Server": <?php echo(json_encode($server)); ?>,
"Email": <?php echo(json_encode($email)); ?>,
"Question": <?php echo(json_encode($question)); ?>
}<?php if ($key + 1 < $total_users) { echo(','); } else { echo(']'); } ?>
<?php
				}	
			}
		}

		if ($_REQUEST['Format'] == 'xml') {
?>
</Transferred>
<?php
		} else {
?>
}
<?php
		}
	}
	
	if ($_REQUEST['Format'] == 'xml') {
?>
</Users>
<?php
	} else {
?>
}}
<?php
	}
}

function Visitors() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;
	global $timezonehours;
	global $timezoneminutes;
	global $visitor_timeout;

	if (!isset($_REQUEST['Action'])){ $_REQUEST['Action'] = ''; }
	if (!isset($_REQUEST['Request'])){ $_REQUEST['Request'] = ''; }
	if (!isset($_REQUEST['Record'])){ $_REQUEST['Record'] = ''; }
	if (!isset($_REQUEST['Total'])){ $_REQUEST['Total'] = '6'; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }
	
	if ($_REQUEST['Action'] == 'Initiate' && $_OPERATOR['PRIVILEGE'] < 4) {
	
		if ($_REQUEST['Request'] != '') {
			// Update active field of user to the ID of the operator that initiated support
			$query = "UPDATE " . $table_prefix . "requests SET `initiate` = '" . $_OPERATOR['ID'] . "' WHERE `id` = '" . $_REQUEST['Request'] . "'";
			$SQL->miscquery($query);
		}
		else {
			// Initiate chat request with all visitors
			$query = "UPDATE " . $table_prefix . "requests SET `initiate` = '" . $_OPERATOR['ID'] . "'";
			$SQL->miscquery($query);
		}
	}
	elseif ($_REQUEST['Action'] == 'Remove' && $_OPERATOR['PRIVILEGE'] < 3) {
	
		if ($_REQUEST['Request'] != '') {
			// Update active field of user to the ID of the operator that initiated support
			$query = "UPDATE " . $table_prefix . "requests SET `status` = '1' WHERE `id` = '" . $_REQUEST['Request'] . "'";
			$SQL->miscquery($query);
		}
	}

	$query = "SELECT *, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`datetime`))) AS `sitetime`, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`request`))) AS `pagetime` FROM " . $table_prefix . "requests WHERE `refresh` > DATE_SUB(NOW(), INTERVAL $visitor_timeout SECOND) AND `status` = '0' ORDER BY `id` ASC";
	$rows = $SQL->selectall($query);
	if (is_array($rows)) {
		$last = 0; $total= 0; $pageviews = 0;
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$last = $row['id'];
				$total += 1;
				$pageviews += substr_count($row['path'], '; ') + 1;
			}
		}

		if ($total > 0) {
			while ($total <= $_REQUEST['Record']) {
				$_REQUEST['Record'] = $_REQUEST['Record'] - $_REQUEST['Total'];
			}
		} else {
			$_REQUEST['Record'] = 0;
		}
		
		if ($_REQUEST['Format'] == 'xml') {
			header('Content-type: text/xml; charset=utf-8');
			echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Visitors xmlns="urn:LiveHelp" TotalVisitors="<?php echo($total); ?>" LastVisitor="<?php echo($last); ?>" PageViews="<?php echo($pageviews); ?>">
<?php
		} else {
			header('Content-type: application/json; charset=utf-8');
?>
{"Visitors": {
"TotalVisitors": <?php echo(json_encode($total)); ?>,
"LastVisitor": <?php echo(json_encode($last)); ?>,
"PageViews": <?php echo(json_encode($pageviews)); ?>,
<?php
		}
	
		$initiated_default_label = 'Live Help Request has not been Initiated';
		$initiated_sending_label = 'Sending the Initiate Live Help Request...';
		$initiated_waiting_label = 'Waiting on the Initiate Live Help Reply...';
		$initiated_accepted_label = 'Initiate Live Help Request was ACCEPTED';
		$initiated_declined_label = 'Initiate Live Help Request was DECLINED';
		$initiated_chatting_label = 'Currently chatting to Operator';
		$initiated_chatted_label = 'Already chatted to an Operator';
		$initiated_pending_label = 'Currently Pending for Live Help';
		
		$rating_label = 'Rating';			
		$unavailable_label = 'Unavailable';
		
		$count = count($rows);
		$total = $_REQUEST['Record'] + $_REQUEST['Total'];
		if ($count < $total) { $total_visitors = $count; } else { $total_visitors = $total; }
		
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				if ($key >= $_REQUEST['Record'] && $key < $_REQUEST['Record'] + $_REQUEST['Total']) {
					$current_request_id = $row['id'];
					$current_request_ipaddress = $row['ipaddress'];
					$current_request_user_agent = $row['useragent'];
					$current_request_resolution = $row['resolution'];
					$current_request_country = $row['country'];
					$current_request_current_page = $row['url'];
					$current_request_current_page_title = $row['title'];
					$current_request_referrer = $row['referrer'];
					$current_request_pagetime = $row['pagetime'];
					$current_request_page_path = $row['path'];
					$current_request_sitetime = $row['sitetime'];
					$current_request_initiate = $row['initiate'];

					$paths = explode('; ', $current_request_page_path);
					$total = count($paths);
					if ($total > 20) {
						$current_request_page_path = '';
						for ($i = $total - 20; $i < $total; $i++) {
							$current_request_page_path .= $paths[$i] . '; ';
						}
					}
					
					// Get the supporters name of the chat request if currently chatting.
					$query = "SELECT sessions.id, sessions.username, `firstname`, `lastname`, sessions.department, `rating`, `active` FROM " . $table_prefix . "sessions AS sessions, " . $table_prefix . "users AS users WHERE `active` = users.id AND `request` = '$current_request_id' LIMIT 1";
					$row = $SQL->selectquery($query);
					if (is_array($row)) {
					
						$current_session_id = $row['id'];
						$current_session_username = $row['username'];
						$current_session_firstname = $row['firstname'];
						$current_session_lastname = $row['lastname'];
						$current_session_department = $row['department'];
						$current_session_rating = $row['rating'];
						$current_session_active = $row['active'];
						
						if ($current_session_active == '-1' || $current_session_active == '-3') {
						
							// Display the rating of the ended chat request
							if ($current_session_rating > 0) {
								$current_request_initiate_status = $initiated_chatted_label . ' - ' . $rating_label . ' (' . $current_session_rating . '/5)';
							}
							else {
								$current_request_initiate_status = $initiated_chatted_label;
							}
							
							// Initiate Chat Status
							switch ($current_request_initiate) {
								case 0: // Not Initiated
									break;
								case -1: // Waiting
									$current_request_initiate_status = $initiated_waiting_label;
									break;
								case -2: // Accepted
									$current_request_initiate_status = $initiated_accepted_label;
									break;
								case -3: // Declined
									$current_request_initiate_status = $initiated_declined_label;
									break;
								case -4: // Chatting
									break;
								default: // Sending
									$current_request_initiate_status = $initiated_sending_label;
									break;
							}
						
						}
						else {
							if ($current_session_active > 0) {
								if ($current_session_firstname != '' && $current_session_lastname != '') {
									$current_request_initiate_status = $initiated_chatting_label . ' (' . $current_session_firstname . ' ' . $current_session_lastname . ')';
								}
								else {
									$current_request_initiate_status = $initiated_chatting_label . ' (' . $unavailable_label . ')';
								}
							}
							else {
								if ($current_session_department != '') {
									$current_request_initiate_status = $initiated_pending_label . ' (' . $current_session_department . ')';
								}
								else {
									$current_request_initiate_status = $initiated_pending_label;
								}
							}
						}
					}
					else {
						$current_session_id = 0;
						$current_session_username = '';
						$current_session_active = '';
						
						// Initiate Chat Status
						switch($current_request_initiate) {
							case 0: // Default Status
								$current_request_initiate_status = $initiated_default_label;
								break;
							case -1: // Waiting
								$current_request_initiate_status = $initiated_waiting_label;
								break;
							case -2: // Accepted
								$current_request_initiate_status = $initiated_accepted_label;
								break;
							case -3: // Declined
								$current_request_initiate_status = $initiated_declined_label;
								break;
							default: // Sending
								$current_request_initiate_status = $initiated_sending_label;
								break;
						}
	
					}
					
					if ($current_request_current_page == '') {
						$current_request_current_page = $unavailable_label;
					}
					
					// Set the referrer as approriate
					if ($current_request_referrer != '' && $current_request_referrer != 'false') {
						$current_request_referrer_result = urldecode($current_request_referrer);
					}
					elseif ($current_request_referrer == false) {
						$current_request_referrer_result = 'Direct Visit / Bookmark';
					}
					else {
						$current_request_referrer_result = $unavailable_label;
					}
					
					if ($_SETTINGS['LIMITHISTORY'] > 0) {
						$history = explode(';', $current_request_page_path);
						$path = array();
						if (count($history) > $_SETTINGS['LIMITHISTORY']) {
							for($i = 0; $i < $_SETTINGS['LIMITHISTORY']; $i++) {
									array_unshift($path, array_pop($history));
							}
							$current_request_page_path = implode('; ', $path);
						}
					}
					
					if ($_REQUEST['Format'] == 'xml') {
?>
<Visitor ID="<?php echo($current_request_id); ?>" Session="<?php echo($current_session_id); ?>" Active="<?php echo($current_session_active); ?>" Username="<?php echo(xmlattribinvalidchars($current_session_username)); ?>">
<Hostname><?php echo(xmlelementinvalidchars($current_request_ipaddress)); ?></Hostname>
<Country><?php echo($current_request_country); ?></Country>
<UserAgent><?php echo(xmlelementinvalidchars($current_request_user_agent)); ?></UserAgent>
<Resolution><?php echo(xmlelementinvalidchars($current_request_resolution)); ?></Resolution>
<CurrentPage><?php echo(xmlelementinvalidchars($current_request_current_page)); ?></CurrentPage>
<CurrentPageTitle><?php echo(xmlelementinvalidchars($current_request_current_page_title)); ?></CurrentPageTitle>
<Referrer><?php echo(xmlelementinvalidchars($current_request_referrer_result)); ?></Referrer>
<TimeOnPage><?php echo($current_request_pagetime); ?></TimeOnPage>
<ChatStatus><?php echo(xmlelementinvalidchars($current_request_initiate_status)); ?></ChatStatus>
<PagePath><?php echo(xmlelementinvalidchars($current_request_page_path)); ?></PagePath>
<TimeOnSite><?php echo($current_request_sitetime); ?></TimeOnSite>
</Visitor>
<?php
					} else {
?>
<?php if ($key == 0) { echo('"Visitor": ['); } ?>
{
"ID": <?php echo(json_encode($current_request_id)); ?>,
"Active": <?php echo(json_encode($current_session_id)); ?>,
"Username": <?php echo(json_encode($current_session_username)); ?>,
"Hostname": <?php echo(json_encode($current_request_ipaddress)); ?>,
"Country": <?php echo(json_encode($current_request_country)); ?>,
"UserAgent": <?php echo(json_encode($current_request_user_agent)); ?>,
"Resolution": <?php echo(json_encode($current_request_resolution)); ?>,
"CurrentPage": <?php echo(json_encode($current_request_current_page)); ?>,
"CurrentPageTitle": <?php echo(json_encode($current_request_current_page_title)); ?>,
"Referrer": <?php echo(json_encode($current_request_referrer_result)); ?>,
"TimeOnPage": <?php echo(json_encode($current_request_pagetime)); ?>,
"ChatStatus": <?php echo(json_encode($current_request_initiate_status)); ?>,
"PagePath": <?php echo(json_encode($current_request_page_path)); ?>,
"TimeOnSite": <?php echo(json_encode($current_request_sitetime)); ?>
}<?php if ($key + 1 < $total_visitors) { echo(','); } else { echo(']'); } ?>
<?php
					}
				}
			}
		}
		
		if ($_REQUEST['Format'] == 'xml') {
?>
</Visitors>
<?php
		} else {
?>
}}
<?php
		}
	}
	else {
		if ($_REQUEST['Format'] == 'xml') {
			header('Content-type: text/xml; charset=utf-8');
			echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Visitors xmlns="urn:LiveHelp"/>
<?php
		} else {
			header('Content-type: application/json; charset=utf-8');
?>
{"Visitors": null}
<?php
		}
	}
}

function Visitor() {

	global $_OPERATOR;
	global $SQL;
	global $table_prefix;

	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	
	$query = "SELECT *, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`datetime`))) AS `sitetime`, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`request`))) AS `pagetime` FROM " . $table_prefix . "requests WHERE `id` = '" . $_REQUEST['ID'] . "' LIMIT 1";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		
		$initiated_default_label = 'Live Help Request has not been Initiated';
		$initiated_sending_label = 'Sending the Initiate Live Help Request...';
		$initiated_waiting_label = 'Waiting on the Initiate Live Help Reply...';
		$initiated_accepted_label = 'Initiate Live Help Request was ACCEPTED';
		$initiated_declined_label = 'Initiate Live Help Request was DECLINED';
		$initiated_chatting_label = 'Currently chatting to Operator';
		$initiated_chatted_label = 'Already chatted to an Operator';
		$initiated_pending_label = 'Currently Pending for Live Help';
		
		$rating_label = 'Rating';			
		$unavailable_label = 'Unavailable';
		
		if (is_array($row)) {
			$current_request_id = $row['id'];
			$current_request_ipaddress = $row['ipaddress'];
			$current_request_user_agent = $row['useragent'];
			$current_request_resolution = $row['resolution'];
			$current_request_country = $row['country'];
			$current_request_current_page = $row['url'];
			$current_request_current_page_title = $row['title'];
			$current_request_referrer = $row['referrer'];
			$current_request_pagetime = $row['pagetime'];
			$current_request_page_path = $row['path'];
			$current_request_sitetime = $row['sitetime'];
			$current_request_initiate = $row['initiate'];
			
			// Get the supporters name of the chat request if currently chatting.
			$query = "SELECT sessions.id, sessions.username, `firstname`, `lastname`, sessions.department, `rating`, `active` FROM " . $table_prefix . "sessions AS sessions, " . $table_prefix . "users AS users WHERE `active` = users.id AND `request` = '$current_request_id' LIMIT 1";
			$row = $SQL->selectquery($query);
			if (is_array($row)) {
			
				$current_session_id = $row['id'];
				$current_session_username = $row['username'];
				$current_session_firstname = $row['firstname'];
				$current_session_lastname = $row['lastname'];
				$current_session_department = $row['department'];
				$current_session_rating = $row['rating'];
				$current_session_active = $row['active'];
				
				if ($current_session_active == '-1' || $current_session_active == '-3') {
				
					// Display the rating of the ended chat request
					if ($current_session_rating > 0) {
						$current_request_initiate_status = $initiated_chatted_label . ' - ' . $rating_label . ' (' . $current_session_rating . '/5)';
					}
					else {
						$current_request_initiate_status = $initiated_chatted_label;
					}
					
					// Initiate Chat Status
					switch ($current_request_initiate) {
						case 0: // Not Initiated
							break;
						case -1: // Waiting
							$current_request_initiate_status = $initiated_waiting_label;
							break;
						case -2: // Accepted
							$current_request_initiate_status = $initiated_accepted_label;
							break;
						case -3: // Declined
							$current_request_initiate_status = $initiated_declined_label;
							break;
						case -4: // Chatting
							break;
						default: // Sending
							$current_request_initiate_status = $initiated_sending_label;
							break;
					}
				
				}
				else {
					if ($current_session_active > 0) {
						if ($current_session_firstname != '' && $current_session_lastname != '') {
							$current_request_initiate_status = $initiated_chatting_label . ' (' . $current_session_firstname . ' ' . $current_session_lastname . ')';
						}
						else {
							$current_request_initiate_status = $initiated_chatting_label . ' (' . $unavailable_label . ')';
						}
					}
					else {
						if ($current_session_department != '') {
							$current_request_initiate_status = $initiated_pending_label . ' (' . $current_session_department . ')';
						}
						else {
							$current_request_initiate_status = $initiated_pending_label;
						}
					}
				}
			}
			else {
				$current_session_id = 0;
				$current_session_username = '';
				$current_session_active = '';
				
				// Initiate Chat Status
				switch($current_request_initiate) {
					case 0: // Default Status
						$current_request_initiate_status = $initiated_default_label;
						break;
					case -1: // Waiting
						$current_request_initiate_status = $initiated_waiting_label;
						break;
					case -2: // Accepted
						$current_request_initiate_status = $initiated_accepted_label;
						break;
					case -3: // Declined
						$current_request_initiate_status = $initiated_declined_label;
						break;
					default: // Sending
						$current_request_initiate_status = $initiated_sending_label;
						break;
				}

			}
			
			if ($current_request_current_page == '') {
				$current_request_current_page = $unavailable_label;
			}
			
			// Set the referrer as approriate
			if ($current_request_referrer != '' && $current_request_referrer != 'false') {
				$current_request_referrer_result = urldecode($current_request_referrer);
			}
			elseif ($current_request_referrer == false) {
				$current_request_referrer_result = 'Direct Visit / Bookmark';
			}
			else {
				$current_request_referrer_result = $unavailable_label;
			}
			
			header('Content-type: text/xml; charset=utf-8');
			echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Visitor xmlns="urn:LiveHelp" ID="<?php echo($current_request_id); ?>" Session="<?php echo($current_session_id); ?>" Active="<?php echo($current_session_active); ?>" Username="<?php echo(xmlattribinvalidchars($current_session_username)); ?>">
<Hostname><?php echo(xmlelementinvalidchars($current_request_ipaddress)); ?></Hostname>
<Country><?php echo($current_request_country); ?></Country>
<UserAgent><?php echo(xmlelementinvalidchars($current_request_user_agent)); ?></UserAgent>
<Resolution><?php echo(xmlelementinvalidchars($current_request_resolution)); ?></Resolution>
<CurrentPage><?php echo(xmlelementinvalidchars($current_request_current_page)); ?></CurrentPage>
<CurrentPageTitle><?php echo(xmlelementinvalidchars($current_request_current_page_title)); ?></CurrentPageTitle>
<Referrer><?php echo(xmlelementinvalidchars($current_request_referrer_result)); ?></Referrer>
<TimeOnPage><?php echo($current_request_pagetime); ?></TimeOnPage>
<ChatStatus><?php echo(xmlelementinvalidchars($current_request_initiate_status)); ?></ChatStatus>
<PagePath><?php echo(xmlelementinvalidchars($current_request_page_path)); ?></PagePath>
<TimeOnSite><?php echo($current_request_sitetime); ?></TimeOnSite>
</Visitor>
<?php
		}
	}
	else {
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Visitor xmlns="urn:LiveHelp"/>
<?php
	}
}

function Version() {

	global $_OPERATOR;
	global $SQL;
	global $table_prefix;
	global $windows_application_version;

	if (!isset($_REQUEST['Windows'])){ $_REQUEST['Windows'] = ''; }
	if ($_REQUEST['Windows'] == $windows_application_version) { $result = 'true'; } else { $result = 'false'; }
	
	header('Content-type: text/xml; charset=utf-8');
	echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Version xmlns="urn:LiveHelp" Web="" Windows="<?php echo($result); ?>"/>
<?php

	exit();
}

function Settings() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;
	global $head;
	global $body;
	global $image;
	
	if (!isset($_REQUEST['Cached'])){ $_REQUEST['Cached'] = ''; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }

	// Save Settings if authorized
	if ($_OPERATOR['PRIVILEGE'] < 2) {
	
		// Update Settings
		$updated = false;
		foreach ($_REQUEST as $key => $value) {
			// Valid Setting
			if (array_key_exists(strtoupper($key), $_SETTINGS)) { 
				$query = "UPDATE " . $table_prefix . "settings SET `value` = '$value' WHERE `name` = '$key'";
				$SQL->miscquery($query);
				$updated = true;
			}
		}
		
		// Last Updated
		if ($updated == true) {
			$query = "UPDATE " . $table_prefix . "settings SET `value` = NOW() WHERE `name` = 'LastUpdated'";
			$SQL->miscquery($query);
		}
		
		$query = "SELECT `name`, `value` FROM " . $table_prefix . "settings";
		$row = $SQL->selectquery($query);
		$_SETTINGS = array();
		while ($row) {
			if (is_array($row)) {
				$_SETTINGS[strtoupper($row['name'])] = $row['value'];
			}
			$row = $SQL->selectnext();
		}
	}
	
	// Time zone Setting
	$_SETTINGS['DEFAULTTIMEZONE'] = date('Z');
	
	// Check available language packs
	$languages = file('../locale/i18n.txt');
	$available_languages = '';
	foreach ($languages as $key => $line) {
		$i18n = split(',', $line);
		$code = trim($i18n[0]);
		$available = file_exists('../locale/' . $code . '/guest.php');
		if ($available) {
			if ($available_languages == '') {
				$available_languages .= $code;
			}
			else {
				$available_languages .=  ', ' . $code;
			}
		}
	}
	
	if ($_REQUEST['Format'] == 'xml') {
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Settings xmlns="urn:LiveHelp">
<Domain><?php echo(xmlelementinvalidchars($_SETTINGS['DOMAIN'])); ?></Domain>
<SiteAddress><?php echo(xmlelementinvalidchars($_SETTINGS['URL'])); ?></SiteAddress>
<Email><?php echo(xmlelementinvalidchars($_SETTINGS['EMAIL'])); ?></Email>
<Name><?php echo(xmlelementinvalidchars($_SETTINGS['NAME'])); ?></Name>
<Logo><?php echo(xmlelementinvalidchars($_SETTINGS['LOGO'])); ?></Logo>
<WelcomeMessage><?php echo(xmlelementinvalidchars($_SETTINGS['INTRODUCTION'])); ?></WelcomeMessage>
<?php 
	if (isset($_REQUEST['Version']) && $_REQUEST['Version'] >= 3.5) { 
?>
<Smilies Enabled="<?php echo($_SETTINGS['SMILIES']); ?>"/>
<?php
	} else {
		if (!isset($_SETTINGS['GUESTSMILIES'])) { $_SETTINGS['GUESTSMILIES'] = '-1'; }
		if (!isset($_SETTINGS['OPERATORSMILIES'])) { $_SETTINGS['OPERATORSMILIES'] = '-1'; }
?>
<Smilies Guest="<?php echo($_SETTINGS['GUESTSMILIES']); ?>" Operator="<?php echo($_SETTINGS['OPERATORSMILIES']); ?>"/>
<?php
	}
?>
<Font Size="<?php echo(xmlattribinvalidchars($_SETTINGS['FONTSIZE'])); ?>" Color="<?php echo(xmlattribinvalidchars($_SETTINGS['FONTCOLOR'])); ?>" LinkColor="<?php echo(xmlattribinvalidchars($_SETTINGS['LINKCOLOR'])); ?>"><?php echo(xmlattribinvalidchars($_SETTINGS['FONT'])); ?></Font>
<ChatFont Size="<?php echo(xmlattribinvalidchars($_SETTINGS['CHATFONTSIZE'])); ?>" SentColor="<?php echo(xmlattribinvalidchars($_SETTINGS['SENTFONTCOLOR'])); ?>" ReceivedColor="<?php echo(xmlattribinvalidchars($_SETTINGS['RECEIVEDFONTCOLOR'])); ?>"><?php echo(xmlelementinvalidchars($_SETTINGS['CHATFONT'])); ?></ChatFont>
<BackgroundColor><?php echo(xmlelementinvalidchars($_SETTINGS['BACKGROUNDCOLOR'])); ?></BackgroundColor>
<OnlineLogo><?php echo(xmlelementinvalidchars($_SETTINGS['ONLINELOGO'])); ?></OnlineLogo>
<OfflineLogo><?php echo(xmlelementinvalidchars($_SETTINGS['OFFLINELOGO'])); ?></OfflineLogo>
<OfflineEmailLogo><?php echo(xmlelementinvalidchars($_SETTINGS['OFFLINEEMAILLOGO'])); ?></OfflineEmailLogo>
<BeRightBackLogo><?php echo(xmlelementinvalidchars($_SETTINGS['BERIGHTBACKLOGO'])); ?></BeRightBackLogo>
<AwayLogo><?php echo(xmlelementinvalidchars($_SETTINGS['AWAYLOGO'])); ?></AwayLogo>
<LoginDetails Enabled="<?php echo($_SETTINGS['LOGINDETAILS']); ?>" Required="<?php echo(xmlattribinvalidchars($_SETTINGS['REQUIREGUESTDETAILS'])); ?>" Email="<?php echo($_SETTINGS['LOGINEMAIL']); ?>" Question="<?php echo($_SETTINGS['LOGINQUESTION']); ?>"/>
<OfflineEmail Enabled="<?php echo($_SETTINGS['OFFLINEEMAIL']); ?>" Redirect="<?php echo(xmlattribinvalidchars($_SETTINGS['OFFLINEEMAILREDIRECT'])); ?>"><?php echo(xmlelementinvalidchars($_SETTINGS['OFFLINEEMAIL'])); ?></OfflineEmail>
<SecurityCode Enabled="<?php echo($_SETTINGS['SECURITYCODE']); ?>"/>
<Departments Enabled="<?php echo($_SETTINGS['DEPARTMENTS']); ?>"/>
<VisitorTracking Enabled="<?php echo($_SETTINGS['VISITORTRACKING']); ?>"/>
<Timezone Server="<?php echo($_SETTINGS['DEFAULTTIMEZONE']); ?>"><?php echo(xmlelementinvalidchars($_SETTINGS['TIMEZONE'])); ?></Timezone>
<Language Available="<?php echo(xmlattribinvalidchars($available_languages)); ?>"><?php echo(xmlelementinvalidchars($_SETTINGS['LOCALE'])); ?></Language>
<InitiateChat Vertical="<?php echo(xmlattribinvalidchars($_SETTINGS['INITIATECHATVERTICAL'])); ?>" Horizontal="<?php echo(xmlattribinvalidchars($_SETTINGS['INITIATECHATHORIZONTAL'])); ?>" Auto="<?php echo($_SETTINGS['INITIATECHATAUTO']); ?>"/>
<ChatUsername Enabled="<?php echo($_SETTINGS['CHATUSERNAME']); ?>"/>
<Campaign Link="<?php echo(xmlattribinvalidchars($_SETTINGS['CAMPAIGNLINK'])); ?>"><?php echo(xmlelementinvalidchars($_SETTINGS['CAMPAIGNIMAGE'])); ?></Campaign>
<IP2Country Enabled="<?php echo($_SETTINGS['IP2COUNTRY']); ?>"/>
<P3P><?php echo(xmlelementinvalidchars($_SETTINGS['P3P'])); ?></P3P>
<ChatWindowSize Width="<?php echo($_SETTINGS['CHATWINDOWWIDTH']); ?>" Height="<?php echo($_SETTINGS['CHATWINDOWHEIGHT']); ?>"/>
<?php
	if (!isset($_REQUEST['Version'])) {
		if (!isset($_SETTINGS['SMTP'])) { $_SETTINGS['SMTP'] = '-1'; }
		if (!isset($_SETTINGS['SMTPPORT'])) { $_SETTINGS['SMTPPORT'] = '25'; }
?>
<SMTP Enabled="<?php echo($_SETTINGS['SMTP']); ?>">
<Server Port="<?php echo(xmlattribinvalidchars($_SETTINGS['SMTPPORT'])); ?>"><?php echo(xmlattribinvalidchars($_SETTINGS['SMTPSERVER'])); ?></Server>
<Email><?php echo(xmlelementinvalidchars($_SETTINGS['SMTPEMAIL'])); ?></Email>
</SMTP>
<?php
	}
?>
<Code>
<Head><![CDATA[<?php echo($head); ?>]]></Head>
<Body><![CDATA[<?php echo($body); ?>]]></Body>
<Image><![CDATA[<?php echo($image); ?>]]></Image>
</Code>
</Settings>
<?php
	} else {
		
		if ($_REQUEST['Cached'] != '') { 
			$updated = strtotime($_SETTINGS['LASTUPDATED']);
			$cached = strtotime($_REQUEST['Cached']);
			if ($updated - $cached <= 0) {
				if (strpos(php_sapi_name(), 'cgi') === false ) { header('HTTP/1.0 304 Not Modified'); } else { header('Status: 304 Not Modified'); }
				exit();
			}
		}
		
		header('Content-type: application/json; charset=utf-8');
?>
{"Settings": {
"Domain": <?php echo(json_encode($_SETTINGS['DOMAIN'])); ?>,
"SiteAddress": <?php echo(json_encode($_SETTINGS['URL'])); ?>,
"Email": <?php echo(json_encode($_SETTINGS['EMAIL'])); ?>,
"Name": <?php echo(json_encode($_SETTINGS['NAME'])); ?>,
"Logo": <?php echo(json_encode($_SETTINGS['LOGO'])); ?>,
"WelcomeMessage": <?php echo(json_encode($_SETTINGS['INTRODUCTION'])); ?>,
"Smilies": <?php echo(json_encode($_SETTINGS['SMILIES'])); ?>,
"Font": { "Type": <?php echo(json_encode($_SETTINGS['FONT'])); ?>, "Size": <?php echo(json_encode($_SETTINGS['FONTSIZE'])); ?>, "Color": <?php echo(json_encode($_SETTINGS['FONTCOLOR'])); ?>, "LinkColor": <?php echo(json_encode($_SETTINGS['LINKCOLOR'])); ?> },
"ChatFont": { "Type": <?php echo(json_encode($_SETTINGS['CHATFONT'])); ?>, "Size": <?php echo(json_encode($_SETTINGS['CHATFONTSIZE'])); ?>, "SentColor": <?php echo(json_encode($_SETTINGS['SENTFONTCOLOR'])); ?>, "ReceivedColor": <?php echo(json_encode($_SETTINGS['RECEIVEDFONTCOLOR'])); ?> },
"BackgroundColor": <?php echo(json_encode($_SETTINGS['BACKGROUNDCOLOR'])); ?>,
"OnlineLogo": <?php echo(json_encode($_SETTINGS['ONLINELOGO'])); ?>,
"OfflineLogo": <?php echo(json_encode($_SETTINGS['OFFLINELOGO'])); ?>,
"OfflineEmailLogo": <?php echo(json_encode($_SETTINGS['OFFLINEEMAILLOGO'])); ?>,
"BeRightBackLogo": <?php echo(json_encode($_SETTINGS['BERIGHTBACKLOGO'])); ?>,
"AwayLogo": <?php echo(json_encode($_SETTINGS['AWAYLOGO'])); ?>,
"LogoDetails": { "Enabled": <?php echo(json_encode($_SETTINGS['LOGINDETAILS'])); ?>, "Required": <?php echo(json_encode($_SETTINGS['REQUIREGUESTDETAILS'])); ?>, "Email": <?php echo(json_encode($_SETTINGS['LOGINEMAIL'])); ?>, "Question": <?php echo(json_encode($_SETTINGS['LOGINQUESTION'])); ?> },
"OfflineEmail": { "Enabled": <?php echo(json_encode($_SETTINGS['OFFLINEEMAIL'])); ?>, "Redirect": <?php echo(json_encode($_SETTINGS['OFFLINEEMAILREDIRECT'])); ?>, "Email": <?php echo(json_encode($_SETTINGS['OFFLINEEMAIL'])); ?> },
"SecurityCode": <?php echo(json_encode($_SETTINGS['SECURITYCODE'])); ?>,
"Departments": <?php echo(json_encode($_SETTINGS['DEPARTMENTS'])); ?>,
"VisitorTracking": <?php echo(json_encode($_SETTINGS['VISITORTRACKING'])); ?>,
"Timezone": { "Offset": <?php echo(json_encode($_SETTINGS['DEFAULTTIMEZONE'])); ?>, "Server": <?php echo(json_encode($_SETTINGS['TIMEZONE'])); ?> },
"Language": { "Available": <?php echo(json_encode($available_languages)); ?>, "Locale": <?php echo(json_encode($_SETTINGS['LOCALE'])); ?> },
"InitiateChat": { "Vertical": <?php echo(json_encode($_SETTINGS['INITIATECHATVERTICAL'])); ?>, "Horizontal": <?php echo(json_encode($_SETTINGS['INITIATECHATHORIZONTAL'])); ?>, "Auto": <?php echo(json_encode($_SETTINGS['INITIATECHATAUTO'])); ?> },
"ChatUsername": <?php echo(json_encode($_SETTINGS['CHATUSERNAME'])); ?>,
"Campaign": { "Link": <?php echo(json_encode($_SETTINGS['CAMPAIGNLINK'])); ?>, "Image": <?php echo(json_encode($_SETTINGS['CAMPAIGNIMAGE'])); ?> },
"IP2Country": <?php echo(json_encode($_SETTINGS['IP2COUNTRY'])); ?>,
"P3P": <?php echo(json_encode($_SETTINGS['P3P'])); ?>,
"ChatWindowSize": { "Width": <?php echo(json_encode($_SETTINGS['CHATWINDOWWIDTH'])); ?>, "Height": <?php echo(json_encode($_SETTINGS['CHATWINDOWHEIGHT'])); ?> },
"LastUpdated": <?php echo(json_encode($_SETTINGS['LASTUPDATED'])); ?>,
<?php
	if (!isset($_REQUEST['Version'])) {
		if (!isset($_SETTINGS['SMTP'])) { $_SETTINGS['SMTP'] = '-1'; }
		if (!isset($_SETTINGS['SMTPPORT'])) { $_SETTINGS['SMTPPORT'] = '25'; }
?>
"SMTP": { "Enabled": <?php echo(json_encode($_SETTINGS['SMTP'])); ?>, "Server": <?php echo(json_encode($_SETTINGS['SMTPSERVER'])); ?>, "Port": <?php echo(json_encode($_SETTINGS['SMTPPORT'])); ?>, "Email": <?php echo(json_encode($_SETTINGS['SMTPEMAIL'])); ?> },
<?php
	}
?>
"Code": { "Head": <?php echo(json_encode($head)); ?>, "Body": <?php echo(json_encode($body)); ?>, "Image": <?php echo(json_encode($image)); ?> }
} }
<?php
	}

}

function InitaliseChat() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;

	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['Message'])){ $_REQUEST['Message'] = ''; }

	$query = "SELECT `email`, `question`, `server`, `department`, `typing`, `active` FROM " . $table_prefix . "sessions WHERE `id` = '" . $_REQUEST['ID'] . "'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$email = $row['email'];
		$question = $row['question'];
		$server = $row['server'];
		$department = $row['department'];
		$typing = $row['typing'];
		$active = $row['active'];
	}

	$query = "SELECT `id`, `session`, `username`, `message`, `align`, `status` FROM " . $table_prefix . "messages WHERE `session` = '" . $_REQUEST['ID'] . "' AND `status` <= '3' AND `id` > '" . $_REQUEST['Message'] . "' ORDER BY `datetime`";
	$rows = $SQL->selectall($query);
	if (is_array($rows)) {
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$message = $row['id']; 
			}
		}
	}
	else {
		$message = '';
	}
	
	header('Content-type: text/xml; charset=utf-8');
	echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Messages xmlns="urn:LiveHelp" ID="<?php echo($_REQUEST['ID']); ?>" Status="<?php echo($active); ?>" Email="<?php echo(xmlattribinvalidchars($email)); ?>" Server="<?php echo(xmlattribinvalidchars($server)); ?>" Department="<?php echo(xmlattribinvalidchars($department)); ?>" Question="<?php echo(xmlattribinvalidchars($question)); ?>">
<?php
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
			$id = $row['id'];
			$session = $row['session']; 
			$username = $row['username'];
			$message = $row['message'];
			$align = $row['align'];
			$status = $row['status'];
			
			// Outputs sent message
			if ($status) {
?>
<Message ID="<?php echo($id); ?>" Align="<?php echo($align); ?>" Status="<?php echo($status); ?>" Username="<?php echo(xmlattribinvalidchars($username)); ?>"><?php echo(xmlelementinvalidchars($message)); ?></Message>
<?php
			} else {	// Outputs received message
?>
<Message ID="<?php echo($id); ?>" Align="<?php echo($align); ?>" Status="<?php echo($status); ?>" Username="<?php echo(xmlattribinvalidchars($username)) ?>"><?php echo(xmlelementinvalidchars($message)); ?></Message>
<?php
			}
		}
	}
}
?>
</Messages>
<?php

}

function Chat() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;

	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['Message'])){ $_REQUEST['Message'] = ''; }
	if (!isset($_REQUEST['Staff'])){ $_REQUEST['Staff'] = ''; }
	if (!isset($_REQUEST['Typing'])){ $_REQUEST['Typing'] = ''; }

	if (!$_REQUEST['Staff']) {
		$query = "SELECT `active`, `typing` FROM " . $table_prefix . "sessions WHERE `id` = '" . $_REQUEST['ID'] . "'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$active = $row['active'];
			$typing = $row['typing'];
			
			if ($_REQUEST['Typing']) { // Currently Typing
				switch($typing) {
				case 0: // None
					$typingresult = 2;
					break;
				case 1: // Guest Only
					$typingresult = 3;
					break;
				case 2: // Operator Only
					$typingresult = 2;
					break;
				case 3: // Both
					$typingresult = 3;
					break;		
				}
			}
			else { // Not Currently Typing
				switch($typing) {
				case 0: // None
					$typingresult = 0;
					break;
				case 1: // Guest Only
					$typingresult = 1;
					break;
				case 2: // Operator Only
					$typingresult = 0;
					break;
				case 3: // Both
					$typingresult = 1;
					break;		
				}
			}
				
			// Update the typing status of the specified chatting visitor
			$query = "UPDATE " . $table_prefix . "sessions SET `typing` = '$typingresult' WHERE `id` = '" . $_REQUEST['ID'] . "'";
			$SQL->miscquery($query);
		}
	}
	else {
		$active = '-1';
		$typingresult = '0';
	}
	
	if ($_REQUEST['Staff']) {
		$query = "SELECT `username` FROM " . $table_prefix . "users WHERE `id` = '" . $_REQUEST['ID'] . "'";
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			$operator_username = $row['username'];
		}
		$query = "SELECT `id`, `user`, `username`, `message`, `align`, `status` FROM " . $table_prefix . "administration WHERE ((`user` = '" . $_REQUEST['ID'] . "' AND `username` = '" . $_OPERATOR['USERNAME'] . "') OR (`user` = '" . $_OPERATOR['ID'] . "' AND `username` = '$operator_username')) AND `status` <= '3' AND `id` > '" . $_REQUEST['Message'] . "' AND (UNIX_TIMESTAMP(`datetime`) - UNIX_TIMESTAMP('" . $_OPERATOR['DATETIME'] . "')) > '0' ORDER BY `datetime`";
	}
	else {
		$query = "SELECT `id`, `session`, `username`, `message`, `align`, `status` FROM " . $table_prefix . "messages WHERE `session` = '" . $_REQUEST['ID'] . "' AND `status` <= '3' AND `id` > '" . $_REQUEST['Message'] . "' ORDER BY `datetime`";
	}
	$rows = $SQL->selectall($query);
	if (is_array($rows)) {
		foreach ($rows as $key => $row) {
			if (is_array($row)) {
				$message = $row['id']; 
			}
		}
	}
	else {
		$message = '';
	}
	
	header('Content-type: text/xml; charset=utf-8');
	echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Messages xmlns="urn:LiveHelp" ID="<?php echo($_REQUEST['ID']); ?>" Typing="<?php echo($typingresult); ?>" Status="<?php echo($active); ?>" ChatType="<?php echo($_REQUEST['Staff']); ?>">
<?php
if (is_array($rows)) {
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
			if ($_REQUEST['Staff']) {
				$session = $row['user'];
			}
			else {
				$session = $row['session']; 
			}
			$id = $row['id'];
			$username = $row['username'];
			$message = $row['message'];
			$align = $row['align'];
			$status = $row['status'];
			
			// Outputs sent message
			if ((!$_REQUEST['Staff'] && $status) || ($_REQUEST['Staff'] && $session == $_REQUEST['ID'] && $row['username'] == $_OPERATOR['USERNAME'])) {
?>
<Message ID="<?php echo($id); ?>" Align="<?php echo($align); ?>" Status="<?php echo($status); ?>" Username="<?php echo(xmlattribinvalidchars($username)); ?>"><?php echo(xmlelementinvalidchars($message)); ?></Message>
<?php
			}
			// Outputs received message
			if ((!$_REQUEST['Staff'] && !$status) || ($_REQUEST['Staff'] && $session == $_OPERATOR['ID'] && $row['username'] == $operator_username)) {
?>
<Message ID="<?php echo($id); ?>" Align="<?php echo($align); ?>" Status="<?php echo($status); ?>" Username="<?php echo(xmlattribinvalidchars($username)) ?>"><?php echo(xmlelementinvalidchars($message)); ?></Message>
<?php
			}
		}
	}
}
?>
</Messages>
<?php

}

function Chats() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;

	if (!isset($_REQUEST['Data'])){ $_REQUEST['Data'] = ''; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }
	
	if ($_REQUEST['Data'] == '') {
?>
<MultipleMessages xmlns="urn:LiveHelp"/>
<?php
		exit();
	}
	
	$chats = explode('|', $_REQUEST['Data']);
	if (is_array($chats)) {
		
		if ($_REQUEST['Format'] == 'xml') {
			header('Content-type: text/xml; charset=utf-8');
			echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<MultipleMessages xmlns="urn:LiveHelp">
<?php
		}
		else {
?>
{"MultipleMessages": 
<?php
		}
		
		$total_chats = count($chats);
		
		foreach ($chats as $chatkey => $chat) {
			list($id, $typingstatus, $staff, $message) = explode(',', $chat);
			
			$introduction = false;
			if ($message < 0) { $introduction = true; }
			
			if (!$staff) {
				$query = "SELECT `username`, `active`, `typing` FROM " . $table_prefix . "sessions WHERE `id` = '$id'";
				$row = $SQL->selectquery($query);
				if (is_array($row)) {
					$guest_username = $row['username'];
					$active = $row['active'];
					$typing = $row['typing'];
					
					if ($typingstatus) { // Currently Typing
						switch($typing) {
						case 0: // None
							$typingresult = 2;
							break;
						case 1: // Guest Only
							$typingresult = 3;
							break;
						case 2: // Operator Only
							$typingresult = 2;
							break;
						case 3: // Both
							$typingresult = 3;
							break;		
						}
					}
					else { // Not Currently Typing
						switch($typing) {
						case 0: // None
							$typingresult = 0;
							break;
						case 1: // Guest Only
							$typingresult = 1;
							break;
						case 2: // Operator Only
							$typingresult = 0;
							break;
						case 3: // Both
							$typingresult = 1;
							break;		
						}
					}
						
					// Update the typing status of the specified chatting visitor
					$query = "UPDATE " . $table_prefix . "sessions SET `typing` = '$typingresult' WHERE `id` = '$id'";
					$SQL->miscquery($query);
				}
			}
			else {
				$active = '-1';
				$typingresult = '0';
			}
			
			if ($staff) {
				$query = "SELECT `username` FROM " . $table_prefix . "users WHERE `id` = '$id'";
				$row = $SQL->selectquery($query);
				if (is_array($row)) {
					$operator_username = $row['username'];
				}
				$query = "SELECT `id`, `user`, `username`, `datetime`, `message`, `align`, `status` FROM " . $table_prefix . "administration WHERE ((`user` = '$id' AND `username` = '" . $_OPERATOR['USERNAME'] . "') OR (`user` = '" . $_OPERATOR['ID'] . "' AND `username` = '$operator_username')) AND (`status` <= '3' OR `status` = '7') AND `id` > '$message' AND (UNIX_TIMESTAMP(`datetime`) - UNIX_TIMESTAMP('" . $_OPERATOR['DATETIME'] . "')) > '0' ORDER BY `datetime`";
			}
			else {
				$query = "SELECT `id`, `session`, `username`, `datetime`, `message`, `align`, `status` FROM " . $table_prefix . "messages WHERE `session` = '$id' AND (`status` <= '3' OR `status` = '7') AND `id` > '$message' ORDER BY `datetime`";
			}
			$rows = $SQL->selectall($query);
			if (is_array($rows)) {
				foreach ($rows as $key => $row) {
					if (is_array($row)) {
						$message = $row['id']; 
					}
				}
			}
			else { $message = ''; }
			
			if ($_REQUEST['Format'] == 'xml') {
?>
<Messages xmlns="urn:LiveHelp" ID="<?php echo($id); ?>" Typing="<?php echo($typingresult); ?>" Status="<?php echo($active); ?>" ChatType="<?php echo($staff); ?>">
<?php
			}
			else {
?>
<?php if ($chatkey == 0) { echo('{"Messages": ['); } ?>
{
"ID": <?php echo(json_encode($id)); ?>,
"Typing": <?php echo(json_encode($typingresult)); ?>,
"Status": <?php echo(json_encode($active)); ?>,
"ChatType": <?php echo(json_encode($staff)); ?>
<?php
			}

/*
if ($introduction == true && $_SETTINGS['INTRODUCTION'] != '') {
	$_SETTINGS['INTRODUCTION'] = preg_replace("/({Username})/", $guest_username, $_SETTINGS['INTRODUCTION']);
	if ($_REQUEST['Format'] == 'xml') {
?>
<Message ID="<?php echo($msgid); ?>" Datetime="<?php echo($datetime); ?>" Align="<?php echo($align); ?>" Status="<?php echo($status); ?>" Username="<?php echo(xmlattribinvalidchars($username)); ?>"><?php echo(xmlelementinvalidchars($message)); ?></Message>
<?php
	}
}
*/

if (is_array($rows)) {
	$total_messages = count($rows);
	foreach ($rows as $key => $row) {
		if (is_array($row)) {
		
			if ($staff) {
				$session = $row['user'];
			}
			else {
				$session = $row['session']; 
			}
			$msgid = $row['id'];
			$username = $row['username'];
			$datetime = $row['datetime'];
			$message = $row['message'];
			$align = $row['align'];
			$status = $row['status'];
			
			// Outputs sent message
			if ((!$staff && $status) || ($staff && $session == $id && $username == $_OPERATOR['USERNAME'])) {
				if ($_REQUEST['Format'] == 'xml') {
?>
<Message ID="<?php echo($msgid); ?>" Datetime="<?php echo($datetime); ?>" Align="<?php echo($align); ?>" Status="<?php echo($status); ?>" Username="<?php echo(xmlattribinvalidchars($username)); ?>"><?php echo(xmlelementinvalidchars($message)); ?></Message>
<?php
				}
				else {
?>
<?php if ($key == 0) { echo(',"Message": ['); } ?>
{
"ID": <?php echo(json_encode($msgid)); ?>,
"Content": <?php echo(json_encode($message)); ?>,
"Datetime": <?php echo(json_encode($datetime)); ?>,
"Align": <?php echo(json_encode($align)); ?>,
"Status": <?php echo(json_encode($status)); ?>,
"Username": <?php echo(json_encode($username)); ?>
}<?php if ($key + 1 < $total_messages) { echo(','); } else { echo(']'); } ?>
<?php
				}
			}
			// Outputs received message
			if ((!$staff && !$status) || ($staff && $session == $_OPERATOR['ID'] && $username == $operator_username)) {
				if ($_REQUEST['Format'] == 'xml') {
?>
<Message ID="<?php echo($msgid); ?>" Datetime="<?php echo($datetime); ?>" Align="<?php echo($align); ?>" Status="<?php echo($status); ?>" Username="<?php echo(xmlattribinvalidchars($username)) ?>"><?php echo(xmlelementinvalidchars($message)); ?></Message>
<?php
				}
				else {
?>
<?php if ($key == 0) { echo(',"Message": ['); } ?>
{
"ID": <?php echo(json_encode($msgid)); ?>,
"Content": <?php echo(json_encode($message)); ?>,
"Datetime": <?php echo(json_encode($datetime)); ?>,
"Align": <?php echo(json_encode($align)); ?>,
"Status": <?php echo(json_encode($status)); ?>,
"Username": <?php echo(json_encode($username)); ?>
}<?php if ($key + 1 < $total_messages) { echo(','); } else { echo(']'); } ?>
<?php
				}
			}
		}
	}
}
			if ($_REQUEST['Format'] == 'xml') {
?>
</Messages>
<?php
			}
			else {
?>
}<?php if ($chatkey + 1 < $total_chats) { echo(','); } else { echo(']'); } ?>
<?php
			}
		}
		if ($_REQUEST['Format'] == 'xml') {
?>
</MultipleMessages>
<?php
		}
		else {
?>
}}
<?php
		}
	}
}

function Operators() {

	global $_OPERATOR;
	global $SQL;
	global $table_prefix;
	global $operators;

	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['User'])){ $_REQUEST['User'] = ''; }
	if (!isset($_REQUEST['Firstname'])){ $_REQUEST['Firstname'] = ''; }
	if (!isset($_REQUEST['Lastname'])){ $_REQUEST['Lastname'] = ''; }
	if (!isset($_REQUEST['CurrentPassword'])){ $_REQUEST['CurrentPassword'] = ''; }
	if (!isset($_REQUEST['NewPassword'])){ $_REQUEST['NewPassword'] = ''; }
	if (!isset($_REQUEST['Email'])){ $_REQUEST['Email'] = ''; }
	if (!isset($_REQUEST['Department'])){ $_REQUEST['Department'] = ''; }
	if (!isset($_REQUEST['Image'])){ $_REQUEST['Image'] = ''; }
	if (!isset($_REQUEST['Privilege'])){ $_REQUEST['Privilege'] = ''; }
	if (!isset($_REQUEST['Disabled'])){ $_REQUEST['Disabled'] = ''; }
	if (!isset($_REQUEST['Status'])){ $_REQUEST['Status'] = ''; }
	if (!isset($_REQUEST['Cached'])){ $_REQUEST['Cached'] = ''; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }
	
	if ($_REQUEST['ID'] != '') {
	
		// If editing own operator details 
		if ($_OPERATOR['ID'] == $_REQUEST['ID']) {
		
			// Can't change permission to lower value - higher administration rights
			if ($_REQUEST['Privilege'] < $_OPERATOR['PRIVILEGE']) {
				$_REQUEST['Privilege'] = $_OPERATOR['PRIVILEGE'];
			}
		}
		else {
			// If NOT an Administrator
			if ($_OPERATOR['PRIVILEGE'] > 1) {
			
				if ($_REQUEST['Format'] == 'xml') {
					header('Content-type: text/xml; charset=utf-8');
					echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
			
?>
<Operators xmlns="urn:LiveHelp" />
<?php
				}
				else {
					header('Content-type: application/json; charset=utf-8');
?>
{"Operators": null}
<?php		
				}
				exit();
			}
		}
	
		// Update an existing account
		if ($_REQUEST['ID'] != '' && $_REQUEST['User'] != '' && $_REQUEST['Firstname'] != '' && $_REQUEST['Email'] != '' && $_REQUEST['Department'] != '' && $_REQUEST['Privilege'] != '' && $_REQUEST['Disabled'] != '') {
			// If current operator is an Full Administrator / Department Administrator
			if ($_OPERATOR['PRIVILEGE'] < 2) {
				if ($_REQUEST['Image'] != '') {
				$query = "UPDATE " . $table_prefix . "users SET `username` = '" . $_REQUEST['User'] . "', `firstname` = '" . $_REQUEST['Firstname'] . "', `lastname` = '" . $_REQUEST['Lastname'] . "', `email` = '" . $_REQUEST['Email'] . "', `department` = '" . $_REQUEST['Department'] . "', `image` = '" . $_REQUEST['Image'] . "', `updated` = NOW(), `privilege` = '" . $_REQUEST['Privilege'] . "', `disabled` = '" . $_REQUEST['Disabled'] . "' WHERE `id` = '" . $_REQUEST['ID'] . "'";
				} else {
				$query = "UPDATE " . $table_prefix . "users SET `username` = '" . $_REQUEST['User'] . "', `firstname` = '" . $_REQUEST['Firstname'] . "', `lastname` = '" . $_REQUEST['Lastname'] . "', `email` = '" . $_REQUEST['Email'] . "', `department` = '" . $_REQUEST['Department'] . "', `privilege` = '" . $_REQUEST['Privilege'] . "', `disabled` = '" . $_REQUEST['Disabled'] . "' WHERE `id` = '" . $_REQUEST['ID'] . "'";
				}
			} else {
				if ($_REQUEST['Image'] != '') {
				$query = "UPDATE " . $table_prefix . "users SET `username` = '" . $_REQUEST['User'] . "', `firstname` = '" . $_REQUEST['Firstname'] . "', `lastname` = '" . $_REQUEST['Lastname'] . "', `email` = '" . $_REQUEST['Email'] . "', `image` = '" . $_REQUEST['Image'] . "', `updated` = NOW(), `privilege` = '" . $_REQUEST['Privilege'] . "', `disabled` = '" . $_REQUEST['Disabled'] . "' WHERE `id` = '" . $_REQUEST['ID'] . "'";
				} else {
				$query = "UPDATE " . $table_prefix . "users SET `username` = '" . $_REQUEST['User'] . "', `firstname` = '" . $_REQUEST['Firstname'] . "', `lastname` = '" . $_REQUEST['Lastname'] . "', `email` = '" . $_REQUEST['Email'] . "', `privilege` = '" . $_REQUEST['Privilege'] . "', `disabled` = '" . $_REQUEST['Disabled'] . "' WHERE `id` = '" . $_REQUEST['ID'] . "'";
				}
			}
			$result = $SQL->miscquery($query);
			if ($result == false) {
			
				if ($_REQUEST['Format'] == 'xml') {
					header('Content-type: text/xml; charset=utf-8');
					echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
			
?>
<Operators xmlns="urn:LiveHelp" />
<?php
				}
				else {
					header('Content-type: application/json; charset=utf-8');
?>
{"Operators":
<?php
				}
				exit();
			}
	
		}
		elseif ($_REQUEST['NewPassword'] != '') {  // Change password
			
			// Confirm current password is correct before updating
			if ($_OPERATOR['PRIVILEGE'] > 0 && $_REQUEST['CurrentPassword'] != '') {
				$query = "SELECT `id` FROM " . $table_prefix . "users WHERE `id` = '" . $_REQUEST['ID'] . "' AND `password` = '" . $_REQUEST['CurrentPassword'] . "' LIMIT 1";
				$row = $SQL->selectquery($query);
			}
			if (is_array($row) || $_OPERATOR['PRIVILEGE'] <= 0) {
		
				$query = "UPDATE " . $table_prefix . "users SET `password` = '" . $_REQUEST['NewPassword'] . "' WHERE `id` = '" . $_REQUEST['ID'] . "'";
				$result = $SQL->miscquery($query);
				if ($result == false) {
				
					if ($_REQUEST['Format'] == 'xml') {
						header('Content-type: text/xml; charset=utf-8');
						echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
				
?>
<Operators xmlns="urn:LiveHelp" />
<?php
					}
					else {
						header('Content-type: application/json; charset=utf-8');
?>
{"Operators": null}
<?php
					}
					exit();
				}
				
			} elseif (!is_array($row)) {
			
				// Forbidden - Incorrect Password
				if (strpos(php_sapi_name(), 'cgi') === false ) { header('HTTP/1.0 403 Forbidden'); } else { header('Status: 403 Forbidden'); }
				exit();
				
			} else {
			
				if ($_REQUEST['Format'] == 'xml') {
					header('Content-type: text/xml; charset=utf-8');
					echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
				
?>
<Operators xmlns="urn:LiveHelp" />
<?php
				}
				else {
					header('Content-type: application/json; charset=utf-8');
?>
{"Operators": null}
<?php
				}
				exit();
			}
		}
		else {  // Delete operator
		
			$query = "DELETE FROM " . $table_prefix . "users WHERE `id` = '" . $_REQUEST['ID'] . "' AND `privilege` <> -1";
			$result = $SQL->miscquery($query);
			if ($result == false) {
			
				if ($_REQUEST['Format'] == 'xml') {
					header('Content-type: text/xml; charset=utf-8');
					echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
				
?>
<Operators xmlns="urn:LiveHelp" />
<?php
				}
				else {
					header('Content-type: application/json; charset=utf-8');
?>
{"Operators": null}
<?php
				}
				exit();
			}
		
		} 
	}
	else {
	
		// If current operator is an Full Administrator / Department Administrator
		if ($_OPERATOR['PRIVILEGE'] < 2) {
	
			// Add a new account
			if ($_REQUEST['User'] != '' && $_REQUEST['Firstname'] != '' && $_REQUEST['NewPassword'] != '' && $_REQUEST['Email'] != '' && $_REQUEST['Department'] != '' && $_REQUEST['Privilege'] != '' && $_REQUEST['Disabled'] != '') {
		
				if ($_OPERATOR['PRIVILEGE'] > 0 && $_REQUEST['Privilege'] == 0) {
					if ($_REQUEST['Format'] == 'xml') {
?>
<Operators xmlns="urn:LiveHelp" />
<?php
					}
					else {
?>
{"Operators": null}
<?php
					}
					exit();
				}
		
				if (isset($operators)) {
					$query = "SELECT COUNT(*) FROM " . $table_prefix . "users";
					$row = $SQL->selectquery($query);
					if (isset($row['COUNT(*)'])) {
						$total = $row['COUNT(*)'];
						if ($total == $operators) {
						
							if ($_REQUEST['Format'] == 'xml') {
								header('Content-type: text/xml; charset=utf-8');
								echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
				
?>
<Operators xmlns="urn:LiveHelp" />
<?php
							}
							else {
								header('Content-type: application/json; charset=utf-8');
?>
{"Operators": null}
<?php
							}
							exit();
						}
					}
				}
		
				$query = "INSERT INTO " . $table_prefix . "users(`username`, `firstname`, `lastname`, `password`, `email`, `department`, `image`, `privilege`, `disabled`) VALUES('" . $_REQUEST['User'] . "', '" . $_REQUEST['Firstname'] . "', '" . $_REQUEST['Lastname'] . "', '" . $_REQUEST['NewPassword'] . "', '" . $_REQUEST['Email'] . "', '" . $_REQUEST['Department'] . "', '" . $_REQUEST['Image'] . "', '" . $_REQUEST['Privilege'] . "', '" . $_REQUEST['Disabled'] . "')";
				$result = $SQL->miscquery($query);
				if ($result == false) {
				
					if ($_REQUEST['Format'] == 'xml') {
						header('Content-type: text/xml; charset=utf-8');
						echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
				
?>
<Operators xmlns="urn:LiveHelp" />
<?php
					}
					else {
						header('Content-type: application/json; charset=utf-8');
?>
{"Operators": null}
<?php
					}
					exit();
				}
			}
		}
		
	}
	
	if ($_REQUEST['Format'] == 'xml') {
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
	}
	else {
		header('Content-type: application/json; charset=utf-8');
	}
	
	$query = "SELECT *, NOW() AS `time` FROM " . $table_prefix . "users ORDER BY `username`";
	$rows = $SQL->selectall($query);
	
	$total_operators = count($rows);
	
	if (is_array($rows)) {
		if (isset($operators)) {
			if ($_REQUEST['Format'] == 'xml') {
?>
<Operators xmlns="urn:LiveHelp" Limit="<?php echo($operators) ?>">
<?php
			}
			else {
?>
{"Operators": { "Limit": <?php echo(json_encode($operators)); ?>,
<?php
			}
		} else {
			if ($_REQUEST['Format'] == 'xml') {
?>
<Operators xmlns="urn:LiveHelp">
<?php
			}
			else {
?>
{"Operators": {
<?php
			}
		}

		$query = "SELECT messages.username, AVG(`rating`) AS `average` FROM " . $table_prefix . "messages AS messages, " . $table_prefix . "sessions AS sessions WHERE messages.session = sessions.id AND `status` = 1 AND `rating` <> 0 GROUP BY messages.username";
		$ratings = $SQL->selectall($query);

		foreach ($rows as $operatorkey => $row) {
			if (is_array($row)) {
				$operator_id = $row['id'];
				$operator_username = $row['username'];
				$operator_firstname = $row['firstname'];
				$operator_lastname = $row['lastname'];
				$operator_email = $row['email'];
				$operator_password = $row['password'];
				$operator_department = $row['department'];
				$operator_image = $row['image'];
				$operator_datetime = $row['datetime'];
				$operator_refresh = $row['refresh'];
				$operator_updated = $row['updated'];
				$operator_privilege = $row['privilege'];
				$operator_disabled = $row['disabled'];
				$operator_status = $row['status'];
				$operator_time = $row['time'];
				
				$length = strlen($operator_password);
				switch ($length) {
					case 40: // SHA1
						$authentication = '2.0';
						break;
					case 128: // SHA512
						$authentication = '3.0';
						break;
					default: // MD5
						$authentication = '1.0';
						break;
				}
				
				$refresh = strtotime($operator_refresh);
				$time = strtotime($operator_time);
				if ($time - $refresh > 45) { $operator_status = 0; }
				
				if ($_REQUEST['Cached'] != '') { 
					$updated = strtotime($operator_updated);
					$cached = strtotime($_REQUEST['Cached']);
					if ($updated - $cached <= 0) {
						$operator_image	= '';
					}
				}
				
				$operator_rating = 'Unavailable';
				if (is_array($ratings)) {
					foreach ($ratings as $key => $rating) {
						if (is_array($rating)) {
							if ($rating['username'] == $operator_username) {
								$operator_rating = $rating['average'];
								break;
							}
						}
					}
				}
				
				if ($_REQUEST['Format'] == 'xml') {
?>
<Operator ID="<?php echo($operator_id); ?>" Updated="<?php echo($operator_updated); ?>" Authentication="<?php echo($authentication); ?>">
<Username><?php echo(xmlelementinvalidchars($operator_username)); ?></Username>
<Firstname><?php echo(xmlelementinvalidchars($operator_firstname)); ?></Firstname>
<Lastname><?php echo(xmlelementinvalidchars($operator_lastname)); ?></Lastname>
<Email><?php echo(xmlelementinvalidchars($operator_email)); ?></Email>
<Department><?php echo(xmlelementinvalidchars($operator_department)); ?></Department>
<?php if ($operator_image != '') { ?><Image><![CDATA[<?php echo(xmlelementinvalidchars($operator_image)); ?>]]></Image><?php } ?>
<Datetime><?php echo(xmlelementinvalidchars($operator_datetime)); ?></Datetime>
<Refresh><?php echo(xmlelementinvalidchars($operator_refresh)); ?></Refresh>
<Privilege><?php echo($operator_privilege); ?></Privilege>
<Disabled><?php echo($operator_disabled); ?></Disabled>
<Status><?php echo($operator_status); ?></Status>
<Rating><?php echo(xmlelementinvalidchars($operator_rating)); ?></Rating>
</Operator>
<?php
				}
				else {
?>
<?php if ($operatorkey == 0) { echo('"Operator": ['); } ?>
{
"ID": <?php echo(json_encode($operator_id)); ?>,
"Updated": <?php echo(json_encode($operator_updated)); ?>,
"Authentication": <?php echo(json_encode($authentication)); ?>,
"Username": <?php echo(json_encode($operator_username)); ?>,
"Firstname": <?php echo(json_encode($operator_firstname)); ?>,
"Lastname": <?php echo(json_encode($operator_lastname)); ?>,
"Email": <?php echo(json_encode($operator_email)); ?>,
"Department": <?php echo(json_encode($operator_department)); ?>,
<?php if ($operator_image != '') { ?>"Image": <?php echo(json_encode($operator_image)); ?>,<?php } ?>
"Datetime": <?php echo(json_encode($operator_datetime)); ?>,
"Refresh": <?php echo(json_encode($operator_refresh)); ?>,
"Privilege": <?php echo(json_encode($operator_privilege)); ?>,
"Disabled": <?php echo(json_encode($operator_disabled)); ?>,
"Status": <?php echo(json_encode($operator_status)); ?>,
"Rating": <?php echo(json_encode($operator_rating)); ?>
}<?php if ($operatorkey + 1 < $total_operators) { echo(','); } else { echo(']'); } ?>
<?php
				}
			}
		}
		if ($_REQUEST['Format'] == 'xml') {
?>
</Operators>
<?php
		}
		else {
?>
}}
<?php
		}
	}
	else {
		if ($_REQUEST['Format'] == 'xml') {
?>
<Operators xmlns="urn:LiveHelp"/>
<?php
		}
		else {
?>
{"Operators": null}
<?php
		}
	}
}

function Statistics() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;

	header('Content-type: text/xml; charset=utf-8');
	echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");

?>
<Statistics xmlns="urn:LiveHelp">
<?php
	
	$query = "SELECT DISTINCT `rating`, COUNT(`id`) AS total FROM " . $table_prefix . "sessions WHERE DATE_FORMAT(`datetime`, '%M') = DATE_FORMAT(NOW(), '%M') GROUP BY `rating` ORDER BY `rating` DESC";
	$rows = $SQL->selectall($query);
	if (is_array($rows)) {
?>
<Rating>
<?php
		foreach($rows as $key => $row) {
			if (is_array($row)) {
				
				$rating = $row['rating'];
				$total = $row['total'];
				
				switch($rating) {
				case 5:
?>
<Excellent><?php echo($total); ?></Excellent>
<?php
					break;
				case 4:
?>
<VeryGood><?php echo($total); ?></VeryGood>
<?php
					break;
				case 3:
?>
<Good><?php echo($total); ?></Good>
<?php
					break;
				case 2:
?>
<Average><?php echo($total); ?></Average>
<?php
					break;
				case 1:
?>
<Poor><?php echo($total); ?></Poor>
<?php
					break;
				}
			}
		}
?>
</Rating>
<?php
	}
	else {
?>
<Rating />
<?php
	}
	
	$query = "SELECT DISTINCT `referrer`, count(`id`) AS total FROM " . $table_prefix . "requests WHERE DATE_FORMAT(`datetime`, '%M') = DATE_FORMAT(NOW(), '%M') AND `referrer` NOT LIKE '%" . $_SETTINGS['DOMAIN'] . "%' GROUP BY `referrer` ORDER BY total DESC LIMIT 0, 5";
	$rows = $SQL->selectall($query);
	if (is_array($rows)) {
?>
<Referrers>
<?php
		foreach($rows as $key => $row) {
			if (is_array($row)) {
				$url = $row['referrer'];
				$total = $row['total'];
?>
<Referrer Total="<?php echo($total); ?>"><?php echo(xmlelementinvalidchars($url)); ?></Referrer>
<?php
			}
		}
?>
</Referrers>
<?php
	}
	else {
?>
<Referrers />
<?php
	}
?>
</Statistics>
<?php

}

function History() {

	global $_SETTINGS;
	global $_OPERATOR;
	global $SQL;
	global $table_prefix;

	if (!isset($_REQUEST['StartDate'])){ $_REQUEST['StartDate'] = ''; }
	if (!isset($_REQUEST['EndDate'])){ $_REQUEST['EndDate'] = ''; }
	if (!isset($_REQUEST['Timezone'])){ $_REQUEST['Timezone'] = ''; }
	if (!isset($_REQUEST['Transcripts'])){ $_REQUEST['Transcripts'] = ''; }
	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['Version'])){ $_REQUEST['Version'] = ''; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }

	if ($_REQUEST['Format'] == 'xml') {
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
	} else {
		header('Content-type: application/json; charset=utf-8');
	}
	
	// View History if authorized
	if ($_OPERATOR['PRIVILEGE'] > 2) {
		if ($_REQUEST['Transcripts'] == '') {
			if ($_REQUEST['Format'] == 'xml') {
?>
<VisitorHistory xmlns="urn:LiveHelp"/>
<?php
			} else {
?>
{ "VisitorHistory": null }
<?php
			}
		exit();
		}
	}

	// Live Help Messenger 2.95 Compatibility
	if (isset($_REQUEST['Date'])) {
		list($from_year, $from_month, $from_day) = split('-', $_REQUEST['Date']);
		list($to_year, $to_month, $to_day) = split('-', $_REQUEST['Date']);
	} else {
		list($from_year, $from_month, $from_day) = split('-', $_REQUEST['StartDate']);
		list($to_year, $to_month, $to_day) = split('-', $_REQUEST['EndDate']);
	}

	$timezone = $_SETTINGS['SERVERTIMEZONE']; $from = ''; $to = '';
	if ($timezone != $_REQUEST['Timezone']) {
	
		$sign = substr($_REQUEST['Timezone'], 0, 1);
		$hours = substr($_REQUEST['Timezone'], -4, 2);
		$minutes = substr($_REQUEST['Timezone'], -2, 2);
		if ($minutes != 0) { $minutes = ($minutes / 0.6); }
		$local = $sign . $hours . $minutes;
	
		$sign = substr($timezone, 0, 1);
		$hours = substr($timezone, 1, 2);
		$minutes = substr($timezone, 3, 4);
		if ($minutes != 0) { $minutes = ($minutes / 0.6); }
		$remote = $sign . $hours . $minutes;
	
		// Convert to eg. +/-0430 format
		$hours = substr(sprintf("%04d", $local - $remote), 0, 2);
		$minutes = substr(sprintf("%04d", $local - $remote), 2, 4);
		if ($minutes != 0) { $minutes = ($minutes * 0.6); }
		$difference = ($hours * 60 * 60) + ($minutes * 60);
		
		if ($difference != 0) {
			$from = date('Y-m-d H:i:s', mktime(0 - $hours, 0 - $minutes, 0, $from_month, $from_day, $from_year));
			$to = date('Y-m-d H:i:s', mktime(0 - $hours, 0 - $minutes, 0, $to_month, $to_day + 1, $to_year));
		}
	}

	if ($from == '' && $to == '') {
		$from = date('Y-m-d H:i:s', mktime(0, 0, 0, $from_month, $from_day, $from_year));
		$to = date('Y-m-d H:i:s', mktime(24, 0, 0, $to_month, $to_day, $to_year));
	}
	
	if ($_REQUEST['Transcripts'] != '') {
		
		$query = '';
		if ($timezone != $_REQUEST['Timezone']) {
			if ($difference != 0) {
				$query = "SELECT DISTINCT sessions.id, sessions.request, `firstname`, `lastname`, `ipaddress`, `useragent`, `country`, `referrer`, `url`, `path`, DATE_ADD(sessions.datetime, INTERVAL '$hours:$minutes' HOUR_MINUTE) AS `datetime`, DATE_ADD(sessions.refresh, INTERVAL '$hours:$minutes' HOUR_MINUTE) AS `refresh`, sessions.username, sessions.department, sessions.email, `rating`, `active` FROM " . $table_prefix . "requests AS requests, " . $table_prefix . "sessions AS sessions, " . $table_prefix . "messages AS messages, " . $table_prefix . "users AS users WHERE sessions.id = messages.session AND requests.id = sessions.request AND messages.username = users.username AND sessions.datetime > '$from' AND sessions.datetime < '$to' AND (messages.status = '1' OR messages.status = '7') AND sessions.id > '{$_REQUEST['ID']}'";		
			}
		}
		if ($query == '') {		
			$query = "SELECT DISTINCT sessions.id, sessions.request, `firstname`, `lastname`, `ipaddress`, `useragent`, `country`, `referrer`, `url`, `path`, sessions.datetime AS `datetime`, sessions.refresh AS `refresh`, sessions.username, sessions.department, sessions.email, `rating`, `active` FROM " . $table_prefix . "requests AS requests, " . $table_prefix . "sessions AS sessions, " . $table_prefix . "messages AS messages, " . $table_prefix . "users AS users WHERE sessions.id = messages.session AND requests.id = sessions.request AND messages.username = users.username AND sessions.datetime > '$from' AND sessions.datetime < '$to' AND (messages.status = '1' OR messages.status = '7') AND sessions.id > '{$_REQUEST['ID']}'";
		}
		
		// Limit History if not Administrator
		if ($_OPERATOR['PRIVILEGE'] > 2) {
			$query .= " AND users.username = '{$_REQUEST['Username']}'";
		}
		$query .= ' ORDER BY sessions.datetime';

		if ($_REQUEST['Format'] == 'xml') {		
?>
<ChatHistory xmlns="urn:LiveHelp">
<?php
		} else {
			$visitors = array();
		}

		$row = $SQL->selectquery($query);
		if (is_array($row)) {
			while ($row) {
				if (is_array($row)) {
				
					$id = $row['id'];
					$request = $row['request'];
					$ipaddress = $row['ipaddress'];
					$useragent = $row['useragent'];
					$referer = $row['referrer'];
					$country = $row['country'];
					$url = $row['url'];
					$path = $row['path'];
					$username = $row['username'];
					$operator = $row['firstname'] . ' ' . $row['lastname'];
					$department = $row['department'];
					$email = $row['email'];
					$rating = $row['rating'];
					$active = $row['active'];
					$datetime = $row['datetime'];
					$refresh = $row['refresh'];
					
					if ($_REQUEST['Format'] == 'xml') {	
?>
<Visitor ID="<?php echo($request); ?>" Session="<?php echo($id); ?>" Active="<?php echo($active); ?>" Username="<?php echo(xmlattribinvalidchars($username)); ?>" Email="<?php echo(xmlattribinvalidchars($email)); ?>">
<Date><?php echo(xmlelementinvalidchars($datetime)); ?></Date>
<Refresh><?php echo(xmlelementinvalidchars($refresh)); ?></Refresh>
<Hostname><?php echo(xmlelementinvalidchars($ipaddress)); ?></Hostname>
<UserAgent><?php echo(xmlelementinvalidchars($useragent)); ?></UserAgent>
<CurrentPage><?php echo(xmlelementinvalidchars($url)); ?></CurrentPage>
<SiteTime><?php echo($timezone); ?></SiteTime>
<Referrer><?php echo(xmlelementinvalidchars($referer)); ?></Referrer>
<Country><?php echo(xmlelementinvalidchars($country)); ?></Country>
<PagePath><?php echo(xmlelementinvalidchars($path)); ?></PagePath>
<Operator><?php echo(xmlelementinvalidchars($operator)); ?></Operator>
<Department><?php echo(xmlelementinvalidchars($department)); ?></Department>
<Rating><?php echo(xmlelementinvalidchars($rating)); ?></Rating>
</Visitor>
<?php
					} else {
					
						$visitor = array("ID" => $request, "Session" => $id, "Active" => $active, "Username" => $username, "Email" => $email, "Date" => $datetime, "Refresh" => $refresh, "Hostname" => $ipaddress, "UserAgent" => $useragent, "CurrentPage" => $url, "SiteTime" => $timezone, "Referrer" => $referer, "Country" => $country, "PagePath" => $path, "Operator" => $operator, "Department" => $department, "Rating" => $rating);
						$visitors[] = array("Visitor" => $visitor);

					}
					
					$row = $SQL->selectnext();
				}
			}
		}
			
		$query = '';
		if ($timezone != $_REQUEST['Timezone']) {
			if ($difference != 0) {
			$query = "SELECT DISTINCT sessions.id, sessions.username, users.firstname, users.lastname, DATE_ADD(sessions.datetime, INTERVAL '$hours:$minutes' HOUR_MINUTE) AS `datetime`, DATE_ADD(sessions.refresh, INTERVAL '$hours:$minutes' HOUR_MINUTE) AS `refresh`, sessions.department, sessions.email, `rating`, `active` FROM " . $table_prefix . "sessions AS sessions, " . $table_prefix . "messages AS messages, " . $table_prefix . "users AS users WHERE messages.username = users.username AND messages.session = sessions.id AND sessions.request = '0' AND sessions.datetime > '$from' AND sessions.datetime < '$to' AND (messages.status = '1' OR messages.status = '7') AND sessions.id > '{$_REQUEST['ID']}'";
			}
		}
		if ($query == '') {
			$query = "SELECT DISTINCT sessions.id, sessions.username, users.firstname, users.lastname, sessions.datetime AS `datetime`, sessions.refresh AS `refresh`, sessions.department, sessions.email, `rating`, `active` FROM " . $table_prefix . "sessions AS sessions, " . $table_prefix . "messages AS messages, " . $table_prefix . "users AS users WHERE messages.username = users.username AND messages.session = sessions.id AND sessions.request = '0' AND sessions.datetime > '$from' AND sessions.id < '$to' AND (messages.status = '1' OR messages.status = '7') AND sessions.request > '{$_REQUEST['ID']}'";
		}
		$row = $SQL->selectquery($query);
		while ($row) {
			if (is_array($row)) {
				$request = -1;
				$id = $row['id'];
				$active = $row['active'];
				$username = $row['username'];
				$ipaddress = 'Unavailable';
				$useragent = 'Unavailable';
				$referer = 'Unavailable';
				$country = 'Unavailable';
				$url = 'Unavailable';
				$path = 'Unavailable';
				$operator = $row['firstname'] . ' ' . $row['lastname'];
				$department = $row['department'];
				$email = $row['email'];
				$rating = $row['rating'];
				$datetime = $row['datetime'];
				$refresh = $row['refresh'];
				
				if ($_REQUEST['Format'] == 'xml') {	
?>
<Visitor ID="<?php echo($request); ?>" Session="<?php echo($id); ?>" Active="<?php echo($active); ?>" Username="<?php echo(xmlattribinvalidchars($username)); ?>" Email="<?php echo(xmlattribinvalidchars($email)); ?>">
<Date><?php echo(xmlelementinvalidchars($datetime)); ?></Date>
<Refresh><?php echo(xmlelementinvalidchars($refresh)); ?></Refresh>
<Hostname><?php echo(xmlelementinvalidchars($ipaddress)); ?></Hostname>
<UserAgent><?php echo(xmlelementinvalidchars($useragent)); ?></UserAgent>
<CurrentPage><?php echo(xmlelementinvalidchars($url)); ?></CurrentPage>
<SiteTime><?php echo($datetime); ?></SiteTime>
<Referrer><?php echo(xmlelementinvalidchars($referer)); ?></Referrer>
<Country><?php echo(xmlelementinvalidchars($country)); ?></Country>
<PagePath><?php echo(xmlelementinvalidchars($path)); ?></PagePath>
<Operator><?php echo(xmlelementinvalidchars($operator)); ?></Operator>
<Department><?php echo(xmlelementinvalidchars($department)); ?></Department>
<Rating><?php echo(xmlelementinvalidchars($rating)); ?></Rating>
</Visitor>
<?php
				} else {
						$visitor = array("ID" => $request, "Session" => $id, "Active" => $active, "Username" => $username, "Email" => $email, "Date" => $datetime, "Refresh" => $refresh, "Hostname" => $ipaddress, "UserAgent" => $useragent, "CurrentPage" => $url, "SiteTime" => $timezone, "Referrer" => $referer, "Country" => $country, "PagePath" => $path, "Operator" => $operator, "Department" => $department, "Rating" => $rating);
						$visitors[] = array("Visitor" => $visitor);
				}

				$row = $SQL->selectnext();
			}
		}
		
		if ($_REQUEST['Format'] == 'xml') {	
?>
</ChatHistory>
<?php
		} else {

			$json = array("ChatHistory" => $visitors);
			echo(json_encode($json));
		}
	}
	else { // $_REQUEST['Transcripts'] == ''
		$query = '';
		if ($timezone != $_REQUEST['Timezone']) {
			if ($difference != 0) {
				$query = "SELECT *, DATE_ADD(`datetime`, INTERVAL '$hours:$minutes' HOUR_MINUTE) AS `timezone`, ((UNIX_TIMESTAMP(`refresh`) - UNIX_TIMESTAMP(`datetime`))) AS `sitetime`, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`request`))) AS `pagetime` FROM " . $table_prefix . "requests WHERE `datetime` > '$from' AND `datetime` < '$to' AND `status` = '0' AND `id` > '{$_REQUEST['ID']}' ORDER BY `request`";
			}
		}
		if ($query == '') {		
				$query = "SELECT *, `datetime` AS `timezone`, ((UNIX_TIMESTAMP(`refresh`) - UNIX_TIMESTAMP(`datetime`))) AS `sitetime`, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`request`))) AS `pagetime` FROM " . $table_prefix . "requests WHERE `datetime` > '$from' AND `datetime` < '$to' AND `status` = '0' AND `id` > '{$_REQUEST['ID']}' ORDER BY `request`";
		}
		$row = $SQL->selectquery($query);
		if (is_array($row)) {
?>
<VisitorHistory xmlns="urn:LiveHelp">
<?php
			while ($row) {
				if (is_array($row)) {
					$id = $row['id'];
					$ipaddress = $row['ipaddress'];
					$useragent = $row['useragent'];
					$resolution = $row['resolution'];
					$country = $row['country'];
					$datetime = $row['timezone'];
					$pagetime = $row['pagetime'];
					$sitetime = $row['sitetime'];
					$url = $row['url'];
					$title = $row['title'];
					$referer = $row['referrer'];
					$path = $row['path'];
					
					$pages = explode('; ', $path);
					$total = count($path);
					if ($total > 20) {
						$path = '';
						for ($i = $total - 20; $i < $total; $i++) {
							$path .= $pages[$i] . '; ';
						}
					}
?>
<Visitor ID="<?php echo($id); ?>">
<Hostname><?php echo(xmlelementinvalidchars($ipaddress)); ?></Hostname>
<UserAgent><?php echo(xmlelementinvalidchars($useragent)); ?></UserAgent>
<Resolution><?php echo(xmlelementinvalidchars($resolution)); ?></Resolution>
<Country><?php echo(xmlelementinvalidchars($country)); ?></Country>
<Date><?php echo(xmlelementinvalidchars($datetime)); ?></Date>
<PageTime><?php echo($pagetime); ?></PageTime>
<SiteTime><?php if (!isset($_REQUEST['Version'])) { echo($datetime); } else { echo($sitetime); } ?></SiteTime>
<CurrentPage><?php echo(xmlelementinvalidchars($url)); ?></CurrentPage>
<CurrentPageTitle><?php echo(xmlelementinvalidchars($title)); ?></CurrentPageTitle>
<Referrer><?php echo(xmlelementinvalidchars($referer)); ?></Referrer>
<PagePath><?php echo(xmlelementinvalidchars($path)); ?></PagePath>
</Visitor>
<?php
					$row = $SQL->selectnext();
				}
			}
?>
</VisitorHistory>
<?php
		}
		else {
?>
<VisitorHistory xmlns="urn:LiveHelp"/>
<?php
		}
	}	
	
}

function Send() {

	global $_OPERATOR;
	global $SQL;
	global $table_prefix;

	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['Message'])){ $_REQUEST['Message'] = ''; }
	if (!isset($_REQUEST['Staff'])){ $_REQUEST['Staff'] = ''; }
	if (!isset($_REQUEST['Type'])){ $_REQUEST['Type'] = ''; }
	if (!isset($_REQUEST['Name'])){ $_REQUEST['Name'] = ''; }
	if (!isset($_REQUEST['Content'])){ $_REQUEST['Content'] = ''; }
	if (!isset($_REQUEST['Status'])){ $_REQUEST['Status'] = 1; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }
	
	$result = '0';
	
	// Check if the message contains any content else return headers
	if ($_REQUEST['Message'] == '' && $_REQUEST['Type'] == '' && $_REQUEST['Name'] == '' && $_REQUEST['Content'] == '') {
		if ($_REQUEST['Format'] == 'xml') {	
			header('Content-type: text/xml; charset=utf-8');
			echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<SendMessage xmlns="urn:LiveHelp"/>
<?php
			exit();
		} else {
?>
{"SendMessage": null}
<?php
		}
	}
	

	if ($_REQUEST['Type'] != '' && $_REQUEST['Name'] != '' && $_REQUEST['Content'] != '') {
	
		// Strip the slashes because slashes will be added to whole string
		$type = $_REQUEST['Type'];
		$name = stripslashes(trim($_REQUEST['Name']));
		$content = stripslashes(trim($_REQUEST['Content']));
		$operator = '';
		
		switch ($type) {
			case 'LINK':
				$type = 2;
				$command = addslashes($name . " \r\n " . $content);
				break;
			case 'IMAGE':
				$type = 3;
				$command = addslashes($name . " \r\n " . $content);
				break;
			case 'PUSH':
				$type = 4;
				$command = addslashes($content);
				$operator = addslashes('The ' . $name . ' has been PUSHed to the visitor.');
				break;
			case 'JAVASCRIPT':
				$type = 5;
				$command = addslashes($content);
				$operator = addslashes('The ' . $name . ' has been sent to the visitor.');
				break;
			case 'FILE':
				$type = 6;
				$command = addslashes($content);
				//$operator = addslashes('The ' . $name . ' has been sent to the visitor.');
				break;
		}
		
		if ($command != '') {
			$query = "INSERT INTO " . $table_prefix . "messages (`session`, `username`, `datetime`, `message`, `align`, `status`) VALUES ('" . $_REQUEST['ID'] . "', '', NOW(), '$command', '2', '$type')";
			if ($operator != '') {
				$query .= ", ('" . $_REQUEST['ID'] . "', '', NOW(), '$operator', '2', '-1')";
			}
			$id = $SQL->insertquery($query);
			if ($id != false) {
				$result = '1';
			}
		}
		
	}
	
	// Format the message string
	$message = trim($_REQUEST['Message']);
		
	if ($message != '') {
		if (!$_REQUEST['Staff']) {
			// Send messages from POSTed data
			$query = "INSERT INTO " . $table_prefix . "messages (`session`, `username`, `datetime`, `message`, `align`, `status`) VALUES('" . $_REQUEST['ID'] . "', '" . $_OPERATOR['USERNAME'] . "', NOW(), '" . $_REQUEST['Message'] . "', '1', '" . $_REQUEST['Status'] . "')";
			$id = $SQL->insertquery($query);
			if ($id != false) {
				$result = '1';
			}
		}
		else {
			$query = "INSERT INTO " . $table_prefix . "administration (`user`, `username`, `datetime`, `message`, `align`, `status`) VALUES('" . $_REQUEST['ID'] . "', '" . $_OPERATOR['USERNAME'] . "', NOW(), '" . $_REQUEST['Message'] . "', '1', '" . $_REQUEST['Status'] . "')";
			$id = $SQL->insertquery($query);
			if ($id != false) {
				$result = '1';
			}
		}
	}
	
	if ($_REQUEST['Format'] == 'xml') {	
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<SendMessage xmlns="urn:LiveHelp" Result="<?php echo($result); ?>"></SendMessage>
<?php
	} else {
?>
{"SendMessage": {"Result": <?php echo(json_encode($result)); ?>}}
<?php
	}

}

function EmailChat() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;

	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['Email'])){ $_REQUEST['Email'] = ''; }

	if ($_SETTINGS['SMTP'] == true) {
		ini_set('SMTP', $_SETTINGS['SMTPSERVER']);
		ini_set('smtp_port', $_SETTINGS['SMTPPORT']);
		ini_set('sendmail_from', $_SETTINGS['SMTPEMAIL']);
	}

	// Determine EOL
	$server = strtoupper(substr($_SERVER['OS'], 0, 3));
	if ($server == 'WIN') { 
		$eol = "\r\n"; 
	} elseif ($server == 'MAC') { 
		$eol = "\r"; 
	} else { 
		$eol = "\n"; 
	}

	# Boundry for marking the split & Multitype Headers 
	$mime_boundary = sha1(time());
	$subject = '=?UTF-8?B?' . base64_encode($_SETTINGS['NAME'] . ' Chat Transcript') . '?=';
	
	if ($_REQUEST['Email'] != '') {
		$headers = 'From: "=?UTF-8?B?' . base64_encode($_SETTINGS['NAME']) . '?=" <' . $_SETTINGS['EMAIL'] . '>' . $eol;
		$headers .= 'Cc: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
		$headers .= 'Reply-To: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
		$headers .= 'Return-Path: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
		$headers .= 'MIME-Version: 1.0' . $eol; 
		$headers .= 'Content-Type: multipart/alternative; boundary="' . $mime_boundary . '"' . $eol;
	} else {
		$headers = 'From: "=?UTF-8?B?' . base64_encode($_SETTINGS['NAME']) . '?=" <' . $_SETTINGS['EMAIL'] . '>' . $eol;
		$headers .= 'Reply-To: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
		$headers .= 'Return-Path: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
		$headers .= 'MIME-Version: 1.0' . $eol; 
		$headers .= 'Content-Type: multipart/alternative; boundary="' . $mime_boundary . '"' . $eol;
	}
	

	$query = "SELECT `username`, `message`, `status` FROM " . $table_prefix . "messages WHERE `session` = '" . $_REQUEST['ID'] . "' AND `status` <= '3' ORDER BY `datetime`";
	$row = $SQL->selectquery($query);
	$htmlmessages = ''; $textmessages = '';
	while ($row) {
		if (is_array($row)) {
			$username = $row['username'];
			$message = $row['message'];
			$status = $row['status'];
			
			// Operator
			if ($status) {
				$htmlmessages .= '<div style="color:#666666">' . $username . ' says:</div><div style="margin-left:15px; color:#666666;">' . $message . '</div>'; 
				$textmessages .= $username . ' says:' . $eol . '	' . $message . $eol; 
			}
			// Guest
			if (!$status) {
				$htmlmessages .= '<div>' . $username . ' says:</div><div style="margin-left: 15px;">' . $message . '</div>'; 
				$textmessages .= $username . ' says:' . $eol . '	' . $message . $eol; 
			}
	
			$row = $SQL->selectnext();
		}
	}

	$htmlmessages = preg_replace("/(\r\n|\r|\n)/", '<br/>', $htmlmessages);
	
	// Add Plain Text Email
	$body = '--' . $mime_boundary . $eol;
	$body .= 'Content-type: text/plain; charset=utf-8' . $eol . $eol;
	$body .= $textmessages . $eol . $eol;
	
	
	$html = <<<END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--

div, p {
	font-family: Calibri, Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
}

//-->
</style>
</head>

<body>
<p><img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/ChatTranscript.gif" width="531" height="79" alt="Chat Transcript" /></p>
<p><strong>Chat Transcript:</strong></p>
<p>$htmlmessages</p>
<p><img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/LogoSmall.png" width="217" height="52" alt="stardevelop.com" /></p>
</body>
</html>
END;
	
	// Add HTML Email
	$body .= '--' . $mime_boundary . $eol;
	$body .= 'Content-type: text/html; charset=utf-8' . $eol . $eol;
	$body .= $html . $eol . $eol;
	$body .= "--" . $mime_boundary . "--" . $eol . $eol;
	
	$sendmail_path = ini_get('sendmail_path');
	
	if ($_REQUEST['Email'] != '') {
		mail($_REQUEST['Email'], $subject, $body, $headers);
	} else {
		mail($_SETTINGS['EMAIL'], $subject, $body, $headers);
	}


}

function Calls() {

	global $SQL;
	global $table_prefix;
	
	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['Operator'])){ $_REQUEST['Operator'] = ''; }
	if (!isset($_REQUEST['Status'])){ $_REQUEST['Status'] = ''; }
	
	if ($_REQUEST['ID'] != '' && $_REQUEST['Status'] != '') {
			$query = "UPDATE " . $table_prefix . "callback SET `operator` = '" . $_REQUEST['Operator'] . "', `status` = '" . $_REQUEST['Status'] . "' WHERE `id` = '" . $_REQUEST['ID'] . "'";
			$SQL->miscquery($query);
	}
	

	$query = "SELECT * FROM " . $table_prefix . "callback WHERE `status` <> '5' ORDER BY `datetime`";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
	
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Calls xmlns="urn:LiveHelp" IPAddress="<?php echo(ip_address()); ?>">
<?php
		while ($row) {
			if (is_array($row)) {
				$id = $row['id'];
				$name = $row['name'];
				$datetime = $row['datetime'];
				$email = $row['email'];
				$country = $row['country'];
				$timezone = $row['timezone'];
				$dial = $row['dial'];
				$telephone = $row['telephone'];
				$message = $row['message'];
				$operator = $row['operator'];
				$status = $row['status'];
?>
<Call ID="<?php echo($id); ?>" Name="<?php echo(xmlattribinvalidchars($name)); ?>" Email="<?php echo(xmlattribinvalidchars($email)); ?>" Operator="<?php echo(xmlattribinvalidchars($operator)); ?>" Status="<?php echo(xmlattribinvalidchars($status)); ?>">
<Datetime><?php echo($datetime); ?></Datetime>
<Country><?php echo(xmlelementinvalidchars($country)); ?></Country>
<Timezone><?php echo(xmlelementinvalidchars($timezone)); ?></Timezone>
<Telephone Prefix="<?php echo(xmlattribinvalidchars($dial)); ?>"><?php echo(xmlelementinvalidchars($telephone)); ?></Telephone>
<Message><?php echo(xmlelementinvalidchars($message)); ?></Message>
</Call>
<?php
		
				$row = $SQL->selectnext();
			}
		}	
?>
</Calls>
<?php
	} else {
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<Calls xmlns="urn:LiveHelp"/>
<?php
	}
	
	
}

function Upgrade() {

	global $SQL;
	global $table_prefix;

	// Automatic Upgrade
	$query = "SELECT `value` FROM `" . $table_prefix . "settings` WHERE `name` = 'ServerVersion';";
	$row = $SQL->selectquery($query);
	if (!is_array($row)) {
	
		// Upgrade database to Live Help Server Software 3.30
		if (file_exists('../install/mysql.schema.3.30.upgrade.txt')) {
		
			$sqlfile = file('../install/mysql.schema.3.30.upgrade.txt');
			if (is_array($sqlfile)) {
				$query = '';
				foreach ($sqlfile as $key => $line) {
					if (trim($line) != '' && substr(trim($line), 0, 1) != '#') {
						$line = str_replace('prefix_', $table_prefix, $line);
						$query .= trim($line); unset($line);
						if (strpos($query, ';') !== false) {
							if (function_exists('mysql_connect')) {
								$result = $SQL->miscquery($query);
								if ($result == false) { return '3.28'; }
							}
							$query = '';
						}
					}
				}
				unset($sqlfile);
			}
			
			$query = "INSERT INTO `" . $table_prefix . "settings` (`name`, `value`) VALUES ('ServerVersion', '3.30');";
			$SQL->miscquery($query);
			return '3.30';
		
		}
		
	}  else {
		// Check Database Schema Version
		$version = $row['value'];
		if ($version == '3.30') {
			// Upgrade database to Live Help Server Software 3.50
			if (file_exists('../install/mysql.schema.3.50.upgrade.txt')) {
			
				$sqlfile = file('../install/mysql.schema.3.50.upgrade.txt');
				if (is_array($sqlfile)) {
					foreach ($sqlfile as $key => $line) {
						if (trim($line) != '' && substr(trim($line), 0, 1) != '#') {
							$line = str_replace('prefix_', $table_prefix, $line);
							$query = trim($line); unset($line);
							if (strpos($query, ';') !== false) {
								if (function_exists('mysql_connect')) {
									$result = $SQL->miscquery($query);
									if ($result == false) { return '3.30'; }
								}
							}
						}
					}
					unset($sqlfile);
				}
				
				$query = "UPDATE `" . $table_prefix . "settings` SET `value` = '3.50' WHERE `" . $table_prefix . "settings`.`name` = 'ServerVersion' LIMIT 1;";
				$SQL->miscquery($query);
				return '3.50';
			
			}
		} elseif ($version == '3.50') {
		
			$query = "UPDATE `" . $table_prefix . "settings` SET `value` = '3.60' WHERE `" . $table_prefix . "settings`.`name` = 'ServerVersion' LIMIT 1;";
			$SQL->miscquery($query);
			return '3.60';
			
		} elseif ($version == '3.60') {
			// Upgrade database to Live Help Server Software 3.70
			if (file_exists('../install/mysql.schema.3.70.upgrade.txt')) {
			
				$sqlfile = file('../install/mysql.schema.3.70.upgrade.txt');
				if (is_array($sqlfile)) {
					foreach ($sqlfile as $key => $line) {
						if (trim($line) != '' && substr(trim($line), 0, 1) != '#') {
							$line = str_replace('prefix_', $table_prefix, $line);
							$query = trim($line); unset($line);
							if (strpos($query, ';') !== false) {
								if (function_exists('mysql_connect')) {
									$result = $SQL->miscquery($query);
									if ($result == false) { return '3.60'; }
								}
							}
						}
					}
					unset($sqlfile);
				}
				
				$query = "UPDATE `" . $table_prefix . "settings` SET `value` = '3.70' WHERE `" . $table_prefix . "settings`.`name` = 'ServerVersion' LIMIT 1;";
				$SQL->miscquery($query);
				return '3.70';
			}
		} elseif ($version == '3.70') {
			// Upgrade database to Live Help Server Software 3.80
			if (file_exists('../install/mysql.schema.3.80.upgrade.txt')) {
			
				$sqlfile = file('../install/mysql.schema.3.80.upgrade.txt');
				if (is_array($sqlfile)) {
					foreach ($sqlfile as $key => $line) {
						if (trim($line) != '' && substr(trim($line), 0, 1) != '#') {
							$line = str_replace('prefix_', $table_prefix, $line);
							$query = trim($line); unset($line);
							if (strpos($query, ';') !== false) {
								if (function_exists('mysql_connect')) {
									$result = $SQL->miscquery($query);
									if ($result == false) { return '3.70'; }
								}
							}
						}
					}
					unset($sqlfile);
				}
				
				$query = "UPDATE `" . $table_prefix . "settings` SET `value` = '3.80' WHERE `" . $table_prefix . "settings`.`name` = 'ServerVersion' LIMIT 1;";
				$SQL->miscquery($query);
				return '3.80';
			}
		}
		return $version;

	}
	
	return '3.28';

}

function Responses() {

	global $SQL;
	global $table_prefix;
	
	if (!isset($_REQUEST['ID'])){ $_REQUEST['ID'] = ''; }
	if (!isset($_REQUEST['Operator'])){ $_REQUEST['Operator'] = ''; }
	if (!isset($_REQUEST['Department'])){ $_REQUEST['Department'] = ''; }
	if (!isset($_REQUEST['ResponsesArray'])){ $_REQUEST['ResponsesArray'] = ''; }
	if (!isset($_REQUEST['Cached'])){ $_REQUEST['Cached'] = ''; }
	if (!isset($_REQUEST['Format'])){ $_REQUEST['Format'] = 'xml'; }

	if ($_REQUEST['ResponsesArray'] != '') {
		$lines = preg_split("/(\r\n|\r|\n)/", trim($_REQUEST['ResponsesArray']));

		// Loop through the responses
		foreach ($lines as $key => $line) {

			$id = ''; $name = ''; $category = ''; $content = ''; $type = ''; $tags = '';
			list($id, $name, $category, $content, $type, $tags) = explode('|', $line);
			
			if ($name != '' && $content != '') {
				if ($id != '') {
					$query = "SELECT * FROM " . $table_prefix . "responses WHERE `id` = '$id' LIMIT 1";
					$row = $SQL->selectquery($query);
					if (is_array($row)) {
						$query = "UPDATE " . $table_prefix . "responses SET `name` = '$name', `category` = '$category', `type` = '$type', `content` = '$content', `tags` = '$tags', `datetime` = NOW() WHERE `id` = '$id'";
					}
				}
				else {
					$query = "INSERT INTO " . $table_prefix . "responses(`name`, `datetime`, `category`, `type`, `content`, `tags`) VALUES('$name', NOW(), '$category', '$type', '$content', '$tags')";
				}
			}
			$result = $SQL->miscquery($query);
			
		}
	}
	
	if ($_REQUEST['ID'] != '') {
		$id = $_REQUEST['ID'];
		$query = "DELETE FROM " . $table_prefix . "responses WHERE `id` = '$id' LIMIT 1";
		$SQL->miscquery($query);
	}
	
	$query = "SELECT * FROM " . $table_prefix . "responses ORDER BY `type` , `category`";
	if ($_REQUEST['Cached'] != '') {
		$query = "SELECT * FROM " . $table_prefix . "responses WHERE `datetime` > '" . $_REQUEST['Cached'] . "' ORDER BY `type` , `category`";
	}
	$rows = $SQL->selectall($query);

	if ($_REQUEST['Format'] == 'json') {
		header('Content-type: application/json; charset=utf-8');

		$json = array();
		$text = array();
		$hyperlink = array();
		$image = array();
		$push = array();
		$javascript = array();
		$lastupdated = '';
		
		if ($rows != false && count($rows) > 0) {
		
			foreach($rows as $key => $row) {
			
				$id = $row['id'];
				$name = $row['name'];
				$datetime = $row['datetime'];
				$content = $row['content'];
				$category = $row['category'];
				$type = $row['type'];
				$tags = $row['tags'];
				if ($tags != '') {
					$tags = explode(';', $tags);
				} else {
					$tags = array();
				}
				
				// Last Updated
				if ($datetime == '') { $lastupdated = $datetime; }
				if (strtotime($datetime) - strtotime($lastupdated) > 0) {
					$lastupdated = $datetime;
				}
				
				switch($type) {
					case '1': // Text
						$text[] = array('ID' => $id, 'Name' => $name, 'Content' => $content, 'Tags' => $tags);
						break;
					case '2': // Hyperlink
						$hyperlink[] = array('ID' => $id, 'Name' => $name, 'Content' => $content, 'Tags' => $tags);
						break;
					case '3': // Image
						$image[] = array('ID' => $id, 'Name' => $name, 'Content' => $content, 'Tags' => $tags);
						break;
					case '4': // PUSH
						$push[] = array('ID' => $id, 'Name' => $name, 'Content' => $content, 'Tags' => $tags);
						break;
					case '5': //JavaScript
						$javascript[] = array('ID' => $id, 'Name' => $name, 'Content' => $content, 'Tags' => $tags);
						break;
				}
			}
			
			$json['Responses'] = array('LastUpdated' => $lastupdated,'Text' => $text, 'Hyperlink' => $hyperlink, 'Image' => $image, 'PUSH' => $push, 'JavaScript' => $javascript);
			
			echo(json_encode($json));
			exit();
			
		} else {
		
			if (strpos(php_sapi_name(), 'cgi') === false ) { header('HTTP/1.0 304 Not Modified'); } else { header('Status: 304 Not Modified'); }
			exit();
		}
		
	}
	
	header('Content-type: text/xml; charset=utf-8');
	echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");

?>
<Responses xmlns="urn:LiveHelp">
  <Text>
<?php

	$textrows = $rows;
	if (is_array($textrows)) {
		while (count($textrows) > 0) {
			$row = $textrows[count($textrows) - 1];
			if (is_array($row)) {
				$id = $row['id'];
				$name = xmlelementinvalidchars($row['name']);
				$content = xmlelementinvalidchars($row['content']);
				$category = xmlelementinvalidchars($row['category']);
				$type = $row['type'];
				
				if ($type == '1') {
					if ($category != '') {
?>
	<Category Name="<?php echo($category); ?>">
<?php
						for($i = count($textrows) - 1; $i >= 0; $i--) {
							$row = $textrows[$i];
							if ($row['type'] == '1' && $row['category'] == $category) {
								$id = $row['id'];
								$name = xmlelementinvalidchars($row['name']);
								$content = xmlelementinvalidchars($row['content']);
								$type = $row['type'];
?>
		<Response ID="<?php echo($id); ?>">
		  <Name><?php echo($name); ?></Name>
		  <Content><?php echo($content); ?></Content>
		  <Tags>
<?php
								$tags = explode(';', $row['tags']);
								if (count($tags) > 0) {
									foreach($tags as $key => $tag) {
?>
										$tag = xmlelementinvalidchars($tag);
			<Tag><?php echo($tag); ?></Tag>
<?php
									}
								}
?>
		  </Tags>
		</Response>
<?php
								array_splice($textrows, $i, 1);
							}
						}
?>
	</Category>
<?php
					} else {
?>
    <Response ID="<?php echo($id); ?>">
      <Name><?php echo($name); ?></Name>
      <Content><?php echo($content); ?></Content>
      <Tags>
<?php
						$tags = explode(';', $row['tags']);
						if (count($tags) > 0) {
							foreach($tags as $key => $tag) {
?>
								$tag = xmlelementinvalidchars($tag);
        <Tag><?php echo($tag); ?></Tag>
<?php
							}
						}
?>
      </Tags>
    </Response>
<?php
						$popped = array_pop($textrows);
					}
				} else {
					$popped = array_pop($textrows);
				}
			} else {
				$popped = array_pop($textrows);
			}
		}
	}
?>
  </Text>
  <Hyperlink>
<?php
	$textrows = $rows;
	if (is_array($textrows)) {
		while (count($textrows) > 0) {
			$row = $textrows[count($textrows) - 1];
			if (is_array($row)) {
				$id = $row['id'];
				$name = xmlelementinvalidchars($row['name']);
				$content = xmlelementinvalidchars($row['content']);
				$category = xmlelementinvalidchars($row['category']);
				$type = $row['type'];
				
				if ($type == '2') {
					if ($category != '') {
?>
	<Category Name="<?php echo($category); ?>">
<?php
						for($i = count($textrows) - 1; $i >= 0; $i--) {
							$row = $textrows[$i];
							if ($row['type'] == '2' && $row['category'] == $category) {
								$id = $row['id'];
								$name = xmlelementinvalidchars($row['name']);
								$content = xmlelementinvalidchars($row['content']);
								$type = $row['type'];
?>
		<Response ID="<?php echo($id); ?>">
		  <Name><?php echo($name); ?></Name>
		  <Content><?php echo($content); ?></Content>
		  <Tags>
<?php
								$tags = explode(';', $row['tags']);
								if (count($tags) > 0) {
									foreach($tags as $key => $tag) {
?>
										$tag = xmlelementinvalidchars($tag);
			<Tag><?php echo($tag); ?></Tag>
<?php
									}
								}
?>
		  </Tags>
		</Response>
<?php
								array_splice($textrows, $i, 1);
							}
						}
?>
	</Category>
<?php
					} else {
?>
    <Response ID="<?php echo($id); ?>">
      <Name><?php echo($name); ?></Name>
      <Content><?php echo($content); ?></Content>
      <Tags>
<?php
						$tags = explode(';', $row['tags']);
						if (count($tags) > 0) {
							foreach($tags as $key => $tag) {
?>
								$tag = xmlelementinvalidchars($tag);
        <Tag><?php echo($tag); ?></Tag>
<?php
							}
						}
?>
      </Tags>
    </Response>
<?php
						$popped = array_pop($textrows);
					}
				} else {
					$popped = array_pop($textrows);
				}
			} else {
				$popped = array_pop($textrows);
			}
		}
	}
?>
  </Hyperlink>
  <Image>
<?php
	$textrows = $rows;
	if (is_array($textrows)) {
		while (count($textrows) > 0) {
			$row = $textrows[count($textrows) - 1];
			if (is_array($row)) {
				$id = $row['id'];
				$name = xmlelementinvalidchars($row['name']);
				$content = xmlelementinvalidchars($row['content']);
				$category = xmlelementinvalidchars($row['category']);
				$type = $row['type'];
				
				if ($type == '3') {
					if ($category != '') {
?>
	<Category Name="<?php echo($category); ?>">
<?php
						for($i = count($textrows) - 1; $i >= 0; $i--) {
							$row = $textrows[$i];
							if ($row['type'] == '3' && $row['category'] == $category) {
								$id = $row['id'];
								$name = xmlelementinvalidchars($row['name']);
								$content = xmlelementinvalidchars($row['content']);
								$type = $row['type'];
?>
		<Response ID="<?php echo($id); ?>">
		  <Name><?php echo($name); ?></Name>
		  <Content><?php echo($content); ?></Content>
		  <Tags>
<?php
								$tags = explode(';', $row['tags']);
								if (count($tags) > 0) {
									foreach($tags as $key => $tag) {
?>
										$tag = xmlelementinvalidchars($tag);
			<Tag><?php echo($tag); ?></Tag>
<?php
									}
								}
?>
		  </Tags>
		</Response>
<?php
								array_splice($textrows, $i, 1);
							}
						}
?>
	</Category>
<?php
					} else {
?>
    <Response ID="<?php echo($id); ?>">
      <Name><?php echo($name); ?></Name>
      <Content><?php echo($content); ?></Content>
      <Tags>
<?php
						$tags = explode(';', $row['tags']);
						if (count($tags) > 0) {
							foreach($tags as $key => $tag) {
?>
								$tag = xmlelementinvalidchars($tag);
        <Tag><?php echo($tag); ?></Tag>
<?php
							}
						}
?>
      </Tags>
    </Response>
<?php
						$popped = array_pop($textrows);
					}
				} else {
					$popped = array_pop($textrows);
				}
			} else {
				$popped = array_pop($textrows);
			}
		}
	}
?>
  </Image>
  <PUSH>
<?php
	$textrows = $rows;
	if (is_array($textrows)) {
		while (count($textrows) > 0) {
			$row = $textrows[count($textrows) - 1];
			if (is_array($row)) {
				$id = $row['id'];
				$name = xmlelementinvalidchars($row['name']);
				$content = xmlelementinvalidchars($row['content']);
				$category = xmlelementinvalidchars($row['category']);
				$type = $row['type'];
				
				if ($type == '4') {
					if ($category != '') {
?>
	<Category Name="<?php echo($category); ?>">
<?php
						for($i = count($textrows) - 1; $i >= 0; $i--) {
							$row = $textrows[$i];
							if ($row['type'] == '4' && $row['category'] == $category) {
								$id = $row['id'];
								$name = xmlelementinvalidchars($row['name']);
								$content = xmlelementinvalidchars($row['content']);
								$type = $row['type'];
?>
		<Response ID="<?php echo($id); ?>">
		  <Name><?php echo($name); ?></Name>
		  <Content><?php echo($content); ?></Content>
		  <Tags>
<?php
								$tags = explode(';', $row['tags']);
								if (count($tags) > 0) {
									foreach($tags as $key => $tag) {
?>
										$tag = xmlelementinvalidchars($tag);
			<Tag><?php echo($tag); ?></Tag>
<?php
									}
								}
?>
		  </Tags>
		</Response>
<?php
								array_splice($textrows, $i, 1);
							}
						}
?>
	</Category>
<?php
					} else {
?>
    <Response ID="<?php echo($id); ?>">
      <Name><?php echo($name); ?></Name>
      <Content><?php echo($content); ?></Content>
      <Tags>
<?php
						$tags = explode(';', $row['tags']);
						if (count($tags) > 0) {
							foreach($tags as $key => $tag) {
?>
								$tag = xmlelementinvalidchars($tag);
        <Tag><?php echo($tag); ?></Tag>
<?php
							}
						}
?>
      </Tags>
    </Response>
<?php
						$popped = array_pop($textrows);
					}
				} else {
					$popped = array_pop($textrows);
				}
			} else {
				$popped = array_pop($textrows);
			}
		}
	}
?>
  </PUSH>
  <JavaScript>
<?php
	$textrows = $rows;
	if (is_array($textrows)) {
		while (count($textrows) > 0) {
			$row = $textrows[count($textrows) - 1];
			if (is_array($row)) {
				$id = $row['id'];
				$name = xmlelementinvalidchars($row['name']);
				$content = xmlelementinvalidchars($row['content']);
				$category = xmlelementinvalidchars($row['category']);
				$type = $row['type'];
				
				if ($type == '5') {
					if ($category != '') {
?>
	<Category Name="<?php echo($category); ?>">
<?php
						for($i = count($textrows) - 1; $i >= 0; $i--) {
							$row = $textrows[$i];
							if ($row['type'] == '5' && $row['category'] == $category) {
								$id = $row['id'];
								$name = xmlelementinvalidchars($row['name']);
								$content = xmlelementinvalidchars($row['content']);
								$type = $row['type'];
?>
		<Response ID="<?php echo($id); ?>">
		  <Name><?php echo($name); ?></Name>
		  <Content><?php echo($content); ?></Content>
		  <Tags>
<?php
								$tags = explode(';', $row['tags']);
								if (count($tags) > 0) {
									foreach($tags as $key => $tag) {
?>
										$tag = xmlelementinvalidchars($tag);
			<Tag><?php echo($tag); ?></Tag>
<?php
									}
								}
?>
		  </Tags>
		</Response>
<?php
								array_splice($textrows, $i, 1);
							}
						}
?>
	</Category>
<?php
					} else {
?>
    <Response ID="<?php echo($id); ?>">
      <Name><?php echo($name); ?></Name>
      <Content><?php echo($content); ?></Content>
      <Tags>
<?php
						$tags = explode(';', $row['tags']);
						if (count($tags) > 0) {
							foreach($tags as $key => $tag) {
?>
								$tag = xmlelementinvalidchars($tag);
        <Tag><?php echo($tag); ?></Tag>
<?php
							}
						}
?>
      </Tags>
    </Response>
<?php
						$popped = array_pop($textrows);
					}
				} else {
					$popped = array_pop($textrows);
				}
			} else {
				$popped = array_pop($textrows);
			}
		}
	}
?>
  </JavaScript>
</Responses>
<?php

}

function ResetPassword() {

	global $_OPERATOR;
	global $_SETTINGS;
	global $SQL;
	global $table_prefix;

	if (!isset($_REQUEST['Username'])){ $_REQUEST['Username'] = ''; }
	if (!isset($_REQUEST['Email'])){ $_REQUEST['Email'] = ''; }

	// Determine EOL
	$server = strtoupper(substr($_SERVER['OS'], 0, 3));
	if ($server == 'WIN') { 
		$eol = "\r\n"; 
	} elseif ($server == 'MAC') { 
		$eol = "\r"; 
	} else { 
		$eol = "\n"; 
	}

	// Boundry for marking the split & Multitype Headers 
	$mime_boundary = sha1(time());
	$subject = '=?UTF-8?B?' . base64_encode($_SETTINGS['NAME'] . ' Password Reset') . '?=';
	
	$headers = 'From: "=?UTF-8?B?' . base64_encode($_SETTINGS['NAME']) . '?=" <' . $_SETTINGS['EMAIL'] . '>' . $eol;
	$headers .= 'Reply-To: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
	$headers .= 'Return-Path: <' . $_SETTINGS['EMAIL'] . '>' . $eol;
	$headers .= 'MIME-Version: 1.0' . $eol; 
	$headers .= 'Content-Type: multipart/alternative; boundary="' . $mime_boundary . '"' . $eol;	

	$password = '';
	$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	for ($index = 1; $index <= 10; $index++) {
   		$number = rand(1, strlen($chars));
   		$password .= substr($chars, $number - 1, 1);
 	}
	
	// Change Password
	if (function_exists('hash') && in_array('sha512', hash_algos())) {
		$hash = hash('sha512', $password);
	} else {
		$hash = sha1($password);
	}
	
	// Reset Password
	$query = "UPDATE " . $table_prefix . "users SET `password` = '$hash' WHERE `username` = '{$_REQUEST['Username']}' AND `email` = '{$_REQUEST['Email']}' LIMIT 1";
	$result = $SQL->miscquery($query);
	
	if ($result == true) {
	
		// Add Plain Text Email
		//$body = '--' . $mime_boundary . $eol;
		//$body .= 'Content-type: text/plain; charset=utf-8' . $eol . $eol;
		//$body .= $textmessages . $eol . $eol;
		
		$html = <<<END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
div, p {
	font-family: Calibri, Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
}
//-->
</style>
</head>

<body>
<div><img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/PasswordReset.gif" width="531" height="79" alt="Password Reset" /></div>
<div><strong>Password Reset:</strong></div>
<div></div><br/>
<div>Server: {$_SETTINGS['DOMAIN']}</div>
<div>Username: {$_REQUEST['Username']}</div>
<div>Password: $password</div><br/>
<div><img src="{$_SETTINGS['URL']}/livehelp/locale/en/images/LogoSmall.png" width="217" height="52" alt="stardevelop.com" /></div>
</body>
</html>
END;
	
		// Add HTML Email
		$body .= '--' . $mime_boundary . $eol;
		$body .= 'Content-type: text/html; charset=utf-8' . $eol . $eol;
		$body .= $html . $eol . $eol;
		$body .= "--" . $mime_boundary . "--" . $eol . $eol;
		mail($_REQUEST['Email'], $subject, $body, $headers);
		
		header('Content-type: text/xml; charset=utf-8');
		echo('<?xml version="1.0" encoding="utf-8"?>' . "\n");
?>
<ResetPassword xmlns="urn:LiveHelp"></ResetPassword>
<?php
		
	}
	else {
		if (strpos(php_sapi_name(), 'cgi') === false ) { header('HTTP/1.0 403 Forbidden'); } else { header('Status: 403 Forbidden'); }	
	}

}

?>