<?php
class SettingsController extends AppController {

	var $name = 'Settings';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	var $uses=array('Product','Setting');
	function index() {
		  $this->account();		
	      $this->set('Setting', $this->Setting->read(null,1));
	}
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Setting->create();
			$data['Setting'] = $this->data['Setting'];
			$data['Setting']['image_header']=$_POST['userfile1'];

			
			if ($this->Setting->save($data['Setting'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Category");
        $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Setting->read(null, $id));
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Setting'] = $this->data['Setting'];
		$data['Setting']['status']=0;
		if ($this->Setting->save($data['Setting'])) {
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
		$data['Setting'] = $this->data['Setting'];
		$data['Setting']['status']=1;
		if ($this->Setting->save($data['Setting'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
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
			$data['Setting'] = $this->data['Setting'];		
			$data['Setting']['image_header']=$_POST['userfile1'];
		
				
			if ($this->Setting->save($data['Setting'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('controller'=>'home','action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setting->findById($id);
		}        
		$this->set('edit',$this->Setting->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Setting->delete($id)) {
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





	function getproduct(){

	$server = '.\SQLEXPRESS';
// Connect to MSSQL
$link = mssql_connect($server, 'sa', 'doannam');


mssql_select_db('test', $link);


//mssql_query("SET NAMES 'utf8'");
//echo "ngon";

 $result=mssql_query('select * from product');
 $i=0;
 while( $row=mssql_fetch_array($result))
 {

	$a=$row['product_name'];
 }
 
 $data['Product']['title']=$a;
 
 $this->Product->save($data);
	echo "<script>alert('".json_encode('Đưa sản phẩm thành công')."');</script>";
echo "<script>location.href='".DOMAINAD."'</script>";
	}
	
}
?>
