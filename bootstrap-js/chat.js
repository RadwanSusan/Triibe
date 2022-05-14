// jshint esversion: 6
$(document).ready(function () {
	document.querySelector(".chat-history").scrollTop =
		document.querySelector(".chat-history").scrollHeight;
	const chatele = document.querySelectorAll(".chatfriend");
	chatele.forEach((ele) => {
		ele.addEventListener("click", () => {
			const idAttr = ele.getAttribute("data-id");
			document.cookie = `idAttr = ${idAttr}`;
			window.location.href = "chat.php";
			document.querySelector(".chat").style.display = "block";
		});
	});
	if (!document.cookie.includes("idAttr")) {
		document.querySelector(".chat").style.display = "none";
	}
	document.querySelector(".send").addEventListener("click", function () {
		const message = document.querySelector(".messagetxt").value;
		const std_id = this.getAttribute("data-std_id");
		const idAttr = this.getAttribute("data-idAttr");
		const fname = this.getAttribute("data-fname");
		$.ajax({
			url: "like.php",
			type: "POST",
			data: {
				chatMessage: 1,
				message,
				std_id,
				idAttr,
				fname,
			},
			success(data) {
				const li = document.createElement("li");
				li.className = "clearfix";
				li.innerHTML = data;
				document.querySelector(".ulList").appendChild(li);
				document.querySelector(".messagetxt").value = "";
				document.querySelector(".chat-history").scrollTop =
					document.querySelector(".chat-history").scrollHeight;
			},
		});
	});
});
