<?php
class BacklinkController extends AppController {


	var $name = 'Backlink';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'Backlink.id DESC');
	      $this->set('Backlink', $this->paginate('Backlink',array()));

	}
	
	function add(){
		$this->account();
		if (!empty($this->data)) {
			$this->Backlink->create();
			$data['Backlink'] = $this->data['Backlink'];
			$data['Backlink']['images']=$_POST['userfile'];
			if ($this->Backlink->save($data['Backlink'])) {
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
		$data['Backlink'] = $this->data['Backlink'];
		$data['Backlink']['status']=0;
		if ($this->Backlink->save($data['Backlink'])) {
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
				$Backlink=($this->Backlink->find('all'));
				foreach($Backlink as $new) {
					$new['Backlink']['status']=1;
					$this->Backlink->save($new['Backlink']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Backlink=($this->Backlink->find('all'));
				foreach($Backlink as $new) {
					$new['Backlink']['status']=0;
					$this->Backlink->save($new['Backlink']);					
				}
				break;
				case 'delete':
				$Backlink=($this->Backlink->find('all'));
				foreach($Backlink as $new) {
					$this->Backlink->delete($new['Backlink']['id']);					
				}
				if($this->Backlink->find('count')<1)
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
				$Backlink=($this->Backlink->find('all'));
				foreach($Backlink as $new) {
					if(isset($_POST[$new['Backlink']['id']]))
					{
						$new['Backlink']['status']=1;
						$this->Backlink->save($new['Backlink']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Backlink=($this->Backlink->find('all'));
				foreach($Backlink as $new) {
					if(isset($_POST[$new['Backlink']['id']]))
					{
						$new['Backlink']['status']=0;
						$this->Backlink->save($new['Backlink']);
					}
				}
				break;
				case 'delete':
				$Backlink=($this->Backlink->find('all'));
				foreach($Backlink as $Backlink) {
					if(isset($_POST[$Backlink['Backlink']['id']]))
					{
					    $this->Backlink->delete($Backlink['Backlink']['id']);
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
		$data['Backlink'] = $this->data['Backlink'];
		$data['Backlink']['status']=1;
		if ($this->Backlink->save($data['Backlink'])) {
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
			$data['Backlink'] = $this->data['Backlink'];			
			$data['Backlink']['images']=$_POST['userfile'];
			if ($this->Backlink->save($data['Backlink'])) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Backlink->read(null, $id);
			$this->set('edit',$this->Backlink->read(null, $id));
		}
		
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Backlink->delete($id)) {
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
