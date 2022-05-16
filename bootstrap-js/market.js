// jshint esversion: 6
$(document).ready(function() {
  const contact = document.querySelectorAll(".contact");
  contact.forEach(function(element) {
    element.addEventListener("click", function() {
      const MPID = element.getAttribute("data-MPID");
      document.querySelector(".contactBox").style.display = "block";
      $.ajax({
        url: "backBone.php",
        type: "POST",
        data: {
          MPContact :1,
          MPID: MPID,
        },
        success(data) {
          const phoneP = document.createElement("p");
          phoneP.innerHTML = data;
          document.querySelector(".contactBox").appendChild(phoneP);
        },
      });
    });
  });
  document.querySelector(".closeContact").addEventListener("click", function() {
    document.querySelector(".contactBox").style.display = "none";
  });
});