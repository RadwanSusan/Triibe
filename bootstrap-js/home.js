// jshint esversion: 6
document.addEventListener("DOMContentLoaded", function () {
<<<<<<< HEAD
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
document
  .querySelector(".write-post-input")
  .addEventListener("click", function () {
    document.querySelector(".container1").style.opacity = "20%";
    document.querySelector(".nav").style.opacity = "20%";
    document.querySelector(".post-card").style.display = "block";
  });
document
  .querySelector(".right-top-card")
  .addEventListener("click", function () {
    document.querySelector(".container1").style.opacity = "100%";
    document.querySelector(".nav").style.opacity = "100%";
    document.querySelector(".post-card").style.display = "none";
  });
=======
	const groupPage = document.querySelector(".group-page");
	if (groupPage.children.length === 1) {
		groupPage.style.height = "100px";
		const noFriends = document.createElement("span");
		noFriends.innerHTML = "You have no friends yet!";
		groupPage.appendChild(noFriends);
	}
});
document.querySelector(".themeLight").addEventListener("click", function () {
	const theme = document.querySelector("#theme");
	theme.setAttribute("href", "bootstrap-css/dark-home.css");
	document.querySelector(".themeLight").style.display = "none";
	document.querySelector(".themeDark").style.display = "block";
	document.querySelector(".logoDark").style.display = "block";
	document.querySelector(".logoLight").style.display = "none";
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
	const theme = document.querySelector("#theme");
	theme.setAttribute("href", "bootstrap-css/light-home.css");
	document.querySelector(".themeDark").style.display = "none";
	document.querySelector(".themeLight").style.display = "block";
	document.querySelector(".logoLight").style.display = "block";
	document.querySelector(".logoDark").style.display = "none";
	document.querySelector(".logoLight").style.display = "block";
	document.querySelector(".logoDark").style.display = "none";
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
	localStorage.setItem("theme", "light");
});
document.querySelector(".themeDark").addEventListener("click", function () {
	localStorage.setItem("theme", "dark");
});
if (localStorage.getItem("theme") === "light") {
	document.querySelector(".themeLight").click();
}
if (localStorage.getItem("theme") === "dark") {
	document.querySelector(".themeDark").click();
}
window.onload = function () {
	if (localStorage.getItem("like") === "liked") {
		document.querySelector(".like").classList.add("liked");
	}
};
document.querySelector(".like").addEventListener("click", function () {
	if (localStorage.getItem("like") === "liked") {
		localStorage.setItem("like", "notLiked");
	} else {
		localStorage.setItem("like", "liked");
	}
});
$(document).ready(function () {
	$(".LikeParagraph").on("click", function () {
		const post_id = $(this).attr("post_id");
		const std_id = $(this).attr("std_id");
		$.ajax({
			url: "like.php",
			type: "post",
			data: {
				liked: 1,
				post_id,
				std_id,
			},
			success(response) {
				$(".LikeParagraph").hide();
				$(".UnLikeParagraph").show();
				$(".likeHollow").hide();
				$(".likeFilled").show();
				localStorage.setItem("like", "liked");
			},
		});
	});
	$(".UnLikeParagraph").on("click", function () {
		const post_id = $(this).attr("post_id");
		const std_id = $(this).attr("std_id");
		$.ajax({
			url: "like.php",
			type: "post",
			data: {
				unliked: 1,
				post_id,
				std_id,
			},
			success(response) {
				$(".UnLikeParagraph").hide();
				$(".LikeParagraph").show();
				$(".likeFilled").hide();
				$(".likeHollow").show();
				localStorage.setItem("like", "notLiked");
			},
		});
	});
	// 	setInterval(function () {
	// 		$.ajax({
	// 			url: "home.php",
	// 			type: "post",
	// 			data: {
	// 				check_like: 1,
	// 			},
	// 			success(response) {
	// 				if (response == "liked") {
	// 					$(".LikeParagraph").hide();
	// 					$(".UnLikeParagraph").show();
	// 					$(".likeHollow").hide();
	// 					$(".likeFilled").show();
	// 					localStorage.setItem("like", "liked");
	// 				} else if (response == "notLiked") {
	// 					$(".UnLikeParagraph").hide();
	// 					$(".LikeParagraph").show();
	// 					$(".likeFilled").hide();
	// 					$(".likeHollow").show();
	// 					localStorage.setItem("like", "notLiked");
	// 				}
	// 			},
	// 		});
	// 	}, 100);
	// });
	const scrollToTopBtn = document.querySelector(".scrollToTopBtn");
	const rootElement = document.documentElement;
	const handleScroll = () => {
		const scrollTotal = 1700;
		if (rootElement.scrollTop / scrollTotal > 0.8) {
			scrollToTopBtn.classList.add("showBtn");
		} else {
			scrollToTopBtn.classList.remove("showBtn");
		}
	};
	const scrollToTop = () => {
		rootElement.scrollTo({
			top: 0,
			behavior: "smooth",
		});
	};
	scrollToTopBtn.addEventListener("click", scrollToTop);
	document.addEventListener("scroll", handleScroll);
});
>>>>>>> 71232fa96fc34bab37383ff5e35765d386bdb724
