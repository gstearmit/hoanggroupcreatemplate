<?php
class OrdersController extends AppController {

	var $name = 'Orders';
	var $uses=array('Order','Userscms','Product');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('Order.status'=>1);
		  $this->paginate = array('limit' => '10','order' => 'Order.id ASC');
	      $this->set('Order', $this->paginate('Order',array()));
	$this->Session->write('order',$this->Order->find('all'));
		
		
		  
	}
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Order->create();
			$data['Order'] = $this->data['Order'];
			$data['Order']['images']=$_POST['userfile'];
			
			if ($this->Order->save($data['Order'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Order->read(null, $id));
	}
	
	/*function search() {
		$data['Order']=$this->data['Order'];
		$CategorynewsOrder=$data['Order']['CategorynewsOrder_id'];
		$this->paginate = array('conditions'=>array('Order.CategorynewsOrder_id'=>$CategorynewsOrder),'limit' => '15','order' => 'Order.id DESC');
	    $this->set('Order', $this->paginate('Order',array()));
		
	}
	*/
function search() {
	
		$keyword=isset($_POST['name'])? $_POST['name'] :'';
		$date1=$date2='';
		$date1=isset($_POST['date_batdau'])? $_POST['date_batdau'] :'';
		$date2=isset($_POST['date_batdau'])? $_POST['date_batdau'] :'';
		if(isset($_POST['date_batdau'])) 
		{
			$date1=$_POST['date_batdau'];
			$date=explode('-',$date1);
			$date1="'".$date[2].'-'.$date[1].'-'.$date[0]."'";
		
		}
		if(isset($_POST['date_ketthuc'])) 
			{
				$date2=$_POST['date_ketthuc'];
				$date=explode('-',$date2);
				$date2="'".$date[2].'-'.$date[1].'-'.$date[0]."'";
			}	
		
		
		if($date1!='' && $date2!='') 
		{
				if($keyword!='') 
				{
					$a=$this->Order->find('all',array('conditions'=>array('Order.name like'=>"% $keyword %","DATEDIFF(Order.created,$date1) >= "=>0,"DATEDIFF(Order.created,$date2) <= "=>0)));
					$this->paginate = array('conditions'=>array('Order.name like'=>"% $keyword %","DATEDIFF(Order.created,$date1) > "=>0,"DATEDIFF(Order.created,$date2) > "<=0),'limit' => '12','order' => 'Order.id DESC');
					$this->set('Order', $this->paginate('Order',array()));	
				}
				else 
				{
					$a=$this->Order->find('all',array('conditions'=>array("DATEDIFF(Order.created,$date1) >= "=>0,"DATEDIFF(Order.created,$date2) <= "=>0)));
					$this->paginate = array('conditions'=>array("DATEDIFF(Order.created,$date1) >= "=>0,"DATEDIFF(Order.created,$date2) <= "<=0),'limit' => '12','order' => 'Order.id DESC');
					$this->set('Order', $this->paginate('Order',array()));	
				}
		
		//pr($a); die;
		} 
		else 
		{
		
			$x['Order.name like']='%'.$keyword.'%';
			$a=$this->Order->find('all',array('conditions'=>$x,'limit' => '12','order' => 'Order.id DESC'));
			$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Order.id DESC');
			$this->set('Order', $this->paginate('Order',array()));	
		}
	$this->Session->write('order',$a);
		
	
		
	}
	
	
/* Xuat file excel + txt */
	
	function export_xls() {
		$this->Lading->recursive = 1;
		mysql_query("SET NAMES 'utf8'"); 
   		mysql_query("SET character_set_client=utf8"); 
  		mysql_query("SET character_set_connection=utf8");
	
		
		$this->set('rows',$this->Session->read('order'));
		$this->render('export_xls','order');
	}
	
	function export_txt() {
		$this->Lading->recursive = 1;
		mysql_query("SET NAMES 'utf8'"); 
   		mysql_query("SET character_set_client=utf8"); 
  		mysql_query("SET character_set_connection=utf8");
	
		$this->set('rows',$this->Session->read('order'));
		$this->render('export_txt','order_txt');
	}
	
/*End Xuat file excel + txt*/

/* Xuat file excel + txt */
	
	function export_xls1($id=null) {
		$this->Lading->recursive = 1;
		mysql_query("SET NAMES 'utf8'"); 
   		mysql_query("SET character_set_client=utf8"); 
  		mysql_query("SET character_set_connection=utf8");
	
		$a=$this->Order->findById($id);
		$name='HOADONBAN_'.$a['Order']['name'];
		$this->set('rows',$a);
		$this->set('name',$name);
		$this->render('export_xls1','export_xls');
	}
	
	function export_txt1($id=null) {
		$this->Lading->recursive = 1;
		mysql_query("SET NAMES 'utf8'"); 
   		mysql_query("SET character_set_client=utf8"); 
  		mysql_query("SET character_set_connection=utf8");
		
		$a=$this->Order->findById($id);
		$this->set('rows',$a);
		$name='HOADONBAN_'.$a['Order']['name'];
		$this->set('name',$name);
		
		
		$this->render('export_txt','export_txt');
	}
	
/*End Xuat file excel + txt*/
	
	
	
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
				    
                    if($new['Order']['status']!=1){
					$new['Order']['status']=1;
					$this->Order->save($new['Order']);
                         
                 $id=$new['Order']['id'];
                 
            $product=$this->Order->findById($id);
            $mang=$product['Order']['product'];
            $chuoi=explode('/',$mang);
            
            for($i=0;$i<count($chuoi)-1; $i++){
                $chuoi1=explode('|',$chuoi[$i]);
                $pr=$this->Product->findById($chuoi1[0]);
                $pr['Product']['dabanthat']=$pr['Product']['dabanthat']+$chuoi1[2];
                $this->Product->save($pr);
                
            }
            }
                    					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
				    if($new['Order']['status']!=0){
					$new['Order']['status']=0;
					$this->Order->save($new['Order']);	
                    
                 $id=$new['Order']['id'];
            $product=$this->Order->findById($id);
            $mang=$product['Order']['product'];
            $chuoi=explode('/',$mang);
            
            for($i=0;$i<count($chuoi)-1; $i++){
                $chuoi1=explode('|',$chuoi[$i]);
                $pr=$this->Product->findById($chuoi1[0]);
                $pr['Product']['dabanthat']=$pr['Product']['dabanthat']-$chuoi1[2];
                $this->Product->save($pr);
                
            }
                 }   				
				}
				break;
				case 'delete':
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					$this->Order->delete($new['Order']['id']);					
				}
				if($this->Order->find('count')<1)
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
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					if(isset($_POST[$new['Order']['id']]))
					{
						$new['Order']['status']=1;
						$this->Order->save($new['Order']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					if(isset($_POST[$new['Order']['id']]))
					{
						$new['Order']['status']=0;
						$this->Order->save($new['Order']);
					}
				}
				break;
				case 'delete':
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					if(isset($_POST[$new['Order']['id']]))
					{
					    $this->Order->delete($new['Order']['id']);
						
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
	
		//dong danh muc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Order'] = $this->data['Order'];
		$data['Order']['id']=$id;
		$data['Order']['status']=0;		
		if ($this->Order->save($data['Order'])) {
		
            
            
            $product=$this->Order->findById($id);
            $mang=$product['Order']['product'];
            $chuoi=explode('/',$mang);
            
            for($i=0;$i<count($chuoi)-1; $i++){
                $chuoi1=explode('|',$chuoi[$i]);
                $pr=$this->Product->findById($chuoi1[0]);
                $pr['Product']['dabanthat']=$pr['Product']['dabanthat']-$chuoi1[2];
                $this->Product->save($pr);
                
            }
            
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
		$data['Order'] = $this->data['Order'];
		$data['Order']['id']=$id;
		$data['Order']['status']=1;
		if ($this->Order->save($data['Order'])) {
		
            
            $product=$this->Order->findById($id);
            $mang=$product['Order']['product'];
            $chuoi=explode('/',$mang);
            //pr($chuoi); die;
            
            for($i=0;$i<count($chuoi)-1; $i++){
                $chuoi1=explode('|',$chuoi[$i]);
                $pr=$this->Product->findById($chuoi1[0]);
                $pr['Product']['dabanthat']=$pr['Product']['dabanthat']+$chuoi1[2];
                $this->Product->save($pr);
                
            }
            
            	$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
            
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}
    
    
    	//dong danh muc
	function close1($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Order'] = $this->data['Order'];
		$data['Order']['id']=$id;
		$data['Order']['tinhtrang']=0;		
		if ($this->Order->save($data['Order'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active1($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Order'] = $this->data['Order'];
		$data['Order']['id']=$id;
		$data['Order']['tinhtrang']=1;
		if ($this->Order->save($data['Order'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

    

	// sua tin da dang
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Order'] = $this->data['Order'];
			
			
			if ($this->Order->save($data['Order'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Order->read(null, $id);
		}
		
		$this->set('edit',$this->Order->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Order->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->CategorynewsOrder->generatetreelist(null, null, null, '__');
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
	
	function get_userscms($id=null){
	
	return $this->Userscms->find('all',array('conditions'=>array('Userscms.id'=>$id),'limit'=>1));
	}
	
	function get_product($id){
		return $this->Product->findById($id);
		}
	

}
?>
