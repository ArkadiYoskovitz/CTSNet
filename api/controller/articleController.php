<?php
(include_once('library/requestHandler.php')	) or die('Cound include library/requestHandler'	 );
(include_once('controller/_baseController.php')	) or die('Cound include controller/baseController.php');

class articleController extends baseController {

	public function invokeAction($request,&$data,&$code) {

		switch(true) {
			/* ======================================================================================================= *
			 * API Calls - Article 
			 * ======================================================================================================= */
			/**
			 * Articles - Get all article news feed
			 * =======================================================================================================
			 */
			case ($request->getMethod() == 'GET') && ($request->getVerb() == 'news'):
				
				$articles = $this -> refreshNewsFeed();
				if($articles != false){
					$data = $articles;
					$code = 200;
				} else {
					$code = 404;
				}
				
				break;
			/**
			 * Articles - Get all articles
			 * =======================================================================================================
			 */
			case ($request->getMethod() == 'GET') && ($request->getVerb() == 'allArticles'):
				
				$articles = $this -> allArticles();
				if($articles != false){
					$data = $this -> allArticles();
					$code = 200;
				} else {
					$code = 404;
				}
				break;	
			/**
			 * Articles - search for article by category or articleID
			 * =======================================================================================================
			 */
			case ($request->getMethod() == 'GET') && ($request->getVerb() != null) && (!$request->getArgs()):
				
				$queryString = str_replace('search&','',$request->getVerb());
				$input = $this->queryToArray($queryString);
				
				if(isset($input['id']) && (is_numeric($input['id']))) {
					$articles = $this -> selectArticleByID(intval($input['id']));
					if($articles['article'] != false){
						$data = $this -> selectArticleByID(intval($input['id']));
						$code = 200;
					} else {
						$code = 404;
					}
				} else if(isset($input['category'])) {
					if(is_numeric($input['category'])){
						$articles = $this -> selectArticlesByCategoryID(intval($input['category']));
						if($articles['article'] != false){
							$data = $articles;
							$code = 200;
						} else {
							$code = 404;
						}
					} else {
						$articles = $this -> selectArticlesByCategoryName($input['category']);
						if($articles['article'] != false){
							$data = $articles;
							$code = 200;
						} else {
							$code = 404;
						}
					}
				} else if(isset($input['user_id'])){
					$articles = $this -> selectArticlesByUserID($input['user_id']);
					if($articles['article'] != false){
						$data = $articles;
						$code = 200;
					} else {
						$code = 404;
					}
				} else {
					$code=404;
				}
				break;
			/**
			 * Article - publish a new article -- was PUT but changed to POST to support image upload
			 * =======================================================================================================
			 */	
			case 	($request->getMethod() == 'POST') && ($request->getVerb() == null) && (!$request->getArgs()):
				
				$input = $_POST;

				if( (isset($input['articalEditTitle']))&&(isset($input['articalEditHeader']))&&(isset($input['articalEditBody']))&&
				    (isset($input['articalEditConclusion'])) && (isset($input['articalEditSummary']))&&
				    (isset($input['article_writer_id']))&&(isset($input['articalEditCategory'])) )
				   {
					
					$bArticles = $this -> allArticles();
					$bArticles_count = count($bArticles['article']);

					$this -> insertArticle($input['articalEditTitle'],$input['articalEditHeader'],$input['articalEditBody'],
							       $input['articalEditConclusion'],$input['articalEditSummary'],' ',
							       $input['article_writer_id'],4,$input['articalEditCategory']);

					$aArticles = $this -> allArticles();
					$aArticles_count = count($aArticles['article']);
					if($aArticles_count > $bArticles_count) {
					
						$input['image_path'] = '';
						// handle file relocation adn call update
						$upload_response = $this -> uploadFiles('articalEditImage');
						if((intval($upload_response['code']) == 201) && (isset($upload_response['data']))) {
							$input['image_path'] = $upload_response['data'];
						}
						$articleID = $this -> lastArticleID();
						$data['a'] = $articleID;
						$data['b'] = intval($articleID['id']);
						$data['c'] = $this -> updateArticleByID(intval($articleID['id']),
									   $input['articalEditTitle'],$input['articalEditHeader'],
				  					   $input['articalEditBody'],$input['articalEditConclusion'],
				  					   $input['articalEditSummary'],$input['image_path'],
				  					   $input['article_writer_id'],4,$input['articalEditCategory']);
				  					   
						$data['d'] = $this -> selectArticleByID(intval($articleID['id']));
						$data['e'] = $upload_response;
						$code = 200;
					} else {					
						$code = 404;
					}
				} else {
					$code = 404;
				}
				break;
			/**
			 * Article - get a Article by ID
			 * =======================================================================================================
			 */				
			case 	($request->getMethod() == 'GET') && ($request->getVerb() == null) && 
				(intval($request->getArgs()[0])) && (count($request->getArgs()) == 1):
				
				$articles = $this -> selectArticleByID(intval($request->getArgs()[0]));
				if($articles['article'] != false){
					$data = $this -> selectArticleByID(intval($request->getArgs()[0]));
					$code = 200;
				} else {
					$code = 404;
				}
				break;
			/**
			 * Article - update an article by ID
			 * =======================================================================================================
			 */	
			case 	($request->getMethod() == 'POST') && ($request->getVerb() == null) && 
				(intval($request->getArgs()[0])) && (count($request->getArgs()) == 1):

				$input = $_POST;

				$articles = $this -> selectArticleByID(intval($request->getArgs()[0]));									
				if($articles['article'] != false){
				
					$input['image_path'] = '';
					// handle file relocation
					$upload_response = $this -> uploadFiles('articalEditImage');
					if((intval($upload_response['code']) == 201) && (isset($upload_response['data']))) {
						$input['image_path'] = $upload_response['data'];
					}
					$data['a'] = $this -> selectArticleByID(intval($request->getArgs()[0]));
					$data['b'] = $this -> updateArticleByID(intval($request->getArgs()[0]),$input['articalEditTitle'],
								$input['articalEditHeader'],$input['articalEditBody'],$input['articalEditConclusion'],
			  					$input['articalEditSummary'],$input['image_path'],$input['article_writer_id'],4,
			  					$input['articalEditCategory']);
			  					   
					$data['c'] = $this -> selectArticleByID(intval($request->getArgs()[0]));
					$data['d'] = $upload_response;
					$data['e'] = $input;
					$code = 200;
				} else {
					$data = null;
					$code = 404;
				}
				break;
			/**
			 * Article - delete an article by ID
			 * =======================================================================================================
			 */
			case 	($request->getMethod() == 'DELETE') && ($request->getVerb() == null) && 
				(intval($request->getArgs()[0])) && (count($request->getArgs()) == 1):
				
				$articles = $this -> selectArticleByID(intval($request->getArgs()[0]));									
				if($articles['article'] != false){
					$bArticles = $this -> selectArticleByID(intval($request->getArgs()[0]));
					$bComments = $this -> selectCommentsByArticleID(intval($request->getArgs()[0]));
					$this -> deleteArticleByID(intval($request->getArgs()[0]));
					foreach ($bComments as $value) {
						foreach ($value as $v) {
							$this -> deleteCommentByID($v['id']);
						}
					}
					$aArticles = $this -> selectArticleByID(intval($request->getArgs()[0]));
					$aComments = $this -> selectCommentsByArticleID(intval($request->getArgs()[0]));
					if(($aArticles['article'] != false) || (count($aComments) > 0)){
						$code = 404;
					} else {
						$code = 200;
					}
				} else {
					$code = 404;
				}
				break;
				
			/* ======================================================================================================= *
			 * API Calls - Comment 
			 * ======================================================================================================= */

			/**
			 * Comments - Get all comment for article
			 * =======================================================================================================
			 */
			case 	($request->getMethod() == 'GET') && ($request->getVerb() == null) && 
				(intval($request->getArgs()[0])) && (count($request->getArgs()) > 1) &&
				($request->getArgs()[1] === 'comments'):
				
				$comments = $this -> selectCommentsByArticleID(intval($request->getArgs()[0]));
				if($comments['comments'] != false){
					$data = $this -> selectCommentsByArticleID(intval($request->getArgs()[0]));
					$code = 200;
				} else {
					$code = 404;
				}
				break;
			/**
			 * Comment - publish a new comment for article
			 * =======================================================================================================
			 */
			case 	($request->getMethod() == 'PUT') && ($request->getVerb() == null) && 
				(intval($request->getArgs()[0])) && (count($request->getArgs()) > 1) &&
				($request->getArgs()[1] === 'comment'):
				
				$inputJSON = file_get_contents('php://input');
				$input = json_decode( $inputJSON, TRUE );
				
				if((isset($input['comment_writer_id'])) && (isset($input['comment_content']))) {
					$bComments = $this -> selectCommentsByArticleID(intval($request->getArgs()[0]));
					$bComments_count = count($bComments['comments']);
					
					$this -> insertComment($input['comment_writer_id'],$input['comment_content'],intval($request->getArgs()[0]));
					
					$aComments = $this -> selectCommentsByArticleID(intval($request->getArgs()[0]));
					$aComments_count = count($aComments['comments']);
					if($aComments_count > $bComments_count) {
						$code = 200;
						$data = $aComments;
					} else {					
						$code = 404;
						$data = $aComments;
					}
				} else if(isset($input['comment_content'])) {
					$bComments = $this -> selectCommentsByArticleID(intval($request->getArgs()[0]));
					$bComments_count = count($bComments['comments']);
					
					$this -> insertComment(1,$input['comment_content'],intval($request->getArgs()[0]));
					
					$aComments = $this -> selectCommentsByArticleID(intval($request->getArgs()[0]));
					$aComments_count = count($aComments['comments']);
					if($aComments_count > $bComments_count) {
						$code = 200;
						$data = $aComments;
					} else {					
						$code = 404;
						$data = $aComments;
					}
				} else {
					$code = 404;
				}
				break;
			/**
			 * Comment - get a comment by ID for article
			 * =======================================================================================================
			 */	
			case 	($request->getMethod() == 'GET') && ($request->getVerb() == null) && 
				(intval($request->getArgs()[0])) && (count($request->getArgs()) > 2) &&
				($request->getArgs()[1] === 'comment'):
								
				$comments = $this -> selectCommentByID(intval($request->getArgs()[2]));
				
				if($comments['comments'] != false){
					$data = $this -> selectCommentByID(intval($request->getArgs()[2]));
					$code = 200;
				} else {
					$code = 404;
					$data = null;
				}
				break;
			/**
			 * Comment - update a comment by ID for article
			 * =======================================================================================================
			 */	
			case 	($request->getMethod() == 'POST') && ($request->getVerb() == null) && 
				(intval($request->getArgs()[0])) && (count($request->getArgs()) > 2) &&
				($request->getArgs()[1] === 'comment'):
				
				$inputJSON = file_get_contents('php://input');
				$input= json_decode( $inputJSON, TRUE );
				
				$comments = $this -> selectCommentByID(intval($request->getArgs()[2]));
				
				if($comments['comments'] != false){
					$this -> updateComment( intval($request->getArgs()[2]),$input['comment_writer_id'],
									$input['comment_content'],$input['article_id']);
					$data = $this -> selectCommentByID(intval($request->getArgs()[2]));
					$code = 200;
				} else {
					$code = 404;
					$data = null;
				}
				break;
			/**
			 * Comment - delete a comment by ID for article
			 * =======================================================================================================
			 */
			case 	($request->getMethod() == 'DELETE') && ($request->getVerb() == null) && 
				(intval($request->getArgs()[0])) && (count($request->getArgs()) > 2) &&
				($request->getArgs()[1] === 'comment'):
								
				$comments = $this -> selectCommentByID(intval($request->getArgs()[2]));
				
				if($comments['comments'] != false){
					$data = $this -> deleteCommentByID(intval($request->getArgs()[2]));
					$comments = $this -> selectCommentByID(intval($request->getArgs()[2]));
					if($comments['comments'] != false){
						$code = 404;
						$data = null;
					} else {
						$code = 200;
					}						
				} else {
					$code = 404;
					$data = null;
				}
				break;
					
			default:
				//echo "articleController default\n";
				$code = 404;
				$data = 'articleController default\n';
				break;
		}
	}
	
