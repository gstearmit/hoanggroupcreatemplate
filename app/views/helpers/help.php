<?php 
// Programing by : Nguyen Van Cong
// company : VTM Group
// Version : 1.0
class HelpHelper extends AppHelper {
	// return hot news
	
	function getHotNews($condition=array(),$x=array('url'=>'news/view','image'=>false,'introduction'=>false,'class_ul'=>NULL,'class_li'=>NULL))
	{
		$this->News=&ClassRegistry::init('News');		
		$y=$this->News->find('all',$condition);		
		if(isset($x['class_ul']))
		$data='<ul class="'.$x['class_ul'].'">';
		else
		$data='<ul>';
		foreach($y as $y){
			if(isset($x['class_li']))
			$data.='<li class="'.$x['class_li'].'">';
			else
			$data.='<li>';
			if(isset($x['image'])&&$x['image']==true)
			if(isset($x['url']))
			$data.='<a href="'.DOMAIN.$x['url'].'/'.$y['News']['id'].'"><img src="'.DOMAINAD.$y['News']['images'].'"></a>';
			else
			$data.='<a href="'.DOMAIN.'news/view/'.$y['News']['id'].'"><img src="'.DOMAINAD.$y['News']['images'].'"></a>';
			if(isset($x['url']))
			$data.='<a href="'.DOMAIN.$x['url'].'/'.$y['News']['id'].'"><span>'.$y['News']['title'].'</span></a>';	
			else
			$data.='<a href="'.DOMAIN.'news/view/'.$y['News']['id'].'"><span>'.$y['News']['title'].'</span></a>';	
			if(isset($x['introduction'])&&$x['introduction']==true)	
			$data.='<div>'.$y['News']['introduction'].'</div>';
			$data.='</li>';
		}
		$data.='</ul>';
		return $data;
	}
	// ham lay du lieu co the phan trang trong view
	function getData($y=array(),$x=array('url'=>'news/view','image'=>false,'introduction'=>false,'parentClass'=>NULL,'childClass'=>NULL,'type'=>false,'data'=>false))
	{	
		if(isset($x['type'])&&$x['type']==true)	
		{ $parent='<div ';
		   $child='<div ';
		   $endparent=$endchild='</div>';
		}
		else
		{
			$parent='<ul ';
		   $child='<li ';
		   $endparent='</ul>';
		   $endchild='</li>';
		}
		
		if(isset($x['parentClass']))// them class
		$parent.='class="'.$x['parentClass'].'">';
		else
		$parent.='>';
		$child.=(isset($x['childClass']))? 'class="'.$x['childClass'].'">' : '>'; //them class
			
		$data=$parent;
		if(isset($x['data'])&&$x['data']==true)	{
			foreach($y as $y){	
		    $data.=$child;		
			if(isset($x['image'])&&$x['image']==true)
			if(isset($x['url']))
			$data.='<a href="'.DOMAIN.$x['url'].'/'.$y['Product']['id'].'"><img src="'.DOMAINAD.$y['Product']['images'].'"></a>';
			else
			$data.='<a href="'.DOMAIN.'products/view/'.$y['Product']['id'].'"><img src="'.DOMAINAD.$y['Product']['images'].'"></a>';
			if(isset($x['url']))
			$data.='<a href="'.DOMAIN.$x['url'].'/'.$y['Product']['id'].'"><span>'.$y['Product']['title'].'</span></a>';	
			else
			$data.='<a href="'.DOMAIN.'products/view/'.$y['Product']['id'].'"><span>'.$y['Product']['title'].'</span></a>';	
			if(isset($x['introduction'])&&$x['introduction']==true)	
			$data.='<div>'.$y['Product']['introduction'].'</div>';
			$data.=$endchild;
		    }
		} else{
		foreach($y as $y){	
		    $data.=$child;		
			if(isset($x['image'])&&$x['image']==true)
			if(isset($x['url']))
			$data.='<a href="'.DOMAIN.$x['url'].'/'.$y['News']['id'].'"><img src="'.DOMAINAD.$y['News']['images'].'"></a>';
			else
			$data.='<a href="'.DOMAIN.'news/view/'.$y['News']['id'].'"><img src="'.DOMAINAD.$y['News']['images'].'"></a>';
			if(isset($x['url']))
			$data.='<a href="'.DOMAIN.$x['url'].'/'.$y['News']['id'].'"><span>'.$y['News']['title'].'</span></a>';	
			else
			$data.='<a href="'.DOMAIN.'news/view/'.$y['News']['id'].'"><span>'.$y['News']['title'].'</span></a>';	
			if(isset($x['introduction'])&&$x['introduction']==true)	
			$data.='<div>'.$y['News']['introduction'].'</div>';
			$data.=$endchild;
		    }		
		}
		$data.=$endparent;
		return $data;
	}
	
