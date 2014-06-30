<?php
class BackgroundController extends AppController {

	var $name = 'Background';
	var $uses=array('Background','Shop','Categoryshop','Category');

	function index() {
        $this->checkIfLogged();
		$this->set('title_for_layout', 'Cài đặt Background ');
		$this->layout='home2';
		 $user = $this->Session->read('id');
	    //var_dump($user);die;
	    $temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.user_id'=>$user),'order'=>'Shop.id DESC'));
	 
		$background = $this->Background->find('all',array('conditions'=>array('Background.user_id'=>$user),'order'=>'Background.id DESC'));
		$this->set('background',$background);
	}

	function add() {
		 $this->checkIfLogged();
		$this->layout='home2';
		$this->set('title_for_layout', 'Cài đặt Background ');
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
			$this->Background->create();
			$this->data['Background']['shop_id']=$temshop[0]['Shop']['id'];
			$this->data['Background']['user_id']=$user;
			$this->data['Background']['images']=$_POST['userfile'];
			if ($this->Background->save($this->data)) {
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
		$this->set('title_for_layout', 'Cài đặt Background ');
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
			$this->Background->create();
			$this->data['Background']['shop_id']=$temshop[0]['Shop']['id'];
			$this->data['Background']['user_id']=$user;
			$this->data['Background']['images']=$_POST['userfile'];
			if ($this->Background->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
				//pr($this->Categoryshops->save($this->data));die;
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		  }
		if (empty($this->data)) {
			$this->data = $this->Background->read(null, $id);
		}
		$this->set('edit',$this->Background->findById($id));
	}
	function delete($id = null) {
		 $this->checkIfLogged();	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Background->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	
	 function checkIfLogged(){
		if(!$this->Session->read("nameshop") || !$this->Session->read("id")){
			 $this->redirect('/login');
		}
	}
	

}
?>
