document.addEventListener("DOMContentLoaded", function () {
  var menuToggle = document.getElementById("menu-toggle");
  var mobileNav = document.getElementById("mobile-nav");

  if (menuToggle) {
    menuToggle.addEventListener("click", function () {
      var expanded =
        menuToggle.getAttribute("aria-expanded") === "true" || false;
      menuToggle.setAttribute("aria-expanded", !expanded);
      mobileNav.classList.toggle("toggled-on");
      document.body.classList.toggle("menu-open");
    });
  }
});
