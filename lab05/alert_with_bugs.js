/*
Author: Ryan Chessum 102564760
Target: alert_with_bugs.html
Purpose: This file is for lab 5
Created: 9/4/2024
Last updated: 9/4/2024
*/

"use strict";   //prevents global variables

function showAnotherMessage() {
	var yourName = prompt("Enter your name.\nThis prompt should show up when the\nCLick Me button is clicked.", "Your name");
	//alert("Hi there " + yourName + ". Alert boxes are a quick way to check the state\n of your variables when you are developing code.");
	rewriteParagraph(yourName)
}

function rewriteParagraph(userName){
	var paragraph = document.getElementById("message");
	paragraph.innerHTML = "Hi " + userName + ". If you can see this you have successfully overwritten the contents of this paragraph!"
}

function showNewMessage(){
	var nm = document.getElementById("new_message")
	nm.innerHTML = "You have now successfully finished task 1"
}

function init() {
	var clickMe = document.getElementById("clickme");
	clickMe.onclick = showAnotherMessage;

	var h = document.getElementById("heading");
	h.onclick = showNewMessage;
	}

window.onload = init;