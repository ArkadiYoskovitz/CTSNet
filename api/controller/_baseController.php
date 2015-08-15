<?php
abstract class baseController {

	public function debug_to_console( $data ) {
		if(is_array($data)) {
			$output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
		} else {
			$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
		} 
		echo $output;
	}

	public function queryToArray($qry) {
                $result = array();
                //string must contain at least one = and cannot be in first position
                if(strpos($qry,'=')) {
                	if(strpos($qry,'?') !== false) {
                		$q = parse_url($qry);
                		$qry = $q['query'];
                	}
                } else {
                	return false;
                }
 
                foreach (explode('&', $qry) as $couple) {
                        list ($key, $val) = explode('=', $couple);
                        $result[$key] = $val;
                }
                return empty($result) ? false : $result;
        }
        
        public function uploadFiles($elsement_name) {
		$response;
		if(isset($_FILES[$elsement_name]["type"])) {
		
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES[$elsement_name]["name"]);
			$file_extension = end($temporary);
			if (
				(
					($_FILES[$elsement_name]["type"] == "image/png") || 
					($_FILES[$elsement_name]["type"] == "image/jpg") || 
					($_FILES[$elsement_name]["type"] == "image/jpeg")
				) && 
				($_FILES[$elsement_name]["size"] < 1024000) && //Approx. 1Mb files can be uploaded.
				in_array($file_extension, $validextensions))
			{
				if ($_FILES[$elsement_name]["error"] > 0) {
					$code = $_FILES[$elsement_name]["error"];
					$data = null;
				} else {
					$sourcePath = $_FILES[$elsement_name]['tmp_name']; // Storing source path of the file in a variable
					$targetPath = $_SERVER['DOCUMENT_ROOT']."/images/".$_FILES[$elsement_name]['name']; // Target path
					if( move_uploaded_file($sourcePath,$targetPath) ){ // Moving Uploaded file

						$new_source = $targetPath;
						$new_target = $_SERVER['DOCUMENT_ROOT']."/images/ ".$_FILES[$elsement_name]['name'];
						if( move_uploaded_file($new_source,$new_target) ){ // Moving Uploaded file

							if( move_uploaded_file($new_target,$targetPath) ){ // Moving Uploaded file
								$code = 201;
								$data = "/images/".$_FILES[$elsement_name]['name']; // Target path for database
							}
							$code = 201;
							$data = "/images/".$_FILES[$elsement_name]['name']; // Target path for database
						}
						$code = 201;
						$data = "/images/".$_FILES[$elsement_name]['name']; // Target path for database
					} else {
						$code = 404;
						$data = 'bad upload';
					}
				}
			} else {
				$code = 404;
				$data = 'bad files';
			}
		} else {
			$code = 404;
			$data = 'no files';
		}
		$response['code'] = $code;
		$response['data'] = $data;
		return $response;
		
	}
}