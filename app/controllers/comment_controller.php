<?php
class CommentController extends AppController {

	var $name = 'Comment';
	var $uses=array('Category','Categoryshop','News','Setting','Slideshow','Partner','Catproduct','Product','Helps','Gallery','Video','City','Classifiedss','Userscm');




	// phô biens ham khong phai viet lại nhiwu lan 
	// moi lamn truy van 
	// 1 ham la 1 lan truy van 


	
	
	function tintucnoibat(){
		mysql_query("SET names utf8");
		return $this->News->find('all',array('conditions'=>array('News.status'=>1,'News.category_id'=>201),'order'=>'News.id DESC','limit'=>5));
	}
	function showroom(){
		return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>4));
	}
	//tin tuc
	function advleft(){
		return $this->Gallery->find('all',array('order'=>'Gallery.id DESC'));
	}
	function advright(){
		return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1,'Gallery.display'=>2),'order'=>'Gallery.id DESC','limit'=>1));
	}



	// lay tat ca cac id catologue
	function catproduct()
	{
		mysql_query("SET names utf8");
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1,'Catproduct.parent_id'=>null),'order'=>'Catproduct.char ASC'));
	}







	
	function submenuproduct($id=null){
		return $this->Catproduct-> find('all',array('conditions'=>array('Catproduct.parent_id '=>$id),'order'=>'Catproduct.char ASC'));
	}
	
	
	function phongmau(){
		mysql_query("SET names utf8");
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1,'Catproduct.parent_id'=>'8'),'order'=>'Catproduct.char DESC'));
	}
function binhchon(){
		mysql_query("SET names utf8");
			return $this->Poll->find('all',array('conditions'=>array('Poll.status'=>1),'order'=>'Poll.id DESC'));	
		//return $this->Categorypro->find('all');
	}
	
	function banner(){
		return $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>'Banner.id DESC'));
	}
	
	function setting(){
		return $this->Setting->find('all',array('conditions'=>array(),'order'=>'Setting.id DESC'));
	}
	function adv(){
		//return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Banner->find('all',array('conditions'=>array('Banner.status'=>1),'order'=>'Banner.id DESC','limit'=>2));
	}
	
	function linkwebsite(){
		//return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Advertisement->find('all',array('conditions'=>array('Advertisement.status'=>1),'order'=>'Advertisement.id DESC'));
	}
	
	function doitac(){
		//return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Partner->find('all',array('conditions'=>array('Partner.status'=>1),'order'=>'Partner.id DESC'));
	}
	
	//cong trinh
	function vanbanphapluat(){
		mysql_query("SET names utf8");
		return $this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'196'),'order'=>'Category.tt DESC'));
	}
	
	
	function menu_active(){
		return $this->Category2->find('all',array('conditions'=>array('Category2.parent_id'=>145),'order'=>'Category2.id ASC'));
	}
	function helpsonline(){
	
	return $this->Helps->find('all',array('conditions'=>array('Helps.status'=>1),'order'=>'Helps.id DESC','limit'=>1));
	}
	function id_product($catproduct_id){
	return $this->Product->read(null,$catproduct_id);
	//pr($this->Product->read(null,$id));die;
	}
	function manshoes(){
		mysql_query("SET names utf8");
			return $this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'143'),'order'=>'Category.id ASC'));	
		//	pr($this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'143'),'order'=>'Category.id ASC')));die;
	}
	function mensandals (){
		mysql_query("SET names utf8");
			return $this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'142'),'order'=>'Category.id ASC'));	
	}
	function getinfo($cat=null){
	return $this->News->find('all',array('conditions'=>array('News.status'=>1,'News.category_id'=>$cat),'order'=>'News.id DESC','limit'=>3));	
	}
	function news_codong($cat=null){
	return $this->News->find('all',array('conditions'=>array('News.status'=>1,'News.category_id'=>$cat),'order'=>'News.id DESC','limit'=>10));	
	}
	
	function videos(){
		mysql_query("SET names utf8");
		return $this->Video->find('all',array('conditions'=>array('Video.status'=>1),'order'=>'Video.id DESC','limit'=>1));
	}
	
	function slideshow(){
		mysql_query("SET names utf8");
		return $this->Slideshow->find('all',array('conditions'=>array('Slideshow.status'=>1),'order'=>'Slideshow.id DESC'));
	}
	
	function about(){
		return $this->About->find('all',array('conditions'=>array('About.status'=>'1'),'order' => 'About.char ASC'));
		
		
	}
	
	
	
	function tintuc($id=null){
		mysql_query("SET names utf8");
		return $this->News->find('all',array('conditions'=>array('News.category_id'=>$id,'News.status'=>1),'order'=>'News.char ASC','limit'=>6));
		
		
	}
	
	function category(){
		mysql_query("SET names utf8");
		return $this->Category->find('all',array('order'=>'Category.tt ASC'));
		
	}
	
	function product($catproduct_id=null){
		
		mysql_query("SET names utf8");
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>$catproduct_id,'Product.status'=>1),'limit' => 2,'order' => 'Product.created DESC');
		return $this->paginate('Product',array());
	}
	
	
	
	function get_name_catproduct($id){
		
		return  $this->Catproduct->find('all',array('conditions'=>array('Catproduct.id'=>$id, 'Catproduct.status'=>1)));
		
	}
	
	
	function gallery($id){
	
		return  $this->Gallery->find('all',array('conditions'=>array('Gallery.product_id'=>$id, 'Gallery.status'=>1)));
	
	}
	
	function city()
	{
		return  $this->City->find('all',array('conditions'=>array('City.status'=>1),'order'=>'City.char ASC'));
		
		
	}
	
	function city2($id=2)
	{
		return  $this->City->find('all',array('conditions'=>array('City.status'=>1,'City.id'=>$id)));
	
	}
	
	function kt_moi($catproduct_id=null)
	{
		
		$id=$this->Session->read('city');
		if($id==null) $id=2;
		$this->Session->write('city',$id);
		$n=$this->Product->find('all',array('conditions'=>array('Product.status'=>1,'Product.catproduct_id'=>$catproduct_id,'Product.city_id'=>$id),'limit'=>1,'order'=>'Product.created DESC'));
		
		foreach($n as $row){
			
			$date=$row['Product']['created'];
	
		$ngay1 =  explode(' ',$date);
		
		$ngay=explode('-',$ngay1['0']);
		
		
		$lastdate=mktime(0,0,0,$ngay['1'],$ngay['2'],$ngay['0']);
		$now=mktime();
		$d=$now-$lastdate;
		$days=floor($d/86400);
		if($days<10){
			return 1;
		}
		
		
			}
			return 0;
		
	}
	
	function get_soluong($id=null)
	{
		
		
		
			$mang[0]=$id;
	$catid=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$id ),'fields' => array('Catproduct.id')));
	
	
