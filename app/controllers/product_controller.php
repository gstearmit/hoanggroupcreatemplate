<?php
class ProductController extends AppController{
	var $name='Product';
	var $uses=array('Product','Catproduct','City','Order','Userscms');
	var $components = array('Session');
	
	function index($id=null)
	{
		
		
		$this->set('product',$this->Product->find('all',array('conditions'=>array('Product.id'=>$id,'Product.status'=>1,'Product.chophep'=>1))));
		
		$n= $this->Product->findById($id);
		
			$this->Session->write('li',$n['Product']['catproduct_id']);
			
	
	}
	
	function prarent_product($id=null){
		
		 $row=$this->Product->find('all',array('conditions'=>array('Product.id'=>$id)));

		$catproduct_id=$row[0]['Product']['catproduct_id'];
		
	
		return $this->Product->find('all',array('conditions'=>array('Product.catproduct_id'=>$catproduct_id,'NOT'=>array('Product.id'=>$id))));
		
	}

	
	function search($search_product=null){

		$search_product = isset($_POST['search_product'])?$_POST['search_product']:'';
		
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.title like'=>'%'.$search_product.'%'),'limit'=>4);
		$this->set('prod', $this->paginate('Product',array()));
		$this->set('txt',$search_product);
		$this->set('result', $this->Product->getNumRows());
		
	}
	
	
	function search_eg($search_product=null){
		
		$search_product = isset($_POST['search_product'])?$_POST['search_product']:'';
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.title_eg like'=>'%'.$search_product.'%'),'limit'=>9);
		$this->set('prod', $this->paginate('Product',array()));
		$this->set('result', $this->Product->getNumRows());
		$this->set('txt',$search_product);
		$this->render('search');
	}
	
	
	function spnb(){
		
		return $this->Product->find('all',array('conditions'=>array('Product.display'=>1),'limit'=>20));
		
	}
	