	//return linkweb
	function getLink()
	{
		$this->Weblink=&ClassRegistry::init('Weblink'); 
		$x=$this->Weblink->find('all');
		$data='<select onChange="window.open(this.options[this.selectedIndex].value,'."'_blank'".');this.options[0].selected=true;"><option>---Chọn liên kết---</option>';
		foreach($x as $x){
			$data.='<option value="'.$x['Weblink']['linkweb'].'">'.$x['Weblink']['name'].'</option>';
		}
		$data.='</select>';
		return $data;
	}
	//re
	function getAdv(){		
		$this->Advertisement=&ClassRegistry::init('Advertisement'); 
		$x=$this->Advertisement->find('all');
		$data='<div class="adv">';
		foreach($x as $x) {
				$data.='<a href="'.DOMAIN.$x['Advertisement']['link'].'"><img src="'.DOMAINAD.$x['Advertisement']['images'].'"></a>';
		}	
		$data.='</div>';
		return $data;
	}
	//return menu base
	function getMenuNews($id=NULL,$url='news/list_news')
	{
		$this->Category=&ClassRegistry::init('Category');
		$b=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$id)));
		$menu ='<ul>';		
		foreach($b as $b){	
			$menu .='<li><a href="'.DOMAIN.$url.'/'.$b['Category']['id'].'">'.$b['Category']['name'].'</a></li>';		
		}
		$menu .='</ul>';
		return $menu;
	}
	//return menu multi level
	function getMultiMenu($id=NULL,$url='news/list_news',$data=false)
	{
		if($data==false){
			$this->Category=&ClassRegistry::init('Category');
			$b=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$id)));
			$menu ='<ul>';
			foreach($b as $b){	
			 if($this->Category->find('count',array('conditions'=>array('Category.parent_id'=>$b['Category']['id'])))==0)		
				$menu .='<li><a href="'.DOMAIN.$url.'/'.$b['Category']['id'].'">'.$b['Category']['name'].'</a></li>';
				else
				{
					$menu .='<li><a href="'.DOMAIN.'parent'.$url.'/'.$b['Category']['id'].'">'.$b['Category']['name'].'</a>'.$this->getMultiMenu($b['Category']['id']).'</li>';
				}
			}
			$menu .='</ul>';
		} else {
			$this->Catproduct=&ClassRegistry::init('Catproduct');
			$b=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.parent_id'=>$id)));		
			$menu ='<ul class="menuleft">';
			foreach($b as $b){	
			 if($this->Catproduct->find('count',array('conditions'=>array('Catproduct.parent_id'=>$b['Catproduct']['id'])))==0)		
				$menu .='<li><a href="'.DOMAIN.$url.'/'.$b['Catproduct']['id'].'">'.$b['Catproduct']['name'].'</a></li>';
				else
				{
					$menu .='<li><a href="'.DOMAIN.'parent-'.$url.'/'.$b['Catproduct']['id'].'">'.$b['Catproduct']['name'].'</a>'.$this->getMultiMenu($b['Catproduct']['id'],$url,true).'</li>';
				}
			}
		    $menu .='</ul>';
		}
		return $menu;
	}
	//menu san pham------------------------------------------
	//return menu base
	function getMenuProduct($id=NULL,$url='products/list')
	{
		$this->Catproduct=&ClassRegistry::init('Catproduct');
		$b=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.parent_id'=>$id)));
		$menu ='<ul>';		
		foreach($b as $b){	
			$menu .='<li><a href="'.DOMAIN.$url.'/'.$b['Catproduct']['id'].'">'.$b['Catproduct']['name'].'</a></li>';		
		}
		$menu .='</ul>';
		return $menu;
	}
	
	// return shoping cart
	function getShopingCart()
	{
		$x=(array)$_SESSION['shoppingcart'];
		$data='<table>';
		$data.='<tr><th>Ma san pham</th><th>Ten san pham</th><th>So luong</th><th>Sua</th><th>Xoa</th></tr>';
		foreach($x as $x){
			$data.='<tr>';
			$data.='<td>'.$x['masp'].'</td>';
			$data.='<td>'.$x['name'].'</td>';
			$data.='<td>'.$x['sl'].'</td>';
			$data.='<td><a href ="'.DOMAIN.'editshoppingcart/?masp='.$x['masp'].'">Sua</a></td>';
			$data.='<td><a href="'.DOMAIN.'removeshoppingcart/?masp'.$x['masp'].'">Xoa</a></td>';
			$data.='</tr>';
		}
		$data.='</table>';
		return $data;
	}
		
		function getGallery(){
			$this->Gallery=&ClassRegistry::init('Gallery');
		    $b=$this->Gallery->find('all');				
			return $b;
		}
		function getInfo($x=array(),$data=false){
			if($data==true){
				$this->Product=&ClassRegistry::init('Product');
		       return $this->Product->find('all',$x);
			}
			else
			{
				$this->News=&ClassRegistry::init('News');
		       return $this->News->find('all',$x);
			}
		}
		//return hotline
		function getHotline(){
			
				$this->Help=&ClassRegistry::init('Help');
		      return $this->Help->find('all');
		}
		function getConfig(){
			
				$this->Setting=&ClassRegistry::init('Setting');
		      return $this->Setting->read(null,1);
		}
		function getComment($id=null){
			$this->Comment=&ClassRegistry::init('Comment');
		      return $this->Comment->find('all',array('conditions'=>array('Comment.id_news'=>$id)));
		}





		function catchu($value, $length)
		{
			if($value!=''){
				if(is_array($value)) list($string, $match_to) = $value;
				else { $string = $value; $match_to = $value{0};
				}
		
				$match_start = stristr($string, $match_to);
				$match_compute = strlen($string) - strlen($match_start);
		
				if (strlen($string) > $length)
				{
					if ($match_compute < ($length - strlen($match_to)))
					{
						$pre_string = substr($string, 0, $length);
						$pos_end = strrpos($pre_string, " ");
						if($pos_end === false) $string = $pre_string."...";
						else $string = substr($pre_string, 0, $pos_end)."...";
					}
					else if ($match_compute > (strlen($string) - ($length - strlen($match_to))))
					{
						$pre_string = substr($string, (strlen($string) - ($length - strlen($match_to))));
						$pos_start = strpos($pre_string, " ");
						$string = "...".substr($pre_string, $pos_start);
						if($pos_start === false) $string = "...".$pre_string;
						else $string = "...".substr($pre_string, $pos_start);
					}
					else
					{
						$pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
						$pos_start = strpos($pre_string, " "); $pos_end = strrpos($pre_string, " ");
						$string = "...".substr($pre_string, $pos_start, $pos_end)."...";
						if($pos_start === false && $pos_end === false) $string = "...".$pre_string."...";
						else $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
					}
		
					$match_start = stristr($string, $match_to);
					$match_compute = strlen($string) - strlen($match_start);
				}
		
				return $string;
			}else{
				return $string ='';
			}
		}
		





}