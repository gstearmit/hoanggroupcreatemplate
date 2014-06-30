<?php
    class NewsraovatController extends AppController {
        
   	    var $name = 'Newsraovat';
    	var $uses=array('Classifiedss','Catproduct');
    	var $helpers = array('Html','Ajax','Javascript');
    	var $components = array( 'RequestHandler' );
        
        function index(){
            mysql_query("SET names utf8");
    	    $this->set('title_for_layout',  'Tin rao vặt');
    		$this->set('meta_for_layout',  'Tin rao vặt');
            $this->layout='home2';
    		$this->paginate = array('order'=>'Classifiedss.id DESC');
			$this->paginate = array('conditions'=>array('Classifiedss.status'=>1),'order'=>'Classifiedss.id DESC','limit'=>30);
			$this->set('raovat', $this->paginate('Classifiedss',array()));	
			// list news raovat
			$cat=$this->Catproduct->find('list',array('conditions'=>array(),'limit'=>15,'order'=>'Catproduct.order ASC'));
		    $this->set(compact('cat'));
        }
        function view($id = null){
			$this->layout="home2";
            mysql_query("SET names utf8");
    		$this->set('views', $this->Classifiedss->read(null, $id));	
        }
		
		function listnews($id=null) {
		//list danh sach sản phẩm theo lĩnh vực
		    $this->layout="home2";
			$x=$this->Catproduct->read(null, $id);
			$this->set('title_for_layout',  $x['Catproduct']['meta_key']);
			$this->set('meta_for_layout', $x['Catproduct']['meta_des']);
			$catid=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$id ),'fields' => array('Catproduct.id')));
			$arr[]=$id;
			foreach($catid as $key){
			$arr[]=$key;
			}
			$this->paginate = array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.scop_id'=>$arr),'order'=>'Classifiedss.id DESC','limit'=>12);
			$this->set('listnews', $this->paginate('Classifiedss',array()));	
			$this->set('cat', $this->Catproduct->read(null, $id));
		}
		
		function itemfields($id=null) {
		//list danh sach sản phẩm theo lĩnh vực
		    $this->layout="home4";
			$x=$this->Catproduct->read(null, $id);
			$this->set('title_for_layout',  $x['Catproduct']['meta_key']);
			$this->set('meta_for_layout', $x['Catproduct']['meta_des']);
			$catid=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$id ),'fields' => array('Catproduct.id')));
			$arr[]=$id;
			foreach($catid as $key){
			$arr[]=$key;
			}
			$this->paginate = array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.scop_id'=>$arr),'order'=>'Classifiedss.id DESC','limit'=>12);
			$this->set('itemfields', $this->paginate('Classifiedss',array()));	
			$this->set('cat', $this->Catproduct->read(null, $id));
		}

    }
?>