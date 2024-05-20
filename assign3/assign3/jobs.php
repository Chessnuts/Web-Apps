<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Jobs" />
        <meta name="keywords" content="html, css, jobs, javascript" />
        <meta name="author" content="Ryan Chessum"  />

        <title>Assignment 2</title>
    
        <link href="styles/style.css" rel="stylesheet" />
        <script src="scripts/enhancements.js"></script>
        <script src="scripts/apply.js"></script>
        
    
    </head>
    <body>
        <?php
            include("header.inc");
        ?>

        <h2 id="jobpage">Jobs</h2>
        <p>Here are the list of Jobs available at the company. Please look at the listings below for details on applicant requirements.</p>

        <aside>
            <h2> How do I apply? </h2>
            <ol>
                <li>Go to the <a href="apply.html">'apply'</a> page</li>
                <li>Enter the job reference number for the job you wish to apply for into the form.</li>
                <li>Fill in the rest of your details and skills.</li>
                <li>Press the 'submit' button</li>
            </ol>
        </aside>
        <span id="jobs">
            
        </span>
        
        <?php
            include("footer.inc");
        ?>

    </body>
</html>