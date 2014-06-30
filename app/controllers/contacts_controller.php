<?php
class ContactsController extends AppController
{ var $name='Contacts';
var $components = array('Email');
var $uses=array('Settings');
function send()
 {      
	 	$data=array("css"=>"style2");
	 	$this->set("data",$data);
 		mysql_query("SET NAMES 'utf8'");
		mysql_query("SET character_set_client=utf8");
		mysql_query("SET character_set_connection=utf8");
		 $x=$this->Settings->read(null,1);
		if(isset($_POST['name']))
		{
		$name=$_POST['name']; 
		
		$mobile=$_POST['phone_dd'];
		$email=$_POST['email'];
		$title=$_POST['title'];
		$content=$_POST['content'];
		
		$this->Email->from = $name.'<'.$email.'>';
		$this->Email->to = $x['Settings']['email']; 
		$this->Email->subject = $title;
		$this->Email->template = 'default';
		$this->Email->sendAs = 'both';
		$this->set('name',$name);
		$this->set('mobile',$mobile);
		$this->set('email',$email);
		$this->set('content',$content);
		
		//pr($this->Email->send());die;
		if($this->Email->send())
		{
		        $this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				  echo '<script language="javascript"> alert("Gửi mail thành công"); location.href="'.DOMAIN.'";</script>';
		}
		else  
		       $this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			      echo '<script language="javascript"> alert("gửi mail không thành công"); location.href="'.DOMAIN.'contact";</script>';
		}
	

}

function dathang()
 {      mysql_query("SET NAMES 'utf8'");
		mysql_query("SET character_set_client=utf8");
		mysql_query("SET character_set_connection=utf8");
		 $x=$this->Helps->read(null,1);
		if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			 $this->set(compact('shopingcart'));
		 }
		 else
		 {
			 echo '<script language="javascript"> alert("Chua co san pham nao trong gio hang"); window.location.replace("'.DOMAIN.'"); </script>';
		 }
		if(isset($_POST['name']))
		{
		$name=$_POST['name']; 
		$mobile=$_POST['phone'];
		$email=$_POST['email'];
		$title=$_POST['title'];
		$content=$_POST['content'];
		
		$images=$_POST['images']; 
		$product_name=$_POST['product_name'];
		$product_sl=$_POST['product_sl'];
		$price=$_POST['price'];
		$total=$_POST['total'];
		$this->Email->from = $name.'<'.$email.'>';
		$this->Email->to = $x['Helps']['mail']; 
		$this->Email->subject = $title;
		$this->Email->template = 'default';
		$this->Email->sendAs = 'both';
		$this->set('name',$name);
		$this->set('mobile',$mobile);
		$this->set('email',$email);
		$this->set('content',$content);
		
		$this->set('images',$images);
		$this->set('product_name',$product_name);
		$this->set('product_sl',$product_sl);
		$this->set('price',$price);
		$this->set('total',$total);
		
		$this->set('sang',array('images','product_name','product_sl','price','total'));
		
		if($this->Email->send())
		{
		        $this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				  echo '<script language="javascript"> alert("Gửi mail thành công"); </script>';
				  unset($_SESSION['shopingcart']);
				  echo '<script language="javascript">location.href="'.DOMAIN.'";</script>';
		  
			}
		else  
		       $this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			      echo '<script language="javascript"> alert("gửi mail không thành công"); location.href="'.DOMAIN.'";</script>';
		}
	

}


} ?>
