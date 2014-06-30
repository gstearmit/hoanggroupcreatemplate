<?php
class PartnersController extends AppController {

	var $name = 'Partners';
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'Partner.id DESC');
	      $this->set('partners', $this->paginate('Partner',array()));

	}
	
	function add(){
		$this->account();
		if (!empty($this->data)) {
			$this->Partner->create();
			$data['Partner'] = $this->data['Partner'];
			$data['Partner']['images']=$_POST['userfile'];
			if ($this->Partner->save($data['Partner'])) {
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
		$data['Partner'] = $this->data['Partner'];
		$data['Partner']['status']=0;
		if ($this->Partner->save($data['Partner'])) {
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
				$Partner=($this->Partner->find('all'));
				foreach($Partner as $new) {
					$new['Partner']['status']=1;
					$this->Partner->save($new['Partner']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Partner=($this->Partner->find('all'));
				foreach($Partner as $new) {
					$new['Partner']['status']=0;
					$this->Partner->save($new['Partner']);					
				}
				break;
				case 'delete':
				$Partner=($this->Partner->find('all'));
				foreach($Partner as $new) {
					$this->Partner->delete($new['Partner']['id']);					
				}
				if($this->Partner->find('count')<1)
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
				$Partner=($this->Partner->find('all'));
				foreach($Partner as $new) {
					if(isset($_POST[$new['Partner']['id']]))
					{
						$new['Partner']['status']=1;
						$this->Partner->save($new['Partner']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Partner=($this->Partner->find('all'));
				foreach($Partner as $new) {
					if(isset($_POST[$new['Partner']['id']]))
					{
						$new['Partner']['status']=0;
						$this->Partner->save($new['Partner']);
					}
				}
				break;
				case 'delete':
				$Partner=($this->Partner->find('all'));
				foreach($Partner as $Partner) {
					if(isset($_POST[$Partner['Partner']['id']]))
					{
					    $this->Partner->delete($Partner['Partner']['id']);
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
		$data['Partner'] = $this->data['Partner'];
		$data['Partner']['status']=1;
		if ($this->Partner->save($data['Partner'])) {
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
			$data['Partner'] = $this->data['Partner'];			
			$data['Partner']['images']=$_POST['userfile'];
			if ($this->Partner->save($data['Partner'])) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Partner->read(null, $id);
			$this->set('edit',$this->Partner->read(null, $id));
		}
		
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Partner->delete($id)) {
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
