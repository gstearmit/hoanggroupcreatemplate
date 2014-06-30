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

header('Content-type: text/html; charset=utf-8');

if (file_exists('../locale/' . LANGUAGE_TYPE . '/admin.php')) {
	include('../locale/' . LANGUAGE_TYPE . '/admin.php');
}
else {
	include('../locale/en/admin.php');
}

include('../include/functions.php');

if (!isset($_REQUEST['RECORD'])){ $_REQUEST['RECORD'] = 0; }
if (!isset($_REQUEST['REQUEST'])){ $_REQUEST['REQUEST'] = ''; }
if (!isset($_REQUEST['REQUEST'])){ $_REQUEST['REQUEST'] = ''; }
if (!isset($_REQUEST['PREVIOUS'])){ $_REQUEST['PREVIOUS'] = ''; }

$current_record = $_REQUEST['RECORD'];
$current_record_request = $_REQUEST['REQUEST'];
$current_record_previous = $_REQUEST['PREVIOUS'];

$current_request_request_flag = '';
$current_request_id = '';
$current_request_ip_address = '';
$total_records = 0;

if ($current_record_request != '') {
	$query = "SELECT *, ((UNIX_TIMESTAMP(`refresh`) - UNIX_TIMESTAMP(`datetime`))) AS `time_on_site`, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`request`))) AS `time_on_page` FROM " . $table_prefix . "requests WHERE `id` = '$current_record_request' ORDER BY `request` DESC";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {	
		$current_request_id = $row['id'];
		$current_request_ip_address = $row['ipaddress'];
		$current_request_user_agent = $row['useragent'];
		$current_request_resolution = $row['resolution'];
		$current_request_current_page = $row['url'];
		$current_request_current_page_title = $row['title'];
		$current_request_referrer = $row['referrer'];
		$current_request_time_on_page = $row['time_on_page'];
		$current_request_page_path = $row['path'];
		$current_request_time_on_site = $row['time_on_site'];
		$current_request_request_flag = $row['initiate'];
		$total_records++;
	}
}
else {

	$query = "SELECT count(`id`) FROM " . $table_prefix . "requests WHERE `refresh` > NOW() - INTERVAL $visitor_timeout SECOND AND status = '0'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$total_records = $row['count(`id`)'];

		$query = "SELECT *, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`datetime`))) AS `time_on_site`, ((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`request`))) AS `time_on_page` FROM " . $table_prefix . "requests WHERE `refresh` > NOW() - INTERVAL $visitor_timeout SECOND AND `status` = '0' ORDER BY `request` DESC LIMIT $current_record, 1";
		$rows = $SQL->selectall($query);
		if (is_array($rows)) {
			foreach ($rows as $key => $row) {
				if (is_array($row)) {
					$current_request_id = $row['id'];
					$current_request_ip_address = $row['ipaddress'];
					$current_request_user_agent = $row['useragent'];
					$current_request_resolution = $row['resolution'];
					$current_request_country = $row['country'];
					$current_request_current_page = $row['url'];
					$current_request_current_page_title = $row['title'];
					$current_request_referrer = $row['referrer'];
					$current_request_time_on_page = $row['time_on_page'];
					$current_request_page_path = $row['path'];
					$current_request_time_on_site = $row['time_on_site'];
					$current_request_request_flag = $row['initiate'];
				}
			}
		}
	}
}

// Count the number of sessions that are associated with the request's IP address
if ($current_request_ip_address != '') {
	$query = "SELECT count(`ipaddress`) FROM " . $table_prefix . "requests WHERE `ipaddress` = '$current_request_ip_address'";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$current_request_num_sessions = $row['count(`ipaddress`)'];
	}
}

