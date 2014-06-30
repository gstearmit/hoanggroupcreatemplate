<?php
class ShopController extends AppController {

	var $name = 'Shop';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	var $uses=array('Shop','Product_subcategory','Store');
	function index() {
		  $this->account();
		 // $conditions=array('Shop.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'Shop.id DESC');
	      $this->set('Shop', $this->paginate('Shop',array()));
		 
     
		  
	}
	//Them bai viet
	function add() {
		$this->account();
		$store=$this->Store->find('all');
		$Product_subcategory=$this->Product_subcategory->find('all');
		if (!empty($this->data)) {
			$this->Shop->create();
			$data['Shop'] = $this->data['Shop'];
			$data['Shop']['images']=$_POST['userfile1'];
			$data['Shop']['companyname']=$_POST['companyname'];
			
			$category_code=null;
			foreach($Product_subcategory as $row) {
			if(isset($_POST[$row['Product_subcategory']['id']]))
			$category_code.=$row['Product_subcategory']['name'].'|';
			}
			$data['Shop']['category_code']=$category_code;
			//echo $category_code; die;
			
			
			$b=$this->Shop->findByName($data['Shop']['name']);
			
			/*
			$a=$this->Shop->findByCategory_code($data['Shop']['category_code']);
			if(isset($a['Shop']['id']) ) 
				{
					
					echo "<script>alert('".json_encode('Mã nhóm đã tồn tại!')."');</script>";
					echo "<script>history.back(-1);</script>";
				
				}*/
					
			if(isset($b['Shop']['id']) ) 
				{
				// echo "b"; die;
					echo "<script>alert('Tên đăng nhập này đã tồn tại!');</script>";
					echo "<script>history.back(-1);</script>";
				
				}		
			else {
			if ($this->Shop->save($data['Shop'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		}
		$this->set('Product_subcategory',$Product_subcategory);
		$this->set('store',$store);
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Shop->read(null, $id));
	}
	
	/*function search() {
		$data['Shop']=$this->data['Shop'];
		$category=$data['Shop']['category_id'];
		$this->paginate = array('conditions'=>array('Shop.category_id'=>$category),'limit' => '15','order' => 'Shop.id DESC');
	    $this->set('Shop', $this->paginate('Shop',array()));
		
	}
	*/
function search() {
		
	   $keyword="";
	 
	  
	   if(isset($_POST['name']))
		$keyword=$_POST['name'];

		$x=array();
		if($keyword!="")
		$x['Shop.name like']='%'.$keyword.'%';
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Shop.id DESC');
		$this->set('Shop', $this->paginate('Shop',array()));	
		//$ketquatimkiem=$this->Product->find('all',array('conditions'=>$x,'order' => 'Product.id DESC','limit'=>3));	
		//pr($ketquatimkiem); die;
		//$this->set('products',$category);

		
	}
	
	
	
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					$new['Shop']['status']=1;
					$this->Shop->save($new['Shop']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					$new['Shop']['status']=0;
					$this->Shop->save($new['Shop']);					
				}
				break;
				case 'delete':
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					$this->Shop->delete($new['Shop']['id']);					
				}
				if($this->Shop->find('count')<1)
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
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					if(isset($_POST[$new['Shop']['id']]))
					{
						$new['Shop']['status']=1;
						$this->Shop->save($new['Shop']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					if(isset($_POST[$new['Shop']['id']]))
					{
						$new['Shop']['status']=0;
						$this->Shop->save($new['Shop']);
					}
				}
				break;
				case 'delete':
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					if(isset($_POST[$new['Shop']['id']]))
					{
					    $this->Shop->delete($new['Shop']['id']);
						
					}
										
				}
				
				die;	
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	
	//close tin tuc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Shop'] = $this->data['Shop'];
		$data['Shop']['status']=0;
		if ($this->Shop->save($data['Shop'])) {
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
		$data['Shop'] = $this->data['Shop'];
		$data['Shop']['status']=1;
		if ($this->Shop->save($data['Shop'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	// sua tin da dang
	function edit($id = null) {
		$this->account();
		$store=$this->Store->find('all');
		$Product_subcategory=$this->Product_subcategory->find('all');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Shop'] = $this->data['Shop'];
			$data['Shop']['images']=$_POST['userfile1'];
			$data['Shop']['companyname']=$_POST['companyname'];
			
			$category_code=null;
			foreach($Product_subcategory as $row) {
			if(isset($_POST[$row['Product_subcategory']['id']]))
			$category_code.=$row['Product_subcategory']['name'].'|';
			}
			$data['Shop']['category_code']=$category_code;
			
			
			//$a=$this->Shop->findByCategory_code($data['Shop']['category_code']);
			$b=$this->Shop->findByName($data['Shop']['name']);
			
			/*
			if(isset($a['Shop']['id']) ) 
				{
					
					echo "<script>alert('".json_encode('Mã nhóm đã tồn tại!')."');</script>";
					echo "<script>history.back(-1);</script>";
				
				}*/
					
			if(isset($b['Shop']['id']) ) 
				{
				// echo "b"; die;
					echo "<script>alert('Tên đăng nhập này đã tồn tại!');</script>";
					echo "<script>history.back(-1);</script>";
				
				}		
			
			
			
			if ($this->Shop->save($data['Shop'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Shop->read(null, $id);
		}
		$this->set('Product_subcategory',$Product_subcategory);
		$this->set('store',$store);
		$this->set('edit',$this->Shop->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Shop->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->Category->generatetreelist(null, null, null, '__');
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
	
	function get_cat(){
	
	$companyname=$_POST['cat'];
	if($companyname!='nhacungcap') {
	$a=$this->Product_subcategory->find('list',array('fields'=>array('Product_subcategory.id', 'Product_subcategory.name'),'conditions'=>array('Product_subcategory.companyname'=>$companyname),'order'=>'Product_subcategory.id DESC'));}
	else {
	$a=$this->Product_subcategory->find('list',array('fields'=>array('Product_subcategory.id', 'Product_subcategory.name'),'order'=>'Product_subcategory.id DESC'));
	}
	$b=array();$i=0;
	foreach($a as $key=>$value){
	$b[$i]['id']=$key;
	$b[$i++]['name']=$value;
	}
	//pr($b); die;
	
	echo json_encode($b); die;
	
	}

}
?>
