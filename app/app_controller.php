<?php

class AppController extends Controller {
 public $helpers = array(
	'Html',
	'Form',
	'Session',
	'Text',
	'Js',
	'Time',	
	'Javascript',
	'Help'
    );
   function beforeFilter() {
	   //mysql_query("SET names utf8");
   		$s_id = session_id();
       $this->layout='home';
		if(isset($_GET['lang'])) {
			if($_GET['lang']=="eng") {
			$this->Session->write('lang',2);	
			} else {
			$this->Session->write('lang',1);	
			} 	
		}
		else {
			if($this->Session->read('lang')) {
				$this->Session->write('lang',$this->Session->read('lang'));
			}
			else {
				$this->Session->write('lang',1);
			}
		}
    }

  
}

?>