function confirmApprove(returnId, memberName, bookTitle) {
    const memberEl = document.getElementById('approveMemberName');
    const bookEl = document.getElementById('approveBookTitle');
    const form = document.getElementById('approveForm');
    const overlay = document.getElementById('approveOverlay');
    const modal = document.getElementById('approveModal');
    if (!memberEl || !bookEl || !form || !overlay || !modal) return;

    memberEl.textContent = memberName;
    bookEl.textContent = bookTitle;

    let template = form.getAttribute('data-action-template');
    if (!template) {
        template = form.action || '/admin/returns/:id/approve';
        form.setAttribute('data-action-template', template);
    }
    form.action = template.replace(':id', returnId);

    overlay.classList.add('active');
    modal.classList.add('active');
}

function closeApproveModal() {
    const overlay = document.getElementById('approveOverlay');
    const modal = document.getElementById('approveModal');
    if (!overlay || !modal) return;
    overlay.classList.remove('active');
    modal.classList.remove('active');
}

function confirmReject(returnId, memberName, bookTitle) {
    const memberEl = document.getElementById('rejectMemberName');
    const bookEl = document.getElementById('rejectBookTitle');
    const form = document.getElementById('rejectForm');
    const overlay = document.getElementById('rejectOverlay');
    const modal = document.getElementById('rejectModal');
    if (!memberEl || !bookEl || !form || !overlay || !modal) return;

    memberEl.textContent = memberName;
    bookEl.textContent = bookTitle;

    let template = form.getAttribute('data-action-template');
    if (!template) {
        template = form.action || '/admin/returns/:id/reject';
        form.setAttribute('data-action-template', template);
    }
    form.action = template.replace(':id', returnId);

    overlay.classList.add('active');
    modal.classList.add('active');
}

function closeRejectModal() {
    const overlay = document.getElementById('rejectOverlay');
    const modal = document.getElementById('rejectModal');
    if (!overlay || !modal) return;
    overlay.classList.remove('active');
    modal.classList.remove('active');
}

if (typeof document !== 'undefined') {
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeApproveModal();
            closeRejectModal();
        }
    });
}
