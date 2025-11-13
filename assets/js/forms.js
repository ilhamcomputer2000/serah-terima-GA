document.addEventListener('DOMContentLoaded', function () {
    // graceful: forms may be on pages that don't include this script; guard handlers
});

function showToast(message, type = 'info') {
    const containerId = 'globalToastContainer';
    let container = document.getElementById(containerId);
    if (!container) {
        container = document.createElement('div');
        container.id = containerId;
        container.style.position = 'fixed';
        container.style.right = '1rem';
        container.style.bottom = '1rem';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = 'mb-3 max-w-sm w-full bg-white shadow-lg rounded-lg overflow-hidden';
    toast.style.borderLeft = '4px solid';
    toast.style.padding = '0.75rem 1rem';
    toast.style.display = 'flex';
    toast.style.alignItems = 'center';
    toast.style.gap = '0.75rem';

    if (type === 'success') toast.style.borderColor = '#16a34a';
    else if (type === 'error') toast.style.borderColor = '#dc2626';
    else toast.style.borderColor = '#2563eb';

    toast.innerHTML = `<div style="flex:1;font-size:0.95rem;color:#111827">${escapeHtml(message)}</div>`;
    container.appendChild(toast);

    setTimeout(() => {
        toast.style.transition = 'opacity 0.25s ease';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/\"/g, "&quot;")
         .replace(/'/g, "&#039;");
}

function handleHandoverSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    const itemName = data.get('itemName')?.trim();
    const recipient = data.get('recipient')?.trim();
    const handoverDate = data.get('handoverDate');

    if (!itemName || !recipient || !handoverDate) {
        showToast('Isi semua field yang wajib diisi.', 'error');
        return;
    }

    // simulate save
    showToast('Data serah terima berhasil disimpan.', 'success');
    form.reset();
}

function handleReturnSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    const itemName = data.get('itemName')?.trim();
    const recipient = data.get('recipient')?.trim();
    const returnDate = data.get('returnDate');

    if (!itemName || !recipient || !returnDate) {
        showToast('Isi semua field yang wajib diisi.', 'error');
        return;
    }

    // simulate save
    showToast('Data pengembalian berhasil disimpan.', 'success');
    form.reset();
}

// Export functions to global (forms are inline-called in markup)
window.handleHandoverSubmit = handleHandoverSubmit;
window.handleReturnSubmit = handleReturnSubmit;
window.showToast = showToast;