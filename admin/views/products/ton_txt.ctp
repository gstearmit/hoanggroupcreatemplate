<?php $date=date('d/m/Y');
	$str='';
foreach($product as $key=>$value)
	{
	$ton=$value['soluong']-$value['soluongban']+$value['soluongbantralai'] -$value['soluongmuatralai']+$value['dieuchinhthua'] - $value['dieuchinhthieu'];
	 $row=$this->requestAction('products/get_product_by_code/'.$value['product_code']);
	
		$str.=$date.",".$row['Product']['barcode2'].','.$ton.chr(13);
	}
echo $str;
?>