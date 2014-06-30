<?php
class LoginController extends AppController {

	var $name = 'Login';
	var $uses=array('User');
	function index() {

	}
	// chekh dang nhap
	function login() {
		$data['User'] = $this->data['User'];
		if (empty($data['User']['name'])) {
			$this->Session->setFlash(__('Xin vui lòng nhập tên đăng nhập', true));
			$this->redirect(array('action'=>'index'));
		}elseif(empty($data['User']['password'])){
			$this->Session->setFlash(__('Xin vui lòng nhập mật khẩu', true));
			$this->redirect(array('action'=>'index'));
		}else{
			$chek=$this->User->findByName($data['User']['name']);
			if($chek){
				if($chek['User']['password']==md5($data['User']['password'])){
					$this->Session->write('id',$chek['User']['id']);
					$this->Session->write('name',$chek['User']['name']);
					$this->redirect('/home');
				}else{
					echo "<script>alert('".json_encode('Mật khẩu không đúng !')."');</script>";
					echo "<script>location.href='".DOMAINAD."'</script>";
				}			
			}else{
				echo "<script>alert('".json_encode('Tên đăng nhập không đúng. Xin vui lòng nhập lại !')."');</script>";
				echo "<script>location.href='".DOMAINAD."'</script>";
			}
		}

	}
	//lay lai password
	function password() {
		$this->layout='password';
	}
	function check_pass() {

	}


	//logout ra khoi he thong
	function logout(){
		$this->Session->delete('id');
		$this->Session->delete('name');		
		$this->redirect(array('action'=>'index'));
	}	

	// chon layout
	function beforeFilter(){
		$this->layout='login';
	}

}
?>
