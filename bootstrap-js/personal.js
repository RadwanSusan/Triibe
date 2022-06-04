// jshint esversion: 6
$(document).ready(() => {
	if (document.cookie.indexOf("Personal_id") == -1) {
		document.cookie = "Personal_id=1";
	}
	document.querySelector(".list-posts").addEventListener("click", (e) => {
		e.preventDefault();
		document.cookie = `Personal_id=1`;
		window.location.href = "personal.php";
	});
	document.querySelector(".list-friends").addEventListener("click", (e) => {
		e.preventDefault();
		document.cookie = `Personal_id=2`;
		window.location.href = "personal.php";
	});
	document.querySelector(".seeMoreFriends").addEventListener("click", (e) => {
		e.preventDefault();
		document.cookie = `Personal_id=2`;
		window.location.href = "personal.php";
	});
	document.querySelector(".list-photos").addEventListener("click", (e) => {
		e.preventDefault();
		document.cookie = `Personal_id=3`;
		window.location.href = "personal.php";
	});
	document.querySelector(".seeMorePhoto").addEventListener("click", (e) => {
		e.preventDefault();
		document.cookie = `Personal_id=3`;
		window.location.href = "personal.php";
	});
	document.querySelector(".list-videos").addEventListener("click", (e) => {
		e.preventDefault();
		document.cookie = `Personal_id=4`;
		window.location.href = "personal.php";
	});
	document.querySelector(".edit-profile").addEventListener("click", () => {
		document.querySelector(".EditInfoForm").style.display = "flex";
	});
	document.getElementById("profileImgForm").onchange = () => {
		setTimeout(() => {
			document.getElementById("submitImg").click();
		}, 300);
	};
	document.getElementById("coverImgForm").onchange = () => {
		setTimeout(() => {
			document.getElementById("submitCoverImg").click();
		}, 300);
	};
	document.querySelector(".write-post-input").addEventListener("click", () => {
		document.querySelector(".content1").style.opacity = "20%";
		document.querySelector(".post-card").style.display = "block";
	});
	document.querySelector(".right-top-card").addEventListener("click", () => {
		document.querySelector(".content1").style.opacity = "100%";
		document.querySelector(".post-card").style.display = "none";
	});
	document.querySelector(".box").addEventListener("click", () => {
		window.location.href = "home.php";
	});

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
			if (element.height >= 800) {
				modalImg.style.maxWidth = "370px";
			} else if (element.height >= 700 && element.height < 800) {
				modalImg.style.maxWidth = "500px";
			} else if (element.height >= 400 && element.height < 700) {
				modalImg.style.maxWidth = "670px";
			} else if (element.height >= 300 && element.height < 400) {
				modalImg.style.maxWidth = "770px";
			} else if (element.height >= 200 && element.height < 300) {
				modalImg.style.maxWidth = "1200px";
			} else {
				modalImg.style.maxWidth = "1400px";
			}
		});
	});
	closeBtn.addEventListener("click", () => {
		modal.style.display = "none";
		document.body.style.overflow = "auto";
	});
	window.addEventListener("click", (e) => {
		if (e.target == modal) {
			modal.style.display = "none";
			document.body.style.overflow = "auto";
		}
	});
	$(".left-bottom-img").on("contextmenu", (e) => false);
	const personalModel = document.getElementById("modal2");
	const personalImg = document.querySelector(".left-bottom-img");
	const PersonalModalImg = document.getElementById("modal-content");
	const closePersonalModal = document.getElementById("close2");
	personalImg.addEventListener("click", () => {
		personalModel.style.display = "block";
		PersonalModalImg.src = personalImg.src;
		document.body.style.overflow = "hidden";
		if (personalImg.height >= 800) {
			PersonalModalImg.style.maxWidth = "200px";
		} else if (personalImg.height >= 700 && personalImg.height < 800) {
			PersonalModalImg.style.maxWidth = "300px";
		} else if (personalImg.height >= 400 && personalImg.height < 700) {
			PersonalModalImg.style.maxWidth = "400px";
		} else if (personalImg.height >= 300 && personalImg.height < 400) {
			PersonalModalImg.style.maxWidth = "500px";
		} else if (personalImg.height >= 200 && personalImg.height < 300) {
			PersonalModalImg.style.maxWidth = "600px";
		} else {
			PersonalModalImg.style.maxWidth = "700px";
		}
	});
	closePersonalModal.addEventListener("click", () => {
		personalModel.style.display = "none";
		document.body.style.overflow = "auto";
	});
	window.addEventListener("click", (e) => {
		if (e.target == personalModel) {
			personalModel.style.display = "none";
			document.body.style.overflow = "auto";
		}
	});
	document.querySelector(".tagIcon").addEventListener("click", () => {
		document.getElementById("myForm").style.display = "block";
	});
	document.querySelector(".cancel").addEventListener("click", () => {
		document.getElementById("myForm").style.display = "none";
	});
});

