<?php
    class ClassifiedssController extends AppController {
        
   	    var $name = 'Classifiedss';
    	var $uses=array('Classifiedss','Catproduct','City');
    	var $helpers = array('Html','Ajax','Javascript');
    	var $components = array( 'RequestHandler' );
        
        function index(){
		$this->account();	
            mysql_query("SET names utf8");
    	    $this->set('title_for_layout',  'Quản lý tin rao vặt');
    		$this->set('meta_for_layout',  'Quản lý tin rao vặt');
			$this->layout='home2';
		    $user = $this->Session->read('id');
			$this->set('classifiedss',$this->Classifiedss->find('all',array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.user_id'=>$user),'order'=>'Classifiedss.id DESC')));
        }
        function view($id = null){
		$this->account();	
            mysql_query("SET names utf8");
    		$this->set('views', $this->Classifiedss->read(null, $id));	
        }
        function search(){
            mysql_query("SET names utf8");
    	    $this->set('title_for_layout',  'Tin rao vặt');
    		$this->set('meta_for_layout',  'Tin rao vặt');
            
    		$this->paginate = array('order'=>'Classifiedss.id DESC');
    	    $this->set('classifiedss', $this->paginate('Classifiedss',array()));	
        }
		function add($id = null){ 
		        $this->account();	
		        $this->layout='home2';
        		mysql_query("SET names utf8"); 
                $x=$this->Catproduct->read(null, $id);
        		$this->set('nameproduct', $x); 

    
    		  	if(!empty($_POST['title'])){   	
						
    	            $this->Classifiedss->create();
                    $data['Classifiedss'] = $this->data['Classifiedss'];
    		 		$data['Classifiedss']['title']=$_POST['title'];
					$data['Classifiedss']['slug']=$this->unicode_convert($_POST['title']);
    				$data['Classifiedss']['cities_id']=$_POST['cities'];
    				$data['Classifiedss']['price']=$_POST['price']; 
    				$data['Classifiedss']['needs']=$_POST['needs']; 
    				$data['Classifiedss']['images']=$_POST['userfile']; 	
    				$data['Classifiedss']['content']=$_POST['content']; 	
    				$data['Classifiedss']['status']=1;
    				$data['Classifiedss']['display']=1; 
					$data['Classifiedss']['user_id']=$this->Session->read("id");
    				$data['Classifiedss']['scop_id']=$id;                
                    
                    	 
        		if ($this->Classifiedss->save($data['Classifiedss'])) {
        			echo '<script language="javascript"> alert("Đã đăng thông tin rao vặt thành công"); location.href="'.DOMAIN.'quan-ly-tin-rao-vat";</script>';
        		} else {
        			echo "<script>alert('".json_encode('Vui lòng điền đầy đủ thông tin')."');</script>";
        		}
        	} 	
		}
        function delete($id = null) {	
    		if (empty($id)) {
    			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true)); 
    		}
    		if ($this->Classifiedss->delete($id)) {
    			echo '<script language="javascript"> alert("Đã xóa thông tin sản phẩm rao vặt thành công"); location.href="'.DOMAIN.'rao-vat";</script>';
    		} 
    	}
        
        function edit($id = null) { 
				$this->account();
				$this->layout='home2';
				if (!$id && empty($this->data)) {
					$this->Session->setFlash(__('Không tồn tại ', true));
					$this->redirect(array('action' => 'index'));
				}
				if (!empty($this->data)) {
					$cat=$this->Classifiedss->read(null,$this->data['Classifiedss']['scop_id']);
					if($cat)
					$this->data['Classifiedss']['slug']=$cat['Classifiedss']['slug'].'/'.$this->unicode_convert($this->data['Classifiedss']['title']);
					else
					$this->data['Classifiedss']['slug']=$this->unicode_convert($this->data['Classifiedss']['title']);
					$data['Classifiedss'] = $this->data['Classifiedss'];
					$data['Classifiedss']['cities']=$_POST['cities'];
					$data['Classifiedss']['needs']=$_POST['needs'];
					$data['Classifiedss']['images']=$_POST['userfile'];
					if ($this->Classifiedss->save($data['Classifiedss'])) {
						$this->Session->setFlash(__('Bài viết sửa thành công', true));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
					}
				}
				if (empty($this->data)) {
					$this->data = $this->Classifiedss->read(null, $id);
				}
				$city=$this->City->find('all');
			    $this->set('city',$city);
				 $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
                $this->set(compact('list_cat'));
				$this->set('edit',$this->Classifiedss->findById($id));
			}
	function _find_list() {
		return $this->Catproduct->generatetreelist(null, null, null, '__');
	}
     function account(){
		if(!$this->Session->read("id") || !$this->Session->read("nameshop")){
			$this->redirect(DOMAIN.'/login');
		}
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
		'-'=>array(' ','&','?'),
		'-'=>array('  ','   '),
		'-'=>array(',')
		);
		
		foreach($unicode as $nonUnicode=>$uni){
		foreach($uni as $value)
		$str = str_replace($value,$nonUnicode,$str);
		}
		return $str;
		}
  }
?>