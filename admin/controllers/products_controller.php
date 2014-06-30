<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck','xls');
	var $uses=array('Product','Shop','City','Setting','Guest','Order','Purchasing_document','Purchasing_document_item','Sale_document','Sale_document_item','Branch','Return_sale_document','Return_sale_document_item','Return_purchasing_document','Return_purchasing_document_item','Stockinventoryplus_document','Stockinventoryplus_item','Stockinventoryminus_document','Stockinventoryminus_item');
	function index() {
		$this->account();
		// $conditions=array('News.status'=>1);
		$this->paginate = array('conditions'=>array('Product.shop_id'=>null),'limit' => '15','order' => 'Product.id DESC');
		$this->set('product', $this->paginate('Product',array()));
		$this->loadModel("Catproduct");
		$list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
		$this->set(compact('list_cat'));
		
		$_list_part=$this->Shop->find('list',array('fields' => array('id', 'name')));
		$this->set('list_cat1',$_list_part);
		//$this->set(compact('list_cat1'));
		
		
	}
	
	/*Hóa đơn mua hàng*/	
	function buy() {
		$this->account();
		// $conditions=array('News.status'=>1);
		$this->paginate = array('limit' => '20','order' => 'Purchasing_document.id DESC');
		$this->set('Purchasing_document', $this->paginate('Purchasing_document',array()));
		
	}
	

	function export_nhap()
	{
		$this->account();
		if(isset($_POST['dropdown']))
		$select=$_POST['dropdown'];
		
		if(isset($_POST['checkall']))
		{
			
			switch ($select){
			case 'xuat':
				
				$this->Lading->recursive = 1;
				mysql_query("SET NAMES 'utf8'"); 
				mysql_query("SET character_set_client=utf8"); 
				mysql_query("SET character_set_connection=utf8");
				
				$data = $this->Purchasing_document->find('all',array('order' => 'Purchasing_document.id ASC'));
				
				$this->set('name','HOADONNHAP');
				$this->set('rows',$data);
				$this->render('export_xls_nhap','export_xls');
				
				
				
				//vong lap active
				break;
				
			case 'delete':
				$Purchasing_document=($this->Purchasing_document->find('all'));
				foreach($Purchasing_document as $Purchasing_document) {
					$this->Purchasing_document->delete($Purchasing_document['Purchasing_document']['id']);					
				}
				if($this->Purchasing_document->find('count')<1)
				$this->redirect(array('action' => 'index'));	
				else
				{
					$this->Session->setFlash(__('Danh mục không close được', true));
					$this->redirect(array('action' => 'index'));
				}
				//vong lap xoa
				break;
				
			}
		}
		else{
			
			switch ($select){
			case 'xuat':
				
				$Purchasing_document=($this->Purchasing_document->find('all'));
				$a=array();$i=0;
				foreach($Purchasing_document as $Purchasing_document) {
					if(isset($_POST[$Purchasing_document['Purchasing_document']['id']]))
					{
						$a[$i++]=$Purchasing_document;
					}
				}
				
				$this->Lading->recursive = 1;
				mysql_query("SET NAMES 'utf8'"); 
				mysql_query("SET character_set_client=utf8"); 
				mysql_query("SET character_set_connection=utf8");
				
				$this->set('name','HOADONNHAP');
				$this->set('rows',$a);
				$this->render('export_xls_nhap','export_xls');
				//vong lap active
				break;
				
			case 'delete':
				$Purchasing_document=($this->Purchasing_document->find('all'));
				foreach($Purchasing_document as $Purchasing_document) {
					if(isset($_POST[$Purchasing_document['Purchasing_document']['id']]))
					{
						$this->Purchasing_document->delete($Purchasing_document['Purchasing_document']['id']);
						
					}
					
				}
				$this->redirect(array('action'=>'buy'));
				
				//vong lap xoa
				break;
				
			}
			
		}
		
		
	}
	/*Xuất hóa đơn nhập ra excel*/	
	function export_xls_ctnhap($uuid=null) {
		$this->Lading->recursive = 1;
		mysql_query("SET NAMES 'utf8'"); 
		mysql_query("SET character_set_client=utf8"); 
		mysql_query("SET character_set_connection=utf8");
		$a=$this->Purchasing_document_item->find('all',array('conditions'=>array('Purchasing_document_item.purchasing_documents_uuid'=>$uuid),'limit' => '20','order' => 'Purchasing_document_item.id DESC')); 
		$this->set('Purchasing_document_item', $a);
		$this->set('name','CTHOADONNHAP');
		$this->render('export_xls_ctnhap','export_xls');
	}

	
	
	/*Xem chi tiết hóa đơn nhập*/	
	function view_hoadonnhap($uuid=null)
	{
		$this->account();
		$a=$this->Purchasing_document_item->find('all',array('conditions'=>array('Purchasing_document_item.purchasing_documents_uuid'=>$uuid),'limit' => '20','order' => 'Purchasing_document_item.id DESC')); 
		$this->set('Purchasing_document_item', $a);
		$this->set('uuid',$uuid);
		
	}

	/*End Hóa đơn nhập hàng*/		



	/*Hóa đơn bán*/
	function sales() {
		$this->account();
		// $conditions=array('News.status'=>1);
		$this->paginate = array('limit' => '20','order' => 'Sale_document.id DESC');
		$this->set('Sale_document', $this->paginate('Sale_document',array()));
		
		
	}
	
	function export_ban(){
		
		$this->account();
		if(isset($_POST['dropdown']))
		$select=$_POST['dropdown'];
		
		if(isset($_POST['checkall']))
		{
			
			$this->Lading->recursive = 1;
			mysql_query("SET NAMES 'utf8'"); 
			mysql_query("SET character_set_client=utf8"); 
			mysql_query("SET character_set_connection=utf8");
			
			$data = $this->Sale_document->find('all',array('order' => 'Sale_document.id ASC'));
			
			$this->set('name','HOADONBAN');
			$this->set('rows',$data);
			$this->render('export_xls_ban','export_xls');
			
			//vong lap active
			
			
		}
		else{
			
			
			$Sale_document=($this->Sale_document->find('all'));
			$a=array();$i=0;
			foreach($Sale_document as $Sale_document) {
				if(isset($_POST[$Sale_document['Sale_document']['id']]))
				{
					$a[$i++]=$Sale_document;
				}
			}
			
			$this->Lading->recursive = 1;
			mysql_query("SET NAMES 'utf8'"); 
			mysql_query("SET character_set_client=utf8"); 
			mysql_query("SET character_set_connection=utf8");
			
			$this->set('name','HOADONBAN');
			$this->set('rows',$a);
			$this->render('export_xls_ban','export_xls');
			
			
			//vong lap active
			
			
			
			
		}
		
	}

	
	/*Xem chi tiết hóa đơn bán hàng*/	
	function view_hoadonban($uuid=null)
	{
		$this->account();
		$a=$this->Sale_document_item->find('all',array('conditions'=>array('Sale_document_item.sale_documents_uuid'=>$uuid),'limit' => '20','order' => 'Sale_document_item.id DESC')); 
		$this->set('Sale_document_item', $a);
		$this->set('uuid',$uuid);
		
	}
	
	
	/*Xuất hóa đơn nhập ra excel*/	
	function export_xls_ctban($uuid=null) {
		$this->Lading->recursive = 1;
		mysql_query("SET NAMES 'utf8'"); 
		mysql_query("SET character_set_client=utf8"); 
		mysql_query("SET character_set_connection=utf8");
		$a=$this->Purchasing_document_item->find('all',array('conditions'=>array('Sale_document_item.sale_documents_uuid'=>$uuid),'limit' => '20','order' => 'Purchasing_document_item.id DESC')); 
		$this->set('Sale_document_item', $a);
		$this->set('name','CTHOADONBAN');
		$this->render('export_xls_ctban','export_xls');
	}
	
	
	/*End hóa đơn bán*/	


	/* TON KHO*/
	function stocks() {
		$this->account();
		// $conditions=array('News.status'=>1);
		/*Danh sach kho hang*/
		
		$list_cat=$this->Branch->find('list',array('fields'=>array('Branch.code','Branch.name')));
		//$this->Set('branch',$this->Branch->find('all'));
		
		$this->set(compact('list_cat'));
		
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.soluong >'=>0),'limit' => '15','order' => 'Product.id DESC');
		$this->set('product', $this->paginate('Product',array()));
		
		
	}
	
	
	
	function search_kho()

	{
		$this->account();
		$branch_code=$this->data['Product']['list_cat'];
		//$companyname=$this->Session->read('companyname');
		
		$a=$this->Purchasing_document->find('all',array('conditions'=>array('Purchasing_document.branch_code'=>$branch_code)));
		//pr($a); die;
		$product=array(); $n=0;
		foreach($a as $row){
			
			$b=$this->Purchasing_document_item->find('all',array('conditions'=>array('Purchasing_document_item.purchasing_documents_uuid'=>$row['Purchasing_document']['uuid'])));
			
			
			foreach($b as $b) 
			{
			
				
				//echo "aa"; die;
				$product[$n]['product_code']=$b['Purchasing_document_item']['product_code'];
				$product[$n]['soluongban']=0;
				$product[$n]['soluongbantralai']=0;
				$product[$n]['soluongmuatralai']=0;
				$product[$n]['dieuchinhthua']=0;
				$product[$n]['dieuchinhthieu']=0;
				
				$product[$n++]['soluong']=$b['Purchasing_document_item']['total_unit'];
			
				
			}
			//pr($product); die;
			
			$a=$this->Sale_document->find('all',array('conditions'=>array('Sale_document.branch_code'=>$branch_code)));
			foreach($a as $row){
				
				$b=$this->Sale_document_item->find('all',array('conditions'=>array('Sale_document_item.sale_documents_uuid'=>$row['Sale_document']['uuid'])));
				
				
				foreach($b as $b) 
				{
					foreach($product as $key=>$product1) {
					if($product1['product_code']==$b['Sale_document_item']['product_code'])
					{
						$product[$key]['soluongban']=$b['Sale_document_item']['total_unit'];
					
					}
					}
					
				}
				
			}
			
			/*Ban tra lai*/
			$a=$this->Return_sale_document->find('all',array('conditions'=>array('Return_sale_document.branch_code'=>$branch_code)));
			//pr($a); die;
			foreach($a as $row){
				
				$b=$this->Return_sale_document_item->find('all',array('conditions'=>array('Return_sale_document_item.return_sale_documents_uuid'=>$row['Return_sale_document']['uuid'])));
				
				//pr($b); die;
				foreach($b as $b) 
				{
					foreach($product as $key=>$product1) {
					if($product1['product_code']==$b['Return_sale_document_item']['product_code'])
					{
						$product[$key]['soluongbantralai']=$b['Return_sale_document_item']['total_unit'];
					
					}
					}
					
				}
				
			}
			
			/*End ban tra lai*/
			
			
			/*Mua tra lai*/
			$a=$this->Return_purchasing_document->find('all',array('conditions'=>array('Return_purchasing_document.branch_code'=>$branch_code)));
			//pr($a); die;
			foreach($a as $row){
				
				$b=$this->Return_purchasing_document_item->find('all',array('conditions'=>array('Return_purchasing_document_item.return_purchasing_documents_uuid'=>$row['Return_purchasing_document']['uuid'])));
				
				//pr($b); die;
				foreach($b as $b) 
				{
					foreach($product as $key=>$product1) {
					if($product1['product_code']==$b['Return_purchasing_document_item']['product_code'])
					{
						$product[$key]['soluongmuatralai']=$b['Return_purchasing_document_item']['total_unit'];
					
					}
					}
					
				}
				
			}
			
			/*End Mua tra lai*/
		
		
		/*Điều chỉnh thừa*/
			$a=$this->Stockinventoryplus_document->find('all',array('conditions'=>array('Stockinventoryplus_document.branch_code'=>$branch_code)));
			//pr($a); die;
			foreach($a as $row){
				
				$b=$this->Stockinventoryplus_item->find('all',array('conditions'=>array('Stockinventoryplus_item.stockinventoryplus_uuid'=>$row['Stockinventoryplus_document']['uuid'])));
				
				//pr($b); die;
				foreach($b as $b) 
				{
					foreach($product as $key=>$product1) {
					if($product1['product_code']==$b['Stockinventoryplus_item']['product_code'])
					{
						$product[$key]['dieuchinhthua']=$b['Stockinventoryplus_item']['total_unit'];
					
					}
					}
					
				}
				
			}
			
			/*End điều chỉnh thừa*/
			
			//pr($product); die;
			
			/*Điều chỉnh thiếu*/
			$a=$this->Stockinventoryminus_document->find('all',array('conditions'=>array('Stockinventoryminus_document.branch_code'=>$branch_code)));
			//pr($a); die;
			foreach($a as $row){
				
				$b=$this->Stockinventoryminus_item->find('all',array('conditions'=>array('Stockinventoryminus_item.stockinventoryminus_uuid'=>$row['Stockinventoryminus_document']['uuid'])));
				
				//pr($b); die;
				foreach($b as $b) 
				{
					foreach($product as $key=>$product1) {
					if($product1['product_code']==$b['Stockinventoryminus_item']['product_code'])
					{
						$product[$key]['dieuchinhthieu']=$b['Stockinventoryminus_item']['total_unit'];
					
					}
					}
					
				}
				
			}
			
			/*End điều chỉnh thiếu*/
			
			//pr($product); die;
		}
		//pr($product); die;
	
		
		
		
		$list_cat=$this->Branch->find('list',array('fields'=>array('Branch.code','Branch.name')));
		$this->set(compact('list_cat'));
		$this->Session->write('product_ton',$product);	
		
			$this->set('product',$product);
		$branch=$this->Branch->find('list',array('fields'=>array('Branch.name'),'conditions'=>array('Branch.code'=>$branch_code)));
		foreach($branch as $key=>$value) {$name=$value;}
		
		$this->set('product',$product);
		$this->set('branch_code',$name);
		$this->Session->write('branch_code',$name);
	}		
		
	function get_product_by_code($id=null)	
	{
	//echo "a"; die;
		return $this->Product->findByProduct_code($id);
	}
	

	function ton_xls()
	{
			$this->Lading->recursive = 1;
			mysql_query("SET NAMES 'utf8'"); 
			mysql_query("SET character_set_client=utf8"); 
			mysql_query("SET character_set_connection=utf8");
			
			$data = $this->Session->read('product_ton');
			$name='TONKHO_'.$this->Session->read('branch_code');
			//pr($data); die;
			$this->set('branch_code',$this->Session->read('branch_code'));
			$this->set('name',$name);
			$this->set('product',$data);
			$this->render('ton_xls','export_xls');

	}	
	
	function ton_txt()
	{
			$this->Lading->recursive = 1;
			mysql_query("SET NAMES 'utf8'"); 
			mysql_query("SET character_set_client=utf8"); 
			mysql_query("SET character_set_connection=utf8");
			
			$data = $this->Session->read('product_ton');
			$name='TONKHO_'.$this->Session->read('branch_code');
			//pr($data); die;
		
			$this->set('branch_code',$this->Session->read('branch_code'));
			$this->set('name',$name);
			$this->set('product',$data);
			$this->render('ton_txt','export_txt');

	}	
	
	
	
	
	
	
	
	
