// jshint esversion: 6
$(document).ready(function () {
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
	hoverAnimation(".imgIcon", "mouseover", ".imgIcon", "animate__heartBeat");
	hoverAnimationOut(".imgIcon", "mouseout", ".imgIcon", "animate__heartBeat");
	hoverAnimation(".locIcon", "mouseover", ".locIcon", "animate__heartBeat");
	hoverAnimationOut(".locIcon", "mouseout", ".locIcon", "animate__heartBeat");
	hoverAnimation(".FileLink", "mouseover", ".FileLink", "animate__heartBeat");
	hoverAnimationOut(".FileLink", "mouseout", ".FileLink", "animate__heartBeat");
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
	// const nl2br = (str) => {
	// 	return str.replace(/\n/g, "<br>");
	// };
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
			number: { value: 200, density: { enable: true, value_area: 2000 } },
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
				attract: { enable: true, rotateX: 600, rotateY: 1200 },
			},
		},
		retina_detect: true,
	});
});
