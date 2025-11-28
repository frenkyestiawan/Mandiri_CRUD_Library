function confirmApprove(loanId, memberName, bookTitle) {
  const memberEl = document.getElementById("approveMemberName");
  const bookEl = document.getElementById("approveBookTitle");
  const form = document.getElementById("approveForm");
  const overlay = document.getElementById("approveOverlay");
  const modal = document.getElementById("approveModal");

  if (!memberEl || !bookEl || !form || !overlay || !modal) {
    console.error("Modal elements not found");
    return;
  }

  memberEl.textContent = memberName;
  bookEl.textContent = bookTitle;

  form.action = `/admin/loans/${loanId}/approve`;

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

function confirmReject(loanId, memberName, bookTitle) {
  const memberEl = document.getElementById("rejectMemberName");
  const bookEl = document.getElementById("rejectBookTitle");
  const form = document.getElementById("rejectForm");
  const overlay = document.getElementById("rejectOverlay");
  const modal = document.getElementById("rejectModal");

  if (!memberEl || !bookEl || !form || !overlay || !modal) {
    console.error("Modal elements not found");
    return;
  }

  // Set the member name and book title in the modal
  memberEl.textContent = memberName;
  bookEl.textContent = bookTitle;

  // Update form action with the loan ID
  form.action = `/admin/loans/${loanId}/reject`;

  // Show the modal
  overlay.style.display = "block";
  modal.style.display = "block";
  document.body.style.overflow = "hidden";

  // Close modal when clicking outside
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

// Initialize modals when the page loads
document.addEventListener("DOMContentLoaded", function () {
  // Make sure all modals are hidden by default
  const modals = document.querySelectorAll(".modal, .modal-overlay");
  modals.forEach((modal) => {
    modal.style.display = "none";
  });
});
