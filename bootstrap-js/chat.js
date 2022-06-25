// jshint esversion: 6
document.querySelector(".themeLight").addEventListener("click", () => {
	const theme = document.querySelector("#theme");
	theme.setAttribute("href", "bootstrap-css/chat-dark.css");
		document.querySelector(".themeLight").style.display = "none";
		document.querySelector(".themeDark").style.display = "block";
});
document.querySelector(".themeDark").addEventListener("click", () => {
	const theme = document.querySelector("#theme");
	theme.setAttribute("href", "bootstrap-css/chat-light.css");
		document.querySelector(".themeDark").style.display = "none";
		document.querySelector(".themeLight").style.display = "block";
});
document.querySelector(".themeLight").addEventListener("click", () => {
	document.cookie = "theme=light; SameSite=None; Secure";
});
document.querySelector(".themeDark").addEventListener("click", () => {
	document.cookie = "theme=dark; SameSite=None; Secure";
});
if (document.cookie.includes("theme=light")) {
	document.querySelector(".themeLight").click();
}
if (document.cookie.includes("theme=dark")) {
	document.querySelector(".themeDark").click();
}
$(document).ready(function () {
	if ($(window).width() < 1000) {
		$(".noUserSelectedPara").css("display", "none");
	} else {
		$(".noUserSelectedPara").css("display", "flex");
	}
	document.querySelector(".settingsList").addEventListener("click", () => {
		if (document.querySelector(".settings").style.display == "none") {
			document.querySelector(".settings").style.display = "flex";
		} else {
			document.querySelector(".settings").style.display = "none";
		}
	});
	document.querySelector(".map").addEventListener("click", () => {
		window.location.href = "map.php";
	});
	document.querySelector(".NotificationsList").addEventListener("click", () => {
		$.ajax({
			url: "backBone.php",
			type: "POST",
			data: {
				notificationsClear: 1,
			},
			success(data) {
				document.querySelector(".notificationCount").style.display = "none";
			},
		});
	});
	document.querySelector(".NotificationsList").addEventListener("click", () => {
		if (document.querySelector(".Notifications").style.display == "none") {
			document.querySelector(".Notifications").style.display = "flex";
		} else {
			document.querySelector(".Notifications").style.display = "none";
		}
	});
	const searchItem2 = document.querySelectorAll(".searchItem2");
	searchItem2.forEach((item) => {
		item.addEventListener("click", (e) => {
			const friend_id = item.getAttribute("friend_id");
			e.preventDefault();
			document.cookie = `idAttr = ${friend_id}`;
			document.querySelector(".chat").style.display = "block";
			console.log("hi");
		});
	});
	$(".chatSearch").on("input", function () {
		if ($(this).val() == "") {
			$(".searchArea2").hide();
		} else {
			$(".searchArea2").show();
		}
		const std_id = $(this).attr("std_id");
		$.ajax({
			url: "backBone.php",
			type: "POST",
			data: {
				search2: 1,
				name: $(".chatSearch").val().toLowerCase(),
				std_id,
			},
			success(response) {
				const searchArea = document.querySelector(".searchArea2");
				searchArea.innerHTML = response;
			},
		});
	});
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
		if (message.length == 0) {
			alert("Please enter a message");
			return;
		}
		const std_id = this.getAttribute("data-std_id");
		const idAttr = this.getAttribute("data-idAttr");
		const fname = this.getAttribute("data-fname");
		$.ajax({
			url: "backBone.php",
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
				li.classList.add(
					"animate__animated",
					"animate__bounceInRight",
					"animate__fast",
				);
				li.innerHTML = data;
				document.querySelector(".ulList").appendChild(li);
				document.querySelector(".messagetxt").value = "";
				document.querySelector(".chat-history").scrollTop =
					document.querySelector(".chat-history").scrollHeight;
				const count = document
					.querySelector(".chat-num-messages")
					.innerHTML.split(" ")[1];
				let num = parseInt(count);
				num += 1;
				document.querySelector(
					".chat-num-messages",
				).innerHTML = `already ${num} messages`;
			},
		});
	});
	document.querySelector(".messagetxt").addEventListener("keypress", (e) => {
		if ((e.keyCode == 13 || e.keyCode == 10) && e.ctrlKey) {
			document.querySelector(".send").click();
			document.querySelector(".messagetxt").value = "";
			document.querySelector(".chat-history").scrollTop =
				document.querySelector(".chat-history").scrollHeight;
		}
	});
	document.querySelector(".box").addEventListener("click", function () {
		window.location.href = "home.php";
	});
	$("#search").on("input", function () {
		if ($(this).val() == "") {
			$(".searchArea").hide();
		} else {
			$(".searchArea").show();
		}
		const std_id = $(this).attr("std_id");
		$.ajax({
			url: "backBone.php",
			type: "POST",
			data: {
				search: 1,
				name: $("#search").val().toLowerCase(),
				std_id,
			},
			success(response) {
				const searchArea = document.querySelector(".searchArea");
				searchArea.innerHTML = response;
			},
		});
	});
	particlesJS("particles-js", {
		particles: {
			number: { value: 120, density: { enable: true, value_area: 2000 } },
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
				speed: 1.5,
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
	document.querySelector(".box").addEventListener("click", () => {
		window.location.href = "home.php";
	});
});
