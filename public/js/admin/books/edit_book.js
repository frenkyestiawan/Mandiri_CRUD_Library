function previewCover(event) {
  const file = event.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    const img = document.getElementById("coverPreview");
    const previewContainer = document.getElementById("coverPreviewContainer");
    const placeholder = document.getElementById("coverPlaceholder");
    const removeFlag = document.getElementById("remove_cover");
    if (!img || !previewContainer || !placeholder) return;

    img.src = e.target.result;
    previewContainer.style.display = "block";
    placeholder.style.display = "none";
    if (removeFlag) removeFlag.value = "0";
  };
  reader.readAsDataURL(file);
}

function confirmRemoveCover() {
  const overlay = document.getElementById("removeCoverOverlay");
  const modal = document.getElementById("removeCoverModal");
  if (!overlay || !modal) return;
  overlay.classList.add("active");
  modal.classList.add("active");
}

function closeRemoveCoverModal() {
  const overlay = document.getElementById("removeCoverOverlay");
  const modal = document.getElementById("removeCoverModal");
  if (!overlay || !modal) return;
  overlay.classList.remove("active");
  modal.classList.remove("active");
}

function removeCover() {
  const previewContainer = document.getElementById("coverPreviewContainer");
  const placeholder = document.getElementById("coverPlaceholder");
  const removeFlag = document.getElementById("remove_cover");
  const fileInput = document.getElementById("cover");

  if (previewContainer) previewContainer.style.display = "none";
  if (placeholder) placeholder.style.display = "flex";
  if (removeFlag) removeFlag.value = "1";
  if (fileInput) fileInput.value = "";

  closeRemoveCoverModal();
  if (typeof alert !== "undefined") {
    alert("Cover akan dihapus setelah Anda menyimpan perubahan.");
  }
}

if (typeof document !== "undefined") {
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      closeRemoveCoverModal();
    }
  });
}
