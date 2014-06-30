<?php
                    $date=date('d-m-Y');
header("Cache-Control: private",false); 
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header("Content-Type:   application/plan; charset=utf-8");
header ("Content-Disposition: attachment; filename=\"".$name."-".$date.".txt" );
header ("Content-Description: Generated Report" );
?>
<?php echo $content_for_layout ?> 
