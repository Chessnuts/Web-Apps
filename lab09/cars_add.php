<?php
    require_once ("settings.php");
    $conn = @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );

    $make = trim($_POST["carmake"]);
    $model = trim($_POST["carmodel"]);
    $price = trim($_POST["price"]);
    $yom = trim($_POST["yom"]);

    if (!$conn) {

        echo "<p>Database connection failure</p>";
    } else {
        $sql_table="cars";
        $query = "insert into $sql_table (make, model, price, yom) values ('$make', '$model', '$price', '$yom')";
        $result = mysqli_query($conn, $query);

        if(!$result) {
            echo "<p class=\"wrong\">Something is wrong with ", $query, " </p>";

        } else {
            echo "<p class=\"ok\"> successfully added New Car Record</p>";
        }
        mysqli_close($conn);
    }
?>