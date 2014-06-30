<?php
class ContactsController extends AppController {
	var $name = 'Contacts';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	var $components = array('Global','Email','SmtpEmail','Upload');	
	function index() {
		 $this->account();
		 $this->paginate = array('limit' => '15','order' => 'Contact.id DESC');
	     $this->set('contacts', $this->paginate('Contact',array()));
		 
	}
	//Gui phản hoi
	function feedback($id=null) {
		$this->account();
		$test=$this->Contact->findById($id);
		if($test){
			$this->set('feedback',$test);
		}else{
			echo "<script>alert('".json_encode('Không tồn tại thư này')."');</script>";
			echo "<script>history.back();</script>";
		}	
	}
	// Ham gui
	function send() {
		//gui mail den nguoi gop y
		if (!empty($this->data)) {			
			$data['Contact']=$this->data['Contact'];
			
			$content="Kính gửi ông (bà) : ".$data['Contact']['name']." <br><br>".$data['Contact']['content_send']."";			
			if ($this->SmtpEmail->smtpmailer($data['Contact']['email'], ADDRESS_EMAIL_SEND_ACTIVE,FROM_NAME_EMAIL_ACTIVE, SUBJECT_EMAIL_ACTIVE,$content)){
				$data['Contact']['status']=1;
				$this->Contact->save($data['Contact']);
				echo "<script>alert('".json_encode('Bạn gửi thư thành công')."');</script>";
				echo "<script>location.href='".DOMAINAD."contacts'</script>";
			}else{
				echo "<script>alert('".json_encode('Gưi thư không thành công')."');</script>";
				echo "<script>location.href='".DOMAINAD."contacts'</script>";
			}
			
		
		}
	}

	function delete($id=null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Contact->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
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
