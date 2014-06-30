<?php
class TemshopController extends AppController {

	var $name = 'Temshop';
	var $uses=array('City','Tems','Shops');
	function index() {
		  if(!$this->Session->read("id")){
			 echo "<script>location.href='".DOMAIN."login'</script>";
		}else
			{
			$this->layout='home2';
			$this->set('imagestems',$this->Tems->find('all'));
			$check=$this->Shops->find('all');
			
			if($check){
				foreach($check as $checks){
			       $this->Session->write('shop_id',$checks['Shops']['id']);
				}
			 }
			}
	   
	}

		 
	function add() {
			$ischecked = $_POST['themeRadio'];
			
			//check theme
			 $x=array();
			switch($ischecked){
					case "team_1":
								$x['imagestems'] = $_POST['imagestems'];
								$x['linktems']=$_POST['linktems'];
								$x['nametem']=$ischecked;
								break;
					case "team_2":
					            $x['imagestems'] = $_POST['imagestems1'];
								$x['linktems']=$_POST['linktems1'];
								$x['nametem']=$ischecked;
								break;
					case "team_3": 
								$x['imagestems'] = $_POST['imagestems2'];
								$x['linktems']=$_POST['linktems2'];
								$x['nametem']=$ischecked;
								break;						
				}
				
			//pr($x);exit;	
		   //$this->set('checkid',$this->Tems->find('all'));
		   $check = $this->Tems->find('all');
			  
				$x['user_id']=$this->Session->read("id");
				$x['shop_id']=$this->Session->read("shop_id");
				
				foreach($check as $checks){
					if($this->Session->read("shop_id")== $checks['Tems']['shop_id']){
					  $x['id']=$_POST['id'];
					}
				 }
				 $this->Tems->save($x);
			 echo "<script language='javascript'>window.location.replace('".DOMAIN."cai-dat-giao-dien');</script>";
			}
  }
?>
