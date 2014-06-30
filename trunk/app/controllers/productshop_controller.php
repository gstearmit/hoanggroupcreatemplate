<?php
class ProductshopController extends AppController {

	var $name = 'Productshop';
	var $uses=array('Productshop','Shop','Categoryshop','Category');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	//list danh sach cac danh muc
	function index() {	
	 $this->checkIfLogged();
	  //echo"nam";
	$this->Session->write('id',17);
	  $user = $this->Session->read('id');
	  
	    $nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		$this->set('nameshop', $nameshop); 
		 //----------------------------------
	   $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
	 //  pr($temshop);die;
	   $this->set('productshop',$this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.shop_id'=>$temshop[0]['Shop']['id']),'order'=>'Productshop.id DESC')));
	   $list_cat = $this->Categoryshop->generatetreelist(null,null,null,"--- ");
	   $this->set(compact('list_cat'));
	}
	
	//them danh muc moi
	function add($id = null){
	  $this->checkIfLogged();
		
	  $this->layout='home2';
		$x=$this->Category->read(null, $id);
        $this->set('nameproduct', $x); 
        $this->Session->write('id',17);
		 $user = $this->Session->read('id');
		// lay danh muc cua tung cua hang
		
	     $nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('shopname', $nameshop); 
		 //------------------------------
		 $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		
		 foreach ($temshop as $temshop){
		 	$tems=$temshop['Shop']['id'];
		 	break;
		 }
		 
		if (!empty($this->data)) 
		{
			
			$this->Productshop->create();
			
			$this->data['Productshop']['shop_id']=$tems;
			$this->data['Productshop']['images']=$_POST['userfile'];
			$this->data['Productshop']['money']=$_POST['money'];
			$this->data['Productshop']['slug']=$this->unicode_convert($this->data['Productshop']['title']);
			$this->data['Productshop']['status']=1;
			$this->data['Productshop']['user_id']=$user;
			$this->data['Productshop']['category_id']=$_POST['category_id'];
			$this->data['Productshop']['categoryshop_id']=$this->data['Productshop']['categoryshop_id'];
			$this->data['Productshop']['quality']=$_POST['quality'];
			if ($this->Productshop->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
				//pr($this->Categoryshops->save($this->data));die;
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$categoryshop = $tems;
		//echo $categoryshop;die;
        $list_cat = $this->Categoryshop->generatetreelist('Categoryshop.shop_id = "'.$categoryshop.'"',null,null," _ ");
        $this->set(compact('list_cat'));
		 $this->set('categoryshop', $categoryshop); 
		}
		
	function edit($id = null) {
		 $this->checkIfLogged();
		 $x=$this->Category->read(null, $id);
	
        $this->set('nameproduct', $x);
		$user = $this->Session->read('id');
		 //------------------------------
		 $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		$categoryshop = $temshop[0]['Shop']['id'];
		//echo $categoryshop;die;
		$this->layout='home2';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại sản phẩm này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Productshop']['slug']=$this->unicode_convert($this->data['Productshop']['title']);
			$this->data['Productshop']['shop_id']=$temshop[0]['Shop']['id'];
			$this->data['Productshop']['images']=$_POST['userfile'];
			$this->data['Productshop']['money']=$_POST['money'];
			$this->data['Productshop']['user_id']=$user;
			$this->data['Productshop']['status']=1;
			//$this->data['Productshop']['category_id']=$_POST['category_id'];
			$this->data['Productshop']['quality']=$_POST['quality'];
			if ($this->Productshop->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sửa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Productshop->read(null, $id);
			$this->parent_id = $this->Productshop->read(null, $id);
			
		}
		 $user = $this->Session->read('id');
	     $nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('nameshop', $nameshop); 
		$list_cat = $this->Categoryshop->generatetreelist('Categoryshop.shop_id = "'.$categoryshop.'"',null,null," _ ");
        $this->set(compact('list_cat'));
		$this->set('edit',$this->Productshop->findById($id));
	}
	
	function delete($id = null) {	
		 $this->checkIfLogged();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Productshop->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	//list danh sach cac danh muc
	function _find_list() {
		return $this->Categoryshop->generatetreelist(null, null, null, '--- ');
	}

	function checkIfLogged(){
		if(!$this->Session->read("shopname") || !$this->Session->read("id")){
			 $this->redirect('dang-nhap');
		}
	}
	function unicode_convert($str){
		if(!$str) return false;
		$unicode = array(
		'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ', 'ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ','� �'),
		'a'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ', 'Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ','� �'),
		'd'=>array('đ'),
		'd'=>array('Đ'),
		'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề' ,'ể','ễ','ệ'),
		'e'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề' ,'Ể','Ễ','Ệ'),
		'i'=>array('í','ì','ỉ','ĩ','ị'),
		'i'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
		'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ', 'ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','� �'),
		'0'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ', 'Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','� �'),
		'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ', 'ử','ữ','ự'),
		'u'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ', 'Ử','Ữ','Ự'),
		'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
		'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
		'-'=>array(' ','&','?'),
		'-'=>array('  ','   '),
		'-'=>array(','),
		'-'=>array(' ')
		);
		
		foreach($unicode as $nonUnicode=>$uni){
		foreach($uni as $value)
		$str = str_replace($value,$nonUnicode,$str);
		}
		return $str;
		}

}
?>
