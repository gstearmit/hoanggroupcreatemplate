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
include('../include/class.cookie.php');
include('../include/config.php');
include('../include/auth.php');

if ($current_privilege > 2){
	header('Location: ./denied.php');
	exit();
}

if (!isset($_REQUEST['DATE'])){ $_REQUEST['DATE'] = ''; }
if (!isset($_REQUEST['SKIP'])){ $_REQUEST['SKIP'] = 0; }
if (!isset($_REQUEST['LIMIT'])){ $_REQUEST['LIMIT'] = 0; }

$date = $_REQUEST['DATE'];
$skip = $_REQUEST['SKIP'];
$limit = $_REQUEST['LIMIT'];

list($day, $month, $year) = split('[-]', $date);
$txt_date = date('d F Y', mktime(date('H') + $timezonehours, date('i') + $timezoneminutes, 0, $month, $day, $year));

header('Content-type: text/html; charset=utf-8');

if (file_exists('../locale/' . LANGUAGE_TYPE . '/admin.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/admin.php');
}
else {
	include('../locale/en/admin.php');
}

if (LANGUAGE_TYPE != 'en') {	  
	switch ($month) { 
		case 'January':
			$month = $january_label; 
			break;
		case 'February':
			$month = $february_label; 
			break;
		case 'March':
			$month = $march_label; 
			break;
		case 'April':
			$month = $april_label; 
			break;
		case 'May':
			$month = $may_label; 
			break;
		case 'June':
			$month = $june_label; 
			break;
		case 'July':
			$month = $july_label; 
			break;
		case 'August':
			$month = $august_label; 
			break;
		case 'September':
			$month = $september_label; 
			break;
		case 'October':
			$month = $october_label; 
			break;
		case 'November':
			$month = $november_label; 
			break;
		case 'December':
			$month = $december_label; 
			break;
	}
}		

if ($limit == 0) $limit = 6;

