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

function confirmDelete() {
    const overlay = document.getElementById("deleteOverlay");
    const modal = document.getElementById("deleteModal");
    if (!overlay || !modal) return;
    overlay.classList.add("active");
    modal.classList.add("active");
}

function closeDeleteModal() {
    const overlay = document.getElementById("deleteOverlay");
    const modal = document.getElementById("deleteModal");
    if (!overlay || !modal) return;
    overlay.classList.remove("active");
    modal.classList.remove("active");
}

if (typeof document !== "undefined") {
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeCoverModal();
            closeDeleteModal();
        }
    });
}
