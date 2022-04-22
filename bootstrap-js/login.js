// jshint esversion: 6
import Typed from "../node_modules/typed.js/src/typed.js";
const typed = new Typed(".typed", {
	strings: ["Connect With Your Friends Inside The University On Triibe ."],
	showCursor: false,
	typeSpeed: 37,
	startDelay: 1100,
});
const removeClass = (name, className, width) => {
	if (window.innerWidth < width) {
		name.classList.remove(className);
	}
};
removeClass(document.querySelector(".right"), "animate__backInDown", 950);
const showPassword = () => {
	const password = document.querySelector(".password");
	const closedEye = document.querySelector(".closedEye");
	const openEye = document.querySelector(".openEye");
	if (password.type === "password") {
		password.type = "text";
		closedEye.style.display = "none";
		openEye.style.display = "block";
	} else {
		password.type = "password";
		closedEye.style.display = "block";
		openEye.style.display = "none";
	}
};
document.querySelector(".password").addEventListener("input", () => {
	document.querySelector(".closedEye").style.display = "block";
});
document.querySelector(".password").addEventListener("focusout", () => {
	if (document.querySelector(".password").value === "") {
		document.querySelector(".closedEye").style.display = "none";
		document.querySelector(".openEye").style.display = "none";
	}
});
document.querySelector(".closedEye").addEventListener("click", () => {
	showPassword("password");
});
document.querySelector(".openEye").addEventListener("click", () => {
	showPassword("text");
});
