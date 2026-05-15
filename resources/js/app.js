import ToasterUi from 'toaster-ui';

const toaster = new ToasterUi();

// Function to show toast from session data
window.showToasterFromSession = function() {
    const sessionData = {
        success: window.sessionSuccess || '',
        error: window.sessionError || ''
    };

    if (sessionData.success) {
        toaster.addToast('✅ ' + sessionData.success, 'success', {
            autoClose: true,
            duration: 3000,
            allowHtml: true
        });
    }
    
    if (sessionData.error) {
        toaster.addToast('❌ ' + sessionData.error, 'error', {
            autoClose: true,
            duration: 3000,
            allowHtml: true
        });
    }
};

// Call when DOM is ready
document.addEventListener('DOMContentLoaded', window.showToasterFromSession);