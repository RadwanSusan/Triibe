// jshint esversion: 6
$(document).ready(() => {
  document.querySelectorAll(".comment").forEach((element) => {
		element.addEventListener("click", () => {
			document.querySelector(".commentBox").style.display = "block";
			const post_id = element.getAttribute("data-post_id");
			const std_id = element.getAttribute("data-std_id");
			const author = element.getAttribute("data-author");
			$.ajax({
				url: "backBone.php",
				type: "POST",
				data: {
					getcomment: 1,
					post_id,
					std_id,
					author,
				},
				success(data) {
					const comment = JSON.parse(data);
					console.table(comment);
					for (let i = 0; i < comment.length; i++) {
						const commentContent = document.createElement("div");
						commentContent.classList.add("commentContent");
						const commentParagraph = document.createElement("p");
						commentParagraph.classList.add("commentParagraph");
						commentParagraph.innerHTML = comment[i][0] + " " + comment[i][1];
						const commentImg = document.createElement("img");
						commentImg.classList.add("commentImg");
						commentImg.src = comment[i][2];
						const commentContent2 = document.createElement("p");
						commentContent2.classList.add("commentContent2");
						commentContent2.innerHTML = comment[i][3];
						const commentDate = document.createElement("p");
						commentDate.classList.add("commentDate");
						commentDate.innerHTML = comment[i][4];
						commentContent.appendChild(commentParagraph);
						commentContent.appendChild(commentImg);
						commentContent.appendChild(commentContent2);
						commentContent.appendChild(commentDate);
						document.querySelector(".commentBox").appendChild(commentContent);
					}
				},
			});
			document.querySelector(".closeBtnComment").addEventListener("click", () => {
				document.querySelector(".commentBox").style.display = "none";
				const commentContent = document.querySelectorAll(".commentContent");
				commentContent.forEach((element) => {
					element.remove();
				});
			});
			document.querySelector(".sendComment").addEventListener("click", () => {
				const comment = $(".commentArea").val();
				$.ajax({
					url: "backBone.php",
					type: "POST",
					data: {
						commentsend: 1,
						post_id,
						std_id,
						author,
						comment,
					},
					success(data) {
						const comment = JSON.parse(data);
						console.log(comment);
						const commentContent = document.createElement("div");
						commentContent.classList.add("commentContent");
						const commentParagraph = document.createElement("p");
						commentParagraph.classList.add("commentParagraph");
						commentParagraph.innerHTML = `${comment[0]} ${comment[1]}`;
						const commentImg = document.createElement("img");
						commentImg.classList.add("commentImg");
						commentImg.src = comment[2];
						const commentContent2 = document.createElement("p");
						commentContent2.classList.add("commentContent2");
						commentContent2.innerHTML = comment[3];
						const commentDate = document.createElement("p");
						commentDate.classList.add("commentDate");
						commentDate.innerHTML = comment[4];
						commentContent.appendChild(commentImg);
						commentContent.appendChild(commentParagraph);
						commentContent.appendChild(commentDate);
						commentContent.appendChild(commentContent2);
						document.querySelector(".commentBox").appendChild(commentContent);
					},
				});
			});
		});
	});
  document.querySelectorAll(".share").forEach((element) => {
		element.addEventListener("click", () => {
			const sh_post_id = element.dataset.post_id;
			const sh_author_id = element.dataset.author_id;
			confirm(
				"Are you sure you want to share this post?",
				() => {
					$.ajax({
						url: "backBone.php",
						type: "post",
						data: {
							share: 1,
							sh_post_id,
							sh_author_id,
						},
						success() {
							window.location.href = "home.php";
						},
					});
				},
				() => {
					alertify.error("Post not shared");
				},
			);
		});
	});
  document.querySelectorAll(".save").forEach((element) => {
		element.addEventListener("click", () => {
			const save_post_id = element.dataset.post_id;
			const save_keeper_id = element.dataset.keeper_id;
			$.ajax({
				url: "backBone.php",
				type: "post",
				data: {
					save: 1,
					save_post_id,
					save_keeper_id,
				},
				success() {
					alert("Post saved");
					element.style.display = "none";
					element.nextElementSibling.style.display = "flex";
				},
			});
		});
	});
  const modify = document.querySelectorAll(".modify");
	modify.forEach((element) => {
		element.addEventListener("click", () => {
			const formElement = element.parentElement.children[1];
			formElement.style.display =
				formElement.style.display == "none" ? "block" : "none";
		});
	});
  document.querySelectorAll(".editExit").forEach((element) => {
		element.addEventListener("click", () => {
			element.parentElement.parentElement.style.display =
				element.parentElement.parentElement.style.display == "block"
					? "none"
					: "block";
		});
	});
	document.querySelectorAll(".edit").forEach((element) => {
		element.addEventListener("click", () => {
			const EditPostBox = element.parentElement.children[1];
			EditPostBox.style.display =
				EditPostBox.style.display == "none" ? "block" : "none";
		});
		const EditBtn = element.parentElement.children[1].children[2];
		EditBtn.addEventListener("click", (e) => {
			const editContent = document.querySelector(".edit-text").value;
			const post_id = EditBtn.getAttribute("data-post_id");
			const author_id = EditBtn.getAttribute("data-author_id");
			$.ajax({
				url: "backBone.php",
				method: "POST",
				data: {
					editPost: 1,
					editContent,
					post_id,
					author_id,
				},
				success: (data) => {
					if (data === "success") {
						location.reload();
					}
				},
			});
		});
	});

	document.querySelectorAll(".saved").forEach((element) => {
		element.addEventListener("click", () => {
			const unSave_post_id = element.dataset.post_id;
			const unSave_keeper_id = element.dataset.keeper_id;
			$.ajax({
				url: "backBone.php",
				type: "post",
				data: {
					unSave: 1,
					unSave_post_id,
					unSave_keeper_id,
				},
				success() {
					alert("Post unsaved");
					element.style.display = "none";
					element.previousElementSibling.style.display = "flex";
				},
			});
		});
	});
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
  document.querySelector(".chat").addEventListener("click", () => {
    window.location.href = "chat.php";
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
  const like1 = document.querySelectorAll(".LikeParagraph");
	like1.forEach((element) => {
		element.addEventListener("click", () => {
			const likeHollow = element.parentElement.children[1];
			const likeFilled = element.parentElement.children[2];
			const LikeCount = element.parentElement.children[3];
			const LikeParagraph = element.parentElement.children[4];
			const UnLikeParagraph = element.parentElement.children[5];
			const post_id = $(element).attr("post_id");
			const std_id = $(element).attr("std_id");
			$.ajax({
				url: "backBone.php",
				type: "post",
				data: {
					like: 1,
					post_id,
					std_id,
				},
				success() {
					LikeParagraph.style.display = "none";
					UnLikeParagraph.style.display = "block";
					likeHollow.style.display = "none";
					likeFilled.style.display = "block";
					const likes = LikeCount.textContent;
					const new_likes_number = parseInt(likes) + 1;
					LikeCount.textContent = `${new_likes_number}`;
					if (new_likes_number == 1) {
						LikeParagraph.textContent = `Like`;
						UnLikeParagraph.textContent = `Like`;
					} else {
						LikeParagraph.textContent = `Likes`;
						UnLikeParagraph.textContent = `Likes`;
					}
				},
			});
		});
	});
	const likeHollow1 = document.querySelectorAll(".likeHollow");
	likeHollow1.forEach((element) => {
		element.addEventListener("click", () => {
			const likeHollow = element.parentElement.children[1];
			const likeFilled = element.parentElement.children[2];
			const LikeCount = element.parentElement.children[3];
			const LikeParagraph = element.parentElement.children[4];
			const UnLikeParagraph = element.parentElement.children[5];
			const post_id = $(element).attr("post_id");
			const std_id = $(element).attr("std_id");
			$.ajax({
				url: "backBone.php",
				type: "post",
				data: {
					like: 1,
					post_id,
					std_id,
				},
				success() {
					LikeParagraph.style.display = "none";
					UnLikeParagraph.style.display = "block";
					likeHollow.style.display = "none";
					likeFilled.style.display = "block";
					const likes = LikeCount.textContent;
					const new_likes_number = parseInt(likes) + 1;
					LikeCount.textContent = `${new_likes_number}`;
					if (new_likes_number == 1) {
						LikeParagraph.textContent = `Like`;
						UnLikeParagraph.textContent = `Like`;
					} else {
						LikeParagraph.textContent = `Likes`;
						UnLikeParagraph.textContent = `Likes`;
					}
				},
			});
		});
	});
	const Unlike1 = document.querySelectorAll(".UnLikeParagraph");
	Unlike1.forEach((element) => {
		element.addEventListener("click", () => {
			const likeHollow = element.parentElement.children[1];
			const likeFilled = element.parentElement.children[2];
			const LikeCount = element.parentElement.children[3];
			const LikeParagraph = element.parentElement.children[4];
			const UnLikeParagraph = element.parentElement.children[5];
			const post_id = $(element).attr("post_id");
			const std_id = $(element).attr("std_id");
			$.ajax({
				url: "backBone.php",
				type: "post",
				data: {
					unlike: 1,
					post_id,
					std_id,
				},
				success() {
					UnLikeParagraph.style.display = "none";
					LikeParagraph.style.display = "block";
					likeFilled.style.display = "none";
					likeHollow.style.display = "block";
					const likes = LikeCount.textContent;
					const new_likes_number = parseInt(likes) - 1;
					LikeCount.textContent = `${new_likes_number}`;
					if (new_likes_number == 1) {
						LikeParagraph.textContent = `Like`;
						UnLikeParagraph.textContent = `Like`;
					} else {
						LikeParagraph.textContent = `Likes`;
						UnLikeParagraph.textContent = `Likes`;
					}
				},
			});
		});
	});
	const likeFilled1 = document.querySelectorAll(".likeFilled");
	likeFilled1.forEach((element) => {
		element.addEventListener("click", () => {
			const likeHollow = element.parentElement.children[1];
			const likeFilled = element.parentElement.children[2];
			const LikeCount = element.parentElement.children[3];
			const LikeParagraph = element.parentElement.children[4];
			const UnLikeParagraph = element.parentElement.children[5];
			const post_id = $(element).attr("post_id");
			const std_id = $(element).attr("std_id");
			$.ajax({
				url: "backBone.php",
				type: "post",
				data: {
					unlike: 1,
					post_id,
					std_id,
				},
				success() {
					UnLikeParagraph.style.display = "none";
					LikeParagraph.style.display = "block";
					likeFilled.style.display = "none";
					likeHollow.style.display = "block";
					const likes = LikeCount.textContent;
					const new_likes_number = parseInt(likes) - 1;
					LikeCount.textContent = `${new_likes_number}`;
					if (new_likes_number == 1) {
						LikeParagraph.textContent = `Like`;
						UnLikeParagraph.textContent = `Like`;
					} else {
						LikeParagraph.textContent = `Likes`;
						UnLikeParagraph.textContent = `Likes`;
					}
				},
			});
		});
	});
  document.querySelector(".settingsList").addEventListener("click", () => {
		if (document.querySelector(".settings").style.display == "none") {
			document.querySelector(".settings").style.display = "flex";
		} else {
			document.querySelector(".settings").style.display = "none";
		}
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
const likeBox = document.querySelector(".show_Likes_Box");
document.querySelectorAll(".show_Likes").forEach((element) => {
	element.addEventListener("click", () => {
		document.querySelector(".show_Likes_Box").style.display =
			document.querySelector(".show_Likes_Box").style.display == "none"
				? "flex"
				: "none";
				while (likeBox.firstChild) {
					likeBox.removeChild(likeBox.firstChild);
				}
		const post_id = element.getAttribute("data-post_id");
		$.ajax({
			url: "backBone.php",
			method: "POST",
			data: {
				post_id: post_id,
				show_Likes: 1,
			},
			success: function (data) {
				const like = JSON.parse(data);
				for (let i = 0; i < like.length; i++) {
					const likeLink = document.createElement("a");
					likeLink.classList.add("likeLink");
					likeLink.setAttribute(
						"href",
						"friendpage.php?account_id=" + like[i][3],
					);
					likeLink.innerHTML = like[i][0] + " " + like[i][1];
					const likeimg = document.createElement("img");
					likeimg.classList.add("likeimg");
					likeimg.setAttribute("src", like[i][2]);
					likeLink.appendChild(likeimg);
					likeBox.appendChild(likeLink);
				}
			},
		});
	});
	setInterval(() => {
		$(".LikeCount").each(function () {
			const post_id = $(this).attr("post_id");
			$.ajax({
				url: "backBone.php",
				type: "post",
				data: {
					refreshLikeCount: 1,
					post_id,
				},
				success(response) {
					$(this).text(response);
				},
			});
		});
	}, 30000);
});
