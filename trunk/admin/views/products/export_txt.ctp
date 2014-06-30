<?php $date=date('d/m/Y');
	$str='';
foreach($rows as $row)
	{
		$str.=$date.",".trim($row['Product']['barcode2'],'/n/t').','.$row['Product']['soluong'].chr(13);
	}
echo $str;
?>