$i=1;
//pr($catid); die;
	foreach($catid as $row=>$value){ 
		$mang[$i++]=$value;
		$cat=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$value ),'fields' => array('Catproduct.id')));
	
		foreach($cat as $cat=>$value){ 
		$mang[$i++]=$value; }
	
		}
			$a= $this->Product->find('all',array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1,'Product.catproduct_id'=>$mang)));
		
		$i=0;
		foreach($a as $a){
		
		$date2 = $a['Product']['date_ketthuc'];
		
					$dayend = strtotime($date2);
					$date1 = date("Y-m-d");
					
					$datenow = strtotime($date1);
                    $days = abs($dayend) - abs($datenow);
					
					$n=floor($days/(60*60*24));
					
			if($n>0){ $i++;}
		}
		return $i; 
	}
	
	
	function get_soluong1()
	{
		return  $this->Product->find('count',array('conditions'=>array('Product.chophep'=>1,'Product.status'=>1)));
	}
	
	function get_product($id=null) {
		return $this->Product->findById($id);
		} 
        
   function sanphambanchay($id=null){
        
        	$a=$this->Product->find('all',array('conditions'=>array('Product.id <>'=>$id,'Product.status'=>1,'Product.chophep'=>1),'order'=>'Product.daban DESC'));
			$i=0;$spnb=array();
			foreach($a as $b){
	 			  $date2 = $b['Product']['date_ketthuc'];
  				  $dayend = strtotime($date2);
				  //so sanh ngay thang
				  $date1 = date("Y-m-d");
				  $datenow = strtotime($date1);
									  
				if($dayend > $datenow){ $i++;
					$spnb[$i]=$b;
					if($i==2)
					break;
					}
			}
        
    	return $spnb;
        //$this->Product->find('all',array('conditions'=>array('Product.id <>'=>$id,'Product.status'=>1,'Product.chophep'=>1,'Product.newsproduct'=>1),'limit'=>2,'order'=>'Product.id DESC'));

   }
   
   
   function sanphammoi($id=null){
  
    $a=$this->Product->find('all',array('conditions'=>array('Product.id <>'=>$id,'Product.status'=>1,'Product.chophep'=>1,'Product.newsproduct'=>1),'order'=>'Product.id DESC'));
    	
			$i=0;$spnb=array();
			foreach($a as $b){
	 			  $date2 = $b['Product']['date_ketthuc'];
  				  $dayend = strtotime($date2);
				  //so sanh ngay thang
				  $date1 = date("Y-m-d");
				  $datenow = strtotime($date1);
									  
				if($dayend > $datenow){ $i++;
					$spnb[$i]=$b;
					if($i==2)
					break;
					}
			}
        
    	return $spnb;

   }     
   
   function get_user($id=null)
   {
	return $this->Userscm->findByEmail($id);
   }
   
	
}

?>
