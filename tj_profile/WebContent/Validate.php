<?php
function validate_profileentry($myarray){
	$error = "";
	if(!($email_eval = trim(filter_var($myarray['email'], FILTER_SANITIZE_EMAIL)))){
		$error.= "Invalid Email<br>";
	}
	$name_eval = trim($myarray['name']);
	if(empty($name_eval)){
		$error .= "Name field is empty<br>";
	}
	if(strcmp($error, "")){
		return array('error_msg' => $error);
	}
	$temp_data = "";
	$avail_data = implode(', ', $myarray['available']);
	$newvals = array('name' => $name_eval,
			'email' => $email_eval,
			'sex' => $myarray['sex'],
			'available' => $avail_data,
			'exp' => $myarray['exp'],
			'trainer_description' => $myarray['trainer_description']);
	return $newvals;
}

function validate_fileentry($files){
	$extentions = array("jpg", "jpeg");
	$temp = explode(".", $files['photo']['name']);
	$ext = end($temp);
	$error = "";
	
	//check if uploaded 
	if($files['photo']['size'] <= 0){
		$error .= "Image upload error<br>";
	}
	//check max size
	if($files['photo']['size'] > 1048576){
		$error .= "Image to large, must be 1mb or less<br>";
	}
	//check extention
	if(!(($files['photo']['type'] == "image/jpg" || $files['photo']['type'] == "image/jpeg")
		&& in_array($ext, $extentions))){
		$error .= "Image is of wrong format (".$files['photo']['type'].") , needs to be of type jpg or jpeg<br>";
	}
	//check if directory exist
	$dir = dirname(__FILE__)."\\photos";
	if(!(file_exists($dir) && is_dir($dir))){
		mkdir("photos");
	}
	//check if photo already exist
	$dir .= "\\";
	if(file_exists("".$dir.$files['photo']['name'])){
		$error .= "file name: ".$files['photo']['name']." already exist.<br>";
	}
	
	if(strcmp($error,"")){
		return array('error_msg_photo' => $error, 'photo_name' => $files['photo']['name']);
	}
	//move photo from temp file in php to "photos/"
	move_uploaded_file($files['photo']['tmp_name'], $dir.$files['photo']['name']);
	
	return array('photo_path' => $dir.$files['photo']['name'], 'photo_name' => $files['photo']['name']);
}
?>