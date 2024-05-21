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
                    $msg = "Invalid postcode for Victoria <br>";
                }
                break;
            case "nsw":
                if ($firstChar !== "1" && $firstChar !== "2") {
                    $msg = "Invalid postcode for New South Wales <br>";
                }
                break;
            case "qld":
                if ($firstChar !== "4" && $firstChar !== "9") {
                    $msg = "Invalid postcode for Queensland <br>";
                }
                break;
            case "nt":
            case "act":
                if ($firstChar !== "0") {
                    $msg = "Invalid postcode for a territory <br>";
                }
                break;
            case "sa":
                if ($firstChar !== "5") {
                    $msg = "Invalid postcode for South Australia <br>";
                }
                break;
            case "wa":
                if ($firstChar !== "6") {
                    $msg = "Invalid postcode for Western Australia <br>";
                }
                break;
            case "tas":
                if ($firstChar !== "7") {
                    $msg = "Invalid postcode for Tasmania <br>";
                }
                break;
            default:
                $msg = "Invalid state <br>";
        }
    
        return $msg;
    }

    require_once('settings.php');
   

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset ($_POST["job_reference_number"])) {
            $jobReferenceNumber = $_POST["job_reference_number"];
            $jobReferenceNumber = sanitise_input($jobReferenceNumber);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["first_name"])) {
            $firstname = $_POST["first_name"];
            $firstname = sanitise_input($firstname);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["last_name"])) {
            $lastname = $_POST["last_name"];
            $lastname = sanitise_input($lastname);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["dob"])) {
            $dateOfBirth = $_POST["dob"];
            $dateOfBirth = sanitise_input($dateOfBirth);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["gender"])) {
            $gender = $_POST["gender"];
            $gender = sanitise_input($gender);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["address"])) {
            $address = $_POST["address"];
            $address = sanitise_input($address);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["suburb"])) {
            $suburb = $_POST["suburb"];
            $suburb = sanitise_input($suburb);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["postcode"])) {
            $postcode = $_POST["postcode"];
            $postcode = sanitise_input($postcode);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["email"])) {
            $email = $_POST["email"];
            $email = sanitise_input($email);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["skills"])) {
            $skills = $_POST["skills"];
            $skills = sanitise_input($skills);
        }
        else {
            header ("location: apply.php");
        }

        if (isset ($_POST["otherskills"])) {
            $otherskills = $_POST["otherskills"];
            $otherskills = sanitise_input($otherskills);
        }
        else {
            header ("location: apply.php");
        }

        // Validate Reference Number
        if (!preg_match('/^[a-zA-Z0-9]{5}$/', $jobReferenceNumber)) {
            $errors[] = "Incorrect reference number format";
            $result = false;
        }

        // Validate First Name
        if (!preg_match('/^[a-zA-Z]+$/', $firstName)) {
            $errors[] = "First name can only include alpha characters";
            $result = false;
        }

        // Validate Last Name
        if (!preg_match('/^[a-zA-Z\-]+$/', $lastName)) {
            $errors[] = "Your last name must only contain alpha characters and hyphens";
            $result = false;
        }

        // Validate Date of Birth
        if (!preg_match('/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/', $dateOfBirth)) {
            $errors[] = "Date format not valid";
            $result = false;
        } else {
            $dateParts = explode('/', $dateOfBirth);
            if (count($dateParts) == 3) {
                $day = (int)$dateParts[0];
                $month = (int)$dateParts[1];
                $year = (int)$dateParts[2];

                if (!checkdate($month, $day, $year)) {
                    $errors[] = "Date of birth is not a valid date";
                    $result = false;
                } else {
                    $age = (date('Y') - $year) - ((date('md') < $month . $day) ? 1 : 0);
                    if ($age < 15 || $age > 80) {
                        $errors[] = "Age must be between 15 and 80 years";
                        $result = false;
                    }
                }
            }
        }

        // Validate Gender
        if (empty($gender)) {
            $errors[] = "Gender not selected";
            $result = false;
        }

        // Validate Street Address
        if (strlen($streetAddress) > 40 || empty($streetAddress)) {
            $errors[] = "Address not valid format";
            $result = false;
        }

        // Validate Suburb
        if (strlen($suburb) > 40 || empty($suburb)) {
            $errors[] = "Suburb not valid format";
            $result = false;
        }

        // Validate State
        $validStates = ['vic', 'nsw', 'qld', 'nt', 'wa', 'sa', 'tas', 'act'];
        if (!in_array(strtolower($state), $validStates)) {
            $errors[] = "State not selected";
            $result = false;
        }

        // Validate Post Code
        if (!preg_match('/^[0-9]{4}$/', $postcode)) {
            $errors[] = "Postcode not valid format";
            $result = false;
        } else {
            // Assuming checkPostcode function exists to validate postcode against state
            $pcMsg = checkPostcode($postcode, $state);
            if ($pcMsg != "") {
                $errors[] = $pcMsg;
                $result = false;
            }
        }

        // Validate Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email not valid format";
            $result = false;
        }

        // Validate Phone Number
        if (!preg_match('/^[0-9 ]{8,12}$/', $phoneNumber)) {
            $errors[] = "Phone Number not valid format";
            $result = false;
        }

        // Validate Other Skills
        if (isset($_POST["other"]) && empty($otherSkills)) {
            $errors[] = "Other skills box was checked but no input was given";
            $result = false;
        }
    }



    if ($result) {

        $conn = @mysqli_connect($host,
        $user,
        $pwd,
        $sql_db);


        if (!$conn) {
            $errors[] = "Database connection failed";
            $result = false;
        } else {
            $sql_table = "eoi";
            $status = 'new';
            $skillsStr = implode(", ", $skills); // Converting array of skills to string

            $query = "INSERT INTO $sql_table 
                (refnum, firstname, lastname, age, address, suburb, state, postcode, email, phone, skills, otherskills, status) 
                VALUES 
                ('$jobReferenceNumber', '$firstName', '$lastName', '$age', '$streetAddress', '$suburb', '$state', '$postcode', '$email', '$phoneNumber', '$skillsStr', '$otherSkills', '$status')";

            $result = mysqli_query($conn, $query);
            if (!$result) {
                $errors[] = "Failed to insert data into database";
            }

            mysqli_close($conn);
        }
    }


    // Display errors if any
    if (!empty($errors)) {
        echo '<div id="error_message"><p>' . implode('<br>', $errors) . '</p></div>';
    } else {
        echo '<div id="error_message"><p>Application submitted successfully!</p></div>';
    }

    // Redirect back to form if there are errors
    if (!$result) {
        header("Location: apply.php");
    }
?>