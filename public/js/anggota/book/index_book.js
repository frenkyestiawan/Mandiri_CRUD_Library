function confirmBorrow(bookId, bookTitle) {
    const titleEl = document.getElementById('borrowBookTitle');
    const idInput = document.getElementById('borrowBookId');
    const overlay = document.getElementById('borrowOverlay');
    const modal = document.getElementById('borrowModal');
    if (!titleEl || !idInput || !overlay || !modal) return;

    titleEl.textContent = bookTitle;
    idInput.value = bookId;
    overlay.classList.add('active');
    modal.classList.add('active');
}

function closeBorrowModal() {
    const overlay = document.getElementById('borrowOverlay');
    const modal = document.getElementById('borrowModal');
    if (!overlay || !modal) return;
    overlay.classList.remove('active');
    modal.classList.remove('active');
}

// Close modal with Escape key
if (typeof document !== 'undefined') {
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeBorrowModal();
        }
    });
}
