<?php
class NewsController extends AppController {

	var $name = 'News';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'News.id DESC');
	      $this->set('news', $this->paginate('News',array()));
	}
	//Them bai viet
	function add() {
		$this->account();
		$this->loadModel("Category");
		if (!empty($this->data)) {			
			$cat=$this->Category->read(null,$this->data['News']['category_id']);
			if($cat)
			$this->data['News']['slug']=$cat['Category']['slug'].'/'.$this->Common->unicode_convert($this->data['News']['title']);
			else
			$this->data['News']['slug']=$this->Common->unicode_convert($this->data['News']['title']);
			
			$this->News->create();
			$data['News'] = $this->data['News'];
			$data['News']['images']=$_POST['userfile'];
			if ($this->News->save($data['News'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		
        $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->News->read(null, $id));
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['News'] = $this->data['News'];
		$data['News']['status']=0;
		if ($this->News->save($data['News'])) {
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
		$data['News'] = $this->data['News'];
		$data['News']['status']=1;
		if ($this->News->save($data['News'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	// sua tin da dang
	function edit($id = null) {
		$this->account();
		$this->loadModel("Category");
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$cat=$this->Category->read(null,$this->data['News']['category_id']);
			if($cat)
			$this->data['News']['slug']=$cat['Category']['slug'].'/'.$this->Common->unicode_convert($this->data['News']['title']);
			else
			$this->data['News']['slug']=$this->Common->unicode_convert($this->data['News']['title']);
			$data['News'] = $this->data['News'];
			$data['News']['images']=$_POST['userfile'];
			if ($this->News->save($data['News'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->News->read(null, $id);
		}
		
        $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		$this->set('edit',$this->News->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->News->delete($id)) {
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

}
?>
