<?php
(include_once('library/requestHandler.php')	) or die('Cound include library/requestHandler'	 );
//(include_once('model/user.php')		) or die('Cound include model/user.php'		 );
//(include_once('model/models.php')		) or die('Cound include model/models.php'	 );
(include_once('controller/_baseController.php'	)) or die('Cound include controller/baseController.php');

class userController extends baseController {

	public function invokeAction($request,&$data,&$code) {

		switch(true) {

			/* USER - POST - Register user
			 * ======================================================================================================= *
			 */
			case ($request -> getVerb() === 'register') && ($request -> getMethod() == 'POST'):
				$inputJSON = file_get_contents('php://input');
				$input = json_decode( $inputJSON, TRUE );
				if (isset($input['signupNameFirst']) && isset($input['signupNameLast']) && 
				    isset($input['signupEmail'    ]) && isset($input['signupPassword']) && isset($input['signupPasswordConfirm'])) 
				{
					if($input['signupPassword'] == $input['signupPasswordConfirm']) {
						$users = $this -> selectUserByEmail($input['signupEmail']);
						if(count($users) != 0){
							$code = 409;
						} else {
							$code = 201;
							$data =	$this -> insertUser($input['signupNameFirst']	,$input['signupNameLast'],
										    $input['signupEmail']	,$input['signupPassword'],2);
							$data = $this -> sendValidationUser($input['signupEmail']);
							$data = $this -> selectUserByEmailAndPassword($input['signupEmail'],$input['signupPassword']);
						}
					} else {
						$code = 206;
					}
				} else {
					$code = 206;
				}
				break;
			
			/* USER - POST - Confirm user registeration
			 * ======================================================================================================= *
			 */
			case ($request -> getVerb() === 'confirm') && ($request -> getMethod() == 'POST'):
				$inputJSON = file_get_contents('php://input');
				$input = json_decode( $inputJSON, TRUE );
				if (isset($input['confirmEmail'])) {
					$users = $this -> selectUserByEmail($input['confirmEmail']);
					$user = $users[0];
					if($user) {
						$code = 200;
						$data = $this -> updateUser($user['id'],$user['userNameFirst'],$user['userNameLast'],
									    $user['userPassword'],$input['confirmEmail'],3);
						$data = $this -> selectUserByEmailAndPassword($user['userEmail'],$user['userPassword']);
					} else {
						$code = 404;
					}
				} else {
					$code = 409;
				}
				break;
			
			/* USER - GET - Confirm user registeration
			 * ======================================================================================================= *
			 */
			case ($request -> getVerb() === 'confirm') && ($request -> getMethod() == 'GET'):
				$queryString = trim($request->getArgs()[0],"edata&");
				$queryString = str_replace('%40','@',$queryString);
				$input = $this->queryToArray($queryString);
				if (isset($input['mail_address'])) {
					$users = $this -> selectUserByEmail($input['mail_address']);
					$user = $users[0];
					if($user) {
						$code = 200;
						$data = $this -> updateUser($user['id'],$user['userNameFirst'],$user['userNameLast'],
									    $user['userPassword'],$input['mail_address'],3);
						$data = $this -> selectUserByEmailAndPassword($user['userEmail'],$user['userPassword']);
					} else {
						$code = 404;
					}
				} else {
					$code = 409;
				}
				break;
						
			/* USER - POST - Login user
			 * ======================================================================================================= *
			 */
			case ($request -> getVerb() === 'login') && ($request -> getMethod() == 'POST'):
				$inputJSON = file_get_contents('php://input');
				$input = json_decode( $inputJSON, TRUE );
				$users = $this -> selectUserByEmailAndPassword($input['signinEmail'],$input['signinPassword']);
				$user = $users[0];
				if($user) {
					if($user['userStatus'] == 3) {
						$code = 200;
						$data = $user;
					} else {
						$code = 401;
					}
				} else {
					$code = 404;
				}
				break;
				
			/* USER - POST - Delete user
			 * ======================================================================================================= *
			 */
			case ($request -> getVerb() === 'deleteUser') && ($request -> getMethod() == 'POST'):
				$inputJSON = file_get_contents('php://input');
				$input = json_decode( $inputJSON, TRUE );
				if (isset($input['deleteID'])) {
					$user = $this -> selectUserByID($input['deleteID']);
					if($user) {
						$this -> deletUser($input['deleteID']);
						$user = $this -> selectUserByID($input['deleteID']);						
						if($user) {
							$code = 500;
							$data = $user;
						} else {
							$code = 200;
							$data = $user;
						}
					} else {
						$code = 404;
						$data = $user;
					}
				} else {
					$code = 409;
				}
				break;	
			
			/* USER - GET - All users info
			 * ======================================================================================================= * 
			 */
			case ($request -> getVerb() === 'usersInfo') && ($request -> getMethod() == 'GET'):
				$inputJSON = file_get_contents('php://input');
				$input = json_decode( $inputJSON, TRUE );
				$code = 200;
				$data = $this -> allUsers();
				break;
				
			/* USER - GET - Get user info by ID
			 * ======================================================================================================= * 
			 */
			case ($request->getMethod() == 'GET') && ($request->getVerb() == null) && (intval($request->getArgs()[0])):
				$inputJSON = file_get_contents('php://input');
				$input= json_decode( $inputJSON, TRUE );
				$users = $this -> selectUserByID(intval($request->getArgs()[0]));
				if(count($users) != 0){
					$code = 200;
					$data = $users;//$this -> selectUserByID(intval($request->getArgs()[0]));
				} else {
					$code = 404;
				}
				break;
				
			/* USER - POST - Update user info by ID
			 * ======================================================================================================= * 
			 */
			case ($request -> getMethod() == 'POST') && ($request->getVerb() == null) && (intval($request->getArgs()[0])):
				$inputJSON = file_get_contents('php://input');
				$input = json_decode( $inputJSON, TRUE );
				if (isset($input['nameFirst']) && isset($input['nameLast']) && 
				    isset($input['email'    ]) && isset($input['password'])) 
				{
					$users = $this -> selectUserByEmailAndPassword($input['email'],$input['password']);
					$user = $users[0];
					if($user) {
						$code = 200;
						$data = $this -> updateUser($user['id'],$input['nameFirst'],$input['nameLast'],
									    $input['password'],$input['email'],$user['userStatus']);
						$data = $this -> selectUserByEmailAndPassword($user['userEmail'],$user['userPassword']);
					} else {
						$code = 404;
					}
				} else {
					$code = 409;
				}
				break;
			/*********************************************************************************************************/
			case ($request -> getVerb() === 'mail') && ($request -> getMethod() == 'GET'):
				$code = 404;
				$data = $this->sendValidationUser();
				break;
				
			default:
				$code = 404;
				$data = "userController default\n";
				break;
		}
	}

