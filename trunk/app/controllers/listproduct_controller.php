<?php
class ListproductController extends AppController{
	var $name='Listproduct';                         // bien Listproduct'  su dung cac bang ben duoi  'Catproduct','Product','Shop'
	var $uses=array('Catproduct','Product','Shop');  // su dung cac bang nay trong model : Catproduct','Product','Shop'
	
	function index($id=null)
	{	
	
        	$mang[0]=$id; // luu het cac câtlogue
       
        	// truy van den danh muc voi id vua nhap vao 
        		// + xem có danh muc cha không ?
        		// + lưu lai vao mang $mang
        	$catid=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$id,'Catproduct.status'=>1  ),
                                                 'fields' => array('Catproduct.id')));	


             $i=1;
            //pr($catid); die;
        	foreach($catid as $row=>$value)
        	{ 
        		$mang[$i++]=$value;
        		
        		$cat=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$value,'Catproduct.status'=>1  ),'fields' => array('Catproduct.id')));
        		
        		
        		foreach($cat as $cat=>$value)
        		{ 
        		   $mang[$i++]=$value; }
        		}
        	
        	//pr($mang); die;
        	$id1=0; $b=array(); $spnb=array();
        	
        			$a=$this->Product->find('all', array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.display'=>1,'Product.catproduct_id'=>$mang),'order' => 'Product.modified DESC'));
        			
        			foreach($a as $b){
        			  			 			  $date2 = $b['Product']['date_ketthuc'];
        					  				  $dayend = strtotime($date2);
        									  //so sanh ngay thang
        									  $date1 = date("Y-m-d");
        									  $datenow = strtotime($date1);
        									  
        								if($dayend > $datenow){
        									$spnb=$b;
        									$id1=$b['Product']['id'];
        									break;
        									}
        			}
        			
        		$this->set('row',$spnb);
        			
        		
        		
        		
        		
        			$a=$this->Product->find('all', array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.catproduct_id'=>$mang),'order' => 'Product.modified DESC'));
        			
        	
        		//echo $id1; die;
        		$i=0; $product=array();
        foreach($a as $c){
        	
        			 $date2 = $c['Product']['date_ketthuc'];
        			  $dayend = strtotime($date2);
        			  //so sanh ngay thang
        			  $date1 = date("Y-m-d");
        			  $datenow = strtotime($date1);
        	if(($dayend > $datenow) && ($c['Product']['id']!=$id1)){
        		$product[$i++]=$c;
        	}
        	}
        	
        	//pr($product); die;
        	
        	$this->set('product',$product);


        	
        	$this->Session->write('catid',$id);

}
	
	function dulich()
	{
	
	
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>81, 'Product.status'=>1),'limit' => '8','order' => 'Product.title DESC');
		$this->set('product', $this->paginate('Product',array()));
	
	
	}
	
	
	function tieudung()
	{
	
	
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>82, 'Product.status'=>1),'limit' => '8','order' => 'Product.title DESC');
		$this->set('prod', $this->paginate('Product',array()));
	
	
	}
	
	
	
	function search($search_product=null){
	
		$search_product = isset($_POST['search'])?$_POST['search']:'';
       // echo $search_product; die;
        
        
			$a=$this->Product->find('all',array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.title like'=>'%'.$search_product.'%'),'limit'=>9));

		$i=0; $product=array();
foreach($a as $c){
	
			 $date2 = $c['Product']['date_ketthuc'];
			  $dayend = strtotime($date2);
			  //so sanh ngay thang
			  $date1 = date("Y-m-d");
			  $datenow = strtotime($date1);
	if($dayend > $datenow){
		$product[$i++]=$c;
	}
	}
	
	//pr($product); die;
	
	$this->set('product',$product);

		$this->set('txt',$search_product);
		$this->set('result', $i-1);
	
	}
	
	
	
	function dsda(){
	
		$this->paginate = array('conditions'=>array('Catproduct.status'=>1),'limit'=>10);
		$this->set('prod', $this->paginate('Catproduct',array()));
	
	
	}
	
	function search_eg($search_product=null){
	
		$search_product = isset($_POST['search_product'])?$_POST['search_product']:'';
	
		$this->paginate = array('conditions'=>array('Catproduct.status'=>1,'Catproduct.name_eg like'=>'%'.$search_product.'%'),'limit'=>4);
		$this->set('prod', $this->paginate('Catproduct',array()));
		$this->set('txt',$search_product);
		$this->set('result', $this->Product->getNumRows());
		$this->render('search');
	}
	
	

	
	
	function getnameproduct($id=null){
		$a=array();
		$i=0;
		$lap=$id;
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.id'=>$id)));
	/* 	echo '<pre>';
		print_r($row);
		die(); */
// 		while($lap!=null)
// 		{
// 			$row=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.id'=>$id)));
// 			$a[$i++]['nam']=$row['Catproduct']['name'];
// 			$lap=$row['Catproduct']['parent_id'];
// 		}
		
// 		return $a;
	
	
}


function dealhot()
	{	
    // dieu kien cua bang product : array('Product.chophep'=>1,'Product.status'=>1,'Product.display'=>1) : dầy là sản phẩm hót	

	//pr($mang); die;
        	$id1=0; $b=array(); $spnb=array();
	
			$a=$this->Product->find('all', array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.display'=>1),'order' => 'Product.giam DESC'));
			
			foreach($a as $b){
			  			 			  $date2 = $b['Product']['date_ketthuc'];
					  				  $dayend = strtotime($date2);
									  //so sanh ngay thang
									  $date1 = date("Y-m-d");
									  $datenow = strtotime($date1);
									  
								if($dayend > $datenow){
									$spnb=$b; // chưa hết dealhot này
									$id1=$b['Product']['id'];
									break;
									}
		                	}
			
		$this->set('row',$spnb);  // hiển thị ra từng dòng
			
		
		
		
		
			$a=$this->Product->find('all', array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1),'order' => 'Product.giam DESC'));
		//echo $id1; die;
		$i=0; $product=array();
         foreach($a as $c){
	
			  $date2 = $c['Product']['date_ketthuc'];
			  $dayend = strtotime($date2);
			  //so sanh ngay thang
			  $date1 = date("Y-m-d");
			  $datenow = strtotime($date1);
	if(($dayend > $datenow) && ($c['Product']['id']!=$id1)){
		$product[$i++]=$c;    // lấy sản phẩm hiển thị ra
        if($i==9) break;
	}
	}
	
	//pr($product); die;
	
	$this->set('product',$product);


}



