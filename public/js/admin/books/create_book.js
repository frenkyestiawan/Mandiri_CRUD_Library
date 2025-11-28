function previewCover(event) {
  const file = event.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    const img = document.getElementById("coverPreview");
    const previewContainer = document.getElementById("coverPreviewContainer");
    const placeholder = document.getElementById("coverPlaceholder");
    if (!img || !previewContainer || !placeholder) return;

    img.src = e.target.result;
    previewContainer.style.display = "block";
    placeholder.style.display = "none";
  };
  reader.readAsDataURL(file);
}
