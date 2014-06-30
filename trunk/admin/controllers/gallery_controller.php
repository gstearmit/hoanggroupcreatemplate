<?php
class GalleryController extends AppController {

	var $name = 'Gallery';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'Gallery.id DESC');
	      $this->set('Gallery', $this->paginate('Gallery',array()));
		  $this->loadModel("Product");
        $list_cat = $this->Product->find('all');
        $this->set(compact('list_cat'));
	}
	
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Gallery->create();
			$data['Gallery'] = $this->data['Gallery'];
			$data['Gallery']['images']=$_POST['userfile'];
			
// 			echo '<pre>';
// 			print_r($data);die();
			
			//$data['Gallery']['images_eg']=$_POST['userfile_eg'];
		//	$data['Gallery']['display']=$_POST['display'];
			if ($this->Gallery->save($data['Gallery'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Product");
        
		$_list_part=$this->Product->find('list',array('fields' => array('id', 'title')));
		$this->set('list_cat',$_list_part);
        $this->set(compact('list_cat'));
        
        
     
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Gallery->read(null, $id));
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Gallery'] = $this->data['Gallery'];
		$data['Gallery']['status']=0;
		if ($this->Gallery->save($data['Gallery'])) {
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
		$data['Gallery'] = $this->data['Gallery'];
		$data['Gallery']['status']=1;
		if ($this->Gallery->save($data['Gallery'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	// tim kiem san pham
	/*function search() {
		$data['Gallery']=$this->data['Gallery'];
		$category=$data['Gallery']['catGallery_id'];
		$this->paginate = array('conditions'=>array('Gallery.catGallery_id'=>$category),'limit' => '15','order' => 'Gallery.id DESC');
	    $this->set('Gallery', $this->paginate('Gallery',array()));
		 $this->loadModel("CatGallery");
        $list_cat = $this->CatGallery->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		
	}*/
	function search() {
		$this->loadModel("CatGallery");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		if(isset($_POST['list_cat']))
		$list_cat=$_POST['list_cat'];
		$x=array();
		if($keyword!="")
		$x['Gallery.title like']='%'.$keyword.'%';
		
		if($list_cat!="")
		$x['Gallery.catGallery_id']=$list_cat;
		//pr($x);exit;
		$tt =array();
		$portfolio=$this->CatGallery->find('all',array('conditions'=>array('CatGallery.parent_id'=>$x)));		
		//pr($portfolio);
		foreach($portfolio as $key){
		$tt[]=$key['CatGallery']['id'];
		}
		for($i=0;$i<count($tt);$i++)
		 if($list_cat==$tt[$i])
		 $list_cat=$this->Product->find('list',array('conditions'=>array('CatGallery.parent_id'=>$tt[$i]),'fields'=>array('CatGallery.id')));	
		 if($list_cat!="")
		$x['Gallery.product_id']=$list_cat;
		//pr($x); die;
		//
	    //$this->set('Gallerys', $this->paginate('Gallery',array()));	
		//pr($x);
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Gallery.id DESC');
		$this->set('Gallery', $this->paginate('Gallery',array()));	
		//$ketquatimkiem=$this->Gallery->find('all',array('conditions'=>$x,'order' => 'Gallery.id DESC','limit'=>3));	
		//pr($ketquatimkiem); die;
		//$this->set('Gallerys',$category);
		 $this->loadModel("Product");
        $list_cat = $this->Product->generatetreelist(null,null,null," _ ");
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
			$data['Gallery'] = $this->data['Gallery'];
			$data['Gallery']['images']=$_POST['userfile'];
			
			//$data['Gallery']['display']=$_POST['display'];
			if ($this->Gallery->save($data['Gallery'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gallery->read(null, $id);
		}
		$this->loadModel("Product");
        
		$_list_part=$this->Product->find('list',array('fields' => array('id', 'title')));
		$this->set('list_cat',$_list_part);
        $this->set(compact('list_cat'));
		$this->set('edit',$this->Gallery->findById($id));
	}
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Gallerys=($this->Gallery->find('all'));
				foreach($Gallerys as $Gallery) {
					$Gallery['Gallery']['status']=1;
					$this->Gallery->save($Gallery['Gallery']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Gallerys=($this->Gallery->find('all'));
				foreach($Gallerys as $Gallery) {
					$Gallery['Gallery']['status']=0;
					$this->Gallery->save($Gallery['Gallery']);					
				}
				break;
				case 'delete':
				$Gallerys=($this->Gallery->find('all'));
				foreach($Gallerys as $Gallery) {
					$this->Gallery->delete($Gallery['Gallery']['id']);					
				}
				if($this->Gallery->find('count')<1)
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
				$Gallerys=($this->Gallery->find('all'));
				foreach($Gallerys as $Gallery) {
					if(isset($_POST[$Gallery['Gallery']['id']]))
					{
						$Gallery['Gallery']['status']=1;
						$this->Gallery->save($Gallery['Gallery']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Gallerys=($this->Gallery->find('all'));
				foreach($Gallerys as $Gallery) {
					if(isset($_POST[$Gallery['Gallery']['id']]))
					{
						$Gallery['Gallery']['status']=0;
						$this->Gallery->save($Gallery['Gallery']);
					}
				}
				break;
				case 'delete':
				$Gallerys=($this->Gallery->find('all'));
				foreach($Gallerys as $Gallery) {
					if(isset($_POST[$Gallery['Gallery']['id']]))
					{
					    $this->Gallery->delete($Gallery['Gallery']['id']);
						
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
		if ($this->Gallery->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->Product->generatetreelist(null, null, null, '__');
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
