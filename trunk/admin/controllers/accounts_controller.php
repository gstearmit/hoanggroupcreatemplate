<?php
class AccountsController extends AppController {

	var $name = 'Accounts';
	var $uses=array('User');
	function index() {
	   $this->account();
	   $this->set('users',$this->User->find('all'));
	}
	function edit_pass($id=null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}		
	}
	function check_pass() {
		if (!empty($this->data)){
			$data['User'] = $this->data['User'];
			if($data['User']['pass_old']=='' || $data['User']['pass_new']==''){
				echo "<script>alert('".json_encode('Bạn vui lòng nhập đầy đủ mật khẩu cũ và mật khẩu mới!')."');</script>";
				echo "<script>history.back();</script>";				
			}else{
				$check=$this->User->findById($data['User']['id']);
				if($check['User']['password']!=md5($data['User']['pass_old'])){
					echo "<script>alert('".json_encode('Mật khẩu cũ không đúng! Vui lòng thực hiện lại!')."');</script>";
					echo "<script>history.back();</script>";
				}else{
					$data['User']['password']=md5($data['User']['pass_new']);
						if ($this->User->save($data['User'])) {
							echo "<script>alert('".json_encode('Tài khoản của bạn đã thay đổi thành công!')."');</script>";
							echo "<script>location.href='".DOMAINAD."/accounts'</script>";
						}
				}
			}
		}
	}
	
	function add(){
		if(!empty($this->data)){
			//pr($this->data);die;
			if($this->data['User']['password']!=$this->data['User']['pass2'])
	   echo '<script language="javascript"> alert("Hai trường password nhập không khớp"); window.history.back(); </script>';
	        $this->data['User']['password']=md5($this->data['User']['password']);
			$this->User->create();
			if($this->User->save($this->data))
			$this->redirect(array('action' => 'index'));
		}
	}
	function delete($id=null){
		if(!empty($id))
		$this->User->delete($id);
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
