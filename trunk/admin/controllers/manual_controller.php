<?php
class ManualController extends AppController {


	var $name = 'Manual';
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'Manual.id DESC');
	      $this->set('manual', $this->paginate('Manual',array()));

	}
	
	function add(){
		$this->account();
		if (!empty($this->data)) {
			$this->Manual->create();
			$data['Manual'] = $this->data['Manual'];
			$data['Manual']['link']=$_POST['pdffile'];
			if ($this->Manual->save($data['Manual'])) {
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
		$data['Manual'] = $this->data['Manual'];
		$data['Manual']['status']=0;
		if ($this->Manual->save($data['Manual'])) {
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
				$Manual=($this->Manual->find('all'));
				foreach($Manual as $new) {
					$new['Manual']['status']=1;
					$this->Manual->save($new['Manual']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Manual=($this->Manual->find('all'));
				foreach($Manual as $new) {
					$new['Manual']['status']=0;
					$this->Manual->save($new['Manual']);					
				}
				break;
				case 'delete':
				$Manual=($this->Manual->find('all'));
				foreach($Manual as $new) {
					$this->Manual->delete($new['Manual']['id']);					
				}
				if($this->Manual->find('count')<1)
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
				$Manual=($this->Manual->find('all'));
				foreach($Manual as $new) {
					if(isset($_POST[$new['Manual']['id']]))
					{
						$new['Manual']['status']=1;
						$this->Manual->save($new['Manual']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Manual=($this->Manual->find('all'));
				foreach($Manual as $new) {
					if(isset($_POST[$new['Manual']['id']]))
					{
						$new['Manual']['status']=0;
						$this->Manual->save($new['Manual']);
					}
				}
				break;
				case 'delete':
				$Manual=($this->Manual->find('all'));
				foreach($Manual as $Manual) {
					if(isset($_POST[$Manual['Manual']['id']]))
					{
					    $this->Manual->delete($Manual['Manual']['id']);
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
		$data['Manual'] = $this->data['Manual'];
		$data['Manual']['status']=1;
		if ($this->Manual->save($data['Manual'])) {
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
			$data['Manual'] = $this->data['Manual'];			
			$data['Manual']['link']=$_POST['pdffile'];
			if ($this->Manual->save($data['Manual'])) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Manual->read(null, $id);
			$this->set('edit',$this->Manual->read(null, $id));
		}
		
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Manual->delete($id)) {
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
