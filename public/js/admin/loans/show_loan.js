function confirmApprove() {
    const overlay = document.getElementById("approveOverlay");
    const modal = document.getElementById("approveModal");
    if (!overlay || !modal) return;
    overlay.classList.add("active");
    modal.classList.add("active");
}

function closeApproveModal() {
    const overlay = document.getElementById("approveOverlay");
    const modal = document.getElementById("approveModal");
    if (!overlay || !modal) return;
    overlay.classList.remove("active");
    modal.classList.remove("active");
}

function confirmReject() {
    const overlay = document.getElementById("rejectOverlay");
    const modal = document.getElementById("rejectModal");
    if (!overlay || !modal) return;
    overlay.classList.add("active");
    modal.classList.add("active");
}

function closeRejectModal() {
    const overlay = document.getElementById("rejectOverlay");
    const modal = document.getElementById("rejectModal");
    if (!overlay || !modal) return;
    overlay.classList.remove("active");
    modal.classList.remove("active");
}

if (typeof document !== "undefined") {
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeApproveModal();
            closeRejectModal();
        }
    });
}
