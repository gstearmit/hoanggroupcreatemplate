<?php
$db= mysql_connect("localhost","develop","VTMGROUP35chualang")
or die("Khong the ket noi");
 mysql_query('SET NAMES "UTF8"');
mysql_select_db("tienthoi",$db);
	

  $doc = new DOMDocument();
  
  $doc->load('Stores.xml');
  $cuahang = $doc->getElementsByTagName("Stores");
  
  foreach($cuahang as $cuahang){
   $companyname = $cuahang->getElementsByTagName( "Name" );
  $companyname = $companyname->item(0)->nodeValue;
	$companyname1=$companyname.'.xml';
echo $companyname1."-";
  $sql=mysql_query("select * from stores where  companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into stores(companyname) values('$companyname')");
							
			}
		
  
  $doc->load($companyname1);

//Luu vao bang Product  
  $product = $doc->getElementsByTagName( "Product" );
  foreach( $product as $row )
  {
  $product_code = $row->getElementsByTagName( "product_code" );
  $product_code = $product_code->item(0)->nodeValue;
  
  //echo $product_code; die;
  
  $category_code = $row->getElementsByTagName( "category_code" );
  $category_code = $category_code->item(0)->nodeValue;
  
  $barcode = $row->getElementsByTagName("barcode" );
  $barcode = $barcode->item(0)->nodeValue;
  
  $product_name = $row->getElementsByTagName( "product_name" );
  $product_name = $product_name->item(0)->nodeValue;
  
  $vat = $row->getElementsByTagName( "vat" );
  $vat = $vat->item(0)->nodeValue;
  
  $purchase_price = $row->getElementsByTagName("purchase_price" );
  $purchase_price = $purchase_price->item(0)->nodeValue;
    
   $retail_price = $row->getElementsByTagName( "retail_price" );
  $retail_price = $retail_price->item(0)->nodeValue;
  
  $whole_price = $row->getElementsByTagName("whole_price" );
  $whole_price = $whole_price->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
  $barcode2 = $row->getElementsByTagName( "barcode2" );
  $barcode2 = $barcode2->item(0)->nodeValue;
 
 $sql=mysql_query("select * from products where product_code='$product_code' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into products(product_code,category_code,barcode,title,vat,purchase_price,retail_price,whole_price,updated_at,barcode2,companyname) values('$product_code','$category_code','$barcode','$title','$vat','$purchase_price','$retail_price','$whole_price','$updated_at','$barcode2','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update products set category_code='$category_code',barcode='$barcode',title='$title',vat='$vat',purchase_price='$purchase_price',retail_price='$retail_price',whole_price='$whole_price',updated_at='$updated_at',barcode2='$barcode2' where product_code='$product_code' and companyname='$companyname'");
							 
						}
				
				}
			
			}
 
 
  }
  
