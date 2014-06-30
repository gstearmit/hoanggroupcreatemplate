<?php
class GetspController extends AppController {

	var $name = 'Getsp';	
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	//list danh sach cac danh muc
	function index() {	
	   $this->account();
	  // $conditions=array('Catduan.status'=>1);	

 
	}
	//tim kiem
	function search($id=null) {
		$data['Catduan']=$this->data['Catduan'];
		$Catduan=$data['Catduan']['parent_id'];
		$this->paginate = array('conditions'=>array('Catduan.id'=>$Catduan),'limit' => '15','order' => 'Catduan.id DESC');
	    $this->set('Catduan', $this->paginate('Catduan',array()));
		
		$this->loadModel("Catduan");
        $list_cat = $this->Catduan->generatetreelist(null,null,null," _ ");
	    $this->set(compact('list_cat'));
		
	}
	//them danh muc moi
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Catduan->create();
			if ($this->Catduan->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Catduan");
        $Catduanlist = $this->Catduan->generatetreelist(null,null,null," _ ");
        $this->set(compact('Catduanlist'));
	}
	//Sua danh muc
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Catduan->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Catduan->read(null, $id);
		}
		$this->set('list_cat',$this->_find_list());
	}
	//dong danh muc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Catduan'] = $this->data['Catduan'];
		$data['Catduan']['id']=$id;
		$data['Catduan']['status']=0;		
		if ($this->Catduan->save($data['Catduan'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Catduan'] = $this->data['Catduan'];
		$data['Catduan']['id']=$id;
		$data['Catduan']['status']=1;
		if ($this->Catduan->save($data['Catduan'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	//Xoa danh muc
	function delete($id = null) {	
		$this->account();	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Catduan->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
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
				$Catduan=$this->Catduan->find('all');
				foreach($Catduan as $Catduan) {
					$Catduan['Catduan']['status']=1;
				
					$this->Catduan->save($Catduan['Catduan']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Catduan=$this->Catduan->find('all');
				foreach($Catduan as $Catduan) {
					$Catduan['Catduan']['status']=0;
					$this->Catduan->save($Catduan['Catduan']);					
				}
				break;
				case 'delete':
				$Catduan=($this->Catduan->find('all'));
				foreach($Catduan as $Catduan) {
					$this->News->delete($Catduan['Catduan']['id']);					
				}
				if($this->Catduan->find('count')<1)
				$this->redirect(array('action' => 'index'));
				 else
				 {
					$this->Session->setFlash(__('Danh mục không close được', true));
					$this->redirect(array('action' => 'index'));
				 }
				//vong lap xoa
				break;
				
			}
		}
		else{
			
			switch ($select){
				case 'active':
				$Catduan=($this->Catduan->find('all'));
				foreach($Catduan as $Catduan) {
					if(isset($_POST[$Catduan['Catduan']['id']]))
					{
						$Catduan['Catduan']['status']=1;
						$this->Catduan->save($Catduan['Catduan']);
						$this->redirect(array('action'=>'index'));
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Catduan=($this->Catduan->find('all'));
				foreach($Catduan as $Catduan) {
					if(isset($_POST[$Catduan['Catduan']['id']]))
					{
						$Catduan['Catduan']['status']=0;
						$this->Catduan->save($Catduan['Catduan']);
						$this->redirect(array('action'=>'index'));
					}
				}
				break;
				case 'delete':
				$Catduan=($this->Catduan->find('all'));
				foreach($Catduan as $Catduan) {
					if(isset($_POST[$Catduan['Catduan']['id']]))
					{
					    $this->Catduan->delete($Catduan['Catduan']['id']);
						$this->redirect(array('action'=>'index'));
					}
										
				}
				
				die;	
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	//list danh sach cac danh muc
	function _find_list() {
		return $this->Catduan->generatetreelist(null, null, null, '__');
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
