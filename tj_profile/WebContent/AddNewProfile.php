<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Profile Add Confermation</title>
</head>
<body>
<h1>Trainer profile confirmation</h1>
<section>
<?php 
exit();
include 'Validate.php';
$ourvals = validate_profileentry($_POST);
$image = validate_fileentry($_FILES);

print_r($ourvals);
echo "<br>";
print_r($_FILES);
echo "<br>";
extract($ourvals);

if(isset($error_msg)){
	echo "Invalid input:<br>".$error_msg;
}
if(isset($error_msg_photo)){
	echo "Invlid photo:<br>".$error_msg_photo;
}else{
	$photo_dir = "./photos/".$image['photo_name'];
	$con = mysqli_connect("localhost", "krobbins", "abc123", "tj_data");
	if (mysqli_connect_errno()) {
		echo "Couldn't connect to database tj_data: " . mysqli_connect_errno();
	}

	$sql =  "INSERT INTO profentry (name, email, sex, available, exp, trainer_description, photo)
	VALUES ('$name', '$email', '$sex', '$available', '$exp', '$trainer_description', '$photo_dir')";

	if (!mysqli_query($con, $sql)) {
		die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	echo "<h2>Added profile:</h2><br>";
	echo "name: ".$name."<br>
		  email: ".$email."<br>
		  sex: ".$sex."<br>
		  experience: ".$exp."<br>
		  available: ".$available."<br>
		  trainer description: ".$trainer_description."<br>";
	echo "<br>Profile picture:<br><img src=\"./photos/".$image['photo_name']."\" alt=\"".$image['photo_name']."\">";
}
?>
<br>
<a href="./index.php">Main page</a>              <a href="./AddProfile.html">Add another trainer profile</a>
</section>
</body>
</html>