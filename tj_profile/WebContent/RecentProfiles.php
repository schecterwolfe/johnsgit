<?php
$con = mysqli_connect("localhost", "krobbins", "abc123", "tj_data");
if (mysqli_connect_errno()) {
	echo "Couldn't connect to database evalurls: " . mysqli_connect_errno();
}else{
	$result = mysqli_query($con, "SELECT * FROM profentry ORDER BY prof_id DESC");
	$row = mysqli_fetch_array($result);
	echo "<a href=\"./GetSingleProfile.php?NAME=".$row['name']."\" target=\"_blank\"><img src=\"".$row['photo']."\" alt=\"".$row['photo']."\"></a>    ";
	echo $row['name']."<br>";
	
	$row = mysqli_fetch_array($result);
	echo "<a href=\"./GetSingleProfile.php?NAME=".$row['name']."\" target=\"_blank\"><img src=\"".$row['photo']."\" alt=\"".$row['photo']."\"></a>    ";
	echo $row['name']."<br>";
	
	$row = mysqli_fetch_array($result);
	echo "<a href=\"./GetSingleProfile.php?NAME=".$row['name']."\" target=\"_blank\"><img src=\"".$row['photo']."\" alt=\"".$row['photo']."\"></a>    ";
	echo $row['name']."<br>";
	mysqli_close($con);
}
?>