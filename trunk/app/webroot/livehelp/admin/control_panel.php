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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<title><?php echo($_SETTINGS['NAME']); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../styles/styles.php" rel="stylesheet" type="text/css">
</head>
<body  style="margin:0px;"> 
<table height="100%" border="0" align="right" cellpadding="0" cellspacing="0"> 
  <tr> 
    <td><div align="right"> 
        <table border="0" align="center" cellpadding="2" cellspacing="2"> 
          <tr> 
            <td><div align="center"><a href="logout.php" target="_parent"><img src="../images/logout.gif" alt="<?php echo($logout_label); ?>" width="22" height="22" border="0"></a></div></td> 
          </tr> 
          <tr> 
            <td><div align="center"><a href="logout.php" target="_parent" class="normlink"><?php echo($logout_label); ?></a></div></td> 
          </tr> 
        </table> 
      </div></td> 
  </tr> 
  <tr> 
    <td valign="middle"><table width="90" border="0" align="right" cellpadding="4" cellspacing="4"> 
        <tr> 
          <td><div align="center"><a href="visitors_index.php" target="displayFrame"><img src="../images/online_visitors.gif" width="32" height="32" border="0" alt="<?php echo($visitors_label); ?>"></a><br> 
              <a href="visitors_index.php" target="displayFrame" class="normlink"><?php echo($visitors_label); ?></a> </div></td> 
        </tr> 
        <tr> 
          <td><div align="center"><a href="overall_statistics.php" target="displayFrame"><img src="../images/stats.gif" alt="<?php echo($statistics_label); ?>" width="32" height="32" border="0"></a><br> 
              <a href="overall_statistics.php" target="displayFrame" class="normlink"><?php echo($statistics_label); ?></a></div></td> 
        </tr> 
        <tr> 
          <td><div align="center"><?php if ($current_privilege < 2) { ?><a href="reports_index.php" target="displayFrame"><?php  } ?><img src="../images/reports.gif" alt="<?php echo($reports_label); ?>" width="32" height="32" border="0"><?php if ($current_privilege < 2) { ?></a><?php  } ?><br> 
              <?php if ($current_privilege < 2) { ?><a href="reports_index.php" target="displayFrame" class="normlink"><?php  } ?><?php echo($reports_label); ?><?php if ($current_privilege < 2) { ?></a><?php  } ?></div></td> 
        </tr> 
        <tr> 
          <td><div align="center"><a href="users_index.php" target="displayFrame"><img src="../images/users.gif" alt="<?php echo($users_label); ?>" width="32" height="32" border="0"></a><br> 
              <a href="users_index.php" target="displayFrame" class="normlink"><?php echo($users_label); ?></a></div></td> 
        </tr> 
        <tr> 
          <td><div align="center"><?php if ($current_privilege < 2) { ?><a href="db_index.php" target="displayFrame"><?php  } ?><img src="../images/dbase.gif" alt="<?php echo($database_label); ?>" width="32" height="32" border="0"><?php if ($current_privilege < 2) { ?></a><?php  } ?><br> 
              <?php if ($current_privilege < 2) { ?><a href="db_index.php" target="displayFrame" class="normlink"><?php  } ?><?php echo($database_label); ?><?php if ($current_privilege < 2) { ?></a><?php  } ?></div></td> 
        </tr> 
        <tr> 
          <td><div align="center"><?php if ($current_privilege < 2) { ?><a href="settings_index.php" target="displayFrame"><?php  } ?><img src="../images/configure.gif" alt="<?php echo($settings_label); ?>" width="32" height="32" border="0"><?php if ($current_privilege < 2) { ?></a><?php  } ?><br> 
              <?php if ($current_privilege < 2) { ?><a href="settings_index.php" target="displayFrame" class="normlink"><?php  } ?><?php echo($settings_label); ?><?php if ($current_privilege < 2) { ?></a><?php  } ?></div></td> 
        </tr> 
      </table></td> 
  </tr> 
</table> 
</body>
</html>
