window.addEventListener("scroll", function () {
  var navbar = document.querySelector(".navbar");
  if (!navbar) return;

  if (window.pageYOffset > 20) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});
