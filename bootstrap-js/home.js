// jshint esversion: 6
document.addEventListener("DOMContentLoaded", () => {
	const groupPage = document.querySelector(".group-page");
	if (groupPage.children.length === 1) {
		groupPage.style.height = "100px";
		const noFriends = document.createElement("span");
		noFriends.innerHTML = "You have no friends yet!";
		groupPage.appendChild(noFriends);
	}
});
document.querySelector(".themeLight").addEventListener("click", () => {
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
document.querySelector(".themeDark").addEventListener("click", () => {
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
document.querySelector(".themeLight").addEventListener("click", () => {
	localStorage.setItem("theme", "light");
});
document.querySelector(".themeDark").addEventListener("click", () => {
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
const hoverAnimation = (
	hoverElement,
	eventType,
	animationElement,
	animationName,
) => {
	document.querySelector(hoverElement).addEventListener(eventType, () => {
		document
			.querySelector(animationElement)
			.classList.add("animate__animated", animationName);
	});
};
const hoverAnimationOut = (
	hoverElement,
	eventType,
	animationElement,
	animationName,
) => {
	document.querySelector(hoverElement).addEventListener(eventType, () => {
		document
			.querySelector(animationElement)
			.classList.remove("animate__animated", animationName);
	});
};
hoverAnimation(
	".right-top-card",
	"mouseover",
	".exitCard",
	"animate__headShake",
);
hoverAnimationOut(
	".right-top-card",
	"mouseout",
	".exitCard",
	"animate__headShake",
);
hoverAnimation(".uploadLabel", "mouseover", ".imgIcon", "animate__heartBeat");
hoverAnimationOut(".uploadLabel", "mouseout", ".imgIcon", "animate__heartBeat");
hoverAnimation(".tagIcon", "mouseover", ".tagIcon", "animate__heartBeat");
hoverAnimationOut(".tagIcon", "mouseout", ".tagIcon", "animate__heartBeat");
hoverAnimation(".locIcon", "mouseover", ".locIcon", "animate__heartBeat");
hoverAnimationOut(".locIcon", "mouseout", ".locIcon", "animate__heartBeat");
hoverAnimation(".gifIcon", "mouseover", ".gifIcon", "animate__heartBeat");
hoverAnimationOut(".gifIcon", "mouseout", ".gifIcon", "animate__heartBeat");
hoverAnimation(".flagIcon", "mouseover", ".flagIcon", "animate__heartBeat");
hoverAnimationOut(".flagIcon", "mouseout", ".flagIcon", "animate__heartBeat");
document.querySelector(".like").addEventListener("click", () => {
	if (localStorage.getItem("like") === "liked") {
		localStorage.setItem("like", "notLiked");
	} else {
		localStorage.setItem("like", "liked");
	}
});
$(document).ready(() => {
	$(".LikeParagraph").on("click", function () {
		const post_id = $(this).attr("post_id");
		const std_id = $(this).attr("std_id");
		$.ajax({
			url: "like.php",
			type: "post",
			data: {
				like: 1,
				post_id,
				std_id,
			},
			success() {
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
				unlike: 1,
				post_id,
				std_id,
			},
			success() {
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
document.querySelector(".write-post-input").addEventListener("click", () => {
	document.querySelector(".container1").style.opacity = "20%";
	document.querySelector(".nav").style.opacity = "20%";
	document.querySelector(".post-card").style.display = "block";
});
document.querySelector(".right-top-card").addEventListener("click", () => {
	document.querySelector(".container1").style.opacity = "100%";
	document.querySelector(".nav").style.opacity = "100%";
	document.querySelector(".post-card").style.display = "none";
});
$(".post-image").on("contextmenu", (e) => false);
const modal = document.querySelector(".modal");
const img = document.querySelectorAll(".post-image");
const modalImg = document.querySelector(".modal-content");
const closeBtn = document.querySelector(".close");
img.forEach((element) => {
	element.addEventListener("click", () => {
		modal.style.display = "block";
		modalImg.src = element.src;
		// set the scroll bar to none
		document.body.style.overflow = "hidden";
	});
});
closeBtn.addEventListener("click", () => {
	modal.style.display = "none";
	document.body.style.overflow = "auto";
});
window.addEventListener("click", (e) => {
	if (e.target == modal) {
		modal.style.display = "none";
		document.body.style.overflow = "auto";
	}
});
document.querySelector(".tagIcon").addEventListener("click", () => {
	document.getElementById("myForm").style.display = "block";
});

document.querySelector(".cancel").addEventListener("click", () => {
	document.getElementById("myForm").style.display = "none";
});
