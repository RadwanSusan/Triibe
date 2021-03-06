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
	document.querySelector(".savedPosts-Dark").style.display = "block";
	document.querySelector(".savedPosts-Light").style.display = "none";
	document.querySelector(".marketIcon-Dark").style.display = "block";
	document.querySelector(".marketIcon-Light").style.display = "none";
	document.querySelector(".housingIcon-Dark").style.display = "block";
	document.querySelector(".housingIcon-Light").style.display = "none";
	document.querySelector(".elearningIcon-Dark").style.display = "block";
	document.querySelector(".elearningIcon-Light").style.display = "none";
	document.querySelector(".infoIcon-Dark").style.display = "block";
	document.querySelector(".infoIcon-Light").style.display = "none";
	document.querySelector(".regIcon-Dark").style.display = "block";
	document.querySelector(".regIcon-Light").style.display = "none";
	document.querySelector(".otherLinksIcon-Dark").style.display = "block";
	document.querySelector(".otherLinksIcon-Light").style.display = "none";
	document.querySelector(".dropDownIcon-Dark").style.display = "block";
	document.querySelector(".dropDownIcon-Light").style.display = "none";
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
	document.querySelector(".savedPosts-Light").style.display = "block";
	document.querySelector(".savedPosts-Dark").style.display = "none";
	document.querySelector(".marketIcon-Light").style.display = "block";
	document.querySelector(".marketIcon-Dark").style.display = "none";
	document.querySelector(".housingIcon-Light").style.display = "block";
	document.querySelector(".housingIcon-Dark").style.display = "none";
	document.querySelector(".elearningIcon-Light").style.display = "block";
	document.querySelector(".elearningIcon-Dark").style.display = "none";
	document.querySelector(".infoIcon-Light").style.display = "block";
	document.querySelector(".infoIcon-Dark").style.display = "none";
	document.querySelector(".regIcon-Light").style.display = "block";
	document.querySelector(".regIcon-Dark").style.display = "none";
	document.querySelector(".otherLinksIcon-Light").style.display = "block";
	document.querySelector(".otherLinksIcon-Dark").style.display = "none";
	document.querySelector(".dropDownIcon-Light").style.display = "block";
	document.querySelector(".dropDownIcon-Dark").style.display = "none";
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
	document.querySelector(".box").addEventListener("click", () => {
		document.cookie = `form_id = 1`;
		document.cookie = "postBtn= 1";
		window.location.href = "home.php";
	});
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
	document.querySelector(".closeBtnComment").addEventListener("click", () => {
		document.querySelector(".commentBox").style.display = "none";
		const commentContent = document.querySelectorAll(".commentContent");
		commentContent.forEach((element) => {
			element.remove();
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
	document.querySelector(".LikesExitBtn").addEventListener("click", (e) => {
		document.querySelector(".show_Likes_Box").style.display = "none";
	});
	document.querySelector(".LikesExitBtn").addEventListener("click", (e) => {
		document.querySelector(".show_Likes_Box").style.display = "none";
	});
	const likeBox = document.querySelector(".show_Likes_Box");
	const likeContent = document.querySelector(".likeContent");
	document.querySelectorAll(".show_Likes").forEach((element) => {
		element.addEventListener("click", () => {
			document.querySelector(".show_Likes_Box").style.display =
				document.querySelector(".show_Likes_Box").style.display == "none"
					? "flex"
					: "none";
			while (likeContent.firstChild) {
				likeContent.removeChild(likeContent.firstChild);
			}
			const post_id = element.getAttribute("data-post_id");
			$.ajax({
				url: "backBone.php",
				method: "POST",
				data: {
					post_id,
					show_Likes: 1,
				},
				success(data) {
					const like = JSON.parse(data);
					for (const element2 of like) {
						let likeLink = document.createElement("a");
						likeLink.classList.add("likeLink");
						likeLink.setAttribute(
							"href",
							`friendpage.php?account_id=${element2[3]}`,
						);
						const likeimg = document.createElement("img");
						likeimg.classList.add("likeimg");
						likeimg.setAttribute("src", element2[2]);
						likeLink.appendChild(likeimg);
						likeContent.appendChild(likeLink);
						likeBox.appendChild(likeContent);
						const temp = `${element2[0]} ${element2[1]}`;
						likeLink.innerHTML += temp;
						if (likeContent.innerHTML == "") {
							likeContent.style.display = "none";
						}
					}
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
}, 5000);
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
document
	.querySelector(".write-post-input,.write-post")
	.addEventListener("click", () => {
		document.querySelector(".container1").style.opacity = "20%";
		document.querySelector(".nav").style.opacity = "20%";
		document.querySelector(".post-card").style.display = "block";
	});
document.querySelector(".exitCard").addEventListener("click", () => {
	document.querySelector(".container1").style.opacity = "100%";
	document.querySelector(".nav").style.opacity = "100%";
	document.querySelector(".post-card").style.display = "none";
	document.querySelector(".card-write-post").value = "";
	document.querySelector(".my-textarea").innerHTML = "";
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
		if (modalImg.height > 850) {
			modalImg.style.maxWidth = "500px";
		} else if (modalImg.height < 600) {
			modalImg.style.maxWidth = "1100px";
		} else {
			modalImg.style.maxWidth = "700px";
		}
	});
});
closeBtn.addEventListener("click", () => {
	modal.style.display = "none";
	document.body.style.overflow = "auto";
	modalImg.style.maxWidth = "700px";
});
window.addEventListener("click", (e) => {
	if (e.target == modal) {
		modal.style.display = "none";
		document.body.style.overflow = "auto";
		modalImg.style.maxWidth = "700px";
	}
});
document.querySelector(".tagIcon").addEventListener("click", () => {
	document.getElementById("myForm").style.display = "block";
});
const modify = document.querySelectorAll(".modify");
modify.forEach((element) => {
	element.addEventListener("click", () => {
		const formElement = element.parentElement.children[1];
		formElement.style.display = "block";
	});
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
particlesJS("particles-js", {
	particles: {
		number: { value: 140, density: { enable: true, value_area: 2000 } },
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
