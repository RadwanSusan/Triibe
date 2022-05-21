// jshint esversion: 6
$(document).ready(() => {
	document.querySelector(".edit-profile").addEventListener("click", () => {
		document.querySelector(".EditInfoForm").style.display = "flex";
	});
	document.getElementById("profileImgForm").onchange = () => {
		setTimeout(() => {
			document.getElementById("submitImg").click();
		}, 300);
	};
	document.getElementById("coverImgForm").onchange = () => {
		setTimeout(() => {
			document.getElementById("submitCoverImg").click();
		}, 300);
	};
	document.querySelector(".write-post-input").addEventListener("click", () => {
		document.querySelector(".content1").style.opacity = "20%";
		document.querySelector(".post-card").style.display = "block";
	});
	document.querySelector(".right-top-card").addEventListener("click", () => {
		document.querySelector(".content1").style.opacity = "100%";
		document.querySelector(".post-card").style.display = "none";
	});
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
});

if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}
