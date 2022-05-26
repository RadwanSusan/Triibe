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
  document.querySelector(".addProduct").addEventListener("click", function() {
    document.querySelector(".post-card").style.display = "block";
  });
  document.querySelector(".exitCard").addEventListener("click", function() {
    document.querySelector(".post-card").style.display = "none";
  });
  document.querySelector(".yourProduct").addEventListener("click", function() {
    document.cookie = "yourProduct = 1 "; 
    window.location.href="market.php";
  });
  document.querySelector(".browseAll").addEventListener("click", function() {
    document.cookie = "yourProduct = 2 "; 
    window.location.href="market.php";
  });
});