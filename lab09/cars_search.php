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
        $query = "SELECT make, model, price, yom FROM cars  WHERE  make LIKE '$make%' AND model LIKE '$model%' AND price LIKE '$price%' AND yom LIKE '$yom%' ORDER BY make, model";
        $result = mysqli_query($conn, $query);

        if(!$result) {
            echo "<p class=\"wrong\">Something is wrong with ", $query, " </p>";

        } else {
            echo "<table border=\"1\">\n";
            echo "<tr>\n "
                ."<th scope=\"col\">Make</th>\n "
                ."<th scope=\"col\">Model</th>\n "
                ."<th scope=\"col\">Price</th>\n "
                ."<th scope=\"col\">YOM</th>\n "
                ."</tr>\n ";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>\n ";
                echo "<td>", $row["make"],"</td>\n";
                echo "<td>", $row["model"],"</td>\n";
                echo "<td>", $row["price"],"</td>\n";
                echo "<td>", $row["yom"],"</td>\n";
                echo "</tr>\n ";
            }
            echo "</table>\n";
        }
        mysqli_close($conn);
    }
?>