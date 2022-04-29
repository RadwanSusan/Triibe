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
$(document).ready(function () {
	$(".friendpage").on("click", function () {
		const friend_id = $(this).attr("friend_id");
		$.ajax({
			url: "like.php",
			type: "post",
			data: {
				friendclick: 1,
				friend_id,
			},
			success(response) {
				window.location.href = "friendpage.php?friend_id=" + response;
			},
		});
	});
	$(".delete").on("click", function () {
		const post_id1 = $(this).attr("post_id");
		const author_id = $(this).attr("author_id");
		const std_id1 = $(this).attr("std_id");
		if (author_id == std_id1) {
			$.ajax({
				url: "like.php",
				type: "post",
				data: {
					delete: 1,
					post_id1,
				},
				success() {
					alert("Post Deleted");
					document.querySelector(".form-popup1").style.display = "none";
					document
						.querySelector(".ajs-button, ajs-close")
						.addEventListener("click", () => {
							window.location.href = "home.php";
						});
					window.addEventListener("click", () => {
						window.location.href = "home.php";
					});
				},
			});
		} else alert("You can't delete this post");
	});
	$("#search").on("input", function () {
		$.ajax({
			url: "like.php",
			type: "POST",
			data: {
				search: 1,
				name: $("#search").val().toLowerCase(),
			},
			success(response) {
				//$("#result").html(response);
				console.log(response);
			},
		});
	});

	$(".modify").on("click", function () {
		$("#myForm1").show();
	});
	$(".LikeParagraph, .likeHollow").on("click", function () {
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
				const likes = document.querySelector(".LikeCount").textContent;
				const new_likes_number = parseInt(likes) + 1;
				$(".LikeCount").text(`${new_likes_number}`);
				if (new_likes_number == 1) {
					$(".LikeParagraph").text(`Like`);
					$(".UnLikeParagraph").text(`Like`);
				} else {
					$(".LikeParagraph").text(`Likes`);
					$(".UnLikeParagraph").text(`Likes`);
				}
			},
		});
	});
	$(".UnLikeParagraph, .likeFilled").on("click", function () {
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
				const likes = document.querySelector(".LikeCount").textContent;
				const new_likes_number = parseInt(likes) - 1;
				$(".LikeCount").text(`${new_likes_number}`);
				if (new_likes_number == 1) {
					$(".LikeParagraph").text(`Like`);
					$(".UnLikeParagraph").text(`Like`);
				} else {
					$(".LikeParagraph").text(`Likes`);
					$(".UnLikeParagraph").text(`Likes`);
				}
			},
		});
	});
});
setInterval(() => {
	$(".LikeCount").each(function () {
		const post_id = $(this).attr("post_id");
		$.ajax({
			url: "like.php",
			type: "post",
			data: {
				refreshLikeCount: 1,
				post_id,
			},
			success(response) {
				$(this).text(response);
			},
		});
	});
}, 5000);
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
		document.body.style.overflow = "hidden";
		if (modalImg.height > 850) {
			modalImg.style.maxWidth = "600px";
		} else if (modalImg.height < 600) {
			modalImg.style.maxWidth = "1100px";
		} else {
			modalImg.style.maxWidth = "700px";
		}
	});
});
closeBtn.addEventListener("click", () => {
	modal.style.display = "none";
	document.body.style.overflow = "auto";
	modalImg.style.maxWidth = "700px";
});
window.addEventListener("click", (e) => {
	if (e.target == modal) {
		modal.style.display = "none";
		document.body.style.overflow = "auto";
		modalImg.style.maxWidth = "700px";
	}
});
document.querySelector(".tagIcon").addEventListener("click", () => {
	document.getElementById("myForm").style.display = "block";
});
document.querySelector(".cancel").addEventListener("click", () => {
	document.getElementById("myForm").style.display = "none";
});
document.querySelector(".cancel1").addEventListener("click", () => {
	document.getElementById("myForm1").style.display = "none";
});
particlesJS("particles-js", {
	particles: {
		number: { value: 160, density: { enable: true, value_area: 2000 } },
		color: { value: "#ffffff" },
		shape: {
			type: "circle",
			stroke: { width: 0, color: "#000000" },
			polygon: { nb_sides: 5 },
			image: { src: "img/github.svg", width: 100, height: 100 },
		},
		opacity: {
			value: 0.5,
			random: false,
			anim: { enable: false, speed: 1, opacity_min: 0.1, sync: false },
		},
		size: {
			value: 3,
			random: true,
			anim: {
				enable: false,
				speed: 4.794668328818349,
				size_min: 0.1,
				sync: true,
			},
		},
		line_linked: {
			enable: true,
			distance: 220.96133965703635,
			color: "#404040",
			opacity: 0.12204657549380909,
			width: 1,
		},
		move: {
			enable: true,
			speed: 3,
			direction: "none",
			random: false,
			straight: false,
			out_mode: "out",
			bounce: true,
			attract: { enable: false, rotateX: 600, rotateY: 1200 },
		},
	},
	retina_detect: true,
});
