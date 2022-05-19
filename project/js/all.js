$(document).ready(function() {
    $("#btn-log").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-log").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
    });

    $("#btn-log-2").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-log-2").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
        window.location = "login.php";
    });

    $("#btn-edit").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-edit").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
    });
    $("#btn-delete").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-delete").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
    });

    $("#btn-add").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-add").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
    });

    $("#btn-suggest").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-suggest").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
    });

    $("#btn-cancel").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-cancel").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
    });

    $("#btn-logout").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-logout").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
    });

    $("#btn-save").mousedown(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--alt-color) 30%, var(--main-color) 150%)");
    });
    $("#btn-save").mouseup(function() {
        $(this).css("background", "radial-gradient(50% 50% at 50% 50%, var(--main-color) 30%, var(--alt-color) 150%)");
    });

    $("#link-reset").mousedown(function() {
        $(this).css("color", "var(--main-color)");
    });
    $("#link-reset").mouseup(function() {
        $(this).css("color", "var(--alt-color)");
    });

    $("#toggle").click(function() {
        if ($("#InputPassword").attr("type") === 'password') {
            var imageUrl = "..\\images\\visible.png";
            $("#InputPassword").attr("type", "text");
            $(this).removeClass("toggle-bg-1");
            $(this).addClass("toggle-bg-2");
        } else {

            var imageUrl = "..\\images\\hidden.png";
            $("#InputPassword").attr("type", "password");
            $(this).removeClass("toggle-bg-2");
            $(this).addClass("toggle-bg-1");
        }
    });

    $("#toggle-1").click(function() {
        if ($("#npassword").attr("type") === 'password') {
            var imageUrl = "..\\images\\visible.png";
            $("#npassword").attr("type", "text");
            $(this).removeClass("toggle-bg-1");
            $(this).addClass("toggle-bg-2");
        } else {

            var imageUrl = "..\\images\\hidden.png";
            $("#npassword").attr("type", "password");
            $(this).removeClass("toggle-bg-2");
            $(this).addClass("toggle-bg-1");
        }
    });

    $("#toggle-2").click(function() {
        if ($("#cpassword").attr("type") === 'password') {
            var imageUrl = "..\\images\\visible.png";
            $("#cpassword").attr("type", "text");
            $(this).removeClass("toggle-bg-1");
            $(this).addClass("toggle-bg-2");
        } else {

            var imageUrl = "..\\images\\hidden.png";
            $("#cpassword").attr("type", "password");
            $(this).removeClass("toggle-bg-2");
            $(this).addClass("toggle-bg-1");
        }
    });

    $("#toggle-3").click(function() {
        if ($("#oldpassword").attr("type") === 'password') {
            var imageUrl = "..\\images\\visible.png";
            $("#oldpassword").attr("type", "text");
            $(this).removeClass("toggle-bg-1");
            $(this).addClass("toggle-bg-2");
        } else {

            var imageUrl = "..\\images\\hidden.png";
            $("#oldpassword").attr("type", "password");
            $(this).removeClass("toggle-bg-2");
            $(this).addClass("toggle-bg-1");
        }
    });

    $("#toggle-4").click(function() {
        if ($("#npassword").attr("type") === 'password') {
            var imageUrl = "..\\images\\visible.png";
            $("#npassword").attr("type", "text");
            $(this).removeClass("toggle-bg-1");
            $(this).addClass("toggle-bg-2");
        } else {

            var imageUrl = "..\\images\\hidden.png";
            $("#npassword").attr("type", "password");
            $(this).removeClass("toggle-bg-2");
            $(this).addClass("toggle-bg-1");
        }
    });

    $("#btn-modal").click(function() {
        $("#login-modal").removeClass("show");
        $("#login-modal").css("display", "none");
    });
});