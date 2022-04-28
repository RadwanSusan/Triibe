$(document).ready(() => {
	document.querySelector(".write-post-input").addEventListener("click", () => {
		document.querySelector(".content1").style.opacity = "20%";
		document.querySelector(".post-card").style.display = "block";
	});
	document.querySelector(".right-top-card").addEventListener("click", () => {
		document.querySelector(".content1").style.opacity = "100%";
		document.querySelector(".post-card").style.display = "none";
	});
});
