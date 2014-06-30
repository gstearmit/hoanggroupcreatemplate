<?php
class UserscmsController extends AppController {

	var $name = 'Userscms';
	var $uses =array('Userscms','City','Product','Order');
	var $components = array('Global','Email','SmtpEmail','Upload');	
	function index() {
		
		
	}
        /* Ham save tai khoan tao */
        function add() {

					$member_register=array(
						'Userscms'=>array(
							'email'=>$_POST['email'],
							'name'=>$_POST['name'],
							'birth_date'=>$_POST['date'],
							'password'=>md5($_POST['password']),
							'sex'=>$_POST['sex'],
							'phone'=>$_POST['phone'],
							'address'=>$_POST['address'],
							'status'=>1,
							//them thanh vien dang ky mo gian hang
					      )
						);			
					if($this->Userscms->save($member_register)){
						$this->Session->write('email',$_POST['email']);
						$this->Session->write('name',$_POST['name']);
							echo "<script>alert('".json_encode('Đăng ký thành viên thành công')."');</script>";
							echo "<script>location.href='".DOMAIN."'</script>";
					}
				
	}

	
	
	function ck_mail_register(){
		$this->layout= 'ajax';
		//$this->Userscms->unbindModel(array('hasMany' => array('Immovable')));
		$mail=$this->Userscms->findAllByEmail($_GET['email']);
		//pr(count($mail));die();
		if (!preg_match('/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i',$_GET['email'])) {
			echo "<span style='color:#FF0000;padding-left:148px;'> </span>";
		}
		else {
			if(count($mail)==0){
				echo "<span style='color:#00FF33;padding-left:148px;'>Email hợp lệ ! </span>";
			}
			if(count($mail)>0){
				foreach($mail AS $mail1){
					if($mail1['Userscms']['email'] == 1){
						$check = 1;
						//break;
					}
					else
					{
						$check = 0;
						//break;
					}
				}
				if($check==1){
					echo "<span style='color:#00FF33;padding-left:148px;'>Email hợp lệ </span>";
				}
				elseif($check==0){
					echo "<span style='color:#FF0000;padding-left:148px;'>Email đã tồn tại </span>";
				}
	
			}
				
		}
	}
	
	
function checkemail()
{

	$mail=$this->Userscms->findAllByEmail($_POST['email']);
	//echo '<script>alert("thu")<script>'; die;
	if(count($mail)==0) echo "false"; else echo "true";
}	
	
function unicode_convert($str){
		if(!$str) return false;
		$unicode = array(
		'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ', 'ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ','� �'),
		'a'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ', 'Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ','� �'),
		'd'=>array('đ'),
		'd'=>array('Đ'),
		'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề' ,'ể','ễ','ệ'),
		'e'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề' ,'Ể','Ễ','Ệ'),
		'i'=>array('í','ì','ỉ','ĩ','ị'),
		'i'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
		'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ', 'ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','� �'),
		'0'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ', 'Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','� �'),
		'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ', 'ử','ữ','ự'),
		'u'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ', 'Ử','Ữ','Ự'),
		'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
		'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
		''=>array(' ','&','?'),
		''=>array('-')
		);
		
		foreach($unicode as $nonUnicode=>$uni){
		foreach($uni as $value)
		$str = str_replace($value,$nonUnicode,$str);
		}
		return $str;
		}
		
		
		function thong_tin_tai_khoan($id=null){
		
		
			$check=$this->Userscms->findByEmail($this->Session->read('email'));
            
           
			$this->set('user',$check);
			$this->set('d',$id);
		}
        
        
        
		function luu(){
		
			$member_register=array(
					'Userscms'=>array(
							'id'=>$_POST['id'],
							'email'=>$_POST['email'],
							'name'=>$_POST['name'],
							'birth_date'=>$_POST['birth_date'],
								
							'sex'=>$_POST['sex'],
							'phone'=>$_POST['phone'],
							'status'=>1,
							//them thanh vien dang ky mo gian hang
					)
			);
			if($this->Userscms->save($member_register)){
				$this->Session->write('email',$_POST['email']);
				$this->Session->write('name',$_POST['name']);
				echo "<script>location.href='".DOMAIN."thong-tin-tai-khoan'</script>";
			}
		
		}
		
		function change_pass(){
		$this->set('title','Đổi mật khẩu');
			
			$check=$this->Userscms->findByEmail($this->Session->read('email'));
			$this->set('user',$check);
			
		
		}
		function ck_change_pass(){
			$member_register=array(
					'Userscms'=>array(
							'id'=>$_POST['id'],
			
							'password'=>md5($_POST['password']),
			
							//them thanh vien dang ky mo gian hang
					)
			);
			if($this->Userscms->save($member_register)){
				echo "<script>alert('".json_encode('Đổi mật khẩu thành công')."');</script>";
				echo "<script>location.href='".DOMAIN."thong-tin-tai-khoan'</script>";
			}
			
		}
		
		
		function check_password() {
			$this->layout= 'ajax';
			$check=$this->Userscms->findByEmail($this->Session->read('email'));
			//pr($check);exit;
			if($check){
				if($check['Userscms']['password']!=md5($_GET['password']))	
					echo  'false';
				echo 'true';
				
				
			}
			
		//return false;
		
		}
		function thong_tin_don_hang(){
		  if(!$this->Session->check('email')){
		      echo "<script>Bạn chưa đăng nhập</script>";
              	echo "<script>location.href='".DOMAIN."'</script>";
              
		  }
          else {
           $email=$this->Session->read('email'); 
           $this->paginate=array('conditions'=>array('Order.email'=>$email),'order'=>'Order.created DESC','limit'=>4);
		  
           
           
           $this->set('order',$this->paginate('Order',array()));
           
          }
          
		}
		function ma_du_thuong(){
		}
		function tien_thuong(){
		}
		
}
?>
