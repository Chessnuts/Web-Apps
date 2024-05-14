<?php
    session_start();
    if (!isset ($_SESSION["rand_number"])) {
        $_SESSION["rand_number"] = rand(1, 100);
        $_SESSION["guesses"] = 0;
        $_SESSION['giveup'] = false;
    }
    
    $message = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guess'])) {
        $guess = intval($_POST['guess']);
        
        if (!is_numeric($guess) || $guess < 1 || $guess > 100) {
            $message = "Please enter a number between 1 and 100.";
        } else {
            $_SESSION["guesses"]++;
            
            if ($guess > $_SESSION["rand_number"]) {
                $message = "Your guess is too high!";
            } elseif ($guess < $_SESSION["rand_number"]) {
                $message = "Your guess is too low!";
            } else {
                $message = "Congratulations! You guessed the number!";
            }
        }
    }

        
    if (isset($_GET['giveup']) && $_GET['giveup'] == 'true') {
        $message = "The correct number was: " . $_SESSION['rand_number'];
        $_SESSION['giveup'] = true;
    } 

    $show_form = !$_SESSION['giveup'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Playing with PHP Sessions" />
        <title>PHP Sessions Lab</title>
    </head>
    <body>
        <h1>Creating Web Apps - PHP Guessing Game</h1>
        <p>Enter a number between 1 and 100, then press the guess button</p>
        <?php if ($show_form) {
                echo '<form method="post" action="guessinggame.php">';
                echo '  <input type="text" name="guess">';
                echo '  <button type="submit">Guess</button>';
                echo '</form>';
            
                echo "<p>", $message , "</p>";
                echo "<p>Number of guesses: ", $_SESSION["guesses"], "</p>";

                echo '<p><a href="guessinggame.php?giveup=true">Give Up</a> | <a href="startover.php">Start Over</a></p>';
            } else {
                echo "<p>", $message , "</p>";
                echo '<p><a href="startover.php">Start Over</a></p>';
            }
        ?>
    </body>
</html>