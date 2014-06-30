
<?php
class RecruitmentController extends AppController{
	var $name='Recruitment';
	var $uses=array('Recruitment');

	function index(){

		
		$this->paginate = array('limit' => 6,'order' => 'Recruitment.id DESC');
		$this->set('Recruitment',$this->paginate('Recruitment',array()));

	}


	function ctrecruitment($id){
	

		$this->set('Recruitment',$this->Recruitment->find('all',array('conditions'=>array('Recruitment.id'=>$id))));
	}
	
	function recruitment2($id=null){
	
		return $this->Recruitment->find('all', array('conditions'=>array('Recruitment.id' <> $id),'limit'=>'10', 'order'=>'Recruitment.created DESC'));
	
	}
}