//Luu vao hoa don nhap  
   $Purchasing_documents = $doc->getElementsByTagName( "Purchasing_documents" );
  foreach( $Purchasing_documents as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $document_post_date = $row->getElementsByTagName( "document_post_date" );
  $document_post_date = $document_post_date->item(0)->nodeValue;
  
  $internal_document_number = $row->getElementsByTagName( "internal_document_number" );
  $internal_document_number = $internal_document_number->item(0)->nodeValue;
  
  $supplier_code = $row->getElementsByTagName( "supplier_code" );
  $supplier_code = $supplier_code->item(0)->nodeValue;
  
  $branch_code = $row->getElementsByTagName( "branch_code" );
  $branch_code = $branch_code->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue; 
  
  $sql=mysql_query("select * from purchasing_documents where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into purchasing_documents(uuid,document_post_date,internal_document_number,supplier_code,branch_code,updated_at,companyname) values('$uuid','$document_post_date','$internal_document_number','$supplier_code','$branch_code','$updated_at','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update purchasing_documents set document_post_date='$document_post_date',internal_document_number='$internal_document_number',supplier_code='$supplier_code',branch_code='$branch_code',updated_at='$updated_at' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  }

//Luu vao bang chi tiet hoa don nhap   
  $Purchasing_document_item = $doc->getElementsByTagName( "Purchasing_document_item" );
  foreach( $Purchasing_document_item as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $purchasing_documents_uuid = $row->getElementsByTagName( "purchasing_documents_uuid" );
  $purchasing_documents_uuid = $purchasing_documents_uuid->item(0)->nodeValue;
  
  $parnert_code_in = $row->getElementsByTagName( "parnert_code_in" );
  $parnert_code_in = $parnert_code_in->item(0)->nodeValue;
  
  $product_code = $row->getElementsByTagName( "product_code" );
  $product_code = $product_code->item(0)->nodeValue;
  
  $total_unit = $row->getElementsByTagName( "total_unit" );
  $total_unit = $total_unit->item(0)->nodeValue;
  
  $unit_price = $row->getElementsByTagName( "unit_price" );
  $unit_price = $unit_price->item(0)->nodeValue;
   
  $total_value_after_tax = $row->getElementsByTagName( "total_value_after_tax" );
  $total_value_after_tax = $total_value_after_tax->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
  $update_by = $row->getElementsByTagName( "update_by" );
  $update_by = $update_by->item(0)->nodeValue;
  
  	$sql=mysql_query("select * from purchasing_document_items where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into purchasing_document_items(uuid,purchasing_documents_uuid,parnert_code_in,product_code,total_unit,unit_price,total_value_after_tax,updated_at,update_by,companyname) values('$uuid','$purchasing_documents_uuid','$parnert_code_in','$product_code','$total_unit','$unit_price','$total_value_after_tax','$updated_at','$update_by','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update purchasing_document_items set purchasing_documents_uuid='$purchasing_documents_uuid',parnert_code_in='$parnert_code_in',product_code='$product_code',total_unit='$total_unit',unit_price='$unit_price',total_value_after_tax='$total_value_after_tax',updated_at='$updated_at',update_by='$update_by' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  
   }

 //Luu vao hoa don ban  
   $Sale_documents = $doc->getElementsByTagName( "Sale_documents" );
  foreach( $Sale_documents as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $document_post_date = $row->getElementsByTagName( "document_post_date" );
  $document_post_date = $document_post_date->item(0)->nodeValue;
  
  $internal_document_number = $row->getElementsByTagName( "internal_document_number" );
  $internal_document_number = $internal_document_number->item(0)->nodeValue;
  
  $customer_code = $row->getElementsByTagName( "customer_code" );
  $customer_code = $customer_code->item(0)->nodeValue;
  
   $sale_by = $row->getElementsByTagName( "sale_by" );
  $sale_by = $sale_by->item(0)->nodeValue;
  
   $total_for_payment = $row->getElementsByTagName( "total_for_payment" );
  $total_for_payment = $total_for_payment->item(0)->nodeValue;
  
  $branch_code = $row->getElementsByTagName( "branch_code" );
  $branch_code = $branch_code->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue; 
  
  $sql=mysql_query("select * from sale_documents where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into sale_documents(uuid,document_post_date,internal_document_number,updated_at,customer_code,sale_by,total_for_payment,branch_code,companyname) values('$uuid','$document_post_date','$internal_document_number','$updated_at','$customer_code','$sale_by','$total_for_payment','$branch_code','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update sale_documents set document_post_date='$document_post_date',internal_document_number='$internal_document_number',customer_code='$customer_code',updated_at='$updated_at',sale_by='$sale_by',total_for_payment='$total_for_payment',branch_code='$branch_code' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  }

    
//Luu vao bang chi tiet hoa don ban   
  $Sale_document_items = $doc->getElementsByTagName( "Sale_document_items" );
  foreach( $Sale_document_items as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $sale_documents_uuid = $row->getElementsByTagName( "sale_documents_uuid" );
  $sale_documents_uuid = $sale_documents_uuid->item(0)->nodeValue;
  
  $parnert_code_out = $row->getElementsByTagName( "parnert_code_out" );
  $parnert_code_out = $parnert_code_out->item(0)->nodeValue;
  
  $product_code = $row->getElementsByTagName( "product_code" );
  $product_code = $product_code->item(0)->nodeValue;
  
  $total_unit = $row->getElementsByTagName( "total_unit" );
  $total_unit = $total_unit->item(0)->nodeValue;
  
  $unit_price = $row->getElementsByTagName( "unit_price" );
  $unit_price = $unit_price->item(0)->nodeValue;
   
  $total_value_after_tax = $row->getElementsByTagName( "total_value_after_tax" );
  $total_value_after_tax = $total_value_after_tax->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
  $update_by = $row->getElementsByTagName( "update_by" );
  $update_by = $update_by->item(0)->nodeValue; 
  
  	$sql=mysql_query("select * from sale_document_items where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into sale_document_items(uuid,sale_documents_uuid,parnert_code_out,total_value_after_tax,product_code,total_unit,unit_price,updated_at,update_by,companyname) values('$uuid','$sale_documents_uuid','$parnert_code_out','$total_value_after_tax','$product_code','$total_unit','$unit_price','$updated_at','$update_by','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update sale_document_items set sale_documents_uuid='$sale_documents_uuid',parnert_code_out='$parnert_code_out',total_value_after_tax='$total_value_after_tax',product_code='$product_code',total_unit='$total_unit',unit_price='$unit_price',updated_at='$updated_at',update_by='$update_by' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
   } 

//Luu vao ban tra lai
   $Return_sale_documents = $doc->getElementsByTagName( "Return_sale_documents" );
  foreach( $Return_sale_documents as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $document_post_date = $row->getElementsByTagName( "document_post_date" );
  $document_post_date = $document_post_date->item(0)->nodeValue;
  
  $internal_document_number = $row->getElementsByTagName( "internal_document_number" );
  $internal_document_number = $internal_document_number->item(0)->nodeValue;
  
  $customer_code = $row->getElementsByTagName( "customer_code" );
  $customer_code = $customer_code->item(0)->nodeValue;
  
   $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
   $branch_code = $row->getElementsByTagName( "branch_code" );
  $branch_code = $branch_code->item(0)->nodeValue;
  
  $sql=mysql_query("select * from return_sale_documents where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into return_sale_documents(uuid,document_post_date,internal_document_number,customer_code,updated_at,branch_code,companyname) values('$uuid','$document_post_date','$internal_document_number','$customer_code','$updated_at','$branch_code','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update return_sale_documents set document_post_date='$document_post_date',internal_document_number='$internal_document_number',customer_code='$customer_code',updated_at='$updated_at',branch_code='$branch_code' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  
  }

   
//Luu vao bang chi tiet ban tra lai  
  $Return_sale_document_items = $doc->getElementsByTagName( "Return_sale_document_items" );
  foreach( $Return_sale_document_items as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $return_sale_documents_uuid = $row->getElementsByTagName( "return_sale_documents_uuid" );
  $return_sale_documents_uuid = $return_sale_documents_uuid->item(0)->nodeValue;
  
  $sale_document_uuid = $row->getElementsByTagName( "sale_document_uuid" );
  $sale_document_uuid = $sale_document_uuid->item(0)->nodeValue;
  
   $store_code = $row->getElementsByTagName( "store_code" );
  $store_code = $store_code->item(0)->nodeValue;
  
  $product_code = $row->getElementsByTagName( "product_code" );
  $product_code = $product_code->item(0)->nodeValue;
  
  $total_unit = $row->getElementsByTagName( "total_unit" );
  $total_unit = $total_unit->item(0)->nodeValue;
  
  $unit_price = $row->getElementsByTagName( "unit_price" );
  $unit_price = $unit_price->item(0)->nodeValue;
   
  $stock_price = $row->getElementsByTagName( "stock_price" );
  $stock_price = $stock_price->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
  $update_by = $row->getElementsByTagName( "update_by" );
  $update_by = $update_by->item(0)->nodeValue; 
  
  $sql=mysql_query("select * from return_sale_document_items where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into return_sale_document_items(uuid,return_sale_documents_uuid,sale_document_uuid,store_code,product_code,total_unit,unit_price,stock_price,updated_at,created_by,companyname) values('$uuid','$return_sale_documents_uuid','$sale_document_uuid','$store_code','$product_code','$total_unit','$unit_price','$stock_price','$updated_at','$created_by','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update return_sale_document_items set return_sale_documents_uuid='$return_sale_documents_uuid',sale_document_uuid='$sale_document_uuid',store_code='$store_code',product_code='$product_code',total_unit='$total_unit',unit_price='$unit_price',stock_price='$stock_price',updated_at='$updated_at',created_by='$created_by' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
   }
 
  //Luu vao bang dieu chinh thieu
   $StockInventoryMinus_documents = $doc->getElementsByTagName( "StockInventoryMinus_documents" );
  foreach( $StockInventoryMinus_documents as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $document_post_date = $row->getElementsByTagName( "document_post_date" );
  $document_post_date = $document_post_date->item(0)->nodeValue;
  
  $internal_document_number = $row->getElementsByTagName( "internal_document_number" );
  $internal_document_number = $internal_document_number->item(0)->nodeValue;
  
  $created_by = $row->getElementsByTagName( "created_by" );
  $created_by = $created_by->item(0)->nodeValue;
  
   $updated_at = $row->getElementsByTagName( "sale_by" );
  $updated_at = $sale_by->item(0)->nodeValue;
  
   $branch_code = $row->getElementsByTagName( "total_for_payment" );
  $branch_code = $total_for_payment->item(0)->nodeValue;
  
  	$sql=mysql_query("select * from stockInventoryMinus_documents where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into stockInventoryMinus_documents(uuid,document_post_date,internal_document_number,created_by,updated_at,branch_code,companyname) values('$uuid','$document_post_date','$internal_document_number','$created_by','$updated_at','$branch_code','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update stockInventoryMinus_documents set document_post_date='$document_post_date',internal_document_number='$internal_document_number',created_by='$created_by',updated_at='$updated_at',branch_code='$branch_code' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  }

     
//Luu vao bang chi tiet dieu chinh thieu  
  $StockInventoryMinus_items = $doc->getElementsByTagName( "StockInventoryMinus_items" );
  foreach( $StockInventoryMinus_items as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $StockInventoryMinus_uuid = $row->getElementsByTagName( "StockInventoryMinus_uuid" );
  $StockInventoryMinus_uuid = $StockInventoryMinus_uuid->item(0)->nodeValue;
  
  $partner_code_out = $row->getElementsByTagName( "partner_code_out" );
  $partner_code_out = $partner_code_out->item(0)->nodeValue;
  
  
  $product_code = $row->getElementsByTagName( "product_code" );
  $product_code = $product_code->item(0)->nodeValue;
  
  $total_unit = $row->getElementsByTagName( "total_unit" );
  $total_unit = $total_unit->item(0)->nodeValue;
   
  $total_unit_standard = $row->getElementsByTagName( "total_unit_standard" );
  $total_unit_standard = $total_unit_standard->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
  $created_by = $row->getElementsByTagName( "created_by" );
  $created_by = $created_by->item(0)->nodeValue; 
  
  
  	$sql=mysql_query("select * from stockinventoryminus_items where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into stockinventoryminus_items(uuid,StockInventoryMinus_uuid,partner_code_out,product_code,total_unit,total_unit_standard,updated_at,created_by,companyname) values('$uuid','$StockInventoryMinus_uuid','$partner_code_out','$product_code','$total_unit','$total_unit_standard','$updated_at','$created_by','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update stockinventoryminus_items set StockInventoryMinus_uuid='$StockInventoryMinus_uuid',partner_code_out='$partner_code_out',product_code='$product_code',total_unit='$total_unit',total_unit_standard='$total_unit_standard',updated_at='$updated_at',created_by='$created_by' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
   }


 
//Luu vao bang dieu chinh thua
   $StockInventoryPlus_documents = $doc->getElementsByTagName( "StockInventoryPlus_documents" );
  foreach( $StockInventoryPlus_documents as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $document_post_date = $row->getElementsByTagName( "document_post_date" );
  $document_post_date = $document_post_date->item(0)->nodeValue;
  
  $internal_document_number = $row->getElementsByTagName( "internal_document_number" );
  $internal_document_number = $internal_document_number->item(0)->nodeValue;
  
   
   $updated_at = $row->getElementsByTagName( "sale_by" );
  $updated_at = $sale_by->item(0)->nodeValue;
  
   $branch_code = $row->getElementsByTagName( "total_for_payment" );
  $branch_code = $total_for_payment->item(0)->nodeValue;
  
  
  	
			$sql=mysql_query("select * from stockinventoryplus_documents where uuid='$uuid' and companyname='$companyname' ");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into stockinventoryplus_documents(uuid,document_post_date,internal_document_number,updated_at,branch_code,companyname) values('$uuid','$document_post_date','$internal_document_number','$updated_at','$branch_code','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update stockinventoryplus_documents set document_post_date='$document_post_date',internal_document_number='$internal_document_number',updated_at='$updated_at',branch_code='$branch_code' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  
  }
 
//Luu vao bang chi tiet dieu chinh thua  
  $StockInventoryPlus_items = $doc->getElementsByTagName( "StockInventoryPlus_items" );
  foreach( $StockInventoryPlus_items as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $StockInventoryPlus_uuid = $row->getElementsByTagName( "StockInventoryPlus_uuid" );
  $StockInventoryPlus_uuid = $StockInventoryPlus_uuid->item(0)->nodeValue;
  
  $partner_code_out = $row->getElementsByTagName( "partner_code_out" );
  $partner_code_out = $partner_code_out->item(0)->nodeValue;
  
  
  $product_code = $row->getElementsByTagName( "product_code" );
  $product_code = $product_code->item(0)->nodeValue;
  
  $total_unit = $row->getElementsByTagName( "total_unit" );
  $total_unit = $total_unit->item(0)->nodeValue;
   
  $total_unit_standard = $row->getElementsByTagName( "total_unit_standard" );
  $total_unit_standard = $total_unit_standard->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
  $created_by = $row->getElementsByTagName( "created_by" );
  $created_by = $created_by->item(0)->nodeValue; 
  
  	
			$sql=mysql_query("select * from stockinventoryplus_items where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into stockinventoryplus_items(uuid,StockInventoryPlus_uuid,partner_code_in,product_code,total_unit,total_unit_standard,updated_at,created_by,companyname) values('$uuid','$StockInventoryPlus_uuid','$partner_code_in','$product_code','$total_unit','$total_unit_standard','$updated_at','$created_by','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update stockinventoryplus_items set StockInventoryPlus_uuid='$StockInventoryPlus_uuid',partner_code_in='$partner_code_in',product_code='$product_code',total_unit='$total_unit',total_unit_standard='$total_unit_standard',updated_at='$updated_at',created_by='$created_by' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  
   }



 
 //Luu vao bang mua tra lai
   $Return_purchasing_documents = $doc->getElementsByTagName( "Return_purchasing_documents" );
  foreach( $Return_purchasing_documents as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $document_post_date = $row->getElementsByTagName( "document_post_date" );
  $document_post_date = $document_post_date->item(0)->nodeValue;
  
  $internal_document_number = $row->getElementsByTagName( "internal_document_number" );
  $internal_document_number = $internal_document_number->item(0)->nodeValue;
  
   $supplier_code = $row->getElementsByTagName( "supplier_code" );
  $supplier_code = $sale_by->item(0)->nodeValue;
  
   $updated_at = $row->getElementsByTagName( "sale_by" );
  $updated_at = $sale_by->item(0)->nodeValue;
  
   $branch_code = $row->getElementsByTagName( "total_for_payment" );
  $branch_code = $total_for_payment->item(0)->nodeValue;
  
  $sql=mysql_query("select * from return_purchasing_documents where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into return_purchasing_documents(uuid,document_post_date,internal_document_number,updated_at,branch_code,supplier_code,companyname) values('$uuid','$document_post_date','$internal_document_number','$updated_at','$branch_code','$supplier_code','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update return_purchasing_documents set document_post_date='$document_post_date',internal_document_number='$internal_document_number',supplier_code='$supplier_code',updated_at='$updated_at',branch_code='$branch_code' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  
  }

//Luu vao bang chi tiet mua tra lai 
  $Return_purchasing_document_items = $doc->getElementsByTagName( "Return_purchasing_document_items" );
  foreach( $Return_purchasing_document_items as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $return_purchasing_documents_uuid = $row->getElementsByTagName( "return_purchasing_documents_uuid" );
  $return_purchasing_documents_uuid = $return_purchasing_documents_uuid->item(0)->nodeValue;
  
  $purchasing_document_uuid = $row->getElementsByTagName( "purchasing_document_uuid" );
  $purchasing_document_uuid = $purchasing_document_uuid->item(0)->nodeValue;
  
   $store_code = $row->getElementsByTagName( "store_code" );
  $store_code = $store_code->item(0)->nodeValue;
  
  
  $product_code = $row->getElementsByTagName( "product_code" );
  $product_code = $product_code->item(0)->nodeValue;
  
  $total_unit = $row->getElementsByTagName( "total_unit" );
  $total_unit = $total_unit->item(0)->nodeValue;
   
  $unit_price = $row->getElementsByTagName( "unit_price" );
  $unit_price = $unit_price->item(0)->nodeValue;
  
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
  $created_by = $row->getElementsByTagName( "created_by" );
  $created_by = $created_by->item(0)->nodeValue; 
  
  	$sql=mysql_query("select * from return_purchasing_document_items where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into return_purchasing_document_items(uuid,return_purchasing_documents_uuid,purchasing_document_uuid,store_code,product_code,total_unit,unit_price,updated_at,created_by,companyname) values('$uuid','$return_purchasing_documents_uuid','$purchasing_document_uuid','$store_code','$product_code','$total_unit','$unit_price','$updated_at','$created_by','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update return_purchasing_document_items set return_purchasing_documents_uuid='$return_purchasing_documents_uuid',purchasing_document_uuid='$purchasing_document_uuid',store_code='$store_code',product_code='$product_code',total_unit='$total_unit',unit_price='$unit_price',updated_at='$updated_at',created_by='$created_by' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
   }

 
//Luu vao bang kho hang
   $Branch_code = $doc->getElementsByTagName( "Branch_code" );
  foreach( $Branch_code as $row )
  {
  $code = $row->getElementsByTagName( "code" );
  $code = $code->item(0)->nodeValue;
  
  $name = $row->getElementsByTagName( "name" );
  $name = $name->item(0)->nodeValue;
  
  $address = $row->getElementsByTagName( "address" );
  $address = $address->item(0)->nodeValue;
  
   $updated_at = $row->getElementsByTagName( "sale_by" );
  $updated_at = $sale_by->item(0)->nodeValue;
  
  
  $sql=mysql_query("select * from branches where code='$code' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into branchs(code,name,address,updated_at,companyname) values('$code','$name','$address','$updated_at','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update branchs set name='$name',address='$address',updated_at='$updated_at' where code='$code' and companyname='$companyname'");
							 
						}
				
				}
			
			}
  
  }

 
//Luu vao bang nhom hang
  $Product_subcategory = $doc->getElementsByTagName( "Product_subcategory" );
  foreach( $Product_subcategory as $row )
  {
  $uuid = $row->getElementsByTagName( "uuid" );
  $uuid = $uuid->item(0)->nodeValue;
  
  $code = $row->getElementsByTagName( "code" );
  $code = $code->item(0)->nodeValue;
  
  $name = $row->getElementsByTagName( "name" );
  $name = $name->item(0)->nodeValue;
  
   $updated_by = $row->getElementsByTagName( "updated_by" );
  $updated_by = $updated_by->item(0)->nodeValue;
  
  
  $category_code = $row->getElementsByTagName( "category_code" );
  $category_code = $category_code->item(0)->nodeValue;
  
 
  $updated_at = $row->getElementsByTagName( "updated_at" );
  $updated_at = $updated_at->item(0)->nodeValue;
  
  $sql=mysql_query("select * from product_subcategorys where uuid='$uuid' and companyname='$companyname'");
			
			if(mysql_num_rows($sql)==0) 
			{
				 $result1=mysql_query("insert into product_subcategorys(code,name,uuid,updated_by,category_code,updated_at,companyname) values('$code','$name','$uuid','$updated_by','$category_code','$updated_at','$companyname')");
				 //var_dump($result1); //die;
				 //echo "them moi"; die;
				
			}
			else 
			{
				while($row=mysql_fetch_array($sql)) 
				{
					if($updated_at!=$row['updated_at']) 
						{
					
							 $result=mysql_query("update product_subcategorys set name='$name',code='$code',updated_by='$updated_by',category_code='$category_code',updated_at='$updated_at' where uuid='$uuid' and companyname='$companyname'");
							 
						}
				
				}
			
			}

   }
   
  
  }
  echo "ok";
  ?>