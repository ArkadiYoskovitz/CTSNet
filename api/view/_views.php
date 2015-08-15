<?php

	class ApiView {
	}
	class JsonView extends ApiView {
		public function render($api_response) {
			// Set HTTP Response Content Type
        		header('Content-Type: application/json; charset=utf-8');
        		
		        // Format data into a JSON response
		        $json_response = json_encode($api_response);
		        
		        // Deliver formatted data
		        echo $json_response;
	            	return true;
		}
	}

	class HtmlView extends ApiView {
		public function render($content) {
			// Set HTTP Response Content Type
	        	header('Content-Type: text/html');
			header('location:http://www.appCTSNet.info/#pageMailConfirm');
	        	// Format data into a HTML response
			// Deliver formatted data
	            	//echo "<pre>";
	            	//print_r($content);
	            	//echo "</pre>";
	            	return true;
	        }
	}
	
	class XmlView extends ApiView {
		public function render($content) {
			// Set HTTP Response Content Type
	        	header('Content-Type: text/xml');
	            	
	            	// Format data into a XML response
	        	$simplexml = simplexml_load_string('<?xml version="1.0" ?><data />');
	            	foreach($content as $key => $value) {
	                	$simplexml->addChild($key, $value);
	            	}
	            	
			// Deliver formatted data
	            	echo $simplexml->asXML();
	            	return true;
	        }
	}