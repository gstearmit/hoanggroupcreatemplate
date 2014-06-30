<?php
class CategorynewsshopController extends AppController {

	var $name = 'Categorynewsshop';
	var $uses=array('Shop','User','Userscms','Newshop');

	function index() {	
	 $this->checkIfLogged();
	   $this->layout='home2';
	   $user = $this->Session->read('id');
	    //var_dump($user);die;
	  $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
	 
	  //foreach($temshop as $temshop){
		$category = $this->Categorynewsshop->find('all',array('conditions'=>array('Categorynewsshop.status'=>1,'Categorynewsshop.shop_id'=>$temshop[0]['Shop']['id']),'order'=>'Categorynewsshop.id DESC'));
	   
	//  }
	}
	function edit($id = null) {
		 $this->checkIfLogged();
		$this->layout='home2';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			if ($this->Categoryshop->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Categoryshop->read(null, $id);
			$this->parent_id = $this->Categoryshop->read(null, $id);
		}
		//pr($this->data);die;
		$this->set('list_cat',$this->_find_list());
	}
	//them danh muc moi
	function add(){ 
	  $this->checkIfLogged();
		$this->layout='home2';
		 $user = $this->Session->read('id');
	     $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		// pr($temshop);die;
		if (!empty($this->data)) 
		{
			
			//pr($this->Categoryshop->create());die;
			$this->Categoryshop->create();
			$this->data['Categoryshop']['shop_id']=$temshop[0]['Shop']['id'];
			if ($this->Categoryshop->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
				//pr($this->Categoryshops->save($this->data));die;
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		  }
		}
	function delete($id = null) {	
		 $this->checkIfLogged();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Categoryshop->delete($id)) {
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
	//check ton tai tai khoan

	 function checkIfLogged(){
		if(!$this->Session->read("nameshop") || !$this->Session->read("id")){
			 $this->redirect('/login');
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
