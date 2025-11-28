function confirmApprove(returnId, memberName, bookTitle) {
  const memberEl = document.getElementById("approveMemberName");
  const bookEl = document.getElementById("approveBookTitle");
  const form = document.getElementById("approveForm");
  const overlay = document.getElementById("approveOverlay");
  const modal = document.getElementById("approveModal");

  if (!memberEl || !bookEl || !form || !overlay || !modal) {
    console.error("Elemen modal tidak ditemukan");
    return;
  }

  memberEl.textContent = memberName;
  bookEl.textContent = bookTitle;

  form.action = `/admin/returns/${returnId}/approve`;

  overlay.style.display = "block";
  modal.style.display = "block";
  document.body.style.overflow = "hidden";

  overlay.onclick = function (event) {
    if (event.target === overlay) {
      closeApproveModal();
    }
  };
}

function closeApproveModal() {
  const overlay = document.getElementById("approveOverlay");
  const modal = document.getElementById("approveModal");
  if (overlay && modal) {
    overlay.style.display = "none";
    modal.style.display = "none";
    document.body.style.overflow = "auto";
  }
}

function confirmReject(returnId, memberName, bookTitle) {
  const memberEl = document.getElementById("rejectMemberName");
  const bookEl = document.getElementById("rejectBookTitle");
  const form = document.getElementById("rejectForm");
  const overlay = document.getElementById("rejectOverlay");
  const modal = document.getElementById("rejectModal");

  if (!memberEl || !bookEl || !form || !overlay || !modal) {
    console.error("Elemen modal tidak ditemukan");
    return;
  }

  memberEl.textContent = memberName;
  bookEl.textContent = bookTitle;

  form.action = `/admin/returns/${returnId}/reject`;

  overlay.style.display = "block";
  modal.style.display = "block";
  document.body.style.overflow = "hidden";

  overlay.onclick = function (event) {
    if (event.target === overlay) {
      closeRejectModal();
    }
  };
}

function closeRejectModal() {
  const overlay = document.getElementById("rejectOverlay");
  const modal = document.getElementById("rejectModal");
  if (overlay && modal) {
    overlay.style.display = "none";
    modal.style.display = "none";
    document.body.style.overflow = "auto";
  }
}

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    closeApproveModal();
    closeRejectModal();
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const modals = document.querySelectorAll(".modal, .modal-overlay");
  modals.forEach((modal) => {
    modal.style.display = "none";
  });
});
