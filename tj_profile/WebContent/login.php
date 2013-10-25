<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Login in page</title>
</head>
<body>
<?php
if(!isset($_SESSION['user'])){
?>
	<h2>Fill in your first and last name a login</h2>
	<form name="add_form"  method="get" action="loginUser.php">
	User name <input type="text" name="username"><button type="submit" value="Submit">Submit</button>
	</form>
<?php 
}else{
?>
	<h4>You are already loggin in as <?php $_SESSION['user']?>, please log off if you wish to log in as a different user.</h4>
<?php 
}?>
</body>
</html>