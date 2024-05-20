/**
    filename: enhancements.js
    author: Ryan Chessum 102564760
    description: Assignment 2 Javascript enhancements
*/

"use strict";

// Define the job data in JSON and load it as an array of Data
function getJobs(){
    var jobsData = [
        {
            title: "Dev Ops Engineer",
            referenceNumber: "1DO24",
            description: "We are looking for a dev ops engineer to help develop tools to speed up development for other departments",
            salaryRange: "$70,000 to $100,000 a year",
            reportingTo: "dev ops coordinator",
            responsibilities: ["Developing tools for other departments", "Maintaining code bases"],
            requiredSkills: ["Programming Skills", "Python", "C#", "JavaScript"],
            preferableSkills: ["MySQL", "PHP"]
        },
        {
            title: "Web Developer",
            referenceNumber: "2WD24",
            description: "We are looking for a web developer to help develop web apps and tools for clients",
            salaryRange: "$70,000 to $100,000 a year",
            reportingTo: "head of the web development department",
            responsibilities: ["Front end web development", "Database Management"],
            requiredSkills: ["HTML", "CSS", "JavaScript", "PHP", "MySQL"],
            preferableSkills: ["Programming Skills"]
        },
        {
            title: "Database Manager",
            referenceNumber: "3DM24",
            description: "We are looking for a database manager to help maintain our databases.",
            salaryRange: "$70,000 to $100,000 a year",
            reportingTo: "head of backend operations",
            responsibilities: ["Database Management"],
            requiredSkills: ["JavaScript", "PHP", "MySQL"],
            preferableSkills: ["Programming Skills"]
        }
    ];

    return jobsData;
}

// Function to load jobs from the defined job data
function loadJobs(jobsData) {
    //get the span element for inserting jobs
    var jobs = document.getElementById("jobs");

    //for each job data obtained create a section containing the data and add to the list of jobs
    jobsData.forEach(jobData => {
        var jobSection = createJobSection(jobData);
        jobs.appendChild(jobSection);
    });
}


// Function to create a job section based on job data
function createJobSection(jobData) {
    //create a sction for job with appropriate class
    var section = document.createElement("section");
    section.classList.add("vertical_section");

    //generate html content for job section based on job data JSON
    var html = `<h3>${jobData.title}</h3>
                <p>Reference Number: <a href="apply.html" class="refNum">${jobData.referenceNumber}</a></p>
                <p>${jobData.description}</p>
                <p>Salary Range: ${jobData.salaryRange}</p>
                <p>For this position you will report to the ${jobData.reportingTo}.</p> 
                <p>Key Responsibilities:</p>
                <ul>
                    ${jobData.responsibilities.map(responsibility => `<li>${responsibility}</li>`).join("")}
                </ul>
                <p>Required Skills:</p>
                <ul>
                    ${jobData.requiredSkills.map(skill => `<li>${skill}</li>`).join("")}
                </ul>
                <p>Preferable Skills:</p>
                <ul>
                    ${jobData.preferableSkills.map(skill => `<li>${skill}</li>`).join("")}
                </ul>`;

    //set the inner html of the section to the generated html
    section.innerHTML = html;
    return section;
}

//sticky nav bar
function stickyNav(sticky){
    //https://www.w3schools.com/howto/howto_js_navbar_sticky.asp
    var navbar = document.getElementById("navbar");

    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } 
    else {
        navbar.classList.remove("sticky");
    }
}

function menuDisplay(){
    var currentPage;
    if (document.getElementById("aboutpage") != null) {
        currentPage = document.getElementById("about");
    }
    if (document.getElementById("applypage") != null) {
        currentPage = document.getElementById("apply");
    }
    if (document.getElementById("enhancementspage") != null) {
        currentPage = document.getElementById("enhancements");
    }
    if (document.getElementById("jsenhancementspage") != null) {
        currentPage = document.getElementById("jsenhancements");
    }
    if (document.getElementById("indexpage") != null) {
        currentPage = document.getElementById("index");
    }
    if (document.getElementById("jobpage") != null) {
        currentPage = document.getElementById("jobslink");
    }

    currentPage.classList.add("currentpage");
}



// Function to initialize the page
function init() {
    if (document.getElementById("jobpage") != null) {
        loadJobs(getJobs());
    }
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    window.onscroll = function() { stickyNav(sticky) };
    menuDisplay();
}

// Add event listener for the load event to stop init functions from interfering with eachother
window.addEventListener('load', init);
