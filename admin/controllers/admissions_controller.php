<?php
class AdmissionsController extends AppController {

	var $name = 'Admissions';
	var $uses=array('News');
	function index() {
		mysql_query("SET names utf8");
		$this->set('news',$this->News->find('all',array('conditions'=>array('News.status'=>1,'News.category_id'=>87),'order'=>'News.id DESC','limit'=>5)));
	}
	function view($id=null) {
		mysql_query("SET names utf8");
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->News->read(null, $id));
	}
}
?>
