// jshint esversion: 6
const confirm = (message, function1, function2) => {
	alertify.defaults.glossary.title = "My Title";
	alertify.confirm("Triibe", message, function1, function2);
};
document.addEventListener("DOMContentLoaded", () => {
	const groupPage = document.querySelector(".group-page");
	if (groupPage.children.length === 1) {
		groupPage.style.height = "100px";
		const noFriends = document.createElement("span");
		noFriends.innerHTML = "You have no friends yet!";
		groupPage.appendChild(noFriends);
	}
});
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
	const theme = document.querySelector("#theme");
	theme.setAttribute("href", "bootstrap-css/savedPosts-dark.css");
	document.querySelector(".themeLight").style.display = "none";
	document.querySelector(".themeDark").style.display = "block";
});
document.querySelector(".themeDark").addEventListener("click", () => {
	const theme = document.querySelector("#theme");
	theme.setAttribute("href", "bootstrap-css/savedPosts-light.css");
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
	const group = document.querySelectorAll(".group-list-item");
	group.forEach((item) => {
		item.addEventListener("click", (e) => {
			e.preventDefault();
			const formId = item.getAttribute("data-form_id");
			document.cookie = `form_id=${formId}`;
			window.location.href = "groups.php";
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
	document.querySelector(".forget-pass").addEventListener("click", () => {
		window.location.href = "changePassword.php";
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
	setInterval(() => {
		$.ajax({
			url: "backBone.php",
			type: "post",
			data: {
				checkStrory: 1,
			},
		});
	}, 500000000);

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
	scrollToTopBtn.addEventListener("click", scrollToTop);
	document.addEventListener("scroll", handleScroll);
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
	const cancel = document.querySelectorAll(".cancel1");
	cancel.forEach((element) => {
		element.addEventListener("click", () => {
			const formElement = element.parentElement.parentElement;
			formElement.style.display = "none";
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
	document.querySelector(".chat").addEventListener("click", () => {
		window.location.href = "chat.php";
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
});
