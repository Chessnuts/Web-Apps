<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Enhancements" />
        <meta name="keywords" content="html, css, enhancements" />
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

        <h2 id="enhancementspage" >Enhancements</h2>
        
        <section class="vertical_section">
            <h2>Enhancement 1 - Responsive Layout</h2>
            <p> 
                I made a responsive layout that makes the page more neat for smaller screens. 
                When the screen is smaller, the nav menu is adjusted to fit in the screen.
                The logo at the top of the page dissapears if the window is made a little smaller.
                On the <a href="jobs.html">Jobs page</a> the section and aside elements change their css style based on the screen size so that the text is more readable.
                On the <a href="about.html">About page</a> the definition list elements style is changed so that the definitions are still in line with each other.
            </p>
        </section>

        <section class="vertical_section">
            <h2>Enhancement 2 - Responsive form</h2>
            <p> 
                On the <a href="apply.html">Apply page</a> 
                I used the "+" selector in css to make certain html elements appear based on what form elements are selected.
                So if "web development" is checked, web development skill checkboxes are displayed. 
                If "Other Skills" is selected, then the text area element to enter other skills is also displayed.
            </p>
        </section>
        <p><br></p>
        <p><br></p>
        
        <?php
            include("footer.inc");
        ?>
    </body>
</html>