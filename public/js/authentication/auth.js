function togglePassword(fieldId, iconId) {
  var f = document.getElementById(fieldId);
  var i = document.getElementById(iconId);
  if (!f) return;
  if (f.type === "password") {
    f.type = "text";
    if (i) i.className = "bi bi-eye-fill";
  } else {
    f.type = "password";
    if (i) i.className = "bi bi-eye-slash-fill";
  }
}
document.addEventListener("DOMContentLoaded", function () {
  var passwordInput = document.getElementById("password");
  var confirmInput = document.getElementById("password_confirmation");

  if (passwordInput && confirmInput) {
    function validateMatch() {
      if (confirmInput.value && passwordInput.value !== confirmInput.value) {
        confirmInput.setCustomValidity("Password tidak cocok");
      } else {
        confirmInput.setCustomValidity("");
      }
    }

    confirmInput.addEventListener("input", validateMatch);
    passwordInput.addEventListener("input", validateMatch);
  }
});
