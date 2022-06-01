$(".unmask").on("click", function () {
	if ($(this).prev("input").attr("type") == "password")
		$(this).prev("input").prop("type", "text");
	else $(this).prev("input").prop("type", "password");
	return false;
});
//Begin supreme heuristics
$(".password").on("keyup", function () {
	var p_c = $("#p-c");
	var p = $("#p");
	console.log(p.val() + p_c.val());
	if (p.val().length > 0) {
		if (p.val() != p_c.val()) {
			$("#valid").html("Passwords Don't Match");
		} else {
			$("#valid").html("");
		}
		var s = "weak";
		if (p.val().length > 5 && p.val().match(/\d+/g)) s = "medium";
		if (p.val().length > 6 && p.val().match(/[^\w\s]/gi)) s = "strong";
		$("#strong span").addClass(s).html(s);
	}
});
