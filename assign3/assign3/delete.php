<?php
	if (isset ($_GET["id"]))
		$id=$_GET["id"];
	else {
		header ("location:manage.php");
		exit();
	}
	
	require_once "settings.php";	
	$conn = @mysqli_connect ($host,$user,$pwd,$sql_db);	// 
	if ($conn) { 
		$query = "DELETE FROM eoi WHERE id = $id";
		$result = mysqli_query ($conn, $query);
		if ($result) {								
			echo "<p>Delete operation successful. </p>";
		} else {
			echo "<p>Delete operation unsuccessful.</p>";
		}
		mysqli_close ($conn);
        header ("location:manage.php");					
	} else {
		echo "<p>Unable to connect to the database.</p>";
	}
?>	