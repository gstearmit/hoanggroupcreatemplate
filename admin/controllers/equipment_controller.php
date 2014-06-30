<?php
class EquipmentController extends AppController {


	var $name = 'Equipment';
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'Equipment.id DESC');
	      $this->set('Equipment', $this->paginate('Equipment',array()));

	}
	
	function add(){
		$this->account();
		if (!empty($this->data)) {
			$this->Equipment->create();
			$data['Equipment'] = $this->data['Equipment'];
			$data['Equipment']['link']=$_POST['pdffile'];
			if ($this->Equipment->save($data['Equipment'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
	}
	
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Equipment'] = $this->data['Equipment'];
		$data['Equipment']['status']=0;
		if ($this->Equipment->save($data['Equipment'])) {
			$this->Session->setFlash(__('Hình ảnh không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Hình ảnh không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Equipment=($this->Equipment->find('all'));
				foreach($Equipment as $new) {
					$new['Equipment']['status']=1;
					$this->Equipment->save($new['Equipment']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Equipment=($this->Equipment->find('all'));
				foreach($Equipment as $new) {
					$new['Equipment']['status']=0;
					$this->Equipment->save($new['Equipment']);					
				}
				break;
				case 'delete':
				$Equipment=($this->Equipment->find('all'));
				foreach($Equipment as $new) {
					$this->Equipment->delete($new['Equipment']['id']);					
				}
				if($this->Equipment->find('count')<1)
				$this->redirect(array('action'=>'index'));
				 else
				$this->redirect(array('action'=>'index'));
				//vong lap xoa
				break;
				
			}
		}
		else{
			
			switch ($select){
				case 'active':
				$Equipment=($this->Equipment->find('all'));
				foreach($Equipment as $new) {
					if(isset($_POST[$new['Equipment']['id']]))
					{
						$new['Equipment']['status']=1;
						$this->Equipment->save($new['Equipment']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Equipment=($this->Equipment->find('all'));
				foreach($Equipment as $new) {
					if(isset($_POST[$new['Equipment']['id']]))
					{
						$new['Equipment']['status']=0;
						$this->Equipment->save($new['Equipment']);
					}
				}
				break;
				case 'delete':
				$Equipment=($this->Equipment->find('all'));
				foreach($Equipment as $Equipment) {
					if(isset($_POST[$Equipment['Equipment']['id']]))
					{
					    $this->Equipment->delete($Equipment['Equipment']['id']);
						$this->redirect(array('action'=>'index'));
					}
										
				}
				
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Equipment'] = $this->data['Equipment'];
		$data['Equipment']['status']=1;
		if ($this->Equipment->save($data['Equipment'])) {
			$this->Session->setFlash(__('Hình ảnh được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Hình ảnh không active được', true));
		$this->redirect(array('action' => 'index'));

	}


	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Equipment'] = $this->data['Equipment'];			
			$data['Equipment']['link']=$_POST['pdffile'];
			if ($this->Equipment->save($data['Equipment'])) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Equipment->read(null, $id);
			$this->set('edit',$this->Equipment->read(null, $id));
		}
		
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Equipment->delete($id)) {
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
