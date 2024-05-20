<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="About" />
        <meta name="keywords" content="html, css, javascript, about" />
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

        <h2 id="aboutpage"> About Me</h2>
            <dl>
                <dt>Name:</dt> <dd>Ryan Chessum</dd>
                <dt>Student Number:</dt> <dd>102564760</dd>
                <dt>Tutor:</dt> <dd>Zeqian Dong</dd>
                <dt>Course:</dt> <dd>Masters of Information Technology</dd>
                <dt>Contact:</dt> <dd><a href="mailto:ryan.chessum@gmail.com">ryan.chessum@gmail.com</a></dd>
            </dl> 
        <figure>
            <img src="images/me.JPG" alt="A picture of me" id="me"/>
        </figure>
        
        <h3 id="timetable">Timetable</h3>
        <table>
            <tr>
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
            <tr>
                <th>8:30-9:30</th>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>
            <tr>
                <th>9:30-10:30</th>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>Software Quality<br/>and Testing:<br/>Class</td>
                <td>----</td>
            </tr>
            <tr>
                <th>10:30-11:30</th>
                <td>----</td>
                <td>Technology Inquiry<br/>Project: Lecture</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>
            <tr>
                <th>11:30-12:30</th>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>
            <tr>
                <th>12:30-1:30</th>
                <td>Software Qulaity<br/>and Testing:<br/>Lecture</td>
                <td>----</td>
                <td>Data Management<br/>for the big data age:<br/>Lecture</td>
                <td>----</td>
                <td>----</td>
            </tr>
            <tr>
                <th>1:30-2:30</th>
                <td>----</td>
                <td>Data Management<br/>for the big data age:<br/>Lecture</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>
            <tr>
                <th>2:30-3:30</th>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>Technology Inquiry<br/>Project: Class</td>
                <td>----</td>
            </tr>
            <tr>
                <th>3:30-4:30</th>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>Technology Inquiry<br/>Project: Class</td>
                <td>----</td>
            </tr>
            <tr>
                <th>4:30-5:30</th>
                <td>Creating Web<br/>Appliactions: Lecture</td>
                <td>----</td>
                <td>----</td>
                <td>Data Management<br/>for the big data age:<br/>Class</td>
                <td>----</td>
            </tr>
            <tr>
                <th>5:30-6:30</th>
                <td>Creating Web<br/>Appliactions: Lecture</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>
            <tr>
                <th>6:30-7:30</th>
                <td>----</td>
                <td>Creating Web<br/>Applications: Class</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>
            <tr>
                <th>7:30-8:30</th>
                <td>----</td>
                <td>Creating Web<br/>Applications: Class</td>
                <td>----</td>
                <td>----</td>
                <td>----</td>
            </tr>
        </table>
        
        <?php
            include("footer.inc");
        ?>
    </body>
</html>