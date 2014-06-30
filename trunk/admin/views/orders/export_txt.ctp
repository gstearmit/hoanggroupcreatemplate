<?php 
	$str='';
foreach($rows as $row)
	{ $date=date('d/m/Y',strtotime($row['Order']['created']));
		$chuoi=explode('/',$row['Order']['product']);
		
		for($i=0;$i<count($chuoi)-1;$i++)
			{	if($chuoi[$i]!='') {
					$xau=explode('|',$chuoi[$i]);
					$id=$xau[0];
					$product=$this->requestAction('products/get_product/'.$id);
					
					$str.=$date.",".$product['Product']['barcode'].','.$xau[2].chr(13);
				}
			}
		
		
	}
echo $str;
?>