	/**
	 * api/v01/user/register	POST	register new user
	 * api/v01/user/confirm		POST	confirm user registeration
	 * api/v01/user/login		POST	login existing user
	 * api/v01/user/deleteUser	POST	delete User
	 * ======================================================================================================= * 
	 */
	function sendValidationUser($mail_address) {
		// multiple recipients
		$to       = $mail_address;

		// subject
		$subject  = 'AppCTSNet.info registration acknowledgement';
	
		// message
		$message  = 'Welcome to AppCTSNet.info, ';
		$message .= 'Please acknowledge registration by clicking the following link: ' . '\r\n ';
		$message .= 'http://appctsnet.info/api/user/confirm/edata?mail_address=' . $mail_address . ' ';
		$message .= 'If you did not register to CTSNet please ignore this email' . '\r\n';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . '\r\n';
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . '\r\n';
//		$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . '\r\n';
		$headers .= 'From: App CTSNet Admin <noreplay@appctsnet.info>' . '\r\n ';

		// Mail it
		$data = mail($to, $subject, $message, $headers);
		return $data;
	}
	
	/**
	 *
	 * ======================================================================================================= * 
	 */
	function allUsers() {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT * FROM user';
			$stmt = $db -> prepare($sql);
			$stmt -> execute();
			$response = $stmt -> fetchAll(PDO::FETCH_ASSOC);	
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
	
	/**
	 *
	 * ======================================================================================================= * 
	 */
	function selectUserByID($user_id) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT * 
				FROM user 
				WHERE id=:user_id';
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':user_id',$user_id,PDO::PARAM_INT);
			$stmt -> execute();
			$response = $stmt -> fetchAll(PDO::FETCH_ASSOC);	
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
	/**
	 *
	 * ======================================================================================================= * 
	 */
	function selectUserByEmail($user_email) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT * 
				FROM user 
				WHERE userEmail = :user_email';
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':user_email',$user_email);
			$stmt -> execute();
			$response = $stmt -> fetchAll(PDO::FETCH_ASSOC);	
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
		
	/**
	 *
	 * ======================================================================================================= * 
	 */
	function selectUserByEmailAndPassword($user_email,$user_password) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT 	* 
				FROM 	user
				WHERE 	userEmail = :user_email AND userPassword = :user_password';			
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':user_password',$user_password);
			$stmt -> bindParam(':user_email'   ,$user_email   );
			$stmt -> execute();
			$response = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			$db = null;	
		} catch (Exception $e) {
			$response = $e -> getMessage();
		}
		return $response;
	}
	
	/**
	 *
	 * ======================================================================================================= * 
	 */	
	function insertUser($user_nameFirst , $user_nameLast ,$user_email ,$user_password ,$user_status) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
		 	$response = array($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'INSERT INTO user (userNameFirst,userNameLast,userPassword,userEmail,userStatus)
				VALUES (:user_nameFirst ,:user_nameLast ,:user_password ,:user_email ,:user_status)';
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':user_nameFirst',$user_nameFirst,PDO::PARAM_STR);
			$stmt -> bindParam(':user_nameLast' ,$user_nameLast ,PDO::PARAM_STR);
			$stmt -> bindParam(':user_password' ,$user_password ,PDO::PARAM_STR);
			$stmt -> bindParam(':user_email'    ,$user_email    ,PDO::PARAM_STR);
			$stmt -> bindParam(':user_status'   ,$user_status   ,PDO::PARAM_INT);
			if($stmt -> execute()){
				$response = "success";
			} else {
				$response = $stmt -> errorCode();
			};
			$db = null;		
		} catch (Exception $e) {
			$response = $e -> getMessage();
		}
		return $response;
	}
	
	/**
	 *
	 * ======================================================================================================= * 
	 */
	function updateUser($user_id ,$user_nameFirst , $user_nameLast ,$user_password ,$user_email ,$user_status) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'UPDATE 	user
				SET    	userNameFirst= :user_nameFirst, userNameLast = :user_nameLast , userPassword = :user_password , 
					userEmail    = :user_email    , userStatus   = :user_status
				WHERE 	id=:user_id';
	
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':user_id',$user_id,PDO::PARAM_INT);
			$stmt -> bindParam(':user_nameFirst',$user_nameFirst,PDO::PARAM_STR);
			$stmt -> bindParam(':user_nameLast' ,$user_nameLast ,PDO::PARAM_STR);
			$stmt -> bindParam(':user_password' ,$user_password ,PDO::PARAM_STR);
			$stmt -> bindParam(':user_email'    ,$user_email    ,PDO::PARAM_STR);
			$stmt -> bindParam(':user_status'   ,$user_status   ,PDO::PARAM_INT);
			if($stmt -> execute()){
				$response = "success";
			} else {
				$response = $stmt -> errorCode();
			};
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();
		}
		return $response;	
	}
	
	/**
	 *
	 * ======================================================================================================= * 
	 */
	function deletUser($user_id) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'DELETE FROM user
					WHERE id=:user_id';
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':user_id',$user_id,PDO::PARAM_INT);
			$stmt -> execute();
			$response = $this -> selectUserByID($user_id);
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();
		}
		return $response;
	}
}