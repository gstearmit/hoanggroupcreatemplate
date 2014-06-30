<?php
class ApiclientController extends AppController{
	var $name='Apiclient';
	var $uses=array();
	function index()
	{
		App::import('Vendor', 'WellNamed', array('file' => 'lib/nusoap.php'));
		// Create the client instance
		$client = new soapclient(DOMAIN.'api/?wsdl');
		// Call the SOAP method
		$result = $client->call('hello', array('name' => 'StackOverFlow'));
		// Display the result
		print_r($result);
	}
	
}