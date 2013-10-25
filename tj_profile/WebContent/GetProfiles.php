<?php 
  session_start();
?>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Trainer Profiles</title>
</head>
<body>

<?php 
if(!isset($_SESSION['user'])){ ?>
	It appears as if you are not logged in, please log in to add a new trainer profile.<br>
	<a href="./login.php">Log in here</a>
<?php 
}else{
?>

	<h1>Submitted trainer profiles to Canine Solutions</h1>

	<section>
	<?php 
	$con = mysqli_connect("localhost", "krobbins", "abc123", "tj_data");
	if (mysqli_connect_errno()) {
   	echo "Couldn't connect to database evalurls: " . mysqli_connect_errno();
	}else{
	
		$result = mysqli_query($con, "SELECT * FROM profentry");
		while ($row = mysqli_fetch_array($result)) {
			echo "<div><hr>";
			echo "<h3>Trainer profile for ".$row['name']."</h3>";
			echo "<img src=\"./photos/".$row['photo']."\" alt=\"".$row['photo']."\"><br>";
			echo "email: ".$row['email']."<br>Gender: ".$row['sex']."<br>";
			echo "availability: ".$row['available']."<br>Experience: ".$row['exp']."<br>";
			echo "trainer description:<br>".$row['trainer_description']."<br>";
			echo"</div>";
		}
		mysqli_close($con);
	}
}
?>

<a href = "index.php">Return to main page</a>
</section>
</body>
</html>