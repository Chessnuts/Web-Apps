<?php
    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function checkPostcode($postcode, $state) {
        $state = strtolower($state);
        $msg = "";
        $firstChar = $postcode[0];
    
        switch ($state) {
            case "vic":
                if ($firstChar !== "3" && $firstChar !== "8") {
                    $msg = "<p>Invalid postcode for Victoria </p>";
                }
                break;
            case "nsw":
                if ($firstChar !== "1" && $firstChar !== "2") {
                    $msg = "<p>Invalid postcode for New South Wales </p>";
                }
                break;
            case "qld":
                if ($firstChar !== "4" && $firstChar !== "9") {
                    $msg = "<p>Invalid postcode for Queensland </p>";
                }
                break;
            case "nt":
            case "act":
                if ($firstChar !== "0") {
                    $msg = "<p>Invalid postcode for a territory </p>";
                }
                break;
            case "sa":
                if ($firstChar !== "5") {
                    $msg = "<p>Invalid postcode for South Australia </p>";
                }
                break;
            case "wa":
                if ($firstChar !== "6") {
                    $msg = "<p>Invalid postcode for Western Australia </p>";
                }
                break;
            case "tas":
                if ($firstChar !== "7") {
                    $msg = "<p>Invalid postcode for Tasmania </p>";
                }
                break;
            default:
                $msg = "<p>Invalid state </p>";
        }
    
        return $msg;
    }

    require_once('settings.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Apply" />
        <meta name="keywords" content="html, css, apply, javascript" />
        <meta name="author" content="Ryan Chessum"  />

        <title>Assignment 2</title>
    
        <link href="styles/style.css" rel="stylesheet" />
        <script src="scripts/apply.js"></script>
        <script src="scripts/enhancements.js"></script>
    
    </head>
    <body>
        <?php
            include("header.inc");
        ?>
        <h2>WIP FOR TESTING!! SET TO REDIRECT LATER</h2>
        <h2 id="applypage">Job Application form</h2>

        <?php
            $error_msg = "";
            $result = true;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST["job_reference_number"])) {
                    $jobReferenceNumber = sanitise_input($_POST["job_reference_number"]);
                } else {
                    $error_msg .= "<p>Job reference number not set.</p>";
                    $result = false;
                }

                if (isset($_POST["first_name"])) {
                    $firstName = sanitise_input($_POST["first_name"]);
                } else {
                    $error_msg .= "<p>First name not set.</p>";
                    $result = false;
                }

                if (isset($_POST["last_name"])) {
                    $lastName = sanitise_input($_POST["last_name"]);
                } else {
                    $error_msg .= "<p>Last name not set.</p>";
                    $result = false;
                }

                if (isset($_POST["dob"])) {
                    $dateOfBirth = sanitise_input($_POST["dob"]);
                } else {
                    $error_msg .= "<p>Date of birth not set.</p>";
                    $result = false;
                }

                if (isset($_POST["gender"])) {
                    $gender = sanitise_input($_POST["gender"]);
                } else {
                    $error_msg .= "<p>Gender not set.</p>";
                    $result = false;
                }

                if (isset($_POST["street_address"])) {
                    $address = sanitise_input($_POST["street_address"]);
                } else {
                    $error_msg .= "<p>Address not set.</p>";
                    $result = false;
                }

                if (isset($_POST["suburb"])) {
                    $suburb = sanitise_input($_POST["suburb"]);
                } else {
                    $error_msg .= "<p>Suburb not set.</p>";
                    $result = false;
                }

                if (isset($_POST["state"])) {
                    $state = sanitise_input($_POST["state"]);
                } else {
                    $error_msg .= "<p>State not set.</p>";
                    $result = false;
                }

                if (isset($_POST["postcode"])) {
                    $postcode = sanitise_input($_POST["postcode"]);
                } else {
                    $error_msg .= "<p>Postcode not set.</p>";
                    $result = false;
                }

                if (isset($_POST["email"])) {
                    $email = sanitise_input($_POST["email"]);
                } else {
                    $error_msg .= "<p>Email not set.</p>";
                    $result = false;
                }

                if (isset($_POST["phone"])) {
                    $phone = sanitise_input($_POST["phone"]);
                } else {
                    $error_msg .= "<p>Phone Number not set.</p>";
                    $result = false;
                }

                if (isset($_POST["skills"])) {   
                    $skills = $_POST["skills"]; 
                } else {
                    $skills = [];
                }

                if (isset($_POST["otherskills"])) {   
                    $otherSkills = sanitise_input($_POST["otherskills"]); 
                } else {
                    $otherSkills = "";
                } 

                // Validate Reference Number
                if (!preg_match('/^[a-zA-Z0-9]{5}$/', $jobReferenceNumber)) {
                    $error_msg .= "<p>Incorrect reference number format</p>";
                    $result = false;
                }

                // Validate First Name
                if (!preg_match('/^[a-zA-Z]+$/', $firstName)) {
                    $error_msg .= "<p>First name can only include alpha characters</p>";
                    $result = false;
                }

                // Validate Last Name
                if (!preg_match('/^[a-zA-Z\-]+$/', $lastName)) {
                    $error_msg .= "<p>Your last name must only contain alpha characters and hyphens</p>";
                    $result = false;
                }

                // Validate Date of Birth
                if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dateOfBirth)) {
                    $error_msg .= "<p>Date format not valid</p>";
                    $result = false;
                } else {
                    $dateParts = explode('/', $dateOfBirth);
                    if (count($dateParts) == 3) {
                        $day = (int)$dateParts[0];
                        $month = (int)$dateParts[1];
                        $year = (int)$dateParts[2];

                        if (!checkdate($month, $day, $year)) {
                            $error_msg .= "<p>Date of birth is not a valid date</p>";
                            $result = false;
                        } else {
                            $age = (date('Y') - $year) - ((date('md') < $month . $day) ? 1 : 0);
                            if ($age < 15 || $age > 80) {
                                $error_msg .= "<p>Age must be between 15 and 80 years</p>";
                                $result = false;
                            }
                        }
                    }
                }

                // Validate Street Address
                if (strlen($address) > 40 || empty($address)) {
                    $error_msg .= "<p>Address not valid format</p>";
                    $result = false;
                }

                // Validate Suburb
                if (strlen($suburb) > 40 || empty($suburb)) {
                    $error_msg .= "<p>Suburb not valid format</p>";
                    $result = false;
                }

                // Validate State
                $validStates = ['vic', 'nsw', 'qld', 'nt', 'wa', 'sa', 'tas', 'act'];
                if (!in_array(strtolower($state), $validStates)) {
                    $error_msg .= "<p>State not valid</p>";
                    $result = false;
                }

                // Validate Postcode
                if (!preg_match('/^[0-9]{4}$/', $postcode)) {
                    $error_msg .= "<p>Postcode not valid format</p>";
                    $result = false;
                } else {
                    $pcMsg = checkPostcode($postcode, $state);
                    if ($pcMsg != "") {
                        $error_msg .= $pcMsg;
                        $result = false;
                    }
                }

                // Validate Email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error_msg .= "<p>Email not valid format</p>";
                    $result = false;
                }

                // Validate Phone Number
                if (!preg_match('/^[0-9 ]{8,12}$/', $phone)) {
                    $error_msg .= "<p>Phone Number not valid format</p>";
                    $result = false;
                }

                // Validate Other Skills
                if (isset($_POST["other"]) && empty($otherSkills)) {
                    $error_msg .= "<p>Other skills box was checked but no input was given</p>";
                    $result = false;
                }

                if ($result) {
                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                    if (!$conn) {
                        $error_msg .= "<p>Database connection failed</p>";
                        $result = false;
                    } else {
                        $query = "CREATE TABLE IF NOT EXISTS eoi (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            referencenum VARCHAR(5) NOT NULL,
                            first_name VARCHAR(20) NOT NULL,
                            last_name VARCHAR(20) NOT NULL,
                            dob VARCHAR(10),
                            gender VARCHAR(10) NOT NULL,
                            address VARCHAR(40) NOT NULL,
                            suburb VARCHAR(40) NOT NULL,
                            postcode VARCHAR(4) NOT NULL,
                            state VARCHAR(3) NOT NULL,
                            email VARCHAR(40) NOT NULL,
                            phone VARCHAR(20) NOT NULL,
                            skills VARCHAR(150),
                            otherskills VARCHAR(1000),
                            status VARCHAR(20) NOT NULL
                        );";

                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $sql_table = "eoi";
                            $status = 'new';
                            $skillsStr = implode(", ", $skills);

                            $query = "INSERT INTO $sql_table 
                                (referencenum, first_name, last_name, dob, gender, address, suburb, postcode, state, email, phone, skills, otherskills, status) 
                                VALUES 
                                ('$jobReferenceNumber', '$firstName', '$lastName', '$dateOfBirth', '$gender', '$address', '$suburb', '$postcode', '$state', '$email', '$phone', '$skillsStr', '$otherSkills', '$status')";

                            $insert_result = mysqli_query($conn, $query);
                            if (!$insert_result) {
                                $error_msg .= "<p>Failed to insert data into database</p>";
                            }
                        } else {
                            $error_msg .= "<p>Failed to create table</p>";
                        }
                        mysqli_close($conn);
                    }
                }

                if (!$result) {
                    echo "<p>Error</p>";
                    echo "<p>Could not submit application</p>";
                    echo $error_msg;
                } else {
                    echo "<p>Application submitted successfully</p>";
                }
            } else {
                echo "<p>Error</p>";
                echo "<p>No form was submitted</p>";
            }
            //header("location:apply.php")
        ?>
        <p><a href="apply.php">Return to apply form.</a></p>

        <?php 
	        include 'footer.inc';
        ?>
    </body>
</html>
