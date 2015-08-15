<?php

/**
 * Stage 00 - Prepare includes
 * ======================================================
 */
 (include_once('library/requestHandler.php')		) or die('Cound include library/requestHandler');
//(include_once('model/models.php')			) or die('Cound include model/models');
 (include_once('view/_views.php')			) or die('Cound include view/_views');
 (include_once('controller/_controllers.php')		) or die('Cound include controller/_controllers');

/**
 * Stage 01 - Prepare request
 * ======================================================
 * Prepare request and call controller as needed
 * If no controller found respond with appropriate code
 */
 $serverRequest = new requestHandler($_SERVER['QUERY_STRING']);

/**
 * Stage 02 - Prepare View 
 * ======================================================
 * Prepare a view object to handle responses,
 * currntly we support JSON view only
 */
 if( ($serverRequest -> getVerb() === 'confirm') && ($serverRequest -> getMethod() == 'GET') ) {
 	$view = new HtmlView();
 } else{
	$view = new JsonView();
 }
/**
 * Stage 03 - Prepare Response object data
 * ======================================================
 * Prepare a response object data
 */
 $code = 404;
 $data = null;
 $controller_name;
/**
 * Stage 04 - Prepare Controller object 
 * ======================================================
 * Prepare a controller object to handle responses,
 */
 if (!($serverRequest->processRequest($controller_name))) {
	$data = $controller_name;
	$code = 404;
 } else {	
	$controller = new $controller_name();
	$controller->invokeAction($serverRequest,$data,$code);
 };

/**
 * Stage 05 - Prepare Response object
 * ======================================================
 * Prepare a response object
 */
 $response = $serverRequest->processResponse($data,$code);

/**
 * Stage 06 - output appropriately
 * ======================================================
 * Handle output appropriately
 */
 $view->render($response);