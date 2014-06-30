<?php

		  class DoannamController extends AppController {
		  var $name = 'Doannam';
		  var $uses=array('Product','Tems','Shop','Newshop','Productshop','Categoryshop','Userscms','Classifiedss','Banner','Background');
		  var $helpers = array('Html', 'Form', 'Javascript');

		  function index() {	
		    $pizza = $_GET['url'];
		   $urlshop = explode('/', $pizza);
		   $geturl=$urlshop[0];
		   
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		   $this->set('title_for_layout', '');
		   $user = $this->Session->read('id');
			$temshop = $this->Shop->findAllByName($geturl);
           $idshop = $temshop[0]['Shop']['id'];
			$product_shop = $this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.shop_id'=>$idshop),'order'=>'Productshop.id DESC','limit'=>9));
			$this->set('productshop',$product_shop);
		 }
		 
		  function tin_tuc() {	
		      $pizza = $_GET['url'];
		     $urlshop = explode('/', $pizza);
		     $geturl=$urlshop[0];
			 $temshop = $this->Shop->findAllByName($geturl);
		     $sang = $this->Tems->find('all');
			$this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
			 $this->set('title_for_layout', 'Tin tức - '.$temshop[0]['Shop']['namecompany']);
			 $user = $this->Session->read('id');
			
            $idshop = $temshop[0]['Shop']['id'];
			 $this->paginate = array('conditions'=>array('Newshop.shop_id'=>$idshop),'limit' => '8','order' => 'Newshop.id DESC');
	        $this->set('newsshop', $this->paginate('Newshop',array()));
		 }
		 
		  function chi_thiet_tin_tuc($id=null) {
			 $sang = $this->Tems->find('all');
			 $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
			if (!$id) {
				$this->Session->setFlash(__('Không tồn tại', true));
				$this->redirect(array('action' => 'index'));
			}
			$x=$this->Newshop->read(null, $id);
			$this->set('views',$x);	
			$this->set('list_others', $this->Newshop->find('all',array('conditions'=>array('Newshop.status'=>1,'Newshop.categorynewsshop_id'=>$x['Newshop']['categorynewsshop_id'],'Newshop.id <>'=>$id),'limit'=>10)));
		}
		 // hien thi san phan trong gian hang
		 function san_pham() {	
		   $pizza = $_GET['url'];
		   $urlshop = explode('/', $pizza);
		   $geturl=$urlshop[0];
		   $temshop = $this->Shop->findAllByName($geturl);
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		   $this->set('title_for_layout', 'Sản phẩm - '.$temshop[0]['Shop']['namecompany']);
		   $user = $this->Session->read('id');
			 //----------------------------------
			
            $idshop = $temshop[0]['Shop']['id'];
			$product_shop = $this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.shop_id'=>$idshop),'order'=>'Productshop.id DESC','limit'=>9));
			$this->set('productshop',$product_shop);
		 }
		function raovat() {	
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		    $sangurl = $_SERVER['REQUEST_URI'];
			$url = explode('/', $sangurl);
		    $geturl=$url[2];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['user_id'];
			$this->set('title_for_layout', 'Rao vặt - '.$temshop[0]['Shop']['namecompany']);
			$this->paginate = array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.user_id'=>$idshop),'order'=>'Classifiedss.id DESC','limit'=>12);
			$this->set('raovat', $this->paginate('Classifiedss',array()));	
		 }
		 
		 // cai dat giao dien
		function bannerheader() {	
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		    $sangurl = $_SERVER['REQUEST_URI'];
			$url = explode("/", $sangurl);
		    $geturl= $url[2];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['user_id'];
			return $this->Banner->find('all',array('conditions'=>array('Banner.user_id'=>$idshop),'order'=>'Banner.id DESC','limit'=>1));
		 }
		function background() {	
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		    $sangurl = $_SERVER['REQUEST_URI'];
			$url = explode("/", $sangurl);
		    $geturl=$url[2];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['user_id'];
			return $this->Background->find('all',array('conditions'=>array('Background.user_id'=>$idshop),'order'=>'Background.id DESC','limit'=>1));
		 } 
		 
		 function raovatnews() {	
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		    $sangurl = $_SERVER['REQUEST_URI'];
			$url = explode('/', $sangurl);
		    $geturl=$url[2];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['user_id'];
			 return $temshop = $this->Classifiedss->find('all',array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.user_id'=>$idshop),'order'=>'Classifiedss.id DESC','limit'=>7));
		 }
		 function chi_thiet_raovat($id=null) {
			 $sang = $this->Tems->find('all');
			 $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
			if (!$id) {
				$this->Session->setFlash(__('Không tồn tại', true));
				$this->redirect(array('action' => 'index'));
			}
			$x=$this->Classifiedss->read(null, $id);
			$this->set('views',$x);	
			$this->set('list_others', $this->Classifiedss->find('all',array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.scop_id'=>$x['Classifiedss']['scop_id'],'Classifiedss.id <>'=>$id),'limit'=>10)));
		}
		  function search($search_name=null) {	
		   $pizza = $_GET['url'];
		   $urlshop = explode('/', $pizza);
		   $geturl=$urlshop[0];
		   
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		   $this->set('title_for_layout', '');
		   $user = $this->Session->read('id');
			 //----------------------------------
			$temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['id'];
			$product_shop = $this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.shop_id'=>$idshop,'Productshop.title like'=>'%'.$search_name.'%'),'order'=>'Productshop.id DESC','limit'=>9));
			$this->set('search',$product_shop);
		 }
		 
		 //list product
		 function danh_sach_san_pham($id=null) {	
		   $pizza = $_GET['url'];
		   $urlshop = explode('/', $pizza);
		   $geturl=$urlshop[0];
		   
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		   $this->set('title_for_layout', '');
		   $user = $this->Session->read('id');
			$temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['id'];
			$product_shop = $this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.categoryshop_id'=>$id,'Productshop.shop_id'=>$idshop),'order'=>'Productshop.id DESC','limit'=>9));
			$this->set('productshop',$product_shop);
			
			$cat=$this->Categoryshop->read(null, $id);
		    $this->set('catid',$cat);	
		 }
		 
		 function chi_thiet_san_pham($id=null) {
			 $sang = $this->Tems->find('all');
			 $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
			if (!$id) {
				$this->Session->setFlash(__('Không tồn tại', true));
				$this->redirect(array('action' => 'index'));
			}
			$x=$this->Productshop->read(null, $id);
			$this->set('views',$x);	
			$this->set('list_others', $this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.categoryshop_id'=>$x['Productshop']['categoryshop_id'],'Productshop.id <>'=>$id),'limit'=>10)));
		}
	
		 function khuyen_mai() {	
		    $pizza = $_GET['url'];
		   $urlshop = explode('/', $pizza);
		   $geturl=$urlshop[0];
		   $temshop = $this->Shop->findAllByName($geturl);
		   $sang = $this->Tems->find('all');
          $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		  $this->set('title_for_layout', 'Khuyến mại - '.$temshop[0]['Shop']['namecompany']);
		 }
		 
		 function chinh_sach() {	
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		   $this->set('title_for_layout', '');
		 }
		 
		function ban_do() {	
		   $sang = $this->Tems->find('all');
			$this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
				$this->set('title_for_layout', '');
		 }
		function gioi_thieu() {
            $pizza = $_GET['url'];
		   $urlshop = explode('/', $pizza);
		   $geturl=$urlshop[0];
		   
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];

		   $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['id'];
			$temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.id'=>$idshop),'order'=>'Shop.id DESC'));
			 $this->set('title_for_layout','Giới thiệu - '.$temshop[0]['Shop']['namecompany']);
			 $this->set('gioithoi',$temshop);
		}

		function lien_he() {	
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		  // hien ti thong tin shop
		   $pizza = $_GET['url'];
		   $urlshop = explode('/', $pizza);
		   $geturl=$urlshop[0];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['id'];
			$temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.id'=>$idshop),'order'=>'Shop.id DESC'));
			$this->set('infomationshop',$temshop);
			$this->set('title_for_layout','Liên hệ - '.$temshop[0]['Shop']['namecompany']);
		  
		 }
	 function send() {	
		   $sang = $this->Tems->find('all');
		   $this->layout='themeshop/'.$sang[0]['Tems']['linktems'];
		  // hien ti thong tin shop
		   $pizza = $_GET['url'];
		   $urlshop = explode('/', $pizza);
		   $geturl=$urlshop[0];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['id'];
			$temshop = $this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.id'=>$idshop),'order'=>'Shop.id DESC'));
			$emailshop = $temshop[0]['Shop']['email'];
			// cau hinh gui mail
			mysql_query('SET NAMES utf8');
			mysql_query('SET character_set_client=utf8');
			mysql_query('SET character_set_connection=utf8');
			if(isset($_POST['name']))
			{
			$name=$_POST['name']; 
			$mobile=$_POST['phone'];
			$email=$_POST['email'];
			$title=$_POST['title'];
			$content=$_POST['content'];
			
			$this->Email->from = $name.'<'.$email.'>';
			$this->Email->to = $emailshop; 
			$this->Email->subject = $title;
			$this->Email->template = 'default';
			$this->Email->sendAs = 'both';
			$this->set('name',$name);
			$this->set('mobile',$mobile);
			$this->set('email',$email);
			$this->set('content',$content);
			
			if($this->Email->send())
			{
					$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
					  echo '<script language="javascript"> alert("Gửi email thành công"); location.href='.DOMAIN.';</script>';
			}
			else  
				   $this->Session->setFlash(__("Thêm mơi danh mục thất bại. Vui long thử lại", true));
					  echo '<script language="javascript"> alert("gửi email không thành công"); location.href='.DOMAIN.';</script>';
			}
		  
		 }
		 
		 //sidebar phai
		function helponline(){
			$sangurl = $_SERVER['REQUEST_URI'];
			$url = explode('/', $sangurl);
		    $geturl=$url[2];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['user_id'];
		    return $temshop = $this->Userscms->find('all',array('conditions'=>array('Userscms.id'=>$idshop),'order'=>'Userscms.id DESC'));
		}
		
	// danh muc menu ben trai
		function categoryproduct(){
			$sangurl = $_SERVER['REQUEST_URI'];
			$url = explode('/', $sangurl);
		    $geturl=$url[2];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['id'];
		    return $this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1,'Categoryshop.shop_id'=>$idshop),'order'=>'Categoryshop.id DESC'));
		}
		
		function categoryproductsub($id=null){
			$sangurl = $_SERVER['REQUEST_URI'];
			$url = explode('/', $sangurl);
		    $geturl=$url[2];
		    $temshop = $this->Shop->findAllByName($geturl);
            $idshop = $temshop[0]['Shop']['id'];
		    return $this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1,'Categoryshop.parent_id'=>$id,'Categoryshop.shop_id'=>$idshop),'order'=>'Categoryshop.id DESC'));
		}
	 }
	 
?>
