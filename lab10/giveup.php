<?php
    session_start();
    if (isset($_SESSION['rand_number'])) {
        $rand_number = $_SESSION['rand_number'];
        echo "<p>The number is", $rand_number , "</p>";
    } else {
        echo "<p>error, no number</p>"
    }
?>