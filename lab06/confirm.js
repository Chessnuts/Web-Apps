/**
* Author: Grima Wormtongue
* Target: confirm.html
* Purpose: Load data from session storage and submit to server
* Credits: J.R. Tolkein
*/
"use strict";
/*get variables from form and check rules*/
function validate(){
	
	var errMsg = "";								/* stores the error message */
	var result = true;	/* assumes no errors */
	
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var age = document.getElementById("age").value;

	var is1day = document.getElementById("1day").checked;
	var is4day = document.getElementById("4day").checked;
	var is10day = document.getElementById("10day").checked;

	var ishuman = document.getElementById("human").checked;
	var iself = document.getElementById("elf").checked;
	var isdwarf = document.getElementById("dwarf").checked;
	var ishobbit = document.getElementById("hobbit").checked;

	var beard = checkBeard(age);



	if (!firstname.match(/^[a-zA-Z]+$/)){
		errMsg = errMsg + "Your first name must only contain alpha characters\n";
		result = false;
	}
	if (!lastname.match(/^[a-zA-Z\-]+$/)){
		errMsg = errMsg + "Your last name must only contain alpha characters and hyphens\n";
		result = false;
	}

	if (isNaN(age)) {
		errMsg = errMsg + "Your age must be a number\n";
		result = false;
	} 
	else if (age < 18) {
		errMsg = errMsg + "Your age must be 18 or older\n";
		result = false;
	}
	else if (age > 10000) {
		errMsg = errMsg + "Your age is impossible\n";
		result = false;
	}
	else {
		var tempMsg = checkSpeciesAge(age);
		if (tempMsg != ""){
			errMsg = errMsg + tempMsg;
			result = false;
		};
	}

	if(beard != ""){
		errMsg = errMsg + beard;
		result = false;
	}
	
	if(document.getElementById("food").value == "none"){
		errMsg = errMsg + "You must select a food preference\n";
		result = false;
	}

	if (!(is1day || is4day || is10day)){
		errMsg = errMsg + "Please select at least 1 trip. \n";
		result = false;
	}

	if (!(ishuman || iself || isdwarf || ishobbit)){
		errMsg = errMsg + "Please select your race. \n";
		result = false;
	}

	if (errMsg != "") {
		alert(errMsg);
	}

	return result;    //if false the information will not be sent to the server
}

function getSpecies() {
	var speciesName = "Unknown"

	var speciesArray = document.getElementById("species").getElementsByTagName("input");

	for (var i = 0; i < speciesArray.length; i++){
		if (speciesArray[i].checked) speciesName = speciesArray[i].value;
	}
	return speciesName;
}

function checkSpeciesAge(age){
	var errMsg = "";
	var species = getSpecies();
	switch(species){
		case "Human":
			if (age > 120 ){
				errMsg = "You cannot be Human and over 120. \n";
			}
			break;
		case "Dwarf":
		case "Hobbit":
			if (age > 150) {
				errMsg = "You cannot be a " + species + " and over 150. \n";
			}
			break;
		case "Elf":
			break;
		default:
			errMsg = "We don't allow your kind. \n";
		}

	return errMsg;
}

function checkBeard(age) {
	var errMsg = "";
	var species = getSpecies();

	var beard = document.getElementById("beard").value;

	switch(species){
		case "Human":
			break;
		case "Dwarf":
			if (age > 30 && beard < 12) {
				errMsg = "You cannot be a " + species + " and have a beard that short. \n";
			}
			break;
		case "Hobbit":
		case "Elf":
			if (beard > 1){
				errMsg = "You cannot be a " + species + " and have a beard. \n";
			}
			break;
		default:
			errMsg = "Beard not valid. \n";
		}
	return errMsg;
}

//This should be really be calculated securely on the server! 
function calcCost(trips, partySize){
	var cost = 0;
	if (trips.search("1day") != -1) cost = 200;
	if (trips.search("4day")!= -1) cost += 1500;
	if (trips.search("10day")!= -1) cost += 3000;
	return cost * partySize;
}

function getBooking(){
	var cost = 0;
	if(sessionStorage.firstname != undefined){    //if sessionStorage for username is not empty
		//confirmation text
		document.getElementById("confirm_name").textContent = sessionStorage.firstname + " " + sessionStorage.lastname;
		document.getElementById("confirm_age").textContent =sessionStorage.age;
		document.getElementById("confirm_trip").textContent = sessionStorage.trip;
		document.getElementById("confirm_species").textContent = sessionStorage.species;
		document.getElementById("confirm_food").textContent =sessionStorage.food;
		document.getElementById("confirm_partySize").textContent = sessionStorage.partySize;
		cost = calcCost(sessionStorage.trip, sessionStorage.partySize);
		document.getElementById("confirm_cost").textContent = cost;
		//fill hidden fields
		document.getElementById("firstname").value = sessionStorage.firstname;
		/*
		Write lastname, age, species, age, food, and partySize from seesionStorage to the hidden inputs 
		*/
		document.getElementById("cost").value = cost;
	}

}


function init () {
	
	var bookForm = document.getElementById("bookform");// link the variable to the HTML element
	bookForm.onsubmit = validate;          /* assigns functions to corresponding events */
	
 }

window.onload = init;

