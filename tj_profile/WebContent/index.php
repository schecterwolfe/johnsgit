<?php
	session_start();
?>

<html>
<head>
<meta charset="ISO-8859-1">
<title>Canine solutions home page</title>
</head>
<body>
<h1>Welcome to Canine solutions!</h1>
<h4>who we are:</h4>
This site is dedicated to the training and rehabilitation of your canine friend(s).<br>
Here you can search our database of registered canine trainers for one what will best suit your needs<br>
<br>
If you're a trainer looking for clients, feel free to register your profile and get hired today!<br> 
<br>
<br>
<?php 
if(!isset($_SESSION['user'])) {?>
	<div><h3>Hello guest!</h3>
	Please log in to view trainer profiles, or to submit your own profile if you are a trainer.<br>
	<a href="./login.php">Log in here</a>	
	</div>
<?php
}else{?>
	<div><h2>Menu</h2>
	<h3>Hello <?php echo $_SESSION['user']?>!</h3>
	<h4>Looking for Client?</h4>
	<a href="./GetProfiles.php">Browse trainer profiles!</a><br>
	<h4>Are you a Trainer?</h4>
	<a href="./AddProfile.html">Add your new profile!</a></div>
	<hr>
	<h4>Recient trainers added:</h4><br>
	<iframe src="RecentProfiles.php" width="100%" height="300px"></iframe>
<?php
}
?>
</body>
</html>