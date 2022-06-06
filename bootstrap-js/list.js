$(document).ready(function () {
	document.querySelector(".SRGS").addEventListener("click", (e) => {
		e.preventDefault();
		$.ajax({
			url: "backBone.php",
			type: "POST",
			data: {
				SRGS: 1,
			},
			success(data) {
				window.location.href = "project/info.php";
			},
		});
	});
});
