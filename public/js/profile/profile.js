function previewPhoto(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();

    reader.onload = function (e) {
      const currentPhoto = document.querySelector(".current-photo");
      if (currentPhoto) {
        currentPhoto.innerHTML = `<img src="${e.target.result}" alt="Preview" class="profile-photo">`;
      }
    };

    reader.readAsDataURL(input.files[0]);
  }
}
