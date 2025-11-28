function confirmDelete(bookId, bookTitle) {
  const titleEl = document.getElementById("bookTitle");
  const form = document.getElementById("deleteForm");
  const overlay = document.getElementById("modalOverlay");
  const modal = document.getElementById("deleteModal");
  if (!titleEl || !form || !overlay || !modal) return;

  titleEl.textContent = bookTitle;

  form.action = `/admin/books/${bookId}`;
  form.method = "POST";

  form.innerHTML = "";

  const methodInput = document.createElement("input");
  methodInput.type = "hidden";
  methodInput.name = "_method";
  methodInput.value = "DELETE";

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
  const csrfInput = document.createElement("input");
  csrfInput.type = "hidden";
  csrfInput.name = "_token";
  csrfInput.value = csrfToken;

  const actionsDiv = document.createElement("div");
  actionsDiv.className = "modal-actions";

  const cancelBtn = document.createElement("button");
  cancelBtn.type = "button";
  cancelBtn.className = "btn btn-secondary";
  cancelBtn.onclick = closeModal;
  cancelBtn.innerHTML = '<i class="bi bi-x-circle"></i> Cancel';

  const deleteBtn = document.createElement("button");
  deleteBtn.type = "submit";
  deleteBtn.className = "btn btn-danger";
  deleteBtn.innerHTML = '<i class="bi bi-trash"></i> Yes, Delete';

  actionsDiv.appendChild(cancelBtn);
  actionsDiv.appendChild(deleteBtn);

  form.appendChild(methodInput);
  form.appendChild(csrfInput);
  form.appendChild(actionsDiv);

  overlay.classList.add("active");
  modal.classList.add("active");
}

function closeModal() {
  const overlay = document.getElementById("modalOverlay");
  const modal = document.getElementById("deleteModal");
  if (!overlay || !modal) return;
  overlay.classList.remove("active");
  modal.classList.remove("active");
}

if (typeof document !== "undefined") {
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      closeModal();
    }
  });
}
