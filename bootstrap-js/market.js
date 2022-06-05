// jshint esversion: 6
$(document).ready(function() {
  const contact = document.querySelectorAll(".contact");
  contact.forEach(function(element) {
    element.addEventListener("click", function() {
      document.querySelector(".chatlink").removeChild(document.querySelector(".chatlink").lastChild);
      const MPID = element.getAttribute("data-MPID");
      document.querySelector(".contactBox").style.display = "block";
      $.ajax({
        url: "backBone.php",
        type: "POST",
        data: {
          MPContact :1,
          MPID: MPID,
        },
        success(data) {
          const phoneP = document.createElement("p");
          phoneP.innerHTML = data;
          document.querySelector(".chatlink").appendChild(phoneP);
          document.querySelector(".chatPage").setAttribute("data-MPID", MPID);
        },
      });
    });
  });
  document.querySelector(".box").addEventListener("click", () => {
		window.location.href = "home.php";
	});
  document
	.querySelector(".bio2")
	.addEventListener("click", () => {
		document.querySelector(".container1").style.opacity = "20%";
		document.querySelector(".nav").style.opacity = "20%";
		document.querySelector(".post-card").style.display = "block";
	});
  document.querySelector(".chat").addEventListener("click", () => {
    window.location.href = "chat.php";
  });
  document.querySelector(".closeContact").addEventListener("click", function() {
    document.querySelector(".contactBox").style.display = "none";
  });
  document.querySelector(".settingsList").addEventListener("click", () => {
		if (document.querySelector(".settings").style.display == "none") {
			document.querySelector(".settings").style.display = "flex";
		} else {
			document.querySelector(".settings").style.display = "none";
		}
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
				success() {
					window.location.href = "login.php";
				},
			});
		});
	});
  document.querySelector(".addProduct").addEventListener("click", function() {
    document.querySelector(".post-card").style.display = "block";
  });
  document.querySelector(".exitCard").addEventListener("click", () => {
    document.querySelector(".container1").style.opacity = "100%";
    document.querySelector(".nav").style.opacity = "100%";
    document.querySelector(".post-card").style.display = "none";
    document.querySelector(".card-write-post").value = "";
    document.querySelector(".my-textarea").innerHTML = "Write something here...";
  });
  document.querySelector(".forget-pass").addEventListener("click", () => {
		window.location.href = "changePassword.php";
	});
  document.querySelector(".yourProduct").addEventListener("click", function() {
    document.cookie = "yourProduct = 1 "; 
    window.location.href="market.php";
  });
  document.querySelector(".browseAll").addEventListener("click", function() {
    document.cookie = "yourProduct = 2 "; 
    window.location.href="market.php";
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
   document.querySelectorAll(".chatPage").forEach(function(element) {
    element.addEventListener("click", function() {
      const post_id = element.getAttribute("data-MPID");
      $.ajax({
        url: "backBone.php",
        type: "POST",
        data: {
          MPChat :1,
          post_id: post_id,
        },
        success(data) {
                document.cookie = `idAttr = ${data}`;
                window.location.href="chat.php";
        },
    });
  });
});
});