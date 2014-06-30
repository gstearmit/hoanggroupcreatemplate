<?php
class MapsController extends AppController {

	var $name = 'Maps';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'Map.id DESC');
	      $this->set('Map', $this->paginate('Map',array()));
		  $this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
	}
	
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Map->create();
			$data['Map'] = $this->data['Map'];
			$data['Map']['images']=$_POST['userfile1'];
			
// 			echo '<pre>';
// 			print_r($data);die();
			
			//$data['Map']['images_eg']=$_POST['userfile_eg'];
		//	$data['Map']['display']=$_POST['display'];
			if ($this->Map->save($data['Map'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
        
        
     
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Map->read(null, $id));
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Map'] = $this->data['Map'];
		$data['Map']['status']=0;
		if ($this->Map->save($data['Map'])) {
			$this->Session->setFlash(__('Bài viết không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	// active tin bai viêt
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Map'] = $this->data['Map'];
		$data['Map']['status']=1;
		if ($this->Map->save($data['Map'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	// tim kiem san pham
	/*function search() {
		$data['Map']=$this->data['Map'];
		$category=$data['Map']['Catproduct_id'];
		$this->paginate = array('conditions'=>array('Map.Catproduct_id'=>$category),'limit' => '15','order' => 'Map.id DESC');
	    $this->set('Map', $this->paginate('Map',array()));
		 $this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		
	}*/
	function search() {
		$this->loadModel("Catproduct");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		if(isset($_POST['list_cat']))
		$list_cat=$_POST['list_cat'];
		$x=array();
		if($keyword!="")
		$x['Map.name like']='%'.$keyword.'%';
		
		if($list_cat!="")
		$x['Map.Catproduct_id']=$list_cat;
		//pr($x);exit;
		$tt =array();
		$portfolio=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.parent_id'=>$x)));		
		//pr($portfolio);
		foreach($portfolio as $key){
		$tt[]=$key['Catproduct']['id'];
		}
		for($i=0;$i<count($tt);$i++)
		 if($list_cat==$tt[$i])
		 $list_cat=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$tt[$i]),'fields'=>array('Catproduct.id')));	
		 if($list_cat!="")
		$x['Map.Catproduct_id']=$list_cat;
		//pr($x); die;
		//
	    //$this->set('Maps', $this->paginate('Map',array()));	
		//pr($x);
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Map.id DESC');
		$this->set('map', $this->paginate('Map',array()));	
		//$ketquatimkiem=$this->Map->find('all',array('conditions'=>$x,'order' => 'Map.id DESC','limit'=>3));	
		//pr($ketquatimkiem); die;
		//$this->set('Maps',$category);
		 $this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		
	}
	// sua tin da dang
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Map'] = $this->data['Map'];
			$data['Map']['images']=$_POST['userfile1'];
			
			//$data['Map']['display']=$_POST['display'];
			if ($this->Map->save($data['Map'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Map->read(null, $id);
		}
		$this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		$this->set('edit',$this->Map->findById($id));
	}
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Maps=($this->Map->find('all'));
				foreach($Maps as $Map) {
					$Map['Map']['status']=1;
					$this->Map->save($Map['Map']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Maps=($this->Map->find('all'));
				foreach($Maps as $Map) {
					$Map['Map']['status']=0;
					$this->Map->save($Map['Map']);					
				}
				break;
				case 'delete':
				$Maps=($this->Map->find('all'));
				foreach($Maps as $Map) {
					$this->Map->delete($Map['Map']['id']);					
				}
				if($this->Map->find('count')<1)
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
				$Maps=($this->Map->find('all'));
				foreach($Maps as $Map) {
					if(isset($_POST[$Map['Map']['id']]))
					{
						$Map['Map']['status']=1;
						$this->Map->save($Map['Map']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Maps=($this->Map->find('all'));
				foreach($Maps as $Map) {
					if(isset($_POST[$Map['Map']['id']]))
					{
						$Map['Map']['status']=0;
						$this->Map->save($Map['Map']);
					}
				}
				break;
				case 'delete':
				$Maps=($this->Map->find('all'));
				foreach($Maps as $Map) {
					if(isset($_POST[$Map['Map']['id']]))
					{
					    $this->Map->delete($Map['Map']['id']);
						
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
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Map->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->Catproduct->generatetreelist(null, null, null, '__');
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

}
?>
