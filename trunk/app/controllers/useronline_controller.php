<?php
class UseronlineController extends AppController{
	var $name="Useronline";
	var $uses="Useronline";
	function so_nguoi_online(){
		
	/* 	$visi=0;
		$handle=opendir(session_save_path());
		//echo "<hre>"; print_r($handle);die();
		while($file=readdir($handle)!=false)
		{
			if($file!= "." && $file!=".."){
				if(ereg("^sess", $file)) $visi++;
			}
		}
		
		echo "user online :$visi";
	 */
		$s_id = session_id();
		$tg=time();
		$tgout=3;
		$tgnew=$tg - $tgout;
	
		//$sql="insert into useronline(tgtmp,ip,local) values('$tg','$_SERVER[REMOTE_ADDR]','$_SERVER[PHP_SELF]')";
		
		$this->Useronline->save(array('tgtmp'=>$tg,'ip'=>$_SERVER['REMOTE_ADDR'],'local'=>$_SERVER['PHP_SELF']));
		
		$sql="delete from useronlines where tgtmp < $tgnew" ;
		$this->Useronline->query($sql);
		
		//$this->Useronline->delete(array('conditions'=>array("tgtmp< $tgnew")));
		
		$sql="SELECT DISTINCT ip FROM useronlines WHERE local='$_SERVER[PHP_SELF]'";
		$this->Useronline->query($sql);
		//$this->Useronline->find('all');
		return $this->Useronline->getNumRows();
		
		
	}
	
	
}