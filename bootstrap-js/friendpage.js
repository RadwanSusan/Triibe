// jshint esversion: 6
$(document).ready(() => {
	document.querySelector(".box").addEventListener("click", () => {
		window.location.href = "home.php";
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
			modalImg.style.maxWidth = modalImg.height > 850 ? "600px" : "700px";
		});
	});
  document.querySelector(".add-friends").addEventListener("click", () => {})
});

if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}
