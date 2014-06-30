<?php
class CatalogController extends AppController {


	var $name = 'Catalog';
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'Catalog.id DESC');
	      $this->set('catalog', $this->paginate('Catalog',array()));

	}
	
	function add(){
		$this->account();
		if (!empty($this->data)) {
			$this->Catalog->create();
			$data['Catalog'] = $this->data['Catalog'];
			$data['Catalog']['link']=$_POST['pdffile'];
			$data['Catalog']['size']=$_FILE[$data['Catalog']['link']]['size'];
			$data['Catalog']['images']=$_POST['userfile'];
			if ($this->Catalog->save($data['Catalog'])) {
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
		$data['Catalog'] = $this->data['Catalog'];
		$data['Catalog']['status']=0;
		if ($this->Catalog->save($data['Catalog'])) {
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
				$Catalog=($this->Catalog->find('all'));
				foreach($Catalog as $new) {
					$new['Catalog']['status']=1;
					$this->Catalog->save($new['Catalog']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Catalog=($this->Catalog->find('all'));
				foreach($Catalog as $new) {
					$new['Catalog']['status']=0;
					$this->Catalog->save($new['Catalog']);					
				}
				break;
				case 'delete':
				$Catalog=($this->Catalog->find('all'));
				foreach($Catalog as $new) {
					$this->Catalog->delete($new['Catalog']['id']);					
				}
				if($this->Catalog->find('count')<1)
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
				$Catalog=($this->Catalog->find('all'));
				foreach($Catalog as $new) {
					if(isset($_POST[$new['Catalog']['id']]))
					{
						$new['Catalog']['status']=1;
						$this->Catalog->save($new['Catalog']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Catalog=($this->Catalog->find('all'));
				foreach($Catalog as $new) {
					if(isset($_POST[$new['Catalog']['id']]))
					{
						$new['Catalog']['status']=0;
						$this->Catalog->save($new['Catalog']);
					}
				}
				break;
				case 'delete':
				$Catalog=($this->Catalog->find('all'));
				foreach($Catalog as $Catalog) {
					if(isset($_POST[$Catalog['Catalog']['id']]))
					{
					    $this->Catalog->delete($Catalog['Catalog']['id']);
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
		$data['Catalog'] = $this->data['Catalog'];
		$data['Catalog']['status']=1;
		if ($this->Catalog->save($data['Catalog'])) {
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
			$data['Catalog'] = $this->data['Catalog'];			
			$data['Catalog']['link']=$_POST['pdffile'];
			$data['Catalog']['images']=$_POST['userfile'];
			if ($this->Catalog->save($data['Catalog'])) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Catalog->read(null, $id);
			$this->set('edit',$this->Catalog->read(null, $id));
		}
		
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Catalog->delete($id)) {
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
