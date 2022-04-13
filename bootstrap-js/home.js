// jshint esversion: 6
document.addEventListener("DOMContentLoaded", function () {
	let groupPage = document.querySelector(".group-page");
	if (groupPage.children.length === 1) {
		// if there is only one child, it's the group-page-header
		groupPage.style.height = "100px"; // set the height to 100px
		let noFriends = document.createElement("span"); // create a span element
		noFriends.innerHTML = "You have no friends yet!"; // set the innerHTML to "You have no friends yet!"
		groupPage.appendChild(noFriends); // append the span to the group-page
	}
});
document.querySelector(".themeLight").addEventListener("click", function () {
	let theme = document.querySelector("#theme"); // get the theme element
	theme.setAttribute("href", "bootstrap-css/dark-home.css"); //dark theme
	document.querySelector(".themeLight").style.display = "none"; // hide light theme button
	document.querySelector(".themeDark").style.display = "block"; // show the dark theme button
	document.querySelector(".logoDark").style.display = "block"; // show the dark logo
	document.querySelector(".logoLight").style.display = "none"; // hide the light logo
	document.querySelector(".chatDark").style.display = "block";
	document.querySelector(".chatLight").style.display = "none";
	document.querySelector(".notificationIcon-dark").style.display = "block";
	document.querySelector(".notificationIcon-light").style.display = "none";
	document.querySelector(".mapIcon-Dark").style.display = "block";
	document.querySelector(".mapIcon-Light").style.display = "none";
	document.querySelector(".SettingsIcon-Dark").style.display = "block";
	document.querySelector(".SettingsIcon-Light").style.display = "none";
	document.querySelector(".pagesIcon-Dark").style.display = "block";
	document.querySelector(".pagesIcon-Light").style.display = "none";
	document.querySelector(".Groups-Dark").style.display = "block";
	document.querySelector(".Groups-Light").style.display = "none";
	document.querySelector(".savedPosts-Dark").style.display = "block";
	document.querySelector(".savedPosts-Light").style.display = "none";
	document.querySelector(".marketIcon-Dark").style.display = "block";
	document.querySelector(".marketIcon-Light").style.display = "none";
	document.querySelector(".housingIcon-Dark").style.display = "block";
	document.querySelector(".housingIcon-Light").style.display = "none";
	document.querySelector(".elearningIcon-Dark").style.display = "block";
	document.querySelector(".elearningIcon-Light").style.display = "none";
	document.querySelector(".infoIcon-Dark").style.display = "block";
	document.querySelector(".infoIcon-Light").style.display = "none";
	document.querySelector(".regIcon-Dark").style.display = "block";
	document.querySelector(".regIcon-Light").style.display = "none";
	document.querySelector(".otherLinksIcon-Dark").style.display = "block";
	document.querySelector(".otherLinksIcon-Light").style.display = "none";
	document.querySelector(".dropDownIcon-Dark").style.display = "block";
	document.querySelector(".dropDownIcon-Light").style.display = "none";
});
document.querySelector(".themeDark").addEventListener("click", function () {
	let theme = document.querySelector("#theme"); // get the theme element
	theme.setAttribute("href", "bootstrap-css/light-home.css"); // bootstrap-css/light-home.css
	document.querySelector(".themeDark").style.display = "none"; // hide the dark theme button
	document.querySelector(".themeLight").style.display = "block"; // show the light theme button
	document.querySelector(".logoLight").style.display = "block";
	document.querySelector(".logoDark").style.display = "none";
	document.querySelector(".logoLight").style.display = "block"; // show the light logo
	document.querySelector(".logoDark").style.display = "none"; // hide the dark logo
	document.querySelector(".chatLight").style.display = "block";
	document.querySelector(".chatDark").style.display = "none";
	document.querySelector(".notificationIcon-light").style.display = "block";
	document.querySelector(".notificationIcon-dark").style.display = "none";
	document.querySelector(".mapIcon-Light").style.display = "block";
	document.querySelector(".mapIcon-Dark").style.display = "none";
	document.querySelector(".SettingsIcon-Light").style.display = "block";
	document.querySelector(".SettingsIcon-Dark").style.display = "none";
	document.querySelector(".pagesIcon-Light").style.display = "block";
	document.querySelector(".pagesIcon-Dark").style.display = "none";
	document.querySelector(".Groups-Light").style.display = "block";
	document.querySelector(".Groups-Dark").style.display = "none";
	document.querySelector(".savedPosts-Light").style.display = "block";
	document.querySelector(".savedPosts-Dark").style.display = "none";
	document.querySelector(".marketIcon-Light").style.display = "block";
	document.querySelector(".marketIcon-Dark").style.display = "none";
	document.querySelector(".housingIcon-Light").style.display = "block";
	document.querySelector(".housingIcon-Dark").style.display = "none";
	document.querySelector(".elearningIcon-Light").style.display = "block";
	document.querySelector(".elearningIcon-Dark").style.display = "none";
	document.querySelector(".infoIcon-Light").style.display = "block";
	document.querySelector(".infoIcon-Dark").style.display = "none";
	document.querySelector(".regIcon-Light").style.display = "block";
	document.querySelector(".regIcon-Dark").style.display = "none";
	document.querySelector(".otherLinksIcon-Light").style.display = "block";
	document.querySelector(".otherLinksIcon-Dark").style.display = "none";
	document.querySelector(".dropDownIcon-Light").style.display = "block";
	document.querySelector(".dropDownIcon-Dark").style.display = "none";
});
document.querySelector(".themeLight").addEventListener("click", function () {
	localStorage.setItem("theme", "light"); // set the theme to light
});
document.querySelector(".themeDark").addEventListener("click", function () {
	localStorage.setItem("theme", "dark"); // save in local storage the theme selected
});
if (localStorage.getItem("theme") === "light") {
	// if the theme is light
	document.querySelector(".themeLight").click(); // click the light theme button
}
if (localStorage.getItem("theme") === "dark") {
	// if the theme is dark
	document.querySelector(".themeDark").click(); // click the dark theme button
}
document.querySelector().addEventListener("click", function () {
	
}

