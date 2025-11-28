function showCoverModal() {
    const overlay = document.getElementById("coverOverlay");
    const modal = document.getElementById("coverModal");
    if (!overlay || !modal) return;
    overlay.classList.add("active");
    modal.classList.add("active");
}

function closeCoverModal() {
    const overlay = document.getElementById("coverOverlay");
    const modal = document.getElementById("coverModal");
    if (!overlay || !modal) return;
    overlay.classList.remove("active");
    modal.classList.remove("active");
}

function confirmBorrow() {
    const overlay = document.getElementById("borrowOverlay");
    const modal = document.getElementById("borrowModal");
    if (!overlay || !modal) return;
    overlay.classList.add("active");
    modal.classList.add("active");
}

function closeBorrowModal() {
    const overlay = document.getElementById("borrowOverlay");
    const modal = document.getElementById("borrowModal");
    if (!overlay || !modal) return;
    overlay.classList.remove("active");
    modal.classList.remove("active");
}

// Close modals with Escape key
if (typeof document !== "undefined") {
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeCoverModal();
            closeBorrowModal();
        }
    });
}
