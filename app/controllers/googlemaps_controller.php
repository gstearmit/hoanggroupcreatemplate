<?php
class GooglemapsController extends AppController {
	var $name = 'Googlemaps';
	var $uses =array('News');
	function index() {
		
		$this->set("data",array('css'=>'style2'));
	}


}
?>