$current_request_support_name = '';
$current_request_session_active = '';
if ($current_request_id != '') {

	if ($_SETTINGS['LIMITHISTORY'] > 0) {
		$history = explode(';', $current_request_page_path);
		$path = array();
		if (count($history) > $_SETTINGS['LIMITHISTORY']) {
			for ($i = 0; $i < $_SETTINGS['LIMITHISTORY']; $i++) {
					array_unshift($path, array_pop($history));
			}
			$current_request_page_path = implode('; ', $path);
		}
	}

	// Get the supporters name of the chat request if currently chatting.
	$query = "SELECT `department`, `rating`, `active` FROM " . $table_prefix . "sessions WHERE `request` = '$current_request_id' ORDER BY `datetime` DESC LIMIT 1";
	$row = $SQL->selectquery($query);
	if (is_array($row)) {
		$current_request_department = $row['department'];
		$current_request_rating = $row['rating'];
		$current_request_active = $row['active'];
		if ($current_request_active == '-1' || $current_request_active == '-3') {
			// Display the rating of the ended chat request
			if ($current_request_rating > 0) {
				$current_request_initiate_status = $initiated_chatted_label . ' - ' . $rating_label . ' (' . $current_request_rating . '/5)';
			}
			else {
				$current_request_initiate_status = $initiated_chatted_label . ' - ' . ' (' . $unavailable_label . ')';
			}
		}
		else {
			if ($current_request_active > 0) {
				// Get the supporters name of the chat request if currently chatting.
				$query = "SELECT `firstname`, `lastname` FROM " . $table_prefix . "users WHERE `id` = '$current_request_active'";
				$row = $SQL->selectquery($query);
				if (is_array($row)) {
					$current_request_support_name = $row['firstname'] . ' ' . $row['lastname'];
					$current_request_initiate_status = $initiated_chatting_label . ' (' . $current_request_support_name . ')';
				}
				else {
					$current_request_initiate_status = $initiated_chatting_label . ' (' . $unavailable_label . ')';
				}
			}
			else {
				if ($current_request_department != '') {
					$current_request_initiate_status = $initiated_pending_label . ' (' . $current_request_department . ')';
				}
				else {
					$current_request_initiate_status = $initiated_pending_label;
				}
			}
		}
	}
	else {
		
		// The Site Visitor has not been sent an Initiate Chat request..
		if ($current_request_request_flag == '0'){
			$current_request_initiate_status = $initiated_default_label;
		}
		// displayed the request..
		elseif ($current_request_request_flag == '-1') {
			$current_request_initiate_status = $initiated_waiting_label;
		}
		// accepted the request..
		elseif ($current_request_request_flag == '-2') {
			$current_request_initiate_status = $initiated_accepted_label;
		}
		// declined the request..
		elseif ($current_request_request_flag == '-3') {
			$current_request_initiate_status = $initiated_declined_label;
		}
		// sent a request and waiting to open on screen..
		else {
			$current_request_initiate_status = $initiated_sending_label;
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
<style type="text/css">

.visitorstable {
	border: thin dashed #6DB4D3;
}
.visitorscelltop {
	border-top-width: 3px;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #F3F3F3;
}

.background {
	background-image: url(../images/background_visitor.gif);
	background-repeat: no-repeat;
	background-position: right bottom;
}
-->
</style>
</head>
<body class="background">
<div align="center">
  <table width="425" border="0">
    <tr>
      <td width="25"><div align="center"><strong><img src="../images/identity.gif" alt="<?php if($current_record_previous == true) { echo($previous_visitors_label); } else {  echo($online_visitors_label); } ?>" width="22" height="22" border="0"></strong></div></td>
      <td width="400" colspan="2"><em class="heading">
        <?php if ($current_record_previous == true) { echo($previous_visitors_label); } else { echo($online_visitors_label); } ?>
        - </em></td>
    </tr>
    <?php
	  if ($total_records > 0){
	  ?>
    <tr>
      <td width="25">&nbsp;</td>
      <td width="400"><div align="left" class="small"><em><?php echo($current_record_label); ?>:
          <?php if ($total_records == 0) { echo('0'); } else { echo($current_record + 1); } ?>
          / <?php echo($total_records); ?></em></div></td>
      <td width="400"><div align="right">
          <table border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td class="small"><a href="#" onClick="javascript:document.location.reload(true);" class="normlink"><?php echo($refresh_label); ?></a> / <a href="hide_visitor.php?REQUEST=<?php echo($current_request_id); ?>" class="normlink"><?php echo($hide_label); ?> <?php echo($record_label); ?></a></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <?php
	  }
	  ?>
    <tr>
      <td width="25">&nbsp;</td>
      <td width="400" colspan="2"><?php
	  if ($total_records > 0) {
	  ?>
        <table width="400" border="0" align="center" cellpadding="2" cellspacing="2" class="visitorstable">
          <tr>
            <td width="5" rowspan="2" bgcolor="#F3F3F3">&nbsp;</td>
            <td colspan="3"><table border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="175" valign="top" class="small"><?php echo($hostname_label); ?>:</td>
                  <td width="250" class="small"><em><?php echo($current_request_ip_address); ?> (<?php echo($current_request_num_sessions); ?>) </em></td>
                </tr>
                <tr>
                  <td width="175" valign="top" class="small"><?php echo($user_agent_label); ?>:</td>
                  <td width="250" class="small"><em><?php echo($current_request_user_agent); ?> </em></td>
                </tr>
                <tr>
                  <td width="175" valign="top" class="small"><?php echo($resolution_label); ?>:</td>
                  <td width="250" class="small"><em><?php
				  if ($current_request_resolution == '') {
				  		$current_request_resolution = $unavailable_label;
				  }
				  echo($current_request_resolution);
				  ?></em></td>
                </tr>
                <?php
				if ($_SETTINGS['IP2COUNTRY'] == true) {
				?>
                <tr>
                  <td valign="top" class="small"><?php echo($country_label); ?>:</td>
                  <td class="small"><em><?php echo($current_request_country); ?></em></td>
                </tr>
                <?php
				}
				?>
                <tr>
                  <td valign="top" class="small"><?php echo($referrer_label); ?>:</td>
                  <td class="small"><em>
                    <?php
				  // Set the referrer as appropriate
				  if ($current_request_referrer != '' && $current_request_referrer != 'Direct Visit / Bookmark') {
						$current_request_referrer_title = $current_request_referrer;
						if (strlen($current_request_referrer) > 40) {
							$current_request_referrer_title = substr($current_request_referrer, 0, 40) . "...";
						}
				  ?>
                    <a href="<?php echo($current_request_referrer); ?>" target="_blank" class="normlink"><?php echo($current_request_referrer_title); ?></a>
                    <?php
				  }
				  elseif ($current_request_referrer == 'Direct Visit / Bookmark') {
				  		echo($current_request_referrer);
				  }
				  else {
						echo($unavailable_label);
				  }	
				  ?>
                    </em></td>
                </tr>
                <tr>
                  <td width="175" valign="top" class="small"><?php echo($current_url_label); ?>:</td>
                  <td width="250" class="small"><em>
                    <?php
				  if ($current_request_current_page != '' && $current_request_current_page_title != '') {
				  ?>
                    <a href="<?php echo($current_request_current_page); ?>" target="_blank" class="normlink"><?php echo($current_request_current_page_title); ?></a>
                    <?php
				  }
				  else {
				  	echo($unavailable_label);
				  }
				  ?>
                    </em></td>
                </tr>
                <tr>
                  <td valign="top" class="small"><?php echo($time_on_page_label); ?>:</td>
                  <td class="small"><em><?php echo(time_layout($current_request_time_on_page)); ?></em></td>
                </tr>
                <tr>
                  <td valign="top" class="small"><?php echo($initiate_chat_status_label); ?>:</td>
                  <td valign="top" class="small"><em><?php echo($current_request_initiate_status); ?></em></td>
                </tr>
                <tr>
                  <td width="175" valign="top" class="small"><?php echo($page_path_label); ?>:</td>
                  <td width="250" valign="top" class="small"><p><em>
                      <textarea name="textarea" cols="40" rows="2" readonly="readonly" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: italic;" ><?php echo($current_request_page_path); ?></textarea>
                      </em></p></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td width="175" bordercolor="#F3F3F3" class="visitorscelltop"><div align="center" class="small"><?php echo($time_on_site_label); ?>:<br>
                <em><?php echo(time_layout($current_request_time_on_site)); ?></em></div></td>
            <td width="90">&nbsp;</td>
            <td width="100" bordercolor="6DB4D3"><table border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><div align="center"><a href="initiate_chat.php?REQUEST=<?php echo($current_request_id); ?>&RECORD=<?php echo($current_record); ?>"><img src="../images/chat.gif" alt="Chat Transcript" width="22" height="22" border="0"></a></div></td>
                  <td><div align="center" class="small"><a href="initiate_chat.php?REQUEST=<?php echo($current_request_id); ?>&RECORD=<?php echo($current_record); ?>" class="normlink"><?php echo($initiate_chat_label); ?></a></div></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <?php
		}
		?></td>
    </tr>
    <tr>
      <td width="25">&nbsp;</td>
      <td width="400" colspan="2"><div align="center">
          <p>
            <?php
	  if ($total_records == 0 && $current_record_request == '') {
	  ?>
          <table width="290" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="32"><img src="../images/error.gif" alt="<?php echo($notice_label); ?>" width="32" height="32"></td>
              <td><div align="center">
                  <p><em><?php echo($visitors_notice_label); ?>:</em></p>
                </div></td>
            </tr>
          </table>
          <p><?php echo($no_visitors_msg_label); ?></p>
          <p><?php echo($no_visitors_tracker_msg_label); ?></p>
          <?php
	  }
	  elseif ($total_records == 0 && $current_record_request != '') {
	  ?>
          <table width="290" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="32"><img src="../images/error.gif" alt="<?php echo($notice_label); ?>" width="32" height="32"></td>
              <td><div align="center">
                  <p><em><?php echo($visitors_notice_label); ?>:</em></p>
                </div></td>
            </tr>
          </table>
          <p><?php echo($no_visitor_record_label); ?></p>
          <?php
	  }
	  elseif ($total_records == 1 && $current_record_request == '') {
	  ?>
  <?php echo($back_record_label); ?> - <?php echo($next_record_label); ?>
  <?php
	  }
	  elseif ($current_record == 0 && $current_record_request == '') {
	  ?>
  <?php echo($back_record_label); ?> - <a href="./visitors_index.php?RECORD=<?php echo($current_record + 1)?>" target="_self" class="normlink"><?php echo($next_record_label); ?></a>
  <?php
	  }
	  elseif ($current_record == ($total_records - 1) && $current_record_request == '') {
	  ?>
  <a href="./visitors_index.php?RECORD=<?php echo($current_record - 1)?>" target="_self" class="normlink"><?php echo($back_record_label); ?></a> - <?php echo($next_record_label); ?>
  <?php
	  }
	  elseif ($current_record < $total_records && $current_record_request == '') {
	  ?>
  <a href="./visitors_index.php?RECORD=<?php echo($current_record - 1)?>" target="_self" class="normlink"><?php echo($back_record_label); ?></a> - <a href="./visitors_index.php?RECORD=<?php echo($current_record + 1)?>" target="_self" class="normlink"><?php echo($next_record_label); ?></a>
  <?php
	  }
	  ?>
        </div></td>
    </tr>
  </table>
</div>
<?php if ($current_record_previous == true) { ?>
<div align="right"><a href="reports_index.php" class="normlink"><?php echo($back_to_daily_reports_label); ?></a></div>
<?php } ?>
</body>
</html>
