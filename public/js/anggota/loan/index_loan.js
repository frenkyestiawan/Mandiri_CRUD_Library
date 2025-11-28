function confirmReturn(loanId, bookTitle, borrowedAt, dueAt, isLate) {
    const titleEl = document.getElementById("returnBookTitle");
    const borrowedEl = document.getElementById("returnBorrowedAt");
    const dueEl = document.getElementById("returnDueAt");
    const lateItem = document.getElementById("lateStatusItem");
    const form = document.getElementById("returnForm");
    const overlay = document.getElementById("returnOverlay");
    const modal = document.getElementById("returnModal");

    if (!titleEl || !borrowedEl || !dueEl || !form || !overlay || !modal)
        return;

    titleEl.textContent = bookTitle;
    borrowedEl.textContent = borrowedAt;
    dueEl.textContent = dueAt;

    if (lateItem) {
        lateItem.style.display = isLate ? "flex" : "none";
    }

    // Use original action template if available, otherwise fall back to simple replace
    let actionTemplate = form.getAttribute("data-action-template");
    if (!actionTemplate) {
        actionTemplate = form.action;
        form.setAttribute("data-action-template", actionTemplate);
    }
    form.action = actionTemplate.replace(":id", loanId);

    overlay.classList.add("active");
    modal.classList.add("active");
}

function closeReturnModal() {
    const overlay = document.getElementById("returnOverlay");
    const modal = document.getElementById("returnModal");
    if (!overlay || !modal) return;
    overlay.classList.remove("active");
    modal.classList.remove("active");
}

// Close modal with Escape key
if (typeof document !== "undefined") {
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeReturnModal();
        }
    });
}
