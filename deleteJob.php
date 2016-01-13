<?php
include 'connection.php';
	$key=$_POST['key'];
	
	$query = "DELETE FROM schdMsg WHERE id= '$key'";
	$result = mysqli_query($link, $query);
	
	if ($result) {
		echo "Job successfully Deleted";
	} else {
		echo "Action failed kindly contact your administrator";
	}
	
?>