<?php
    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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

    if (isset ($_POST["age"])) {
        $age = $_POST["age"];
        $age = sanitise_input($age);
    }
    else {
        header ("location: register.html");
    }