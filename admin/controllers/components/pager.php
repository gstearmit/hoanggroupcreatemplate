<?php
class PagerComponent extends Object 
{     
    /** 
     * The (calling) controller object. 
     * 
     * @access public 
     * @var object 
     */ 
     var $Controller; 

     /** 
      * The pager object. 
      * 
      * @access public 
      * @var object 
      */ 
     var $Pager; 
      
     /** 
      * Configuration parameters 
      * 
      * @access public 
      * @var array 
      */ 
     var $params = false; 

    /** 
     * Component pseudo controller 
     * 
     * @access public 
     * @param object $controller Calling controller object 
     * @return void 
     */ 
	 
	 var $category;
	 var $multipara;
	 var $xfileName;
	 var $lstpara;
	 
    function startup(&$controller) { 
        $this->Controller =& $controller; 
    } 
     
    /** 
     * Initializes the pager. Must be called before using the component. 
     * 
     * Takes user configuration and creates pager object ($this->Pager) 
     * 
     * @access public 
     * @param array $config Configuration options for Pager::factory() method 
     * @see http://pear.php.net/manual/en/package.html.pager.factory.php 
     * @return void 
     */ 
    function init($config) 
    {         
        // Get the correct URL, even with admin routes 
	
        $here = array();         
        if (defined('CAKE_ADMIN') && !empty($this->Controller->params[CAKE_ADMIN])) { 
            $here[0] = $this->Controller->params[CAKE_ADMIN]; 
            $here[2] = substr($this->Controller->params['action'], strlen($this->Controller->params[CAKE_ADMIN]) + 1); 
        } else { 
            $here[2] = $this->Controller->params['action']; 
        } 
        $here[1] = Inflector::underscore($this->Controller->params['controller']); 
        ksort($here); 
        $url = implode('/', $here); 
		
		if($this->category == true)
		{
			$ct = $this->Controller->params['pass']['0'];
		
		
				if($this->multipara == true){
        
            for($x = 2;$x< count($this->Controller->params) -2;$x++)
            {
                 
                $this->lstpara = $this->lstpara . "/" . $this->Controller->params['pass'][$x];
            }
        }
       
		}
		
	  
		if($this->category == true)
		{
        if($this->multipara == true){
            $xfileName = $this->Controller->base ."/"  .  $url . "/" . $ct . "/" .'%d'.$this->lstpara;
        }else
        {
            $xfileName = $this->Controller->base . "/".  $url . "/" . $ct . "/" .'%d';
        }
    }else
    {
        $xfileName = $this->Controller->base . "/" . $url . "/" . '%d';
    }
                 
        // Set up the default configuration vars 

			$this->params = array( 
				'mode' => 'Sliding', 
				'perPage' => 2, 
				'delta' => 1, 
				'totalItems' => '', 
				'httpMethod' => 'GET', 
				'currentPage' => 1, 
				'linkClass' => 'pager', 
				'altFirst' => 'First page', 
				'altPrev '=> 'Previous page', 
				'altNext' => 'Next page', 
				'altLast' => 'Last page', 
				'separator' => '', 
				'spacesBeforeSeparator' => 1, 
				'spacesAfterSeparator' => 1, 
				'useSessions' => false, 
				'firstPagePre'     => '', 
				'firstPagePost' => '', 
				'firstPageText' => '|<', //<img border="0" src="http://localhost/SunShineTravel/images/icon_pagination/preall.png" />
				'lastPagePre' => '', 
				'lastPagePost' => '', 
				'lastPageText' => '>|', //<img border="0" src="http://localhost/SunShineTravel/images/icon_pagination/nextall.png" />
				'prevImg' => '< &nbsp;', //<img border="0" src="http://localhost/SunShineTravel/images/icon_pagination/pre.png" />
				'nextImg' => '&nbsp; >', //<img border="0" src="http://localhost/SunShineTravel/images/icon_pagination/next.png" />
				'altPage' => 'Page', 
				'clearIfVoid' => true, 
				'append' => false, 
				'path' => '', 
				'fileName' => $xfileName, 
				'urlVar' => '', 
			); 
			
			
        vendor('Pear/Pager/Pager'); 
         
        // Merge with user config 
        $this->params = array_merge($this->params, $config);         
  		
        // sanitize requested page number 
        if (!in_array($this->params['currentPage'], range(1, ceil($this->params['totalItems'] / $this->params['perPage'])))) { 
            $this->params['currentPage'] = 1; 
        } 
        $this->Pager =& Pager::factory($this->params); 
         
        // Set the template vars 
        $this->Controller->set('pageLinks',   $this->Pager->getLinks()); 
        $this->Controller->set('currentPage', $this->params['currentPage']); 
        $this->Controller->set('isFirstPage', $this->Pager->isFirstPage()); 
        $this->Controller->set('isLastPage',  $this->Pager->isLastPage()); 

		if($this->params['totalItems']%$this->params['perPage'] > 0){
			$total= (($this->params['totalItems'] - ($this->params['totalItems']%$this->params['perPage']) ) / $this->params['perPage'] ) + 1;
		}else{
			$total= $this->params['totalItems']/$this->params['perPage'];
		}
		
		$this->Controller->set('totalItem',$total);
    }
}
?>