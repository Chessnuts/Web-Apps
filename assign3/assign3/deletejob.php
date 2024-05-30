<?php
	if (isset ($_POST["referencenum"]))
		$referencenum=$_POST["referencenum"];
	else {
		header ("location:manage.php");
		exit();
	}
	
	// Load MySQL log in credentials
	require_once "settings.php";	
	
	// Log in and use database
	$conn = @mysqli_connect ($host,$user,$pwd,$sql_db);	
	
	 // check is database is available for use
	if ($conn) {
		$query = "DELETE FROM eoi WHERE referencenum = '$referencenum'";
		 
		$result = mysqli_query ($conn, $query);
		
		// check if query was successfully executed
		if ($result) {								
			echo "<p>" . mysqli_affected_rows($conn) . " record deleted. </p>";
		} else {
			echo "<p>Delete operation unsuccessful.</p>";
		}
		
		// Close the database connect
		mysqli_close ($conn);	
        header ("location:manage.php");				
	} else {
		echo "<p>Unable to connect to the database.</p>";
	}
?>