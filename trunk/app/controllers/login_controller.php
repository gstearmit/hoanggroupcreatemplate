<?php
class LoginController extends AppController {

	var $name = 'Login';
	var $uses =array('Userscms');
	function index() {
		
		
	}
	function check_login() {	
		if(!empty($_POST['email1']) && !empty($_POST['email1'])){
			$check=$this->Userscms->findByEmail($_POST['email1']);
			//pr($check);exit;
			if($check){
				
				if($check['Userscms']['password']!=md5($_POST['password1']) ){
					echo "<script>alert('".json_encode('Sai mật khẩu!')."');</script>";
                    
					
				}
				elseif($check['Userscms']['status']==0){
					
					echo "<script>alert('".json_encode('Tài khoản đã bị khóa !')."');</script>";
                   
					
					
				}
				else {
					$this->Session->write('email',$check['Userscms']['email']);
					$this->Session->write('name1',$check['Userscms']['name']);
					echo "<script>alert('".json_encode('Chúc mừng bạn đã đăng nhập thành công !')."');</script>";
				
				}
				
			
		}
		else echo "<script>alert('".json_encode('Sai email đăng nhập !')."');</script>";
	}
    	echo "<script>location.href='".DOMAIN."'</script>";
	}
	
	
	function check_email() {
		$this->layout= 'ajax';
			$check=$this->Userscms->findByEmail($_GET['email']);
			
			if(!$check){
				
				echo "<span style='color:#FF0000;padding-left:148px;'>Sai Email đăng nhập</span>";
			}
				
		
	}
	
	
	function check_password() {
		$this->layout= 'ajax';
			$check=$this->Userscms->findByPassword(md5($_GET['password']));
			//pr($check);exit;
			if(!$check){
					
				
					echo "<span style='color:#FF0000;padding-left:148px;'>Mật khẩu không đúng </span>";
			
			
			}
				
		
	}
	
	
	function logout() {
	
		$this->Session->delete('email');
  $this->Session->delete('name');

		$this->redirect('/');
	}


}
?>

