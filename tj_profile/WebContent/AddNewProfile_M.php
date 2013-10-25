<?php 
  session_start();
?>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Profile Add Confirmation</title>
</head>
<body>
<?php 
if(!isset($_SESSION['user'])){ ?>
	It appears as if you are not logged in, please log in to add a new trainer profile.<br>
	<a href="./login.php">Log in here </a>
<?php 
}else{
?>
	<h1>Trainer profile confirmation</h1>

<?php 
	require_once('EvalProfileModel.php');

	$model = new EvalProfileModel("localhost", "krobbins", "abc123", "tj_data");
	$values = $model->create($_POST, $_FILES);
	if(!$values){
		echo "error adding entry: ".$model->getError();
		exit();
	}

	extract($values);
	echo "<h2>Added profile:</h2><br>";
	echo "name: ".$name."<br>
		  	email: ".$email."<br>
		  	sex: ".$sex."<br>
		  	experience: ".$exp."<br>
		  	available: ".$available."<br>
		  	trainer description: ".$trainer_description."<br>
			Photo: ".$values['photo_dir']."<br>";
	echo "<br>Profile picture:<br><img src=\"./photos/".$values['photo_dir']."\" alt=\"".$values['photo_dir']."\">";
}
?>

<br>
<a href="./index.php">Main page</a>              <a href="./AddProfile.html">Add another trainer profile</a>
</body>
</html>