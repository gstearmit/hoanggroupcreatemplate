<?php
class HomeController extends AppController {

	var $name = 'Home';
	var $uses=array('News','Product','Slideshows','Guest','Catproduct');

	function index($id=null)
	{
                    		$a=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1),'order'=>'Catproduct.char ASC','limit'=>1));
                    		
                            $this->set('catid',$a);

                    	
                    		foreach($a as $a){
                    			          $id=$a['Catproduct']['id'];
                    		             	}


	                        $mang[0]=$id;
                            
                    	    $catid=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$id,'Catproduct.status'=>1 ),'fields' => array('Catproduct.id')));
                    	
                            $i=1;



                   // echo " Hien Tat ca cac gia tri Id catologue";
                    //pr($catid); 
                   //die; //  hien tat ca cac cac ma id cua catalogue




                	   foreach($catid as $row=>$value)
                       { 
                    		$mang[$i++]=$value; // luu tat ca cac gia tri ca id catologue
                    		
                            
                    		$cat=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$value,'Catproduct.status'=>1  ),'fields' => array('Catproduct.id')));

                    		foreach($cat as $cat=>$value)
                                { 
                    	               	$mang[$i++]=$value; 
                                }
                    		
                    		
	                   }
                    	
                    	 //echo " Hien Tat ca bien luu mang ";
                         //pr($mang); die;



                    	$id1=0; 
                        $b=array(); 
                        $spnb=array();
                    	
	                    $a=$this->Product->find('all', array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.display'=>1,'Product.catproduct_id'=>$mang),'order' => 'Product.modified DESC'));
                    			
                    	foreach($a as $b)
                           {
                    			  		 $date2 = $b['Product']['date_ketthuc'];
                    					 $dayend = strtotime($date2);
                    				 //so sanh ngay thang
                    					 $date1 = date("Y-m-d");
                                         $datenow = strtotime($date1);
                    									  
	                              if($dayend > $datenow)
                                     {
	                                      $spnb=$b;
                    				   	  $id1=$b['Product']['id'];
                    							break;
	                                }
                  			}
                    			
                    		$this->set('row',$spnb);
                    			
                    		
                    		
                    		
                    		
                  			$a=$this->Product->find('all', array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.catproduct_id'=>$mang),'order' => 'Product.modified DESC'));
                    			
                    	
                    		//echo $id1; die;
                    		$i=0; $product=array();
                            foreach($a as $c)
                              {
                    	
                    			 $date2 = $c['Product']['date_ketthuc'];
                    			  $dayend = strtotime($date2);
                    			  //so sanh ngay thang
                    			  $date1 = date("Y-m-d");
                    			  $datenow = strtotime($date1);
                                	if(($dayend > $datenow) && ($c['Product']['id']!=$id1))
                                                             {
                    	                                    	$product[$i++]=$c;
                            	                             }
                    	           }
                    	
                    	//pr($product); die;
                    	
                    	$this->set('product',$product);
                    	$this->Session->write('catid',$id);
                    		
                    		
    	}
	
	function kt($email){
		$this->Guest->find('all',array('conditions'=>array('Guest.email'=>$email)));
		if($this->Guest->getNumRows()) return  1;
		else
			return 0;
	
	}
    
	function register(){
	
		$data['email']=$_POST['email'];
		
		$url=$_POST['url'];
		if($this->kt($data['email'])==0)
		{
			//echo $data['email']; die;
			$this->Guest->save($data);
			echo '<script>alert("Ðăng ký thành công" ) ;window.location="'.DOMAIN.$url.'"; </script>';
		}
		else{
			echo '<script>alert("Email này đã được đăng ký" );window.location="'.DOMAIN.$url.'"; </script>';
	
		}
	
	
	}
	
	
	
	
	
	
	
}

?>