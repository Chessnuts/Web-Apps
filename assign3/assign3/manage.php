<?php
    require_once "settings.php";

    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Management" />
        <meta name="keywords" content="html, css, manage, javascript" />
        <meta name="author" content="Ryan Chessum"  />

        <title>Assignment 3</title>
    
        <link href="styles/style.css" rel="stylesheet" />
        <script src="scripts/apply.js"></script>
        <script src="scripts/enhancements.js"></script>
    
    </head>
    <body>
        <?php
            include "header.inc";
        ?>

        <h2> Job Application Table</h2>
        <?php
            error_reporting(E_ALL);
            if (!isset($_POST["referencenum"])&&!isset($_POST["first_name"])&&!isset($_POST["last_name"]))
                $query = "SELECT * FROM eoi;";	
            else {
                $rn=trim($_POST["referencenum"]);
                $fn=trim($_POST["first_name"]);
                $ln=trim($_POST["last_name"]);
                $query="SELECT * FROM eoi WHERE referencenum LIKE '%$rn%' and first_name LIKE '%$fn%' and last_name LIKE '%$ln%'";
            }
            
            // Load MySQL log in credentials
            require_once "settings.php";	
            
            // Log in and use database
            $conn = mysqli_connect ($host,$user,$pwd,$sql_db);	
            
            // check is database is available for use
            if ($conn) { 
        
                $result = mysqli_query ($conn, $query);
                
                // check if query was successfully executed
                if ($result) {								
                    
                    $record = mysqli_fetch_assoc ($result);
                    // check if any record exists
                    if ($record) {							
                        
                        echo "<table border='1'>";
                        echo "<tr><th>ID</th><th>Job Ref</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>Gender</th><th>Address</th><th>Suburb</th><th>Postcode</th><th>state</th><th>email</th><th>Phone</th><th>Skills</th><th>Other Skills</th><th>Status</th><th></th></tr>";
                        while ($record) {
                            echo "<tr><td>{$record['id']}</td>";
                            echo "<td>{$record['referencenum']}</td>";
                            echo "<td>{$record['first_name']}</td>";
                            echo "<td>{$record['last_name']}</td>";
                            echo "<td>{$record['dob']}</td>";
                            echo "<td>{$record['gender']}</td>";
                            echo "<td>{$record['address']}</td>";
                            echo "<td>{$record['suburb']}</td>";
                            echo "<td>{$record['postcode']}</td>";
                            echo "<td>{$record['state']}</td>";
                            echo "<td>{$record['email']}</td>";
                            echo "<td>{$record['phone']}</td>";
                            echo "<td>{$record['skills']}</td>";
                            echo "<td>{$record['otherskills']}</td>";
                            echo "<td>{$record['status']}</td>";
                            echo "<td><a href='delete.php?id=" . $record['id'] 
                                        . "'>Delete</a></td></tr>";
                            $record = mysqli_fetch_assoc($result);
                        }
                        echo "</table>";
                        
                        // Free up resources
                        mysqli_free_result ($result);	
                    } else {
                        echo "<p>No records retrieved.</p>";
                    }
                } else {
                    echo "<p>Job application table doesn't exist or select operation unsuccessful.</p>";
                }
                
                // Close the database connect
                mysqli_close ($conn);					
            } else {
                echo "<p>Unable to connect to the database.</p>";
            }
        ?>	
        <h3>Search</h3>
            <form action="manage.php" method="post">
                <p><label>Reference Number <input type="text" name="referencenum" /></label></p>
                <p><label>First Name: <input type="text" name="first_name" /></label></p>    
                <p><label>Last Name: <input type="text" name="last_name" /></label>     
                <input type="submit" value="Search" /></p>
            </form>
            
        <h3>Delete based on job reference number:</h3>	
            <form action="deletejob.php" method="post">
                <p><label>Job Ref: <input type="text" name="referencenum" /></label>    
                <input type="submit" value="Delete" /></p>
            </form>

        <h3>Update Selection</h3> 
            

        <?php
            include "footer.inc";
        ?>
    </body>
</html>