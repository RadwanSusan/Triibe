// jshint esversion: 6
new rive.Rive({
	src: "./Design/Rive Files/manRidingABike.riv",
	canvas: document.getElementById("canvas"),
	autoplay: true,
});
let showPassword2 = () => {
	let password2 = document.querySelector(".CreatePass1");
	let password3 = document.querySelector(".CreatePass2");
	let closedEye2 = document.querySelector(".closedEye2");
	let openEye2 = document.querySelector(".openEye2");
	if (password2.type === "password" && password3.type === "password") {
		password2.type = "text";
		password3.type = "text";
		closedEye2.style.display = "none";
		openEye2.style.display = "block";
	} else {
		password2.type = "password";
		password3.type = "password";
		closedEye2.style.display = "block";
		openEye2.style.display = "none";
	}
};
document.querySelector(".CreatePass2").addEventListener("input", () => {
	document.querySelector(".closedEye2").style.display = "block";
});
document.querySelector(".CreatePass1").addEventListener("focusout", () => {
	if (
		document.querySelector(".CreatePass1").value === "" &&
		document.querySelector(".CreatePass2").value === ""
	) {
		document.querySelector(".closedEye2").style.display = "none";
		document.querySelector(".openEye2").style.display = "none";
	}
});
document.querySelector(".closedEye2").addEventListener("click", () => {
	showPassword2("password");
});
document.querySelector(".openEye2").addEventListener("click", () => {
	showPassword2("text");
});
const removeElement = (name, width) => {
	if (window.innerWidth < width) {
		document.querySelector(name).style.display = "none";
	}
};
removeElement(document.querySelector(".left2"), 1250);
$("select").each(function () {
	const $this = $(this);
	const numberOfOptions = $(this).children("option").length;
	$this.addClass("select-hidden");
	$this.wrap('<div class="select"></div>');
	$this.after('<div class="select-styled"></div>');
	const $styledSelect = $this.next("div.select-styled");
	$styledSelect.text($this.children("option").eq(0).text());
	const $list = $("<ul />", {
		class: "select-options",
	}).insertAfter($styledSelect);
	for (let i = 0; i < numberOfOptions; i++) {
		$("<li />", {
			text: $this.children("option").eq(i).text(),
			rel: $this.children("option").eq(i).val(),
		}).appendTo($list);
	}
	const $listItems = $list.children("li");
	$styledSelect.click(function (e) {
		e.stopPropagation();
		$("div.select-styled.active")
			.not(this)
			.each(function () {
				$(this).removeClass("active").next("ul.select-options").hide();
			});
		$(this).toggleClass("active").next("ul.select-options").toggle();
		$(".select-options").addClass(
			"animate__animated animate__bounceIn animate__faster",
		);
	});
	$listItems.click(function (e) {
		e.stopPropagation();
		$styledSelect.text($(this).text()).removeClass("active");
		$this.val($(this).attr("rel"));
		$list.hide();
	});
	$(document).click(() => {
		$styledSelect.removeClass("active");
		$list.hide();
		$(".select-options").removeClass("animate__animated animate__fadeInDown");
	});
});

if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}
