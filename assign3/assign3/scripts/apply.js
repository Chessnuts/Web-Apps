/**
    filename: apply.js
    author: Ryan Chessum 102564760
    description: Assignment 2 Javascript
*/

"use strict";

//validation
function validate() {
	
	//for the error message
	var errMsg = "";
	var result = true;
	
    // Form Variables
    var jobReferenceNumber = document.getElementById("job_reference_number").value;
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value;
    var dateOfBirth = document.getElementById("dob").value;

    var isMale = document.getElementById("male").checked;
    var isFemale = document.getElementById("female").checked;
    var isOther = document.getElementById("other").checked;
    var gender = "";

    var streetAddress = document.getElementById("street_address").value;
    var suburb = document.getElementById("suburb").value;

    var state = document.getElementById("state").value;
    var postcode = document.getElementById("postcode").value;

    var email = document.getElementById("email").value;
    var phoneNumber = document.getElementById("phone").value;

    var osBox = document.getElementById("other_checkbox").checked;
    var otherSkills = document.getElementById("otherskills").value;




    //Form Check
//------------------------------------------
    // Reference Number
    if(!jobReferenceNumber.match(/^[a-zA-Z0-9]{5}$/)){
        errMsg += "Incorrect reference number format <br>";
        result = false;
    }
    // First Name
	if (!firstName.match(/^[a-zA-Z]+$/)){
        errMsg += "First name can only include alpha characters <br>";
        result = false;
    }
    // Last name
	if (!lastName.match(/^[a-zA-Z\-]+$/)){
		errMsg += "Your last name must only contain alpha characters and hyphens <br>";
		result = false;
	}
    // Date of birth
    // Check format
    if (!dateOfBirth.match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/)){
        //Regex from: https://stackoverflow.com/questions/15491894/regex-to-validate-date-formats-dd-mm-yyyy-dd-mm-yyyy-dd-mm-yyyy-dd-mmm-yyyy
        errMsg += "Date format not valid <br>";
		result = false;
    }
    else { //check age

        var ageMessage = checkAge(dateOfBirth);

        if (ageMessage != ""){
            errMsg += ageMessage;
            result = false;
        }
    }
    // Gender
    if (!(isMale || isFemale || isOther)){
        errMsg += "Gender not selected <br>";
        result = false;
    }
    else{
        if (isMale){
            gender = "male";
        }
        else if (isFemale){
            gender = "female";
        }
        else if (isOther){
            gender = "other";
        }
    }
    // Street Address
    if (!streetAddress.match(/^.{1,40}$/)){
        errMsg += "Address not valid format <br>";
        result = false;
    }
    // Suburb Town
    if (!suburb.match(/^.{1,40}$/)){
        errMsg += "Suburb not valid format <br>";
        result = false;
    }
    //state
    if (state.value === 'none'){
        errMsg += "State not selected <br>";
        result = false;
    }
    // Post Code
    if (!postcode.match(/^[0-9]{4}$/)){
        errMsg += "Postcode not valid format <br>";
        result = false;
    }
    else {
        var pcMsg = checkPostcode(postcode, state);

        if (pcMsg != ""){
            errMsg += pcMsg;
            result = false;
        }
    }
    // Email
    if (!email.match(/^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]+$/)){
        errMsg += "Email not valid format <br>";
        result = false;
    }
    // Phone Number
    if (!phoneNumber.match(/^[0-9 ]{8,12}$/)){
        errMsg += "Phone Number not valid format <br>";
        result = false;
    }

    // Other Skills
	if (osBox && otherSkills == ''){
        errMsg += "Other skills box was checked but no input was given <br>";
        result = false;
    }
    else if(!osBox){ // for changing form when otherskills dissapears
        document.getElementById("otherskills").value = "";
    }

	// Display error message
	if (errMsg != "" || result == false) {
		var messageBox = document.getElementById("error_message");
        messageBox.innerHTML = '<p id="em"> ' + errMsg + '</p>';
		result = false;
	}

    //save data input to session storage
	if (result == true) {
	    saveForm(
            jobReferenceNumber, 
            firstName, 
            lastName, 
            dateOfBirth,
            gender, 
            streetAddress, 
            suburb, 
            postcode, 
            state, 
            email, 
            phoneNumber, 
            otherSkills
        );
	}
	
	//resets the error
	return result;
}

function checkAge(dob){
    var msg = "";
    var CurrentDate = new Date();

    var dobComponents = dob.split(/[\/. ]/);
    var d = parseInt(dobComponents[0]);
    var m = parseInt(dobComponents[1]) - 1;
    var y = parseInt(dobComponents[2]);

	var dateOfBirth = new Date(y, m, d);

    var age = CurrentDate.getFullYear() - dateOfBirth.getFullYear();
    var month = CurrentDate.getMonth() - dateOfBirth.getMonth();
    var day = CurrentDate.getDate() - dateOfBirth.getDate();
    
    if(month < 0 || (month === 0 && day < 0)){
        age--;
    }
    if(age < 15 || age > 80){
		msg = "Age not suitable for position <br>";
	}

    return msg;
}

