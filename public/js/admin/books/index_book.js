function confirmDelete(bookId, bookTitle) {
    const titleEl = document.getElementById('bookTitle');
    const form = document.getElementById('deleteForm');
    const overlay = document.getElementById('modalOverlay');
    const modal = document.getElementById('deleteModal');
    if (!titleEl || !form || !overlay || !modal) return;

    titleEl.textContent = bookTitle;

    let template = form.getAttribute('data-action-template');
    if (!template) {
        template = form.action || '/admin/books/:id';
        form.setAttribute('data-action-template', template);
    }
    form.action = template.replace(':id', bookId);

    overlay.classList.add('active');
    modal.classList.add('active');
}

function closeModal() {
    const overlay = document.getElementById('modalOverlay');
    const modal = document.getElementById('deleteModal');
    if (!overlay || !modal) return;
    overlay.classList.remove('active');
    modal.classList.remove('active');
}

if (typeof document !== 'undefined') {
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
}
