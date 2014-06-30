<?php
class AnswerquestionsController extends AppController {
	var $name = 'Answerquestions';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	var $components = array('Global','Email','SmtpEmail','Upload');	
	function index() {
		  mysql_query("SET names utf8");
		 $this->account();
		// $conditions=array('Answerquestion.status'=>1,'Answerquestion.answer <>'=>'');
		 $this->paginate=array('conditions'=>array(),'order'=>'Answerquestion.id DESC','limit'=>20);
		 $this->set('answerquestions', $this->paginate('Answerquestion',array()));
	}
	function index_vn() {
		  mysql_query("SET names utf8");
		 $this->account();
		// $conditions=array('Answerquestion.status'=>1,'Answerquestion.answer <>'=>'');
		 $this->paginate=array('conditions'=>array('Answerquestion.language'=>0),'order'=>'Answerquestion.id DESC','limit'=>20);
		 $this->set('answerquestions', $this->paginate('Answerquestion',array()));
	}
	function index_eg() {
		  mysql_query("SET names utf8");
		 $this->account();
		// $conditions=array('Answerquestion.status'=>1,'Answerquestion.answer <>'=>'');
		 $this->paginate=array('conditions'=>array('Answerquestion.language'=>1),'order'=>'Answerquestion.id DESC','limit'=>20);
		 $this->set('answerquestions', $this->paginate('Answerquestion',array()));
	}
	//Gui phản hoi
	
	function delete($id=null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Answerquestion->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function close($id=null) {
	//	$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Answerquestion'] = $this->data['Answerquestion'];
		$data['Answerquestion']['status']=0;
		$data['Answerquestion']['id']=$id;
		if ($this->Answerquestion->save($data['Answerquestion'])) {
			$this->Session->setFlash(__('Bài viết không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	function edit($id = null) {
		  mysql_query("SET names utf8");
		//$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Answerquestion'] = $this->data['Answerquestion'];
			
			if ($this->Answerquestion->save($data['Answerquestion'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Answerquestion->read(null, $id);
		}
		$this->loadModel("Category");
        $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));		
	}
function active($id=null) {
		//$this->account();
	  
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Answerquestion'] = $this->data['Answerquestion'];
		$data['Answerquestion']['status']=1;
		$data['Answerquestion']['id']=$id;
		
		if ($this->Answerquestion->save($data['Answerquestion'])) {
			$this->Session->setFlash(__('Được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Không hiển được ', true));
		$this->redirect(array('action' => 'index'));
	}
	
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
