<?php
class RegistrationshopController extends AppController {

	var $name = 'Registrationshop';
	var $uses=array('Shops','News','City','Userscms');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  
			
			$city=$this->City->find('all');
			$this->set('city',$city);
			
			$shops=$this->Shops->find('all');
			//pr($shops);die;
			$this->set('shops',$shops);
            //echo "nam"; die;
			
	}
	
	function profile() {
		$this->layout='home2';
		$this->checkIfLogged();
		$member_id=$this->Session->read('id');
		$edit=$this->Shops->findByUser_id ($member_id);
		//pr($member_id);die;
		$this->set('edit',$edit);
	}
	function editshop() {
		$this->layout='home2';
		$this->checkIfLogged();
// 		$member_id=$this->Session->read('id');
		$member_id=17;
		$iduser = $this->Shops->find('all',array('conditions'=>array('Shops.user_id'=>$member_id)));
		//pr($iduser);die;
		$this->set('edit', $iduser);
		$city=$this->City->find('all');
		$this->set('city',$city);
		
		// --------------------------
		
	}
	
	// dang ky gian hang 
	function add() {
		
		 $name=$this->Shops->findByName($_POST['tengianhang']);
        // var_dump($name); 
		$email=$this->Shops->findByEmail($_POST['email']);
        //pr($email); die;
       // echo count($name); die;
		if($name!=null){
				echo "<script>alert('".json_encode('Tên gian hàng đã tồn tại!')."');</script>";
				echo "<script>history.back(-1);</script>";
	    }elseif($email!=null){
	       		echo "<script>alert('".json_encode('Email đã tồn tại!')."');</script>";
				echo "<script>history.back(-1);</script>";}
	   else{
	       	$x['link']=$_POST['link'];
			$x['business']=$_POST['business'];
			$x['phone']=$_POST['phone'];
			$x['email']=$_POST['email'];
			$x['address']=$_POST['address'];
			$x['name']=$_POST['tengianhang'];
            $x['password']=md5('123456');
			
			$x['mobile']=$_POST['mobile'];
            $x['namecompany']=$_POST['namecompany'];
            $this->Shops->save($x);
            echo "<script>alert('".json_encode('Thêm gian hàng thành công. Xin vui lòng chờ chúng tôi sẽ duyện và cấp gian hàng cho bạn!')."');</script>";
            echo "<script>location.href='".DOMAIN."'</script>";
           
	   }
				
		}
	
	// dang ky gian hang 
	function edit()
	 {
		 
		  $x=array();
			$x['user_id']=$this->Session->read("id");
			$x['link']=$_POST['link'];
			$x['business']=$_POST['business'];
			$x['phone']=$_POST['phone'];
			$x['email']=$_POST['email'];
			$x['address']=$_POST['address'];
			$x['images']=$_POST['userfile'];
			$x['city']=$_POST['city'];
			$x['mobile']=$_POST['mobile'];
			$x['id']=$_POST['id'];
			$x['content']=$this->data['Shops']['content'];
			$x['fax']=$_POST['fax'];
			$x['ckshops']=1;
			//mkdir("/path/to/my/dir", 0700);
		   $this->Shops->save($x);
		  // echo($structure);die;
		// To create the nested structure, the $recursive parameter 
		// to mkdir() must be specified.

			echo "<script language='javascript'>alert('Chúc mừng bạn cập nhật thành công');window.location.replace('".DOMAIN."thanh-vien');</script>";
	
		}
	
	function account() {
		$this->checkIfLogged();
		$member_id=$this->Session->read('id');
		$edit=$this->Shops->findByUser_id ($member_id);
		//pr($member_id);die;
		$this->set('edit',$edit);
	   
	}
	
	//cai dat giao dien
	function settingshop() {
		  if(!$this->Session->read("id")){
			 echo "<script>location.href='".DOMAIN."login'</script>";
		}else
			{
			$this->layout='home2';
			}
	   
	}
			
	
	 /* Ham check mail ton tai khi dang ky thanh vien */
	function ck_name_register(){
		 $this->checkIfLogged();
		$this->layout= 'ajax';
		//$this->Shops->unbindModel(array('hasMany' => array('Shops')));
		$name=$this->Shops->findAllByName($_GET['name']);
		if(count($name)==0){
			echo "<span style='color:#00FF33;padding-left:0px;'>Gian hàng hợp lệ ! </span>"; 
		}
		
		if(count($name)>0){
			foreach($name as $name1){
				 if($name1['Shops']['name'] == 1){
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
					echo "<span style='color:#00FF33;padding-left:0px;'>Gian hàng hợp lệ </span>";
				}
				elseif($check==0){
					echo "<span style='color:#FF0000;padding-left:0px;'>Gian hàng đã tồn tại </span>";
				}
					
			}
        }
		
		function checkIfLogged(){
		if(!$this->Session->read("shopname") || !$this->Session->read("id")){
			 $this->redirect('/dang-nhap');
		}
	}
/* Ham khoi tao capcha*/
	function create_image(){
		$md5_hash = md5(rand(0,999));
		$security_code = substr($md5_hash, 15, 5);
		$this->Session->write('security_code',$security_code);
		$width = 80;
		$height = 22;
		$image = ImageCreate($width, $height);
		$black = ImageColorAllocate($image, 37, 170, 226);
		$white = ImageColorAllocate($image, 255, 255, 255);
		ImageFill($image, 0, 0, $black);
		ImageString($image, 5, 18, 3, $security_code, $white);
		header("Content-Type: image/jpeg");
		ImageJpeg($image);
		ImageDestroy($image);
	}	
	
	
	function create_image1($random){
		
		$md5_hash = md5(rand(0,999));
		$security_code = substr($md5_hash, 15, 5);
		$this->Session->write('security_code',$security_code);
		$width = 80;
		$height = 22;
		$image = ImageCreate($width, $height);
		$black = ImageColorAllocate($image, 37, 170, 226);
		$white = ImageColorAllocate($image, 255, 255, 255);
		ImageFill($image, 0, 0, $black);
		ImageString($image, 5, 18, 3, $security_code, $white);
		header("Content-Type: image/jpeg");
		ImageJpeg($image);
		ImageDestroy($image);
		
	}
	// ham chuyen doi ky tu
function unicode_convert($str){
		if(!$str) return false;
		$unicode = array(
		'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ', 'ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ','� �'),
		'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ', 'Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ','� �'),
		'd'=>array('đ'),
		'D'=>array('Đ'),
		'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề' ,'ể','ễ','ệ'),
		'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề' ,'Ể','Ễ','Ệ'),
		'i'=>array('í','ì','ỉ','ĩ','ị'),
		'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
		'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ', 'ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','� �'),
		'0'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ', 'Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','� �'),
		'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ', 'ử','ữ','ự'),
		'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ', 'Ử','Ữ','Ự'),
		'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
		'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
		'-'=>array(' ','&','?')
		);
		
		foreach($unicode as $nonUnicode=>$uni){
		foreach($uni as $value)
		$str = str_replace($value,$nonUnicode,$str);
		}
		return $str;
		}
  }
?>