if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}

const confirm = (message, function1, function2) => {
	alertify.defaults.glossary.title = "My Title";
	alertify.confirm("Triibe", message, function1, function2);
};
if (document.cookie.indexOf("form_id") == -1) {
	document.cookie = "form_id=1";
}
if (document.cookie.indexOf("postBtn") == -1) {
	document.cookie = "postBtn=1";
}
if (document.cookie.indexOf("theme") == -1) {
	document.cookie = "theme=dark";
}
document.querySelector(".themeLight").addEventListener("click", () => {
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
hoverAnimation(
	".right-top-card",
	"mouseover",
	".exitCard",
	"animate__headShake",
);
hoverAnimationOut(
	".right-top-card",
	"mouseout",
	".exitCard",
	"animate__headShake",
);
hoverAnimation(".uploadLabel", "mouseover", ".imgIcon", "animate__heartBeat");
hoverAnimationOut(".uploadLabel", "mouseout", ".imgIcon", "animate__heartBeat");
hoverAnimation(".tagIcon", "mouseover", ".tagIcon", "animate__heartBeat");
hoverAnimationOut(".tagIcon", "mouseout", ".tagIcon", "animate__heartBeat");
hoverAnimation(".locIcon", "mouseover", ".locIcon", "animate__heartBeat");
hoverAnimationOut(".locIcon", "mouseout", ".locIcon", "animate__heartBeat");
hoverAnimation(".gifIcon", "mouseover", ".gifIcon", "animate__heartBeat");
hoverAnimationOut(".gifIcon", "mouseout", ".gifIcon", "animate__heartBeat");
hoverAnimation(
	".FileLink_Button_Label",
	"mouseover",
	".FileLink",
	"animate__heartBeat",
);
hoverAnimationOut(
	".FileLink_Button_Label",
	"mouseout",
	".FileLink",
	"animate__heartBeat",
);
$(document).ready(function () {
	const modify = document.querySelectorAll(".modify");
	modify.forEach((element) => {
		element.addEventListener("click", () => {
			const formElement = element.parentElement.children[1];
			formElement.style.display =
				formElement.style.display == "none" ? "block" : "none";
		});
	});
	document.querySelectorAll(".form-container2").forEach((element) => {
		element.addEventListener("submit", (e) => {
			e.preventDefault();
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
	document.querySelector(".closeProf").addEventListener("click", () => {
		document.querySelector(".EditInfoForm").style.display = "none";
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
						commentContent.appendChild(commentImg);
						commentContent.appendChild(commentParagraph);
						commentContent.appendChild(commentDate);
						commentContent.appendChild(commentContent2);
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
	document.querySelector(".forget-pass").addEventListener("click", () => {
		window.location.href = "changePassword.php";
	});
	document.querySelector(".formIdLabel1").addEventListener("click", () => {
		document.querySelector(".FriendChoice").style.display = "none";
		document.querySelector(".PublicChoice").style.display = "inline-block";
	});
	document.querySelector(".formIdInput1").addEventListener("click", () => {
		document.querySelector(".FriendChoice").style.display = "none";
		document.querySelector(".PublicChoice").style.display = "inline-block";
	});
	document.querySelector(".formIdLabel2").addEventListener("click", () => {
		document.querySelector(".PublicChoice").style.display = "none";
		document.querySelector(".FriendChoice").style.display = "inline-block";
	});
	document.querySelector(".formIdInput2").addEventListener("click", () => {
		document.querySelector(".PublicChoice").style.display = "none";
		document.querySelector(".FriendChoice").style.display = "inline-block";
	});
	document.querySelectorAll(".delete").forEach((element) => {
		element.addEventListener("click", () => {
			const post_id1 = element.dataset.post_id;
			const author_id = element.dataset.author_id;
			const std_id1 = element.dataset.std_id;
			confirm(
				"Are you sure you want to delete this post?<br/>You can't undo this action.",
				() => {
					if (author_id == std_id1) {
						$.ajax({
							url: "backBone.php",
							type: "post",
							data: {
								delete: 1,
								post_id1,
							},
							success() {
								document.querySelector(".form-popup1").style.display = "none";
								window.location.href = "home.php";
							},
						});
					} else alert("You can't delete this post");
				},
				() => {
					document.querySelector(".form-popup1").style.display = "none";
				},
			);
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
	document.querySelector(".card-inside-top").addEventListener("click", () => {
		if (document.querySelector(".formIdSelector").style.display == "none") {
			document.querySelector(".formIdSelector").style.display = "block";
		} else {
			document.querySelector(".formIdSelector").style.display = "none";
		}
	});
	document.querySelector(".btn-primary").addEventListener("click", (e) => {
		e.preventDefault();
		document.querySelector(".formIdSelector").style.display = "none";
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
	const setEndOfContenteditable = (elem) => {
		const sel = window.getSelection();
		sel.selectAllChildren(elem);
		sel.collapseToEnd();
	};
	let change = true;
	const tagFriend = document.querySelectorAll(".tagButton");
	tagFriend.forEach((element) => {
		element.addEventListener("click", () => {
			const textareaDiv = document.querySelector(".my-textarea");
			const textareaForm = document.querySelector(".card-write-post");
			const text = textareaDiv.innerHTML;
			const fName = $(element).attr("fName");
			const lName = $(element).attr("lName");
			const account_id = $(element).attr("account_id");
			const fullName = `@${fName}${lName}`;
			const fullNameLink = `<a href="friendpage.php?account_id=${account_id}">${fullName}</a>`;
			textareaDiv.innerHTML = `${text} ${fullNameLink}`;
			textareaForm.value = `${text} ${fullNameLink}`;
			change = false;
			$(".form-popup").hide();
			setEndOfContenteditable(textareaDiv);
			if (document.querySelector(".post-write").clicked == true) {
				$.ajax({
					url: "backBone.php",
					type: "post",
					data: {
						tag: 1,
						friend_id,
						account_id,
					},
					success() {},
				});
			}
		});
	});
	const locIcon = document.querySelector(".locIcon");
	locIcon.addEventListener("click", () => {
		const textareaDiv = document.querySelector(".my-textarea");
		const textareaForm = document.querySelector(".card-write-post");
		const text = textareaDiv.innerHTML;
		const promise = new Promise((resolve, reject) => {
			navigator.geolocation.getCurrentPosition(
				(position) => {
					const lat = position.coords.latitude;
					const lng = position.coords.longitude;
					const latLng = [lat, lng];
					resolve(latLng);
				},
				(err) => {
					reject(err);
				},
			);
		});
		promise.then((latLng) => {
			const link = `<a href="https://www.google.com/maps/search/?api=1&query=${latLng[0]},${latLng[1]}">My Location</a>`;
			textareaDiv.innerHTML = `${text} ${link}`;
			textareaForm.value = `${text} ${link}`;
			change = false;
			setEndOfContenteditable(textareaDiv);
		});
	});
	document.querySelector(".my-textarea").addEventListener("click", () => {
		if (
			document.querySelector(".my-textarea").innerHTML ==
			"Write something here..."
		) {
			document.querySelector(".my-textarea").innerHTML = "";
		}
	});
	$(".my-textarea").on("input", function () {
		const text = $(this).html();
		const textareaForm = document.querySelector(".card-write-post");
		if (change == true) {
			textareaForm.value = text;
			const regex = /<div><br><\/div>/g;
			textareaForm.value = textareaForm.value.replace(regex, "");
			return;
		}
		$(this).html(textareaForm.value);
		change = true;
		const textarea = document.querySelector(".my-textarea");
		setEndOfContenteditable(textarea);
	});
});
setInterval(() => {
	$.ajax({
		url: "backBone.php",
		type: "post",
		data: {
			checkStrory: 1,
		},
	});
}, 500000);
document
	.querySelector("div[contenteditable]")
	.addEventListener("paste", function (e) {
		e.preventDefault();
		var text = e.clipboardData.getData("text/plain");
		document.execCommand("insertHTML", false, text);
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
const scrollToTopBtn = document.querySelector(".scrollToTopBtn");
const rootElement = document.documentElement;
const handleScroll = () => {
	const scrollTotal = 1700;
	if (rootElement.scrollTop / scrollTotal > 0.8) {
		scrollToTopBtn.classList.add("showBtn");
	} else {
		scrollToTopBtn.classList.remove("showBtn");
	}
};
const scrollToTop = () => {
	rootElement.scrollTo({
		top: 0,
		behavior: "smooth",
	});
};
document.querySelector(".exitCard").addEventListener("click", () => {
	document.querySelector(".container1").style.opacity = "100%";
	document.querySelector(".nav").style.opacity = "100%";
	document.querySelector(".post-card").style.display = "none";
	document.querySelector(".card-write-post").value = "";
	document.querySelector(".my-textarea").innerHTML = "Write something here...";
});
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
		if (element.height >= 800) {
			modalImg.style.maxWidth = "370px";
		} else if (element.height >= 700 && element.height < 800) {
			modalImg.style.maxWidth = "500px";
		} else if (element.height >= 400 && element.height < 700) {
			modalImg.style.maxWidth = "670px";
		} else if (element.height >= 300 && element.height < 400) {
			modalImg.style.maxWidth = "770px";
		} else if (element.height >= 200 && element.height < 300) {
			modalImg.style.maxWidth = "1200px";
		} else {
			modalImg.style.maxWidth = "1400px";
		}
	});
});
const story = document.querySelectorAll(".story");
const modalStory = document.querySelector(".modalStory");
const modalContent = document.querySelector(".modal-content2");
const videoElement = document.querySelector(".videoElement");
const vidSource = document.querySelector(".vidSource");
const storyName = document.querySelector(".storyName");
const storyTime = document.querySelector(".storyTime");
const storyImg = document.querySelector(".storyImg");
story.forEach((element) => {
	element.addEventListener("click", () => {
		const author_id = element.getAttribute("data-AthStory");
		let i = 0;
		$.ajax({
			url: "backBone.php",
			type: "post",
			data: {
				getStory: 1,
				author_id,
			},
			success(response) {
				const stories = JSON.parse(response);
				$.ajax({
					url: "backBone.php",
					type: "post",
					data: {
						getStoryInfo: 1,
						personStoryId: stories[i].author,
					},
					success(response) {
						const storyInfo = JSON.parse(response);
						storyName.textContent = storyInfo[0] + " " + storyInfo[1];
						storyTime.textContent = stories[i].created_date;
						storyImg.src = storyInfo[2];
					},
				});
				if (
					stories[i].img_name != null ||
					stories[i].img_name != undefined ||
					stories[i].img_name != ""
				) {
					modalStory.style.display = "block";
					document
						.querySelector(".next_story")
						.addEventListener("click", () => {
							modalContent.src = stories[++i].img_name;
							$.ajax({
								url: "backBone.php",
								type: "post",
								data: {
									getStoryInfo: 1,
									personStoryId: stories[i].author,
								},
								success(response) {
									const storyInfo = JSON.parse(response);
									storyName.textContent = storyInfo[0] + " " + storyInfo[1];
									storyTime.textContent = stories[i].created_date;
									storyImg.src = storyInfo[2];
								},
							});
						});
					document
						.querySelector(".prev_story")
						.addEventListener("click", () => {
							if (i >= 0) {
								modalContent.src = stories[--i].img_name;
								$.ajax({
									url: "backBone.php",
									type: "post",
									data: {
										getStoryInfo: 1,
										personStoryId: stories[i].author,
									},
									success(response) {
										const storyInfo = JSON.parse(response);
										storyName.textContent = storyInfo[0] + " " + storyInfo[1];
										storyTime.textContent = stories[i].created_date;
										storyImg.src = storyInfo[2];
									},
								});
							}
						});
					modalContent.src = stories[i].img_name;
					document.body.style.overflow = "hidden";
					if (element.height >= 800) {
						modalContent.style.maxWidth = "370px";
					} else if (element.height >= 700 && element.height < 800) {
						modalContent.style.maxWidth = "500px";
					} else if (element.height >= 400 && element.height < 700) {
						modalContent.style.maxWidth = "670px";
					} else if (element.height >= 300 && element.height < 400) {
						modalContent.style.maxWidth = "770px";
					} else if (element.height >= 200 && element.height < 300) {
						modalContent.style.maxWidth = "1200px";
					} else {
						modalContent.style.maxWidth = "1400px";
					}
				}
			},
		});
	});
});

closeBtn.addEventListener("click", () => {
	modal.style.display = "none";
	document.body.style.overflow = "auto";
});
window.addEventListener("click", (e) => {
	if (e.target == modal) {
		modal.style.display = "none";
		document.body.style.overflow = "auto";
	}
});
window.addEventListener("click", (e) => {
	if (e.target == modalStory) {
		modalStory.style.display = "none";
		document.body.style.overflow = "auto";
	}
});
document.querySelector(".tagIcon").addEventListener("click", () => {
	if (document.getElementById("myForm").style.display == "none") {
		document.getElementById("myForm").style.display = "block";
	} else {
		document.getElementById("myForm").style.display = "none";
	}
});
const cancel = document.querySelectorAll(".cancel1");
cancel.forEach((element) => {
	element.addEventListener("click", () => {
		const formElement = element.parentElement.parentElement;
		formElement.style.display = "none";
	});
});
document.querySelector(".cancel").addEventListener("click", () => {
	document.querySelector(".form-popup").style.display = "none";
});
if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}
document.querySelector(".chat").addEventListener("click", () => {
	window.location.href = "chat.php";
});

const dropdown = document.querySelectorAll(".dropdown");
const dropdownArray = Array.prototype.slice.call(dropdown, 0);
dropdownArray.forEach(function (el) {
	const button = el.querySelector('a[data-toggle="dropdown"]');
	const menu = el.querySelector(".dropdown-menu");
	const arrow = button.querySelector("i.icon-arrow");

	button.onclick = (event) => {
		if (!menu.hasClass("show")) {
			menu.classList.add("show");
			menu.classList.remove("hide");
			arrow.classList.add("open");
			arrow.classList.remove("close");
		} else {
			menu.classList.remove("show");
			menu.classList.add("hide");
			arrow.classList.remove("open");
			arrow.classList.add("close");
		}
		event.preventDefault();
	};
});

Element.prototype.hasClass = function (className) {
	return (
		this.className &&
		new RegExp(`(^|\\s)${className}(\\s|$)`).test(this.className)
	);
};
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
});
