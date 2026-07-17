import ToasterUi from 'toaster-ui';

const toaster = new ToasterUi();

// ── Show a single toast directly ──────────────────────────────────────────────
window.showToast = function(message, type = 'success', duration = 3500) {
    if (!message) return;
    const icon = type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️';
    toaster.addToast(icon + ' ' + message, type, {
        autoClose: true,
        duration,
        allowHtml: true
    });
};

// ── Show toasts from window.sessionSuccess / window.sessionError ─────────────
window.showToasterFromSession = function() {
    if (window.sessionSuccess) {
        window.showToast(window.sessionSuccess, 'success');
        window.sessionSuccess = ''; // prevent double-show
    }
    if (window.sessionError) {
        window.showToast(window.sessionError, 'error');
        window.sessionError = '';
    }
};

// Auto-run on DOMContentLoaded for pages that use layouts.app (sets sessionSuccess/Error inline)
document.addEventListener('DOMContentLoaded', window.showToasterFromSession);