	/* ======================================================================================================= *
	 * PDO CALLS
	 * ======================================================================================================= */
			
	/*
	 * refreshNewsFeed [api/v01/article/news 	GET	]
	 * ======================================================
	 * The function queries the data base for the latest
	 * articles in each section and returns an associative array
	 */
	function refreshNewsFeed() {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT * FROM article WHERE category_id = :category ORDER BY date_last_modification DESC LIMIT 2';
			
			$stmt = $db -> prepare($sql);
			$stmt->bindValue(':category',1, PDO::PARAM_INT);
			$stmt -> execute();
			$response['news'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			
			$stmt = $db -> prepare($sql);
			$stmt->bindValue(':category',2, PDO::PARAM_INT);
			$stmt -> execute();			
			$response['tech'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			
			$stmt = $db -> prepare($sql);
			$stmt->bindValue(':category',3, PDO::PARAM_INT);
			$stmt -> execute();			
			$response['cars'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			$stmt = $db -> prepare($sql);
			
			$stmt->bindValue(':category',4, PDO::PARAM_INT);
			$stmt -> execute();			
			$response['sports'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
	/*
	 * last article ID
	 * ======================================================
	 */
	 function lastArticleID() {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT * FROM article ORDER BY article.id DESC LIMIT 1';			
			$stmt = $db -> prepare($sql);
			$stmt -> execute();
			$response = $stmt -> fetch(PDO::FETCH_ASSOC);
			
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
		
	/*
	 * All Articles	 [api/v01/article/allArticles	GET	]
	 * ======================================================
	 * The function queries the data base for an article by its ID
	 */
	 function allArticles() {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT	article.id, article.title, article.header, article.body, article.conclusion, article.summary,
					article.image_path, article.writer_id, article.date_creation, article.date_last_modification,
					article.article_status, article.category_id,category.name as category_name,user.userNameFirst,user.userNameLast
				FROM	article,category,user
				WHERE	article.category_id =category.id AND article.writer_id = user.id';			
			
			$stmt = $db -> prepare($sql);

			$stmt -> execute();
			$response['article'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
	/*
	 * Search for Article by ID [api/v01/article/search	GET	]
	 * ===============================================================
	 * The function queries the data base for an article by its ID
	 */
	 function selectArticlesByUserID($user_ID) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT	article.id, article.title, article.header, article.body, article.conclusion, article.summary,
					article.image_path, article.writer_id, article.date_creation, article.date_last_modification,
					article.article_status, article.category_id,category.name as category_name,user.userNameFirst,user.userNameLast
				FROM	article,category,user
				WHERE	article.category_id=category.id AND article.category_id=category.id AND 
					article.writer_id=user.id AND user.id=:user_ID
				ORDER BY article.date_last_modification DESC';			
			
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':user_ID',$user_ID,PDO::PARAM_INT);

			$stmt -> execute();
			$response['article'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
	/*
	 * Search for Article by ID [api/v01/article/search	GET	]
	 * ===============================================================
	 * The function queries the data base for an article by its ID
	 */
	 function selectArticlesByCategoryID($category_ID) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT	article.id, article.title, article.header, article.body, article.conclusion, article.summary,
					article.image_path, article.writer_id, article.date_creation, article.date_last_modification,
					article.article_status, article.category_id,category.name as category_name,user.userNameFirst,user.userNameLast
				FROM	article,category,user
				WHERE	article.category_id = :category_ID AND article.category_id=category.id AND article.writer_id=user.id
				ORDER BY article.date_last_modification DESC';			
			
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':category_ID',$category_ID,PDO::PARAM_INT);

			$stmt -> execute();
			$response['article'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
		/*
	 * Search for Article by name [api/v01/article/search	GET	]
	 * ===============================================================
	 * The function queries the data base for an article by its ID
	 */
	 function selectArticlesByCategoryName($category_name) {
		$response;
		$categorys = array(
			'News' => 1,
			'Tech' => 2,
			'Cars' => 3,
			'Sports' => 4, 
		);
		$testCategorys = array_change_key_case($categorys, CASE_UPPER);
		$testName = strtoupper($category_name);
		$search_value = $testCategorys[$testName];
		$response = $this -> selectArticlesByCategoryID($search_value);
		return $response;
	}
	/*
	 * Insert new  article	 [api/v01/article/	PUT	]
	 * ======================================================
	 * The function queries the data base for an article by its ID
	 */
	 function insertArticle($article_title,$article_header,$article_body,$article_conclusion,$article_summary,
				$article_image_path,$article_writer_id,$article_article_status,$article_category)
	{
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'INSERT INTO article (title,header,body,conclusion,summary,image_path,writer_id,article_status,category_id)
				VALUES (:title,:header,:body,:conclusion,:summary,:image_path,:writer_id,:status,:categoryID)';
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':title'	,$article_title		,PDO::PARAM_STR);
			$stmt -> bindParam(':header'	,$article_header	,PDO::PARAM_STR);
			$stmt -> bindParam(':body'	,$article_body		,PDO::PARAM_STR);
			$stmt -> bindParam(':conclusion',$article_conclusion	,PDO::PARAM_STR);
			$stmt -> bindParam(':summary'	,$article_summary	,PDO::PARAM_STR);
			$stmt -> bindParam(':image_path',$article_image_path	,PDO::PARAM_STR);
			$stmt -> bindParam(':writer_id'	,$article_writer_id	,PDO::PARAM_INT);
			$stmt -> bindParam(':status'	,$article_article_status,PDO::PARAM_INT);
			$stmt -> bindParam(':categoryID',$article_category	,PDO::PARAM_INT);
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
	/*
	 * Update article by ID	 [api/v01/article/-ID-	POST	]
	 * ======================================================
	 * The function queries the data base for an article by its ID
	 */
	 function updateArticleByID($article_ID,$article_title,$article_header,$article_body,$article_conclusion,$article_summary,
				    $article_image_path,$article_writer_id,$article_article_status,$article_category)
	{
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'UPDATE	article
				SET	article.title = :title, article.header = :header, article.body = :body,
					article.conclusion = :conclusion, article.summary = :summary,article.image_path = :image_path,
					article.writer_id = :writer_id,article.article_status = :status,article.category_id = :categoryID
				WHERE	article.id = :articleID';			
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':articleID'	,$article_ID		,PDO::PARAM_INT);
			$stmt -> bindParam(':title'	,$article_title		,PDO::PARAM_STR);
			$stmt -> bindParam(':header'	,$article_header	,PDO::PARAM_STR);
			$stmt -> bindParam(':body'	,$article_body		,PDO::PARAM_STR);
			$stmt -> bindParam(':conclusion',$article_conclusion	,PDO::PARAM_STR);
			$stmt -> bindParam(':summary'	,$article_summary	,PDO::PARAM_STR);
			$stmt -> bindParam(':image_path',$article_image_path	,PDO::PARAM_STR);
			$stmt -> bindParam(':writer_id'	,$article_writer_id	,PDO::PARAM_INT);
			$stmt -> bindParam(':status'	,$article_article_status,PDO::PARAM_INT);
			$stmt -> bindParam(':categoryID',$article_category	,PDO::PARAM_INT);
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
	/*
	 * Article by ID	 [api/v01/article/-ID-	GET	]
	 * ======================================================
	 * The function queries the data base for an article by its ID
	 */
	 function selectArticleByID($article_ID) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT	article.id, article.title, article.header, article.body, article.conclusion, article.summary,
					article.image_path, article.writer_id, article.date_creation, article.date_last_modification,
					article.article_status, article.category_id,category.name as category_name,user.userNameFirst,user.userNameLast
				FROM	article,category,user
				WHERE	article.id = :article_ID AND article.category_id=category.id AND article.writer_id=user.id';			
			
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':article_ID',$article_ID,PDO::PARAM_INT);

			$stmt -> execute();
			$response['article'] = $stmt -> fetch(PDO::FETCH_ASSOC);
			
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
	/* ======================================================
	 * Delete article By ID  [api/v01/article/-ID-	DELETE	]
	 * ======================================================
	 * Delete an article by ID.
	 */
	 function deleteArticleByID($article_ID) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'DELETE FROM article
				WHERE	article.id = :article_ID';			
				
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':article_ID',$article_ID,PDO::PARAM_INT);
			$stmt -> execute();
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
	
	/* ===============================================================================
	 * Comments By ArticleID  	 [api/v01/article/-ID-/comments 	 GET	]
	 * ===============================================================================
	 * The function queries the data base for an article by its ID
	 */
	 function selectCommentsByArticleID($article_ID) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT 	comment.id,comment.comment_writer_id,comment.comment_content,
					comment.article_id,comment.date_last_modification as timestamp,
				       	user.userNameLast,user.userNameFirst,article.title as article_title 
				FROM   	comment,user,article
				WHERE  	comment.article_id = :article_ID AND comment.comment_writer_id=user.id AND comment.article_id=article.id
				ORDER BY comment.date_last_modification DESC';			
			
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':article_ID',$article_ID,PDO::PARAM_INT);

			$stmt -> execute();
			$response['comments'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}

	/* ===============================================================================
	 * Publish a new Comment  	[api/v01/article/-ID-/comment		PUT	]
	 * ===============================================================================
	 * The function queries the data base for an comment by its ID
	 */	
	function insertComment($comment_writer_id ,$comment_content ,$comment_article_id) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
		 	$response = array($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options);
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'INSERT INTO comment (comment_writer_id,comment_content,article_id)
				VALUES (:writer_id ,:content ,:article_id)';
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':writer_id'	  ,$comment_writer_id	,PDO::PARAM_INT);
			$stmt -> bindParam(':content'	  ,$comment_content	,PDO::PARAM_STR);
			$stmt -> bindParam(':article_id'  ,$comment_article_id	,PDO::PARAM_INT);
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
	
	/* ===============================================================================
	 * Update comment By comment_ID  [api/v01/article/-ID-/comment/-ID-	POST	]
	 * ===============================================================================
	 * The function queries the data base for an comment by its ID
	 */
	 function updateComment($comment_ID, $comment_writer_id ,$comment_content ,$comment_article_id) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
			$sql = 'UPDATE	comment
				SET    	comment_writer_id = :writer_id, comment_content = :content ,article_id = :article_id
				WHERE 	comment.id = :comment_ID';
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':comment_ID'  ,$comment_ID		,PDO::PARAM_INT);
			$stmt -> bindParam(':writer_id'	  ,$comment_writer_id	,PDO::PARAM_INT);
			$stmt -> bindParam(':content'	  ,$comment_content	,PDO::PARAM_STR);
			$stmt -> bindParam(':article_id'  ,$comment_article_id	,PDO::PARAM_INT);
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
	/* ===============================================================================
	 * Comment By comment_ID  	 [api/v01/article/-ID-/comment/-ID-	GET	]
	 * ===============================================================================
	 * The function queries the data base for an comment by its ID
	 */
	 function selectCommentByID($comment_ID) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'SELECT 	comment.id,comment.comment_writer_id,comment.comment_content,comment.article_id,
				     	user.userNameLast,user.userNameFirst,article.title as article_title 
				FROM  	comment,user,article
				WHERE  	comment.id = :comment_ID AND comment.comment_writer_id=user.id AND comment.article_id=article.id';

			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':comment_ID',$comment_ID,PDO::PARAM_INT);

			$stmt -> execute();
			$response['comments'] = $stmt -> fetch(PDO::FETCH_ASSOC);
			
			$db = null;
		} catch (Exception $e) {
			$response = $e -> getMessage();	
		}
		return $response;
	}
	/* ===============================================================================
	 * Delete comment By comment_ID	[api/v01/article/-ID-/comment/-ID-	DELETE	]
	 * ===============================================================================
	 * The function queries the data base for an comment by its ID
	 */
	 function deleteCommentByID($comment_ID) {
		$response;
		try {
		 	(include('model/pdo_connection.php')) or die('Cound include model/pdo_connection.php');
			$db = new PDO($pdo_dsn, $pdo_username, $pdo_password, $pdo_options) or die('Unable to establish a DB connection');
			$db -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = 'DELETE FROM comment
				WHERE	comment.id = :comment_ID';			
				
			$stmt = $db -> prepare($sql);
			$stmt -> bindParam(':comment_ID',$comment_ID,PDO::PARAM_INT);
			$stmt -> execute();
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
}