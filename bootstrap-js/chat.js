// const { id } = require("generator-code/generators/app/generate-colortheme");

$(document).ready(function () {
	const chatele = document.querySelectorAll(".chatfriend");
	chatele.forEach((ele) => {
		ele.addEventListener("click", function () {
			const idAttr = ele.getAttribute("data-id");
			console.log(idAttr);
			document.cookie = "idAttr = " + idAttr;
			window.location.href = "chat.php";
			document.querySelector(".chat").style.display = "block";
		});
	});
});
// function changeurl(url, title) {
// 	var new_url = "/" + url;
// 	window.history.pushState("data", title, new_url);
// }
// const datatochat = document.querySelectorAll(".datatochat");
// datatochat.forEach((ele) => {
// 	ele.addEventListener("click", function (e) {
// 		e.preventDefault();
// 		const id = ele.getAttribute("data-id");
// 		changeurl("Triibe/chat.php?id=" + id, "chat");
// 	});
// });
