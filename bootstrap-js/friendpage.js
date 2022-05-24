// jshint esversion: 6
$(document).ready(() => {
  if (document.cookie.indexOf("Personal_id") == -1) {
		document.cookie = "Personal_id=1";
	}
	document.querySelector('.list-posts').addEventListener('click', (e) => {
		//e.preventDefault();
		document.cookie = `Personal_id=1`;
		window.location.href = "friendpage.php";
	});
	document.querySelector('.list-friends').addEventListener('click', (e) => {
		//e.preventDefault();
		document.cookie = `Personal_id=2`;
		window.location.href = "friendpage.php";
	});
	document.querySelector('.seeMoreFriends').addEventListener('click', (e) => {
		//e.preventDefault();
		document.cookie = `Personal_id=2`;
		window.location.href = "friendpage.php";
	});
	document.querySelector('.list-photos').addEventListener('click', (e) => {
		//e.preventDefault();
		document.cookie = `Personal_id=3`;
		window.location.href = "friendpage.php";
	});
	document.querySelector('.seeMorePhoto').addEventListener('click', (e) => {
		//e.preventDefault();
		document.cookie = `Personal_id=3`;
		window.location.href = "friendpage.php";
	});
	document.querySelector('.list-videos').addEventListener('click', (e) => {
		//e.preventDefault();
		document.cookie = `Personal_id=4`;
		window.location.href = "friendpage.php";
	});
	document.querySelector(".box").addEventListener("click", () => {
		window.location.href = "home.php";
	});
  const user_id = document.querySelector(".add-friends").getAttribute("data-user_id");
  $.ajax({
    url: "backBone.php",
    method: "POST",
    data: {
      checkFriendStatus: 1,
      user_id,
    },
    success: (data) => {
      if(data == 1){
        document.querySelector(".add-friends").style.display = "none";
        document.querySelector(".RequestSent").style.display = "none";
        document.querySelector(".AcceptRequest").style.display = "none";
        document.querySelector(".RejectRequest").style.display = "none";
      }else if(data == 0){
        document.querySelector(".RequestSent").style.display = "none";
        document.querySelector(".Friends").style.display = "none";
        document.querySelector(".AcceptRequest").style.display = "none";
        document.querySelector(".RejectRequest").style.display = "none";
      }
      else if(data == 2){
        document.querySelector(".add-friends").style.display = "none";
        document.querySelector(".Friends").style.display = "none";
        document.querySelector(".AcceptRequest").style.display = "none";
        document.querySelector(".RejectRequest").style.display = "none";
      }
      else if(data == 3){
        document.querySelector(".add-friends").style.display = "none";
        document.querySelector(".RequestSent").style.display = "none";
        document.querySelector(".Friends").style.display = "none";
      }
    }  
  });
  setTimeout(() => {
    const user_id = document.querySelector(".add-friends").getAttribute("data-user_id");
    $.ajax({
      url: "backBone.php",
      method: "POST",
      data: {
        checkFriendStatus: 1,
        user_id,
      },
      success: (data) => {
        if(data == 1){
          document.querySelector(".add-friends").style.display = "none";
          document.querySelector(".RequestSent").style.display = "none";
          document.querySelector(".AcceptRequest").style.display = "none";
          document.querySelector(".RejectRequest").style.display = "none";
        }else if(data == 0){
          document.querySelector(".RequestSent").style.display = "none";
          document.querySelector(".Friends").style.display = "none";
          document.querySelector(".AcceptRequest").style.display = "none";
          document.querySelector(".RejectRequest").style.display = "none";
        }
        else if(data == 2){
          document.querySelector(".add-friends").style.display = "none";
          document.querySelector(".Friends").style.display = "none";
          document.querySelector(".AcceptRequest").style.display = "none";
          document.querySelector(".RejectRequest").style.display = "none";
        }
        else if(data == 3){
          document.querySelector(".add-friends").style.display = "none";
          document.querySelector(".RequestSent").style.display = "none";
          document.querySelector(".Friends").style.display = "none";
        }
      }  
    });
  }, 1000);

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
  document.querySelector(".add-friends").addEventListener("click", () => {
    const user_id = document.querySelector(".add-friends").getAttribute("data-user_id");
    $.ajax({
      url: "backBone.php",
      method: "POST",
      data: {
        add_friends: 1,
        user_id,
      },
      success(data){
        document.querySelector(".add-friends").style.display = "none";
        document.querySelector(".RequestSent").style.display = "block";
      }
    });
  });
  document.querySelector(".RequestSent").addEventListener("click", () => {
    const user_id = document.querySelector(".add-friends").getAttribute("data-user_id");
    $.ajax({
      url: "backBone.php",
      method: "POST",
      data: {
        RequestSent: 1,
        user_id,
      },
      success(data){
        document.querySelector(".RequestSent").style.display = "none";
        document.querySelector(".add-friends").style.display = "block";
      }
    });
  });
  document.querySelector(".AcceptRequest").addEventListener("click", () => {
    const user_id = document.querySelector(".AcceptRequest").getAttribute("data-user_id");
    $.ajax({
      url: "backBone.php",
      method: "POST",
      data: {
        AcceptRequest: 1,
        user_id,
      },
      success(data){
        document.querySelector(".AcceptRequest").style.display = "none";
        document.querySelector(".RejectRequest").style.display = "none";
        document.querySelector(".Friends").style.display = "block";
      }
    });
  });
  document.querySelector(".RejectRequest").addEventListener("click", () => {
    const user_id = document.querySelector(".RejectRequest").getAttribute("data-user_id");
    $.ajax({
      url: "backBone.php",
      method: "POST",
      data: {
        RejectRequest: 1,
        user_id,
      },
      success(data){
        document.querySelector(".RejectRequest").style.display = "none";
        document.querySelector(".AcceptRequest").style.display = "none";
        document.querySelector(".add-friends").style.display = "block";
      }
    });
  });
  document.querySelector(".Friends").addEventListener("click", () => {
    confirm("Are you sure you want to remove this friend?", () => {
    const user_id = document.querySelector(".Friends").getAttribute("data-user_id");
    $.ajax({
      url: "backBone.php",
      method: "POST",
      data: {
        Friends: 1,
        user_id,
      },
      success(data){
        document.querySelector(".Friends").style.display = "none";
        document.querySelector(".add-friends").style.display = "block";
      }
    });
   });
  });

  document.querySelector(".posts").addEventListener("click", () => {
    document.cookie = "show=1";
    const account_id = document.querySelector(".posts").getAttribute("data-account_id");
    window.location.href = `friendpage.php?account_id=${account_id}`;
  });
  document.querySelector(".friends").addEventListener("click", () => {
    document.cookie = "show=2";
    const account_id = document.querySelector(".friends").getAttribute("data-account_id");
    window.location.href = `friendpage.php?account_id=${account_id}`;
});
document.querySelector(".photos").addEventListener("click", () => {
  document.cookie = "show=3";
  const account_id = document.querySelector(".photos").getAttribute("data-account_id");
  window.location.href = `friendpage.php?account_id=${account_id}`;
});
document.querySelector(".videos").addEventListener("click", () => {
  document.cookie = "show=4";
  const account_id = document.querySelector(".videos").getAttribute("data-account_id");
  window.location.href = `friendpage.php?account_id=${account_id}`;
});
});

if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}
