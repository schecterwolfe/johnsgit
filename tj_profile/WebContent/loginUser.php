<?php 
  session_start();
?>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Log in confirmation</title>
</head>
<body>
<?php 
if(!isset($_SESSION['user'])){
	$_SESSION['user'] = $_GET['username'];
	
	echo "you are now logged in as ".$_SESSION['user']."<br>";
}
?>

<a href="./index.php">Main page</a>
</body>
</html>