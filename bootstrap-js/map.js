// jshint esversion: 6
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
});
document.querySelector(".themeLight").addEventListener("click", () => {
	document.cookie = "theme=light";
});
document.querySelector(".themeDark").addEventListener("click", () => {
	document.cookie = "theme=dark";
});
if (document.cookie.includes("theme=light")) {
	document.querySelector(".themeLight").click();
}
if (document.cookie.includes("theme=dark")) {
	document.querySelector(".themeDark").click();
}
$(document).ready(function () {
	document.querySelector(".map").addEventListener("click", () => {
		window.location.href = "map.php";
	});
	document.querySelector(".Logout").addEventListener("click", () => {
		confirm("Are you sure you want to Logout?", () => {
			$.ajax({
				url: "backBone.php",
				type: "POST",
				data: {
					logout: 1,
				},
				success(data) {
					window.location.href = "login.php";
				},
			});
		});
	});
	document.querySelector(".box").addEventListener("click", () => {
		window.location.href = "home.php";
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
	document.querySelector(".settingsList").addEventListener("click", () => {
		if (document.querySelector(".settings").style.display == "none") {
			document.querySelector(".settings").style.display = "flex";
		} else {
			document.querySelector(".settings").style.display = "none";
		}
	});
	document.querySelector(".NotificationsList").addEventListener("click", () => {
		if (document.querySelector(".Notifications").style.display == "none") {
			document.querySelector(".Notifications").style.display = "flex";
		} else {
			document.querySelector(".Notifications").style.display = "none";
		}
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
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
	document.querySelector(".chat").addEventListener("click", () => {
		window.location.href = "chat.php";
	});
});
