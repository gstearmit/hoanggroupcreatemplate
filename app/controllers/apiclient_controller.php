<?php
class ApiclientController extends AppController{
	var $name='Apiclient';
	var $uses=array();
	function index()
	{
		App::import('Vendor', 'WellNamed', array('file' => 'lib'.DS.'nusoap.php'));
		// Create the client instance
		$client = new nusoap_client('http://develop.vtmgroup.com.vn/tienthoi/api?wsdl');
		// Call the SOAP method
		$result = $client->call('hello', array('params' => array('name' => 'Andrew' ) ) );
		// Display the result
		print_r($result);
		die();
	}
	
}