function show_reports($limit, $total, $skip) {
	global $page_label;
	
	if ($total_products > $limit) { 
	  echo('Page: ');   
	  $paginas = ceil(($total/$limit));
	   
	  if (!$_REQUEST['SKIP']) { 
	   $comeco = 0; 
	  } else { 
	   $comeco = $_REQUEST['SKIP']; 
	  } 
	
	  for ($i = 0; $i < $paginas; $i++) { 
		$page = $i+1;
		if ($skip == ($i * $limit)){
		  echo(' ' . $page . ' |'); 
		  }
		else {
			echo('<a href="#" onClick="submitForm(' . $i * $limit . ');" class="normlink">' . $page . '</a> |'); 
		  }
		} 
	  }  
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function submitForm(skipped) {
	document.reports.SKIP.value = skipped;
	void(document.reports.submit());
}
/-->
</script>
<style type="text/css">
<!--
.background {
	background-image: url(../images/background_reports.gif);
	background-repeat: no-repeat;
	background-position: right bottom;
}
-->
</style>
</head>
<body class="background"> 
<div align="center"> 
  <form name="reports" method="post" action="./reports_daily_summary.php?DATE=<?php echo($date); ?>"> 
    <table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
        <td width="22"><strong><img src="../images/reports_small.gif" alt="<?php echo($daily_reports_label); ?>" width="22" height="22" border="0"></strong></td> 
        <td><em class="heading"><?php echo($daily_reports_label); ?> - <?php echo($txt_date); ?></em></td> 
      </tr> 
      <tr> 
        <td colspan="2"> <?php
	  // Count the total number of sessions for the passed date
	  $query = "SELECT count(`id`) FROM " . $table_prefix . "sessions WHERE DATE_FORMAT(DATE_ADD(`datetime`, INTERVAL '$timezonehours:$timezoneminutes' HOUR_MINUTE), '%d-%m-%Y') = '$date' AND (`active` > '0' OR `active` = '-3')";
	  $row = $SQL->selectquery($query); 
	  if (is_array($row)) {
			$total_sessions = $row['count(`id`)'];
	  }
	  else {
			$total_sessions = 0;
	  }
	  ?> 
          <table width="400" height="25" border="0" align="center" cellpadding="4" cellspacing="0"> 
            <tr height="5"> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
              <td></td> 
            </tr> 
            <tr> 
              <td></td> 
              <td><strong><?php echo($username_label); ?></strong></td> 
              <td><strong><?php echo($department_label); ?></strong></td> 
              <td><strong><?php echo($rating_label); ?></strong></td> 
              <td><strong><?php echo($email_label); ?></strong></td> 
            </tr> 
            <?php
	  $query = "SELECT `id`, `request`, `username`, `email`, `department`, `rating`, (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`refresh`)) AS `ttl_refresh` FROM " . $table_prefix . "sessions WHERE DATE_FORMAT(DATE_ADD(`datetime`, INTERVAL '$timezonehours:$timezoneminutes' HOUR_MINUTE), '%d-%m-%Y') = '$date' AND active != '0' LIMIT $skip, $limit";
	  $rows = $SQL->selectall($query);
	  
	  $colour = false;
	  if (is_array($rows)) {
	  		foreach ($rows as $key => $row) {
				if (is_array($row)) {
				
					if ($colour == true) {
						$colour = false;
					}
					elseif ($colour == false) {
						$rgb = '#E4F2FB';
						$colour = true;
					}
					
					$login_id = $row['id'];
					$request = $row['request'];
					$username = $row['username'];
					$department = $row['department'];
					$rating = $row['rating'];
					$email = $row['email'];
					$ttl_refresh = $row['ttl_refresh'];
					
					switch ($rating) { 
						case '-1':
							$rating = $unavailable_label; 
							break;
						case '1':
							$rating = $poor_label; 
							break;
						case '2':
							$rating = $fair_label; 
							break;
						case '3':
							$rating = $good_label; 
							break;
						case '4':
							$rating = $very_good_label; 
							break;
						case '5':
							$rating = $excellent_label; 
							break;
					}

	  ?> 
            <tr<?php if($colour == false) { echo(' bgcolor="E4F2FB"'); } ?>  onMouseOver="this.style.background='#CAE6F7';" onMouseOut="this.style.background='<?php if($colour == false) { echo('E4F2FB'); } else { echo('#FFFFFF'); } ?>';" onClick="location.href = './visitors_index.php?<?php echo('REQUEST=' . $request); if($ttl_refresh < $connection_timeout) { echo('&PREVIOUS=false'); } else { echo('&PREVIOUS=true'); }  ?>';" > 
              <td><img src="../images/<?php if($ttl_refresh < $connection_timeout) { echo('mini_chatting.gif'); } else { echo('mini_chat_ended.gif'); } ?>" alt="<?php if($ttl_refresh < $connection_timeout) { echo($currently_chatting_label); } else { echo($chat_ended_label); } ?>"></td> 
              <td><?php echo($username); ?></td> 
              <td><?php echo($department); ?></td> 
              <td><?php echo($rating); ?></td> 
              <td><?php if ($email != '') { ?> 
                <a href="mailto:<?php echo($email); ?>" class="normlink"><?php echo($send_email_label); ?></a> 
                <?php } else { echo($unavailable_label); } ?></td> 
            </tr> 
            <?php
						}
			}
	  }
	  ?> 
            <tr> 
              <td colspan="5"><div align="right"> 
                  <input name="SKIP" type="hidden" id="SKIP" value="<?php echo($skip); ?>"> 
                  <input name="LIMIT" type="hidden" id="LIMIT" value="<?php echo($limit); ?>"> 
                  <?php show_product_pages($limit, $total_sessions, $skip); ?> 
                </div></td> 
            </tr> 
          </table></td> 
      </tr> 
    </table> 
  </form> 
</div> 
<div align="right"><a href="reports_index.php" class="normlink"><?php echo($back_to_daily_reports_label); ?></a></div>
</body>
</html>
