<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Index" />
        <meta name="keywords" content="html, css, index, javascript" />
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

        <h2 id="indexpage"> Welcome to the RC IT Solutions</h2>
        <img src="images/RC.png" alt="RC" id="rc">
        <p>Welcome to the RC IT Solutions company website.</p>

        <h3>About Us</h3>
        <p>RC IT Solutions is a company that provides IT services for hire.</p>

        <h3>Careers</h3>
        <p>More about careers with RC IT Solutions can be found on this site. For information on what positions are availabe at the company, visit the <a href="jobs.html">jobs</a> page. <br/></p>

        <p>To apply for an availabe position, please fill out an application on the <a href="apply.html">Apply page.</a></p>

        <?php
            include("footer.inc");
        ?>
    </body>

</html>