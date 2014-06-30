<?php
class BuyCartsController extends AppController {

	var $name = 'BuyCarts';
	var $uses= array('Cart','Product');
	function index($id=null) {
		//lay san pham co id
		//pr($this->Session->id());
			///pr($this->Session);die;
		$sp=$this->Product->findById($id);
		$check=$this->Cart->find('all');
	
		if(count($check)==0){
			//pr($check);die;
			$cart=array(
			  'Cart'=>array(
				   'id_product'=>$sp['Product']['id'],
				   'title'=>$sp['Product']['title'],
				   //'price'=>$sp['Product']['price'],
				   'producer'=>$sp['Product']['producer'],
				   'number'=>1,
				   'images'=>$sp['Product']['images'],
				   'sesson_brow'=>$this->Session->id()
				   )
			  ); 
			$this->Cart->save($cart);
			echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";	  
		}elseif(count($check)>0){
		
			$ck=$this->Cart->findByIdProduct($id);			
			if(($ck['Cart']['sesson_brow']==$this->Session->id()) && ($ck['Cart']['id_product'] == $id)){
				$update['Cart']=$ck['Cart'];
				$update['Cart']['id']=$ck['Cart']['id'];
				$update['Cart']['number']=$ck['Cart']['number'] + 1;	
				//pr($update['Cart']);die();		  
				$this->Cart->save($update['Cart']);	
				echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";
			} elseif($ck['Cart']['id_product'] != $id && ($ck['Cart']['sesson_brow']==$this->Session->id())){
				$cart=array(
					  'Cart'=>array(
						   'id_product'=>$sp['Product']['id'],
						   'title'=>$sp['Product']['title'],
						   //'price'=>$sp['Product']['price'],
						   'producer'=>$sp['Product']['producer'],
						   'number'=>1,
						   'images'=>$sp['Product']['images'],
						   'sesson_brow'=>$this->Session->id()
						   )
					  ); 
				$this->Cart->save($cart);	
				echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";
			}elseif($ck['Cart']['id_product'] != $id && ($ck['Cart']['sesson_brow']!=$this->Session->id())){
				$cart=array(
					  'Cart'=>array(
						   'id_product'=>$sp['Product']['id'],
						   'title'=>$sp['Product']['title'],
						   //'price'=>$sp['Product']['price'],
						   'producer'=>$sp['Product']['producer'],
						   'number'=>1,
						   'images'=>$sp['Product']['images'],
						   'sesson_brow'=>$this->Session->id()
						   )
					  ); 
				$this->Cart->save($cart);	
				echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";
			}
			elseif($ck['Cart']['id_product'] == $id && ($ck['Cart']['sesson_brow']!=$this->Session->id())){
				$cart=array(
					  'Cart'=>array(
						   'id_product'=>$sp['Product']['id'],
						   'title'=>$sp['Product']['title'],
						   //'price'=>$sp['Product']['price'],
						   'producer'=>$sp['Product']['producer'],
						   'number'=>1,
						   'images'=>$sp['Product']['images'],
						   'sesson_brow'=>$this->Session->id()
						   )
					  ); 
				$this->Cart->save($cart);	
				echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";
			}
					
		}
		
	}
	  /*
	  $Session=$this->Product->findById($id);
		// inser vao bang cart luu tam
		$cart=array(
			  'Cart'=>array(
				   'id_product'=>$Session['Product']['id'],
				   'name'=>$Session['Product']['name'],
				   'price'=>$Session['Product']['price'],
				   'manufacturers'=>$Session['Product']['manufacturers'],
				   'number'=>1,
				   'images'=>$Session['Product']['images'],
				   'sesson_brow'=>$this->Session->id()
				   )
			  ); 
		  
		// kiem tra ton tai cau san pham
		$check=$this->Cart->findByIdProduct($id);
		if(!$check){
			$this->Cart->save($cart);
			//$this->redirect('/buy_carts/view');	
			echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";
		
		}elseif(!empty($check) && $check['Cart']['sesson_brow']==$this->Session->id()){
			$cart_new=array(
			  'Cart'=>array(
					'id'=>$check['Cart']['id'],			  
				    'number'=>$cart['Cart']['number'] + 1,
					//'price'=>$cart['Cart']['price'] * $cart['Cart']['number'],
				   )
			  ); 
		  $this->Cart->save($cart_new);		
		} 
		//$this->redirect('/buy_carts/view');	
		echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";
		// hien thi nhung san pham nmoi dua vao gio hang
		//$this->set('views',$this->Cart->find('all',array('conditions'=>array('Cart.sesson_brow'=>$this->Session->id()))));  				
	 }*/
	function add() {
		$add=array(
			  'Cart'=>array(
					'id'=>$_POST['id'],			  
				    'number'=>$_POST['mumber'],
					
				   )
			  ); 
			 //pr($add);die();
		  $this->Cart->save($add);	
		
		echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";
	}
	function delete($id = null) {	
		if ($this->Cart->delete($id)) {
			$this->Session->setFlash(__('Xóa thành công', true));
			//$this->redirect(array('action'=>'view'));
			echo "<script>location.href='".DOMAIN."buy_carts/view'</script>";
		}
		
	}
		function view() {
		$this->set('views',$this->Cart->find('all',array('conditions'=>array('Cart.sesson_brow'=>$this->Session->id())))); 
	}
	


}
?>
