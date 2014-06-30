<?php
function getCategories($id=null){
     mysql_query("SET names utf8");
		if (!$id) {
			$Session->setFlash(__('Không t?n t?i', true));
			$redirect(array('action' => 'index'));
		}
	return	$Category->find('all',array('conditions'=>array('Category.status'=>1,'parent_id'=>$id),'order'=>'Category.id asc'));
		

}

foreach($categories as $ct) {
echo $ct['Category']['id'].'....'.$ct['Category']['name'].'....'.$ct['Category']['parent_id'].'<br>';
$ct2=getCategories($ct['Category']['id']);
if(!$ct2)
print_r($ct2);
}

 ?>