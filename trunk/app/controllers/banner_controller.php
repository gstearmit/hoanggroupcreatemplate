<?php
class BannerController extends AppController {

	var $name = 'Banner';
	var $uses=array('Banner','Shop','Categoryshop','Category');

	function index() {
        $this->checkIfLogged();
		$this->layout='home2';
		 //$user = $this->Session->read('id');
		 $user=17;
	    //var_dump($user);die;
	    $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
	 
	  //foreach($temshop as $temshop){
		$banner = $this->Banner->find('all',array('conditions'=>array('Banner.user_id'=>$user),'order'=>'Banner.id DESC'));
		$this->set('banner',$banner);
	}

	function add() {
		 $this->checkIfLogged();
		$this->layout='home2';
		$this->set('title_for_layout', 'Cài đặt banner ');
		//$user = $this->Session->read('id');
		$user=17;
          $nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('nameshop', $nameshop); 
		 
		 $user = $this->Session->read('id');
	     $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		// pr($temshop);die;
		 $nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('nameshop', $nameshop); 
		 //------------------------------
		if (!empty($this->data)) 
		{
			
			//pr($this->Categoryshop->create());die;
			$this->Banner->create();
			$this->data['Banner']['shop_id']=$temshop[0]['Shop']['id'];
			$this->data['Banner']['user_id']=$user;
			$this->data['Banner']['images']=$_POST['userfile'];
			if ($this->Banner->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
				//pr($this->Categoryshops->save($this->data));die;
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		  }
		
	}
	
	function edit($id = null) {
		  $this->checkIfLogged();
		$this->layout='home2';
		$this->set('title_for_layout', 'Cài đặt banner ');
		$user = $this->Session->read('id');
          $nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('nameshop', $nameshop); 
		 
		 $user = $this->Session->read('id');
	     $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		// pr($temshop);die;
		 $nameshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
		 $this->set('nameshop', $nameshop); 
		 //------------------------------
		if (!empty($this->data)) 
		{
			
			//pr($this->Categoryshop->create());die;
			$this->Banner->create();
			$this->data['Banner']['shop_id']=$temshop[0]['Shop']['id'];
			$this->data['Banner']['user_id']=$user;
			$this->data['Banner']['images']=$_POST['userfile'];
			if ($this->Banner->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
				//pr($this->Categoryshops->save($this->data));die;
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		  }
		if (empty($this->data)) {
			$this->data = $this->Banner->read(null, $id);
		}
		$this->set('edit',$this->Banner->findById($id));
	}
	function delete($id = null) {
		 $this->checkIfLogged();	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Banner->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	
	 function checkIfLogged(){
		if(!$this->Session->read("shopname") || !$this->Session->read("id")){
			 $this->redirect('dang-nhap');
		}
	}
	

}
?>