function gianhang(){
    
    $this->paginate=array('conditions'=>array('Shop.status'=>1),'order'=>'Shop.id ASC');
    $this->set('shop',$this->paginate('Shop',array()));
}



function sanphamgianhang($shop_id=null){
    
		$this->Session->write('shop_id',$shop_id);
    	$id1=0; $b=array(); $spnb=array();
	
			$a=$this->Product->find('all', array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.display'=>1),'order' => 'Product.modified DESC'));
			
			foreach($a as $b){
			  			 			  $date2 = $b['Product']['date_ketthuc'];
					  				  $dayend = strtotime($date2);
									  //so sanh ngay thang
									  $date1 = date("Y-m-d");
									  $datenow = strtotime($date1);
									  
								if($dayend > $datenow){
									$spnb=$b;
									$id1=$b['Product']['id'];
									break;
									}
			}
			
		$this->set('row',$spnb);
        
        
        
        $this->paginate= array('conditions'=>array('Product.status'=>1,'Product.shop_id'=>$shop_id),'order' => 'Product.modified DESC');
        
        $this->set('product',$this->paginate('Product',array()));
        
	    $this->Session->write('shop_id',$shop_id);
    
    
}

function ctspgh($id=null) 
    { 
        /// ctspgh : chi tiet ssan pham gian hàng
    	$id1=0; $b=array(); $spnb=array();
        $a=$this->Product->find('all', array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.display'=>1),'order' => 'Product.modified DESC'));	
        foreach($a as $b)
            {
			  			 			  $date2 = $b['Product']['date_ketthuc'];
					  				  $dayend = strtotime($date2);
									  //so sanh ngay thang
									  $date1 = date("Y-m-d");
									  $datenow = strtotime($date1);
									  
								if($dayend > $datenow){
									$spnb=$b;
									$id1=$b['Product']['id'];
									break;
									}
			}
			
		$this->set('row',$spnb);
        $this->set('product',$this->Product->find('all',array('conditions'=>array('Product.id'=>$id,'Product.status'=>1))));
        $this->set('idprod',$id);
    
    }


}