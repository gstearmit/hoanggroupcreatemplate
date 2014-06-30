<?php
class CityController extends AppController {


	var $name = 'City';
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'City.id DESC');
	      $this->set('City', $this->paginate('City',array()));

	}
	
	function add(){
		$this->account();
		if (!empty($this->data)) {
			$this->City->create();
			$data['City'] = $this->data['City'];
			
			if ($this->City->save($data['City'])) {
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
		$data['City'] = $this->data['City'];
		$data['City']['status']=0;
		if ($this->City->save($data['City'])) {
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
				$City=($this->City->find('all'));
				foreach($City as $new) {
					$new['City']['status']=1;
					$this->City->save($new['City']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$City=($this->City->find('all'));
				foreach($City as $new) {
					$new['City']['status']=0;
					$this->City->save($new['City']);					
				}
				break;
				case 'delete':
				$City=($this->City->find('all'));
				foreach($City as $new) {
					$this->City->delete($new['City']['id']);					
				}
				if($this->City->find('count')<1)
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
				$City=($this->City->find('all'));
				foreach($City as $new) {
					if(isset($_POST[$new['City']['id']]))
					{
						$new['City']['status']=1;
						$this->City->save($new['City']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$City=($this->City->find('all'));
				foreach($City as $new) {
					if(isset($_POST[$new['City']['id']]))
					{
						$new['City']['status']=0;
						$this->City->save($new['City']);
					}
				}
				break;
				case 'delete':
				$City=($this->City->find('all'));
				foreach($City as $City) {
					if(isset($_POST[$City['City']['id']]))
					{
					    $this->City->delete($City['City']['id']);
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
		$data['City'] = $this->data['City'];
		$data['City']['status']=1;
		if ($this->City->save($data['City'])) {
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
			$data['City'] = $this->data['City'];			
		
			if ($this->City->save($data['City'])) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->City->read(null, $id);
			$this->set('edit',$this->City->read(null, $id));
		}
		
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->City->delete($id)) {
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
	
	function search() {
	
		$keyword=$_POST['keyword'];
	
		if($keyword!="")
			$x['City.name like']='%'.$keyword.'%';

				$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'City.id DESC');
				$this->set('city', $this->paginate('City',array()));
			
	
	}

}
?>
