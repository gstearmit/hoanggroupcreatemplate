<?php
class UserscmsController extends AppController {

	var $name = 'Userscms';
	var $uses=array('Userscm','Shop');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('Userscm.status'=>1);
		  $this->paginate = array('limit' => '10','order' => 'Userscm.id DESC');
	      $this->set('Userscm', $this->paginate('Userscm',array()));
	
		
		
		  
	}
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Userscm->create();
			$data['Userscm'] = $this->data['Userscm'];
			$data['Userscm']['images']=$_POST['userfile'];
			
			if ($this->Userscm->save($data['Userscm'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Userscm->read(null, $id));
	}
	
	/*function search() {
		$data['Userscm']=$this->data['Userscm'];
		$CategorynewsUserscm=$data['Userscm']['CategorynewsUserscm_id'];
		$this->paginate = array('conditions'=>array('Userscm.CategorynewsUserscm_id'=>$CategorynewsUserscm),'limit' => '15','order' => 'Userscm.id DESC');
	    $this->set('Userscm', $this->paginate('Userscm',array()));
		
	}
	*/
function search() {
	
		$keyword=isset($_POST['name'])? $_POST['name'] :'';
	
		$x['Userscm.name like']='%'.$keyword.'%';
	
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Userscm.id DESC');
		$this->set('Userscm', $this->paginate('Userscm',array()));	
	
		
	}
	
	
	
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Userscm=($this->Userscm->find('all'));
				foreach($Userscm as $new) {
					$new['Userscm']['status']=1;
					$this->Userscm->save($new['Userscm']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Userscm=($this->Userscm->find('all'));
				foreach($Userscm as $new) {
					$new['Userscm']['status']=0;
					$this->Userscm->save($new['Userscm']);					
				}
				break;
				case 'delete':
				$Userscm=($this->Userscm->find('all'));
				foreach($Userscm as $new) {
					$this->Userscm->delete($new['Userscm']['id']);					
				}
				if($this->Userscm->find('count')<1)
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
				$Userscm=($this->Userscm->find('all'));
				foreach($Userscm as $new) {
					if(isset($_POST[$new['Userscm']['id']]))
					{
						$new['Userscm']['status']=1;
						$this->Userscm->save($new['Userscm']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Userscm=($this->Userscm->find('all'));
				foreach($Userscm as $new) {
					if(isset($_POST[$new['Userscm']['id']]))
					{
						$new['Userscm']['status']=0;
						$this->Userscm->save($new['Userscm']);
					}
				}
				break;
				case 'delete':
				$Userscm=($this->Userscm->find('all'));
				foreach($Userscm as $new) {
					if(isset($_POST[$new['Userscm']['id']]))
					{
					    $this->Userscm->delete($new['Userscm']['id']);
						
					}
										
				}
				$this->redirect(array('action'=>'index'));
				die;	
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	
		//dong danh muc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Userscm'] = $this->data['Userscm'];
		$data['Userscm']['id']=$id;
		$data['Userscm']['status']=0;		
		if ($this->Userscm->save($data['Userscm'])) {
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
		$data['Userscm'] = $this->data['Userscm'];
		$data['Userscm']['id']=$id;
		$data['Userscm']['status']=1;
		if ($this->Userscm->save($data['Userscm'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	
	//dong danh muc
	function close1($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Userscm'] = $this->data['Userscm'];
		$data['Userscm']['id']=$id;
		$data['Userscm']['den']=0;		
		if ($this->Userscm->save($data['Userscm'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active1($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Userscm'] = $this->data['Userscm'];
		$data['Userscm']['id']=$id;
		$data['Userscm']['den']=1;
		if ($this->Userscm->save($data['Userscm'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	// sua tin da dang
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Userscm'] = $this->data['Userscm'];
			
			
			if ($this->Userscm->save($data['Userscm'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Userscm->read(null, $id);
		}
		
		$this->set('edit',$this->Userscm->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Userscm->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->CategorynewsUserscm->generatetreelist(null, null, null, '__');
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
	
	function get_shop($id=null){
	
	return $this->Shop->find('all',array('conditions'=>array('Shop.user_id'=>$id),'limit'=>1));
	}
	

}
?>