//End Tồn kho	
	
	
	
		function export_xls() {
			$this->Lading->recursive = 1;
			mysql_query("SET NAMES 'utf8'"); 
			mysql_query("SET character_set_client=utf8"); 
			mysql_query("SET character_set_connection=utf8");
			
			$data = $this->Product->find('all',array('conditions'=>array('Product.status'=>1),'order' => 'Product.id ASC'));
			
			
			$this->set('rows',$data);
			$this->render('export_xls','product');
		}
		
		function export_txt() {
			$this->Lading->recursive = 1;
			mysql_query("SET NAMES 'utf8'"); 
			mysql_query("SET character_set_client=utf8"); 
			mysql_query("SET character_set_connection=utf8");
			
			$data = $this->Product->find('all',array('conditions'=>array('Product.status'=>1),'order' => 'Product.id ASC'));
			
			
			$this->set('rows',$data);
			$this->render('export_txt','export_txt');
		}
		
		
		
		
		
		
		/*Update so luong*/
		function updateshopingcart1($id=null,$soluong=null, $str=null)
		{
			
			$chuoi=explode('|',$str);
			$chuoi1=$chuoi[0].'|'.$chuoi[1].'|'.$soluong;
			
			$a=$this->Order->findById($id);
			//pr($a); die;
			//echo $id.'--'.$str.'-----'.$chuoi1.'-----'.$a['Order']['product'];
			$a['Order']['product']=str_replace($str,$chuoi1,$a['Order']['product']);
			//echo $a['Order']['product']; die;
			$this->Order->save($a);
			
			$this->redirect(array('controller'=>'orders','action' => 'view/'.$id));
		}
		
		
		
		
		function index1() {
			$this->account();
			// $conditions=array('News.status'=>1);
			$this->paginate = array('conditions'=>array('Product.shop_id <>'=>null),'limit' => '15','order' => 'Product.id DESC');
			$this->set('product', $this->paginate('Product',array()));
			$this->loadModel("Catproduct");
			$list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
			$this->set(compact('list_cat'));
			
			
			
		}
		
		
		function date($date)
		{
			$ngay = explode("-", $date);
			$date1=$ngay['2'].'-'.$ngay['1'].'-'.$ngay['0'];
			return  $date1;
		}

		
		
		//Them bai viet
		function add() {
			$this->account();
			$this->set('city',$this->City->find('all'));
			if (!empty($this->data)) {
				$this->Product->create();
				$data['Product'] = $this->data['Product'];
				$data['Product']['images']=$_POST['userfile1'];
				
				$data['Product']['chophep']=1;
				if($_POST['date_batdau']!='')
				$data['Product']['date_batdau']=$this->date($_POST['date_batdau']);
				if($_POST['date_ketthuc']!='')
				$data['Product']['date_ketthuc']=$this->date($_POST['date_ketthuc']);
				
				$data['Product']['conlai']=$data['Product']['soluong']-$data['Product']['daban'];
				
				$data['Product']['price']=$this->chuantien($this->data['Product']['price']);
				
				$data['Product']['price_old']=$this->chuantien($this->data['Product']['price_old']);
				
				$data['Product']['giam']=round(($data['Product']['price_old']-$data['Product']['price'])*100/$data['Product']['price_old']);
				
				// 			echo '<pre>';
				// 			print_r($data);die();
				
				//$data['Product']['images_eg']=$_POST['userfile_eg'];
				//	$data['Product']['display']=$_POST['display'];
				if ($this->Product->save($data['Product'])) {
					
					$sanpham=$this->Product->find('all',array('order'=>'Product.id DESC','limit'=>1));        
					require("components/class.phpmailer.php");  

					$mail = new PHPMailer();

					$setting=$this->Setting->findById(1);
					$email=$setting['Setting']['email'];
					//Thiet lap thong tin nguoi gui va email nguoi gui
					$mail->SetFrom($email,'hoichogiare');
					//Thiết lập định dạng font chữ
					$mail->CharSet = "utf-8";

					
					$guest=$this->Guest->find('all',array('order'=>'Guest.id ASC')) ;
					foreach($guest as $guest){



						//Thiết lập thông tin người nhận
						//$mail->AddAddress("zenvn@gmail.com", "ZendVN Group");
						$mail->AddAddress($guest['Guest']['email'],$guest['Guest']['email']);

						//$mail->AddReplyTo($email,$name);

						$mail->Subject    = "Sản phẩm mới từ tienthoi.com.vn";

						$mail->Ishtml(true);


						//Thiết lập nội dung chính của email

						$mail->Body = " 
tienthoi.com.vn có sản phẩm mới
<a target='_blank' href='http://tienthoi.com.vn/chi-tiet-san-pham/".$sanpham[0]['Product']['id']."'>
".$this->data['Product']['title']."
</a>
";
						
						$mail->Send();}
					
					$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
				}
			}
			$this->loadModel("Catproduct");
			$list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
			$this->set(compact('list_cat'));
			
			
			
			
			//         $list_cat1 = $this->City->find('all');
			//         $this->set(compact('list_cat1'));
			
			
			
		}
		//view mot tin 
		function view($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Không tồn tại', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('views', $this->Product->read(null, $id));
		}
		//dong danh muc
		function close($id=null) {
			$this->account();
			if (empty($id)) {
				$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
				$this->redirect(array('action'=>'index'));
			}
			$data['Product'] = $this->data['Product'];
			$data['Product']['id']=$id;
			$data['Product']['status']=0;		
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Danh mục không được hiển thị', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Danh mục không close được', true));
			$this->redirect(array('action' => 'index'));

		}
		// kich hoat
		function active($id=null) {
			$this->account();
			if (empty($id)) {
				$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
				$this->redirect(array('action'=>'index'));
			}
			$data['Product'] = $this->data['Product'];
			$data['Product']['id']=$id;
			$data['Product']['status']=1;
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
			$this->redirect(array('action' => 'index'));

		}
		function export_excel()
		{
			$this->paginate = array('conditions'=>array('Product.shop_id'=>null),'order' => 'Product.id DESC');
			$data = $this->paginate('Product',array());
			print_r($data); die();
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");;
			header("Content-Disposition: attachment;filename=buylist.xls "); 
			header("Content-Transfer-Encoding: binary ");

			$this->xlsBOF();

			/*
			Make a top line on your excel sheet at line 1 (starting at 0).
			The first number is the row number and the second number is the column, both are start at '0'
			*/

			$this->xlsWriteLabel(0,0,"Danh sach hang nhap.");

			// Make column labels. (at line 3)
			$this->xlsWriteLabel(2,0,"Name");
			$this->xlsWriteLabel(2,1,"Barcode");
			$this->xlsWriteLabel(2,2,"So luong");
			$this->xlsWriteLabel(2,2,"Tien");
			$xlsRow = 4;

			// Put data records from mysql by while loop.
			while($row=$data['Product']){

				$this->xlsWriteNumber($xlsRow,0,$row['title']);
				$this->xlsWriteLabel($xlsRow,1,$row['barcode']);
				$this->xlsWriteLabel($xlsRow,2,$row['soluong']);
				$this->xlsWriteLabel($xlsRow,3,$row['price']);

				$xlsRow++;
			} 
			$this->xlsEOF();
			exit();
		}
		function xlsBOF() { 
			echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); 
			return; 
		} 
		function xlsEOF() { 
			echo pack("ss", 0x0A, 0x00); 
			return; 
		} 
		function xlsWriteNumber($Row, $Col, $Value) { 
			echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
			echo pack("d", $Value); 
			return; 
		} 
		function xlsWriteLabel($Row, $Col, $Value ) { 
			$L = strlen($Value); 
			echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
			echo $Value; 
			return; 
		} 

		// tim kiem san pham
		/*function search() {
		$data['Product']=$this->data['Product'];
		$category=$data['Product']['catproduct_id'];
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>$category),'limit' => '15','order' => 'Product.id DESC');
		$this->set('product', $this->paginate('Product',array()));
		$this->loadModel("Catproduct");
		$list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
		$this->set(compact('list_cat'));
		
	}*/
		function search() {
			$this->loadModel("Catproduct");
			$keyword="";
			$list_cat="";
			
			if(isset($_POST['keyword']))
			$keyword=$_POST['keyword'];
			
			if(isset($_POST['list_cat']))
			$list_cat=$_POST['list_cat'];
			$x=array();
			if($keyword!="")
			$x['Product.title like']='%'.$keyword.'%';
			
			if($list_cat!="")
			$x['Product.catproduct_id']=$list_cat;
			//pr($x);exit;
			$tt =array();
			$portfolio=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.parent_id'=>$x)));		
			//pr($portfolio);
			foreach($portfolio as $key){
				$tt[]=$key['Catproduct']['id'];
			}
			for($i=0;$i<count($tt);$i++)
			if($list_cat==$tt[$i])
			$list_cat=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$tt[$i]),'fields'=>array('Catproduct.id')));	
			if($list_cat!="")
			$x['Product.catproduct_id']=$list_cat;
			//pr($x); die;
			//
			//$this->set('products', $this->paginate('Product',array()));	
			//pr($x);
			$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Product.id DESC');
			$this->set('product', $this->paginate('Product',array()));	
			//$ketquatimkiem=$this->Product->find('all',array('conditions'=>$x,'order' => 'Product.id DESC','limit'=>3));	
			//pr($ketquatimkiem); die;
			//$this->set('products',$category);
			$this->loadModel("Catproduct");
			$list_cat1 = $this->Catproduct->generatetreelist(null,null,null," _ ");
			$this->set(compact('list_cat'));
			
		}
		
		
		
		
		// sua tin da dang
		function edit($id = null) {
			$this->account();
			
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Không tồn tại ', true));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->data)) {
				$data['Product'] = $this->data['Product'];
				
				$data['Product']['chophep']=1;
				$data['Product']['images']=$_POST['userfile1'];
				$data['Product']['conlai']=$data['Product']['soluong']-$data['Product']['daban'];
				if($_POST['date_batdau']!='')
				$data['Product']['date_batdau']=$this->date($_POST['date_batdau']);
				if($_POST['date_batdau']!='')
				$data['Product']['date_ketthuc']=$this->date($_POST['date_ketthuc']);

				$this->chuantien($this->data['Product']['price']);
				
				$data['Product']['price']=$this->chuantien($this->data['Product']['price']);
				
				$data['Product']['price_old']=$this->chuantien($this->data['Product']['price_old']);
				
				$data['Product']['giam']=round(($data['Product']['price_old']-$data['Product']['price'])*100/$data['Product']['price_old']);
				
				
				//$data['Product']['display']=$_POST['display'];
				if ($this->Product->save($data['Product'])) {
					$this->Session->setFlash(__('Bài viết sửa thành công', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Product->read(null, $id);
			}
			$this->loadModel("Catproduct");
			$list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
			$this->set(compact('list_cat'));
			$this->set('edit',$this->Product->findById($id));
			
			$_list_part=$this->City->find('list',array('fields' => array('id', 'name')));
			$this->set('list_cat1',$_list_part);
			$this->set(compact('list_cat1'));
			
			
		}
		function processing() {
			$this->account();
			if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
			if(isset($_POST['checkall']))
			{
				
				switch ($select){
				case 'active':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						$product['Product']['status']=1;
						$this->Product->save($product['Product']);					
					}
					//vong lap active
					break;
				case 'notactive':	
					//vong lap huy
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						$product['Product']['status']=0;
						$this->Product->save($product['Product']);					
					}
					break;
				case 'delete':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						$this->Product->delete($product['Product']['id']);					
					}
					if($this->Product->find('count')<1)
					$this->redirect(array('action' => 'index'));	
					else
					{
						$this->Session->setFlash(__('Danh mục không close được', true));
						$this->redirect(array('action' => 'index'));
					}
					//vong lap xoa
					break;
					
				}
			}
			else{
				
				switch ($select){
				case 'active':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						if(isset($_POST[$product['Product']['id']]))
						{
							$product['Product']['status']=1;
							$this->Product->save($product['Product']);
						}
					}
					//vong lap active
					break;
				case 'notactive':	
					//vong lap huy
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						if(isset($_POST[$product['Product']['id']]))
						{
							$product['Product']['status']=0;
							$this->Product->save($product['Product']);
						}
					}
					break;
				case 'delete':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						if(isset($_POST[$product['Product']['id']]))
						{
							$this->Product->delete($product['Product']['id']);
							
						}
						
					}
					$this->redirect(array('action'=>'index'));
					die;	
					//vong lap xoa
					break;
					
				}
				
			}
			$this->redirect(array('action' => 'index'));
			
		}
		// Xoa cac dang
		function delete($id = null) {
			$this->account();		
			if (empty($id)) {
				$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
				//$this->redirect(array('action'=>'index'));
			}
			if ($this->Product->delete($id)) {
				$this->Session->setFlash(__('Xóa bài viết thành công', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Bài viết không xóa được', true));
			$this->redirect(array('action' => 'index'));
		}
		function _find_list() {
			return $this->Catproduct->generatetreelist(null, null, null, '__');
		}
		//check ton tai tai khoan
		function account(){
			if(!$this->Session->read("id") || !$this->Session->read("name")){
				$this->redirect('/');
			}
		}
		// chon layout
		function beforeFilter(){
			$this->layout='admin';
		}

		function dinhdangngay($date=null){
			$date=explode("-", $date);
			$date1=$date['2'].'-'.$date['1'].'-'.$date['0'];
			return $date1;
			
		}
		
		function chuantien($tien){
			$a='/[^0-9]/';
			$b='';
			return (int)preg_replace($a,$b,$tien);
			
		}
		
		
		function add1() {
			$this->account();
			//$this->set('city',$this->City->find('all'));
			if (!empty($this->data)) {
				$this->Product->create();
				$data['Product'] = $this->data['Product'];
				$data['Product']['images']=$_POST['userfile1'];
				
				
				$data['Product']['date_batdau']=$this->date($_POST['date_batdau']);
				$data['Product']['date_ketthuc']=$this->date($_POST['date_ketthuc']);
				
				$data['Product']['conlai']=$data['Product']['soluong']-$data['Product']['daban'];
				
				$data['Product']['price']=$this->chuantien($this->data['Product']['price']);
				
				$data['Product']['price_old']=$this->chuantien($this->data['Product']['price_old']);
				
				$data['Product']['giam']=round(($data['Product']['price_old']-$data['Product']['price'])*100/$data['Product']['price_old']);
				
				
				// 			echo '<pre>';
				// 			print_r($data);die();
				
				//$data['Product']['images_eg']=$_POST['userfile_eg'];
				//	$data['Product']['display']=$_POST['display'];
				if ($this->Product->save($data['Product'])) {
					$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
					$this->redirect(array('action' => 'index1'));
				} else {
					$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
				}
			}
			$this->loadModel("Catproduct");
			$list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
			$this->set(compact('list_cat'));
			
			
			$_list_part=$this->Shop->find('list',array('fields' => array('id', 'name')));
			$this->set('list_cat1',$_list_part);
			$this->set(compact('list_cat1'));
			
			//         $list_cat1 = $this->City->find('all');
			//         $this->set(compact('list_cat1'));
			
			
			
		}
		
		//view mot tin 
		function view1($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Không tồn tại', true));
				$this->redirect(array('action' => 'index1'));
			}
			$this->set('views', $this->Product->read(null, $id));
		}
		//dong danh muc
		function close1($id=null) {
			$this->account();
			if (empty($id)) {
				$this->Session->setFlash(__('Không tồn tại danh mục này', true));
				$this->redirect(array('action'=>'index1'));
			}
			$data['Product'] = $this->data['Product'];
			$data['Product']['id']=$id;
			$data['Product']['status']=0;		
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Danh mục không được hiển thị', true));
				$this->redirect(array('action'=>'index1'));
			}
			$this->Session->setFlash(__('Danh mục không close được', true));
			$this->redirect(array('action' => 'index1'));

		}
		// kich hoat
		function active1($id=null) {
			$this->account();
			if (empty($id)) {
				$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
				$this->redirect(array('action'=>'index1'));
			}
			$data['Product'] = $this->data['Product'];
			$data['Product']['id']=$id;
			$data['Product']['status']=1;
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
				$this->redirect(array('action'=>'index1'));
			}
			$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
			$this->redirect(array('action' => 'index1'));

		}
		
		//dong danh muc
		function close2($id=null) {
			$this->account();
			if (empty($id)) {
				$this->Session->setFlash(__('Không tồn tại danh mục này', true));
				$this->redirect(array('action'=>'index1'));
			}
			$data['Product'] = $this->data['Product'];
			$data['Product']['id']=$id;
			$data['Product']['chophep']=0;		
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Danh mục không được hiển thị', true));
				$this->redirect(array('action'=>'index1'));
			}
			$this->Session->setFlash(__('Danh mục không close được', true));
			$this->redirect(array('action' => 'index1'));

		}
		// kich hoat
		function active2($id=null) {
			$this->account();
			if (empty($id)) {
				$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
				$this->redirect(array('action'=>'index1'));
			}
			$data['Product'] = $this->data['Product'];
			$data['Product']['id']=$id;
			$data['Product']['chophep']=1;
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
				$this->redirect(array('action'=>'index1'));
			}
			$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
			$this->redirect(array('action' => 'index1'));

		}
		
		// tim kiem san pham
		/*function search() {
		$data['Product']=$this->data['Product'];
		$category=$data['Product']['catproduct_id'];
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>$category),'limit' => '15','order' => 'Product.id DESC');
		$this->set('product', $this->paginate('Product',array()));
		$this->loadModel("Catproduct");
		$list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
		$this->set(compact('list_cat'));
		
	}*/
		function search1() {
			$this->loadModel("Catproduct");
			$keyword="";
			$list_cat="";
			
			if(isset($_POST['keyword']))
			$keyword=$_POST['keyword'];
			
			if(isset($_POST['list_cat']))
			$list_cat=$_POST['list_cat'];
			$x=array();
			if($keyword!="")
			$x['Product.title like']='%'.$keyword.'%';
			
			if($list_cat!="")
			$x['Product.catproduct_id']=$list_cat;
			//pr($x);exit;
			$tt =array();
			$portfolio=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.parent_id'=>$x)));		
			//pr($portfolio);
			foreach($portfolio as $key){
				$tt[]=$key['Catproduct']['id'];
			}
			for($i=0;$i<count($tt);$i++)
			if($list_cat==$tt[$i])
			$list_cat=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$tt[$i]),'fields'=>array('Catproduct.id')));	
			if($list_cat!="")
			$x['Product.catproduct_id']=$list_cat;
			//pr($x); die;
			//
			//$this->set('products', $this->paginate('Product',array()));	
			//pr($x);
			$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Product.id DESC');
			$this->set('product', $this->paginate('Product',array()));	
			//$ketquatimkiem=$this->Product->find('all',array('conditions'=>$x,'order' => 'Product.id DESC','limit'=>3));	
			//pr($ketquatimkiem); die;
			//$this->set('products',$category);
			$this->loadModel("Catproduct");
			$list_cat1 = $this->Catproduct->generatetreelist(null,null,null," _ ");
			$this->set(compact('list_cat'));
			
		}
		
		
		
		
		// sua tin da dang
		function edit1($id = null) {
			$this->account();
			
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Không tồn tại ', true));
				$this->redirect(array('action' => 'index1'));
			}
			if (!empty($this->data)) {
				$data['Product'] = $this->data['Product'];
				
				
				$data['Product']['images']=$_POST['userfile1'];
				$data['Product']['conlai']=$data['Product']['soluong']-$data['Product']['daban'];
				
				$data['Product']['date_batdau']=$this->date($_POST['date_batdau']);
				$data['Product']['date_ketthuc']=$this->date($_POST['date_ketthuc']);

				$this->chuantien($this->data['Product']['price']);
				
				$data['Product']['price']=$this->chuantien($this->data['Product']['price']);
				
				$data['Product']['price_old']=$this->chuantien($this->data['Product']['price_old']);
				$data['Product']['giam']=round(($data['Product']['price_old']-$data['Product']['price'])*100/$data['Product']['price_old']);
				
				
				
				//$data['Product']['display']=$_POST['display'];
				if ($this->Product->save($data['Product'])) {
					$this->Session->setFlash(__('Bài viết sửa thành công', true));
					$this->redirect(array('action' => 'index1'));
				} else {
					$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Product->read(null, $id);
			}
			$this->loadModel("Catproduct");
			$list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
			$this->set(compact('list_cat'));
			$this->set('edit',$this->Product->findById($id));
			
			$_list_part=$this->Shop->find('list',array('fields' => array('id', 'name')));
			$this->set('list_cat1',$_list_part);
			$this->set(compact('list_cat1'));
			
			
		}
		function processing1() {
			$this->account();
			if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
			if(isset($_POST['checkall']))
			{
				
				switch ($select){
				case 'active':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						$product['Product']['status']=1;
						$this->Product->save($product['Product']);					
					}
					//vong lap active
					break;
				case 'notactive':	
					//vong lap huy
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						$product['Product']['status']=0;
						$this->Product->save($product['Product']);					
					}
					break;
					
				case 'active1':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						$product['Product']['chophep']=1;
						$this->Product->save($product['Product']);					
					}
					//vong lap active
					break;
				case 'notactive1':	
					//vong lap huy
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						$product['Product']['chophep']=0;
						$this->Product->save($product['Product']);					
					}
					break;
					
				case 'delete':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						$this->Product->delete($product['Product']['id']);					
					}
					if($this->Product->find('count')<1)
					$this->redirect(array('action' => 'index1'));	
					else
					{
						$this->Session->setFlash(__('Danh mục không close được', true));
						$this->redirect(array('action' => 'index1'));
					}
					//vong lap xoa
					break;
					
				}
			}
			else{
				
				switch ($select){
				case 'active':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						if(isset($_POST[$product['Product']['id']]))
						{
							$product['Product']['status']=1;
							$this->Product->save($product['Product']);
						}
					}
					//vong lap active
					break;
				case 'notactive':	
					//vong lap huy
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						if(isset($_POST[$product['Product']['id']]))
						{
							$product['Product']['status']=0;
							$this->Product->save($product['Product']);
						}
					}
					break;
					
				case 'active1':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						if(isset($_POST[$product['Product']['id']]))
						{
							$product['Product']['status']=1;
							$this->Product->save($product['Product']);
						}
					}
					//vong lap active
					break;
				case 'notactive1':	
					//vong lap huy
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						if(isset($_POST[$product['Product']['id']]))
						{
							$product['Product']['status']=0;
							$this->Product->save($product['Product']);
						}
					}
					break;
				case 'delete':
					$products=($this->Product->find('all'));
					foreach($products as $product) {
						if(isset($_POST[$product['Product']['id']]))
						{
							$this->Product->delete($product['Product']['id']);
							
						}
						
					}
					$this->redirect(array('action'=>'index1'));
					die;	
					//vong lap xoa
					break;
					
				}
				
			}
			$this->redirect(array('action' => 'index1'));
			
		}
		// Xoa cac dang
		function delete1($id = null) {
			$this->account();		
			if (empty($id)) {
				$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
				//$this->redirect(array('action'=>'index'));
			}
			if ($this->Product->delete($id)) {
				$this->Session->setFlash(__('Xóa bài viết thành công', true));
				$this->redirect(array('action'=>'index1'));
			}
			$this->Session->setFlash(__('Bài viết không xóa được', true));
			$this->redirect(array('action' => 'index1'));
		}
		
		function get_product($id=null)
		
		{
			return $this->Product->findById($id);
		}
		
	}
	?>
