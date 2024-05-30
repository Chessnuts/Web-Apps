<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Apply" />
        <meta name="keywords" content="html, css, apply, javascript" />
        <meta name="author" content="Ryan Chessum"  />

        <title>Assignment 2</title>
    
        <link href="styles/style.css" rel="stylesheet" />
        <!--<script src="scripts/apply.js"></script> -->
        <script src="scripts/enhancements.js"></script>
    
    </head>
    <body>
        <?php
            include("header.inc");
        ?>

        <h2 id="applypage">Job Application form</h2>
        <p>Please apply for a job using the form below</p>

        <form id="apply_form" method="post" action="processEOI.php" novalidate="novalidate">
	
            <fieldset>
                <legend>Job Reference</legend>
                <p>
                    <!-- Job Reference Number Input -->
                    <!-- exactly 5 alphanumeric characters -->
                    <label for="job_reference_number">Job Reference Number</label> 
                    <input type="text" name="job_reference_number" id="job_reference_number" pattern="[A-Za-z0-9]{5}" required="required" readonly=""/>
                </p>
            </fieldset>
            <fieldset>
                <legend>Personal Details</legend>
                <p>
                    <!-- Name input -->

                    <!-- First Name input -->
                    <!-- max 20 alpha characters -->
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" maxlength="20" minlength="1" pattern="[A-Za-z]{1,20}" size="20" required="required"/>
                    
                    <br/>
                    <br/>
                    <!-- Last Name input -->
                    <!-- max 20 alpha characters -->
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" maxlength="20" minlength="1" pattern="[A-Za-z]{1,20}" size="20" required="required"/>
                </p>
            
                    <!-- Date of Birth -->
                    <!-- dd/mm/yyyy -->
                <p>
                    <label>Date of Birth<input id="dob" type="text" name="dob" size="10" placeholder="dd/mm/yyyy" pattern="\d{1,2}/\d{1,2}/\d{4}" required="required" /></label>
                </p>

            </fieldset>
            
            <fieldset>

                <!-- Gender -->
                <!-- radio inputs grouped using a fieldset and legend -->
                <legend>Gender</legend>
                <p>
                    <label><input type="radio" name="gender" id="male" value="male" required="required" />Male</label>
                    <label><input type="radio" name="gender" id="female" value="female" />Female</label>
                    <label><input type="radio" name="gender" id="other" value="other" />Other</label>
                </p>
            </fieldset>
            
            <fieldset>
                <legend>Contact Information</legend>
                <!-- Street Adress -->
                <!-- max 40 characters -->
                <p>
                    <label for="street_address">Street Address</label>
                    <input type="text" name="street_address" id="street_address" maxlength="40" minlength="1" size="40" required="required"/>
                </p>

                <!-- Suburb/Town -->
                <!-- max 40 characters -->
                <p>
                    <label for="suburb">Suburb/Town</label>
                    <input type="text" name="suburb" id="suburb" maxlength="40" minlength="1" size="20" required="required"/>
                </p>

                <!-- State -->
                <!-- drop down selection from VIC,NSW,QLD,NT,WA,SA,TAS,ACT -->
                <p>
                <label for="state">State</label> 
                    <select name="state" id="state">
                        <option value="vic">VIC</option>			
                        <option value="nsw">NSW</option>
                        <option value="qld">QLD</option>
                        <option value="nt">NT</option>
                        <option value="sa">SA</option>
                        <option value="wa">WA</option>
                        <option value="tas">TAS</option>
                        <option value="act">ACT</option>
                    </select>
                </p>

                <!-- Postcode -->
                <!-- exactly 4 digits -->
                <p>
                    <label for="postcode">Postcode</label> 
                        <input type="text" name="postcode" id="postcode" maxlength="4" minlength="4" pattern="[0-9]{4}" size="4" required="required"/>
                </p>
                
                <!-- Email Address -->
                <!-- validate format -->
                <p>
                    <label>Email</label>
                        <input type="email" id="email" name="email"  size="40" required="required"/>
                </p>
                
                <!-- Phone Number -->
                <!-- 8 to 12 digits, or spaces-->
                <p>
                    <label for="phone">Phone Number</label> 
                        <input type="text" name="phone" id="phone" pattern="[0-9 ]{8,12}" maxlength="12" minlength="8" size="12" required="required"/>
                </p>
            </fieldset>

            <fieldset>
                <legend>Skills</legend>
                <!-- Skills -->
                <!-- checkbox inputs -->
                <p>Skills:</p>
                <label class="expand" for="programming">Programming</label> 
                <input type="checkbox" id="programming" class="skill_box" name="skills[]" value="programming"/>
                <p class="hidden">
                    Languages: <br/><br/>
                    <label for="cpp">C++</label> 
                        <input type="checkbox" id="cpp" class="skill_box" name="skills[]" value="cpp"/>
                    
                    <label for="csharp">C#</label> 
                        <input type="checkbox" id="csharp" class="skill_box" name="skills[]" value="csharp"/>
                    
                    <label for="java">Java</label> 
                        <input type="checkbox" id="java" class="skill_box" name="skills[]" value="java"/>
                    
                    <label for="python">Python</label> 
                        <input type="checkbox" id="python" class="skill_box" name="skills[]" value="python"/>
                </p>

                <label class="expand" for="web_development">Web Development</label> 
                <input type="checkbox" id="web_development" class="skill_box" name="skills[]" value="web_development"/>

                <p class="hidden">
                        <label for="html">HTML</label> 
                            <input type="checkbox" id="html" class="skill_box" name="skills[]" value="html" />
                        
                        <label for="css">CSS</label> 
                            <input type="checkbox" id="css" class="skill_box" name="skills[]" value="css"/>
                        
                        <label for="javascript">JavaScript</label> 
                            <input type="checkbox" id="javascript" class="skill_box" name="skills[]" value="javascript"/>
                        
                        <label for="php">PHP</label> 
                            <input type="checkbox" id="php" class="skill_box" name="skills[]" value="php"/>
                        
                        <label for="mysql">MySQL</label> 
                            <input type="checkbox" id="mysql" class="skill_box" name="skills[]" value="mysql"/>
                </p>

                <!-- Other Skills -->
                <p>
                    <label for="otherskills">Other Skills</label>
                    <input class="box" type="checkbox" id="other_checkbox" name="other" value="other" />
                    <textarea class="hidden" id="otherskills" name="otherskills" rows="12" cols="40" placeholder="List other skills here"></textarea>
                </p> 
                  
            </fieldset>
            <span id="error_message">

            </span>
            <input type="submit" value="submit" />
            <input type="reset" value="reset application" />
        </form>
        <p><br></p>

        <?php
            include("footer.inc");
        ?>
    </body>
</html>