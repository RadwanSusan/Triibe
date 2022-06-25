// jshint esversion: 6

const confirm = (message, function1, function2) => {
	alertify.defaults.glossary.title = "My Title";
	alertify.confirm("Triibe", message, function1, function2);
};
$(document).ready(function () {
  document.querySelector(".settingsList").addEventListener("click", () => {
		if (document.querySelector(".settings").style.display == "none") {
			document.querySelector(".settings").style.display = "flex";
		} else {
			document.querySelector(".settings").style.display = "none";
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
  document.querySelector(".forget-pass").addEventListener("click", () => {
		window.location.href = "changePassword.php";
	});
  document.querySelector(".Logout").addEventListener("click", () => {
		confirm("Are you sure you want to Logout?", () => {
			$.ajax({
				url: "backBone.php",
				type: "POST",
				data: {
					logout: 1,
				},
				success() {
					window.location.href = "login.php";
				},
			});
		});
	});
	document.querySelector(".box").addEventListener("click", () => {
		window.location.href = "home.php";
	});
  $("#searchIn").on("input", function () {
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
				search3: 1,
				name: $("#searchIn").val().toLowerCase(),
				std_id,
			},
			success(response) {
				const searchArea2 = document.querySelector(".searchArea2");
				searchArea2.innerHTML = response;
			},
		});
	});
});

