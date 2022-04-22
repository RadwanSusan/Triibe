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
