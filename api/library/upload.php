<?
class uploadImage {
	
	public function upload() {
		$response;
		if(isset($_FILES["file"]["type"])) {
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			if (
				(
					($_FILES["file"]["type"] == "image/png") || 
					($_FILES["file"]["type"] == "image/jpg") || 
					($_FILES["file"]["type"] == "image/jpeg")
				) && 
				($_FILES["file"]["size"] < 100000) && //Approx. 100kb files can be uploaded.
				in_array($file_extension, $validextensions))
			{
				if ($_FILES["file"]["error"] > 0) {
					$code = $_FILES["file"]["error"]
				} else {
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "upload/".$_FILES['file']['name']; // Target path where file is to be stored
					if( move_uploaded_file($sourcePath,$targetPath) ){ // Moving Uploaded file
						$code = 201;
					} else {
						$code = 404;
					}
				}
			} else {
				$code = 404;
			}
		} else {
			$code = 404;
		}
		$response['code'] = $code;
	}
}