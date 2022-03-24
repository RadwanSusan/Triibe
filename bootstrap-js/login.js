// jshint esversion: 6
import Typed from "../node_modules/typed.js/src/typed.js";
const typed = new Typed(".typed", {
	strings: ["Connect With Your Friends Inside The University On Triibe ."],
	showCursor: false,
	typeSpeed: 30,
	loop: false,
	startDelay: 1100,
}); // typed.js
let removeClass = (name, className, width) => {
	// remove class from element with class name if the window is smaller than the width that the class is set for
	if (window.innerWidth < width) {
		name.classList.remove(className);
	}
};
removeClass(document.querySelector(".right"), "animate__backInDown", 950);
