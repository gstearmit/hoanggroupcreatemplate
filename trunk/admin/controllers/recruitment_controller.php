<?php
class RecruitmentController extends AppController {

	var $name = 'Recruitment';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'Recruitment.id DESC');
	      $this->set('Recruitment', $this->paginate('Recruitment',array()));

	}
	
	function add(){
		$this->account();
		if (!empty($this->data)) {
			$this->Recruitment->create();
			$data['Recruitment'] = $this->data['Recruitment'];
			$data['Recruitment']['images']=$_POST['userfile'];
			if ($this->Recruitment->save($data['Recruitment'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui lòng thử lại', true));
			}
		}
	}
	
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Recruitment'] = $this->data['Recruitment'];
		$data['Recruitment']['status']=0;
		if ($this->Recruitment->save($data['Recruitment'])) {
			$this->Session->setFlash(__('Hình ảnh không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Hình ảnh không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Recruitment'] = $this->data['Recruitment'];
		$data['Recruitment']['status']=1;
		if ($this->Recruitment->save($data['Recruitment'])) {
			$this->Session->setFlash(__('Hình ảnh được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Hình ảnh không active được', true));
		$this->redirect(array('action' => 'index'));

	}

	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Recruitment'] = $this->data['Recruitment'];
			$data['Recruitment']['images']=$_POST['userfile'];
			if ($this->Recruitment->save($data['Recruitment'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Recruitment->read(null, $id);
		}
		
		$this->set('edit',$this->Recruitment->findById($id));
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại dịch vụ này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Recruitment->delete($id)) {
			$this->Session->setFlash(__('Xóa  thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}

	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	function beforeFilter(){
		$this->layout='admin';
	}

}
?>