	function datmua($id=null)
	{
	
		  if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			 $this->set(compact('shopingcart'));
		 }
		 else
		 {
			 echo '<script language="javascript"> alert("Chưa có sản phầm nào trong giỏ hàng"); window.location.replace("'.DOMAIN.'"); </script>';
		 }
	}
	
	
	function datmua1()
	{
		$this->data=$this->Session->read('thongtin');
		//pr($this->data); die;
		//echo $_POST['diadiem']; die; 
		if(isset($_POST['name'])) {
			//echo $_POST['diadiem']; die;
		$this->data['name']=isset($_POST['name'])? $_POST['name'] :'' ;
		$this->data['email']=isset($_POST['email'])? $_POST['email'] :'' ;
		$this->data['phone']=isset($_POST['phone'])? $_POST['phone'] :'' ;
		$this->data['address']=isset($_POST['address'])? $_POST['address'] :'' ;
		$this->data['diadiem']=isset($_POST['diadiem'])? $_POST['diadiem'] :'' ;
		$this->data['ghichu']=isset($_POST['ghichu'])? $_POST['ghichu'] :'' ;
		
		$this->data['thongtinkhachhang']=isset($_POST['thongtinkhachhang'])? $_POST['thongtinkhachhang'] :2;
		
		$this->Session->delete('thongtin');
		$this->Session->write('thongtin',$this->data);
		}
		
		$this->set('data',$this->data);
		
		
		
		 if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			 $this->set(compact('shopingcart'));
		 }
		 else
		 {
			 echo '<script language="javascript"> alert("Chưa có sản phầm nào trong giỏ hàng"); window.location.replace("'.DOMAIN.'"); </script>';
		 }
		
		
		
		
		}
		
		
		
		function datmua2()
		{
		
	
			$this->data=$this->Session->read('thongtin');
	
				if($_POST['hinhthucthanhtoan1']==1) $this->data['hinhthucthanhtoan']='Thanh toán bằng tiền mặt';
				
				if($_POST['hinhthucthanhtoan2']==1) $this->data['hinhthucthanhtoan']='Thanh toán bằng thẻ ATM';
				
				
		$this->Session->write('b3','b3');
		//echo $this->data['hinhthucthanhtoan']; die;
		
				$this->Session->write('thongtin',$this->data);
	
		
			$this->set('data',$this->data);
		
			
			
			
			 if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			 $this->set(compact('shopingcart'));
		 }
		 else
		 {
			 echo '<script language="javascript"> alert("Chưa có sản phầm nào trong giỏ hàng"); window.location.replace("'.DOMAIN.'"); </script>';
		 }
			
			
		}
		
		
		function datmua3()
		{
			
		
			$product=null;
			 if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];	
			 $this->set('shopingcart',$shopingcart);
			 foreach($shopingcart as $key=>$value)	
			 {
				$product=$product.$value['pid'].'|'.$value['name'].'|'.$value['sl'].'/';
                
                $pr=$this->Product->findById($value['pid']);
                $pr['Product']['daban']= $pr['Product']['daban'] + $value['sl'];
                $this->Product->save($pr);
                
				 }
				 
			$this->data['Order']=$this->Session->read('thongtin');
		//pr($this->data['Order']); die;
			//$this->data['Order']['product_id']=$this->data['Order']['id'];
			$this->data['Order']['id']=null;
			$this->data['Order']['tongtien']=$_POST['tongtien'];
			$a=$this->Userscms->findByEmail($this->Session->read('email'));
			$this->data['Order']['userscm_id']=$a['Userscms']['id'];
			$this->data['Order']['product']=$product;
			$this->Order->save($this->data['Order']);
			unset($_SESSION['shopingcart']);
		
		 }
		 else
		 {
			 echo '<script language="javascript"> alert("Chưa có sản phầm nào trong giỏ hàng"); window.location.replace("'.DOMAIN.'"); </script>';
		 }
			
			
			$this->Session->delete('b3');
		
	
			
			
		}
		
		
		
		 //shopping	
    function addshopingcart($id=null){
        if(!$this->Session->check('email'))
        {
           echo '<script language="javascript"> alert("Hãy đăng nhập để có giỏ hàng"); window.location.replace("'.DOMAIN.'"); </script>'; 
            
        } else {
    		$product=$this->Product->read(null,$id);	
    //	
	if(!isset($_SESSION['shopingcart'])){  $_SESSION['shopingcart']=array();};
	 		
	 if(isset($_SESSION['shopingcart']))	 
	 {   
	 	 
	 	 $shopingcart=$_SESSION['shopingcart'];
	 	 if(isset($shopingcart[$id]))
		 {		 	
			 $shopingcart[$id]['sl']= $shopingcart[$id]['sl']+1;
			 $shopingcart[$id]['total']= $shopingcart[$id]['price']*$shopingcart[$id]['sl'];			
			 $_SESSION['shopingcart']=$shopingcart;			 
			echo '<script language="javascript"> alert("Thêm thành công"); window.location.replace("'.DOMAIN.'gio-hang"); </script>';
		 }
	     else
		 {			
		 		$shopingcart[$id]['pid'] = $id;		
				$shopingcart[$id]['name']=$product['Product']['title'];	
				$shopingcart[$id]['images']=$product['Product']['images'];	
				$shopingcart[$id]['sl']=1;
				$shopingcart[$id]['price'] = $product['Product']['price'];				
				$shopingcart[$id]['total']= $product['Product']['price']*$shopingcart[$id]['sl'];
				$_SESSION['shopingcart']=$shopingcart;				
				echo '<script language="javascript" type="text/javascript"> alert("Thêm giỏ hàng thành công"); window.location.replace("'.DOMAIN.'gio-hang"); </script>';
	         }
	 	}	
	}
    }

	function deleteshopingcart($id=null){
		if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			  if(isset($shopingcart[$id]))
			  unset($shopingcart[$id]);
			  $_SESSION['shopingcart']=$shopingcart;
              
                $pr=$this->Product->findById($id);
                $pr['Product']['daban']= $pr['Product']['daban'] - $value['sl'];
                $this->Product->save($pr);
              
			echo '<script language="javascript" type="text/javascript"> window.location.replace("'.DOMAIN.'gio-hang"); </script>';
	          
		 }
		
	}

    function viewshopingcart(){
         if(!$this->Session->check('email'))
        {
           echo '<script language="javascript"> alert("Hãy đăng nhập để có giỏ hàng"); window.location.replace("'.DOMAIN.'"); </script>'; 
            
        } else {
        
        if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			 $this->set(compact('shopingcart'));
		 }
		 else
		 {
			 echo '<script language="javascript"> alert("Chưa có sản phầm nào trong giỏ hàng"); window.location.replace("'.DOMAIN.'"); </script>';
		 }
		 $this->Session->write('next',$_GET['url']);
	}
}
	function updateshopingcart($id=null){
		
		if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			  if(isset($shopingcart[$id]))
			  {
				  $shopingcart[$id]['sl']=$_POST['soluong'];			
				  echo $_POST['soluong'];			die;
				  $shopingcart[$id]['total']= $shopingcart[$id]['sl']*$shopingcart[$id]['price'];
			  }
			  $_SESSION['shopingcart']=$shopingcart;
			 
				echo '<script language="javascript" type="text/javascript"> window.location.replace("'.DOMAIN.'gio-hang"); </script>';
		 }
	}
		
		function updateshopingcart1($id=null,$soluong=null,$url){
		
		
		if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			  if(isset($shopingcart[$id]))
			  {
				  $shopingcart[$id]['sl']=$soluong;
				  $shopingcart[$id]['total']= $shopingcart[$id]['sl']*$shopingcart[$id]['price'];
			  }
			  $_SESSION['shopingcart']=$shopingcart;
			
			echo '<script language="javascript" type="text/javascript"> window.location.replace("'.DOMAIN.$url.'"); </script>';
		 }
	}
	
	
	function txt_to_mysql()
	{
		$this->layout='test';
		$myFile = DOCUMENT_ROOT.'/app/webroot/Product.txt';
		//echo $myFile; die;
		$fh = fopen($myFile, 'r') or die("can't open file");
		$i=1;
		while(!feof($fh))
		{
			$theData = fgets($fh);
			$str=explode('|',$theData);
			//pr($str); die;
			if($theData!=null) {
			$product_code=$str[0];
			$category_id=$str[1];
			$barcode=$str[2];
			$title=$str[3];
			$vat=$str[4];
			$purchase_price=$str[5];
			$retail_price=$str[6];
			$whole_price=$str[7];
			$updated_at=$str[8];
			$a=array();
			$a=$this->Product->findByProduct_code($product_code);
			//pr($a); die;
			$a['Product']['product_code']=$product_code;
			$a['Product']['category_id']=$category_id;
			$a['Product']['barcode']=$barcode;
			$a['Product']['title']=$title;
			$a['Product']['vat']=$vat;
			$a['Product']['purchase_price']=$purchase_price;
			$a['Product']['retail_price']=$retail_price;
			$a['Product']['whole_price']=$whole_price;
			
			if(isset($a['Product']['id'])) 
				{
					if($updated_at!=$a['Product']['updated_at']) 
					{
						$a['Product']['updated_at']=$updated_at;
						$this->Product->save($a);
					}
				}
			else 
				{
				$a['Product']['updated_at']=$updated_at;
				$this->Product->save($a);				 
				}	
			
		}
		}
		
		fclose($fh);
	}
	
	function buy(){
	
		require 'components/excel.php';

		
		$data = array(
				array ('Name', 'Surname'),
				array ('Hồ', 'Ngọc Triển'),
				array ('Lê', 'Chánh Còi'),
				);

		// generate file (constructor parameters are optional)
		$xls = new Excel_XML('UTF-8', false, 'Workflow Management');
		$xls->addArray($data);
		$xls->generateXML('Output_Report_WFM');

	
	
	}
	
	
}