function checkPostcode(pc, s) {
    var state = s.toLowerCase();
    var msg = "";

    var firstChar = pc.charAt(0);

    // Check the first character of the postcode based on state
    switch (state) {
        case "vic":
            if (firstChar !== "3" && firstChar !== "8") {
                msg = "Invalid postcode for Victoria <br>";
            }
            break;
        case "nsw":
            if (firstChar !== "1" && firstChar !== "2") {
                msg = "Invalid postcode for New South Wales <br>";
            }
            break;
        case "qld":
            if (firstChar !== "4" && firstChar !== "9") {
                msg = "Invalid postcode for Queensland <br>";
            }
            break;
        case "nt":
        case "act":
            if (firstChar !== "0") {
                msg = "Invalid postcode for a territory <br>";
            }
            break;
        case "sa":
            if (firstChar !== "5") {
                msg = "Invalid postcode for South Australia <br>";
            }
            break;
        case "wa":
            if (firstChar !== "6") {
                msg = "Invalid postcode for Western Australia <br>";
            }
            break;
        case "tas":
            if (firstChar !== "7") {
                msg = "Invalid postcode for Tasmania <br>";
            }
            break;
        default:
            msg = "Invalid state <br>";
    }

    return msg;
}

function saveForm(refNum, firstName, lastName, dob, gender, address, suburb, postcode, state, email, phone, otherSkills) {
    if (typeof(Storage) != "undefined") {
        sessionStorage.setItem("refNum", refNum);
        sessionStorage.setItem("firstName", firstName);
        sessionStorage.setItem("lastName", lastName);
        sessionStorage.setItem("dob", dob);
        sessionStorage.setItem("gender", gender);
        sessionStorage.setItem("address", address);
        sessionStorage.setItem("suburb", suburb);
        sessionStorage.setItem("postcode", postcode);
        sessionStorage.setItem("state", state);
        sessionStorage.setItem("email", email);
        sessionStorage.setItem("phone", phone);
        sessionStorage.setItem("otherSkills", otherSkills);
        
        // Store the state of each checkbox
        var skillBoxes = document.getElementsByClassName("skill_box");
        var skillBoxValues = [];
        for (var i = 0; i < skillBoxes.length; i++) {
            // Convert boolean to string "1" or "0"
            skillBoxValues.push(skillBoxes[i].checked ? "1" : "0"); 
        }
        // Convert array to comma-separated string before storing
        sessionStorage.setItem("skillBoxes", skillBoxValues.join(",")); 
    }
}

function loadForm() {
    if (typeof(Storage) != "undefined") {
        document.getElementById("job_reference_number").value = sessionStorage.getItem("refNum");
        document.getElementById("first_name").value = sessionStorage.getItem("firstName");
        document.getElementById("last_name").value = sessionStorage.getItem("lastName");
        document.getElementById("dob").value = sessionStorage.getItem("dob");
        document.getElementById("street_address").value = sessionStorage.getItem("address");
        document.getElementById("suburb").value = sessionStorage.getItem("suburb");
        document.getElementById("postcode").value = sessionStorage.getItem("postcode");
        document.getElementById("state").value = sessionStorage.getItem("state");
        document.getElementById("email").value = sessionStorage.getItem("email");
        document.getElementById("phone").value = sessionStorage.getItem("phone");
        document.getElementById("otherskills").value = sessionStorage.getItem("otherSkills");

        if (sessionStorage.getItem("otherSkills") !== "") {
            document.getElementById("other_checkbox").checked = true;
        }

        var gender = sessionStorage.getItem("gender");
        if (gender !== null) {
            switch(gender) {
                case "male":
                    document.getElementById("male").checked = true;
                    break;
                case "female":
                    document.getElementById("female").checked = true;
                    break;
                case "other":
                    document.getElementById("other").checked = true;
                    break;
                default:
                    break;
            }
        }

        // Check if the skillBoxes item exists
        var skillBoxes = sessionStorage.getItem("skillBoxes");
        if (skillBoxes !== null) {
            // Split the comma-separated string back to array
            var skillBoxValues = skillBoxes.split(","); 
            var skillBoxes = document.getElementsByClassName("skill_box");
            for (var i = 0; i < skillBoxes.length; i++) {
                //Convert string "1" or "0" back to boolean and set checkbox
                skillBoxes[i].checked = skillBoxValues[i] === "1";
            }
        }
    }
}

//reference number auto fill
function setRefNum(number){
	if (typeof(Storage)!= "undefined"){
            console.log("stepped");
            sessionStorage.setItem("refNum", number);
	}
}

function init() {
    if (document.getElementById("jobpage") != null) {
        var jobs = document.getElementsByClassName("refNum");
        for (var i = 0; i < jobs.length; i++){
            jobs[i].onclick = (function(job) {
                return function() { setRefNum(job.innerHTML); };
            })(jobs[i]);
        }
    }
    if (document.getElementById("applypage") != null) {
        loadForm();

        var form = document.getElementById("apply_form");
        form.onsubmit = validate;
    }
}

// Add event listener for the load event to stop init functions from interfering with eachother
window.addEventListener('load', init);
