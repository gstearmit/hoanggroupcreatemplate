<?php
class AboutsController extends AppController {

	var $name = 'Abouts';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('About.status'=>1);
		  $this->paginate = array('limit' => '10','order' => 'About.id DESC');
	      $this->set('About', $this->paginate('About',array()));
		
		  
	}
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->About->create();
			$data['About'] = $this->data['About'];
			
		
			
			if ($this->About->save($data['About'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Category");
        $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->About->read(null, $id));
	}
	
	/*function search() {
		$data['About']=$this->data['About'];
		$category=$data['About']['category_id'];
		$this->paginate = array('conditions'=>array('About.category_id'=>$category),'limit' => '15','order' => 'About.id DESC');
	    $this->set('About', $this->paginate('About',array()));
		
	}
	*/
	function search() {
		
	   $keyword="";
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		$x['About.title like']='%'.$keyword.'%';
		
		
	
	    //$this->set('products', $this->paginate('Product',array()));	
		//pr($x);
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'About.id DESC');
		$this->set('About', $this->paginate('About',array()));	
		//$ketquatimkiem=$this->Product->find('all',array('conditions'=>$x,'order' => 'Product.id DESC','limit'=>3));	
		//pr($ketquatimkiem); die;
		//$this->set('products',$category);
 
		
	}
	
	
	//close tin tuc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['About'] = $this->data['About'];
		$data['About']['status']=0;
		if ($this->About->save($data['About'])) {
			$this->Session->setFlash(__('Bài viết không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// active tin bai viêt
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['About'] = $this->data['About'];
		$data['About']['status']=1;
		if ($this->About->save($data['About'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
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
			$data['About'] = $this->data['About'];
		
			
			if ($this->About->save($data['About'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->About->read(null, $id);
		}
		$this->loadModel("Category");
        $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		$this->set('edit',$this->About->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->About->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->Category->generatetreelist(null, null, null, '__');
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

	
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
		{
	
			switch ($select){
				case 'active':
					$Abouts=($this->About->find('all'));
					foreach($Abouts as $Abouts) {
						$Abouts['About']['status']=1;
						$this->About->save($Abouts['About']);
					}
					//vong lap active
					break;
				case 'notactive':
					//vong lap huy
					$Abouts=($this->About->find('all'));
					foreach($Abouts as $Abouts) {
						$Abouts['About']['status']=0;
						$this->About->save($Abouts['About']);
					}
					break;
				case 'delete':
					$Abouts=($this->About->find('all'));
					foreach($Abouts as $Abouts) {
						$this->About->delete($Abouts['About']['id']);
					}
					if($this->About->find('count')<1)
						$this->redirect(array('action' => 'index'));
					else
					{
						$this->Session->setFlash(__('Danh mục không close được', true));
	
					}
					//vong lap xoa
					break;
					$this->redirect(array('action' => 'index'));
			}
		}
		else{
	
			switch ($select){
				case 'active':
					$Abouts=($this->About->find('all'));
					foreach($Abouts as $Abouts) {
						if(isset($_POST[$Abouts['About']['id']]))
						{
							$Abouts['About']['status']=1;
							$this->About->save($Abouts['About']);
						}
					}
					//vong lap active
					break;
				case 'notactive':
					//vong lap huy
					$Abouts=($this->About->find('all'));
					foreach($Abouts as $Abouts) {
						if(isset($_POST[$Abouts['About']['id']]))
						{
							$Abouts['About']['status']=0;
							$this->About->save($Abouts['About']);
						}
					}
					break;
				case 'delete':
					$Abouts=($this->About->find('all'));
					foreach($Abouts as $Abouts) {
						if(isset($_POST[$Abouts['About']['id']]))
						{
							$this->About->delete($Abouts['About']['id']);
	
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
	
	
}
?>
