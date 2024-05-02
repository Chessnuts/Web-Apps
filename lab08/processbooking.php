<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rohirrim Booking</title>
        <meta charset="utf-8"/>
        <meta name="description" content="Rohirrim Booking Form" />
        <meta name="keywords"    content=" " />
    </head>
    <?php
        function sanitise_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    <body>
        <header>
            <h1>Rohirrim Tour Booking</h1>
        </header>
        <?php
            if (isset ($_POST["firstname"])) {
                $firstname = $_POST["firstname"];
                $firstname = sanitise_input($firstname);
                //echo "<p>This is a test: Your first name is $firstname</p>";
            }
            else {
                header ("location: register.html");
            }

            if (isset ($_POST["lastname"])) {
                $lastname = $_POST["lastname"];
                $lastname = sanitise_input($lastname);
                //echo "<p>This is a test: Your last name is $lastname</p>";
            }
            else {
                header ("location: register.html");
            }

            if (isset ($_POST["age"])) {
                $age = $_POST["age"];
                $age = sanitise_input($age);
                //echo "<p>This is a test: Your age is $age</p>";
            }
            else {
                header ("location: register.html");
            }

            if (isset ($_POST["food"])) {
                $food = $_POST["food"];
                $food = sanitise_input($food);
                //echo "<p>This is a test: Your food is: $food</p>";
            }
            else {
                header ("location: register.html");
            }

            if (isset ($_POST["partySize"])) {
                $partySize = $_POST["partySize"];
                //echo "<p>This is a test: Your party size is $partySize</p>";
            }
            else {
                header ("location: register.html");
            }

            if (isset ($_POST["species"])) {
                $species = $_POST["species"];
            }
            else {
                header ("location: register.html");
            }

            $tour = "";
            if (isset ($_POST["1day"])) {
                $tour .= "One-day tour ";
            }
            if (isset ($_POST["4day"])) {
                $tour .= "Four-day tour ";
            }
            if (isset ($_POST["10day"])) {
                $tour .= "Ten-day tour ";
            }
            if ($tour == ""){
                header ("location: register.html");
            }

            $errMsg = "";

            if ($firstname=="") {
                $errMsg .= "<p>You must enter a first name.</p>";
            }
            else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
                $errMsg .= "<p>Only alpha letters allowed in the first name.</p>";
            }

            if ($lastname=="") {
                $errMsg .= "<p>You must enter a last name.</p>";
            }
            else if (!preg_match("/^[a-zA-Z\-]*$/", $lastname)) {
                $errMsg .= "<p>Only alpha letters and hyphens allowed in the last name.</p>";
            }

            if (!is_numeric($age)) {
                $errMsg .= "<p>You must enter a number for your age.</p>";
            }
            else if ($age < 10 || $age > 10000){
                $errMsg .= "<p>Age not suitable for tour.</p>";
            }

            if ($errMsg != ""){
                echo "<p>$errMsg</p>";
            }
            else {
                echo "<p>
                    Welcome $firstname $lastname <br>
                    You are booked on the $tour <br>
                    Species: $species <br>
                    Age: $age <br>
                    Meal preference: $food <br>
                    Number of Travellers: $partySize
                </p>";
            }
        ?>
    </body>

</html>