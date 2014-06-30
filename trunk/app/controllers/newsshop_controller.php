<?php
class NewsshopController extends AppController {

	var $name = 'Newsshop';
	var $uses=array('Shop','User','Userscms','Newshop','Categorynewsshop');

	function index() {	
	 $this->checkIfLogged();
	   $this->layout='home2';
	   $user = $this->Session->read('id');
	    //var_dump($user);die;
	  $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
	 
	  //foreach($temshop as $temshop){
		$newsshop = $this->Newshop->find('all',array('conditions'=>array('Newshop.shop_id'=>$temshop[0]['Shop']['id']),'order'=>'Newshop.id DESC'));
		$this->set('newsshop',$newsshop);
		
		$categorynewsshop = $this->Categorynewsshop->find('all',array('conditions'=>array('Categorynewsshop.status'=>1,'Categorynewsshop.shop_id'=>$temshop[0]['Shop']['id']),'order'=>'Categorynewsshop.id DESC'));
		$this->set('categorynewsshop',$categorynewsshop);
		
	   
	//  }
	}
	
	//them danh muc moi
	function add(){ 
	  $this->checkIfLogged();
		$this->layout='home2';
		 $user = $this->Session->read('id');
	     $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		// pr($temshop);die;
		 $nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('nameshop', $nameshop); 
		 //------------------------------
		if (!empty($this->data)) 
		{
			
			//pr($this->Categoryshop->create());die;
			$this->Newshop->create();
			$this->data['Newshop']['shop_id']=$temshop[0]['Shop']['id'];
			$this->data['Newshop']['user_id']=$user;
			$this->data['Newshop']['images']=$_POST['userfile'];
			$this->data['Newshop']['categorynewsshop_id']=$_POST['categorynewsshop_id'];
			if ($this->Newshop->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
				//pr($this->Categoryshops->save($this->data));die;
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		  }
		  $categoryshop = $temshop[0]['Shop']['id'];
		//echo $categoryshop;die;
		$nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('nameshop', $nameshop); 
		 
		 $categorynews = $this->Categorynewsshop->find('all',array('conditions'=>array('Categorynewsshop.status'=>1,'Categorynewsshop.shop_id'=>$categoryshop),'order'=>'Categorynewsshop.id DESC'));
		 $this->set('categorynews', $categorynews); 
		 
		}
		
    function edit($id = null) {
		 $this->checkIfLogged();
		 $user = $this->Session->read('id');
	     $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		$this->layout='home2';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Newshop']['categorynewsshop_id']=$_POST['categorynewsshop_id'];
			$this->data['Newshop']['images']=$_POST['userfile'];
			$this->data['Newshop']['user_id']=$user;
			if ($this->Newshop->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Newshop->read(null, $id);
			$this->parent_id = $this->Newshop->read(null, $id);
		}
		 $categoryshop = $temshop[0]['Shop']['id'];
		//echo $categoryshop;die;
		$nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('nameshop', $nameshop); 
		 
		 $categorynews = $this->Categorynewsshop->find('all',array('conditions'=>array('Categorynewsshop.status'=>1,'Categorynewsshop.shop_id'=>$categoryshop),'order'=>'Categorynewsshop.id DESC'));
		 $this->set('categorynews', $categorynews); 
		 $this->set('edit',$this->Newshop->findById($id));
	}
	//them danh muc moi
	function addcategory(){ 
	    $this->checkIfLogged();
		$this->layout='home2';
		 $user = $this->Session->read('id');
	     $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		
		if (!empty($this->data)) 
		{
			
			$this->Categorynewsshop->create();
			$this->data['Categorynewsshop']['shop_id']=$temshop[0]['Shop']['id'];
			$this->data['Categorynewsshop']['user_id']=$user;
			if ($this->Categorynewsshop->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index#tab3'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		  }
		}
		
	//them danh muc moi
	
	function editcategory($id = null) {
		 $this->checkIfLogged();
		 $user = $this->Session->read('id');
	     $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		$this->layout='home2';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Categorynewsshop']['shop_id']=$temshop[0]['Shop']['id'];
			$this->data['Categorynewsshop']['user_id']=$user;
			if ($this->Categorynewsshop->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index#tab3'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Categorynewsshop->read(null, $id);
			$this->parent_id = $this->Categorynewsshop->read(null, $id);
		}
		//pr($this->data);die;
	}
	function deletecategory($id = null) {	
		 $this->checkIfLogged();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Categorynewsshop->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index#tab3'));
	}
	//list danh sach cac danh muc
	function _find_list() {
		return $this->Categorynewsshop->generatetreelist(null, null, null, '--- ');
	}
	//check ton tai tai khoan

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
		'-'=>array(',')
		);
		
		foreach($unicode as $nonUnicode=>$uni){
		foreach($uni as $value)
		$str = str_replace($value,$nonUnicode,$str);
		}
		return $str;
		}

}
?>
