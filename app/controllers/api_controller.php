<?php
class ApiController extends AppController{
	var $name='Api';
	var $uses=array();
	function index()
	{
	$this->autoRender = false;
		App::import('Vendor', 'WellNamed', array('file' => 'lib/nusoap.php'));
		$URL       = DOMAIN."api";
		$server = new soap_server();

		//define( 'NS', 'http://develop.vtmgroup.com.vn/tienthoi/api?wsdl');
		$server->configureWSDL('hellowsdl', 'urn:hellowsdl');
// Register the method to expose
$server->register('hello',                // method name
    array('name' => 'xsd:string'),        // input parameters
    array('return' => 'xsd:string'),      // output parameters
    'urn:hellowsdl',                      // namespace
    'urn:hellowsdl#hello',                // soapaction
    'rpc',                                // style
    'encoded',                            // use
    'Says hello to the caller'            // documentation
);
// Define the method as a PHP function

// Khoi tao Webservice
$HTTP_RAW_POST_DATA = (isset($HTTP_RAW_POST_DATA)) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

}
function hello($name) {
        return 'Hello, ' . $name;
}		
}