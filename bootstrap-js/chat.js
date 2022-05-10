// const { id } = require("generator-code/generators/app/generate-colortheme");

$(document).ready(function () {
	const chatele = document.querySelectorAll(".chatfriend");
	chatele.forEach((ele) => {
		ele.addEventListener("click", function () {
			const idAttr = ele.getAttribute("data-id");
			document.cookie = "idAttr = " + idAttr;
			window.location.href = "chat.php";
			document.querySelector(".chat").style.display = "block";
		});
	});
	if(!document.cookie.includes("idAttr")){
		document.querySelector(".chat").style.display = "none";
	};
	document.querySelector(".send").addEventListener("click", function () {
	  const message =	document.querySelector(".messagetxt").value; 
		const std_id = this.getAttribute("data-std_id");
		const idAttr = this.getAttribute("data-idAttr");
		const fname = this.getAttribute("data-fname");
		console.log(message);
		$.ajax({
			url: "like.php",
			type: "POST",
			data: {
				chatMessage: 1,
				message: message,
				std_id: std_id,
				idAttr: idAttr,
				fname: fname,
			},
			success: function (data) {
				document.querySelector(".msgList").innerHTML = data;
				document.querySelector(".messagetxt").value = "";
			},
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
