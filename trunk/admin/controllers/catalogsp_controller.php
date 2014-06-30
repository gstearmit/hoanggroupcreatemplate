<?php
class CatalogspController extends AppController {


	var $name = 'Catalogsp';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'Catalogsp.id DESC');
	      $this->set('Catalogsp', $this->paginate('Catalogsp',array()));

	}
	
	function add(){
		$this->account();
		if (!empty($this->data)) {
			$this->Catalogsp->create();
			$data['Catalogsp'] = $this->data['Catalogsp'];
			$data['Catalogsp']['images']=$_POST['userfile'];
			if ($this->Catalogsp->save($data['Catalogsp'])) {
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
		$data['Catalogsp'] = $this->data['Catalogsp'];
		$data['Catalogsp']['status']=0;
		if ($this->Catalogsp->save($data['Catalogsp'])) {
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
				$Catalogsp=($this->Catalogsp->find('all'));
				foreach($Catalogsp as $new) {
					$new['Catalogsp']['status']=1;
					$this->Catalogsp->save($new['Catalogsp']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Catalogsp=($this->Catalogsp->find('all'));
				foreach($Catalogsp as $new) {
					$new['Catalogsp']['status']=0;
					$this->Catalogsp->save($new['Catalogsp']);					
				}
				break;
				case 'delete':
				$Catalogsp=($this->Catalogsp->find('all'));
				foreach($Catalogsp as $new) {
					$this->Catalogsp->delete($new['Catalogsp']['id']);					
				}
				if($this->Catalogsp->find('count')<1)
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
				$Catalogsp=($this->Catalogsp->find('all'));
				foreach($Catalogsp as $new) {
					if(isset($_POST[$new['Catalogsp']['id']]))
					{
						$new['Catalogsp']['status']=1;
						$this->Catalogsp->save($new['Catalogsp']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Catalogsp=($this->Catalogsp->find('all'));
				foreach($Catalogsp as $new) {
					if(isset($_POST[$new['Catalogsp']['id']]))
					{
						$new['Catalogsp']['status']=0;
						$this->Catalogsp->save($new['Catalogsp']);
					}
				}
				break;
				case 'delete':
				$Catalogsp=($this->Catalogsp->find('all'));
				foreach($Catalogsp as $Catalogsp) {
					if(isset($_POST[$Catalogsp['Catalogsp']['id']]))
					{
					    $this->Catalogsp->delete($Catalogsp['Catalogsp']['id']);
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
		$data['Catalogsp'] = $this->data['Catalogsp'];
		$data['Catalogsp']['status']=1;
		if ($this->Catalogsp->save($data['Catalogsp'])) {
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
			$data['Catalogsp'] = $this->data['Catalogsp'];			
			$data['Catalogsp']['images']=$_POST['userfile'];
			if ($this->Catalogsp->save($data['Catalogsp'])) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Catalogsp->read(null, $id);
			$this->set('edit',$this->Catalogsp->read(null, $id));
		}
		
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Catalogsp->delete($id)) {
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
