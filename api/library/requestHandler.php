<?php
include_once('library/request.php');

class requestHandler extends request {

	function __construct($request) {
		header("Access-Control-Allow-Orgin: *");
		header("Access-Control-Allow-Methods: *");
		header("Content-Type: application/json");

		$this->args = explode('/', rtrim($request, '/'));
		$this->endpoint = array_shift($this->args);
		
		if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
			$this->verb = array_shift($this->args);
		}

		$this->method = $_SERVER['REQUEST_METHOD'];

	}
	
	public function processRequest(&$controller_name) {
		$handlers = array(
			'user'	  => 'userController',
			'article' => 'articleController',
		);
		$testHandlers = array_change_key_case($handlers, CASE_UPPER);
		$testEndPoint = strtoupper($this->endpoint);
			
		if (isset($testHandlers[$testEndPoint]) || array_key_exists($testEndPoint,$testHandlers)) {
			$controller_name = $testHandlers[$testEndPoint];
			return true;
		} else {
			$controller_name = $this->response("No Endpoint: $this->endpoint", 404);
		       	return false;
		}
	}
		
	public function processResponse($data,$code = 200) {
		$response['code'	] = $code;
		$response['status'	] = $this->requestStatus($response['code']);
		$response['data'	] = $data;
		return $response;
	}
	
	// PUBLIC GETTERS
	/**
	* Property: method
	* The HTTP method this request was made in, either GET, POST, PUT or DELETE
	*/
	public function getMethod() {
		return $this->method;
	}
	/**
	* Property: endpoint
	* The Model requested in the URI. eg: /files
	*/
	public function getEndpoint() {
		return $this->endpoint;
	}
	/**
	* Property: verb
	* An optional additional descriptor about the endpoint, used for things that can
	* not be handled by the basic methods. eg: /files/process
	*/
	public function getVerb() {
		return $this->verb;
	}
	/**
	* Property: args
	* Any additional URI components after the endpoint and verb have been removed, in our
	* case, an integer ID for the resource. eg: /<endpoint>/<verb>/<arg0>/<arg1>
	* or /<endpoint>/<arg0>
	*/
	public function getArgs() {
		return $this->args;
	}
	/**
	* Property: file
	* Stores the input of the PUT request
	*/
	public function getFile() {
		return $this->file;
	}	
}