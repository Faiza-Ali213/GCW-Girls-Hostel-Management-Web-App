// ============================================
// FEE RECORD - JAVASCRIPT
// ============================================

$(document).ready(function() {
    console.log('✅ Fee Record JS loaded successfully');

    // ========== SEARCH AND FILTER ==========
    let searchTimeout;
    
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            performSearch();
        }, 500);
    });

    $('#statusFilter').on('change', function() {
        performSearch();
    });

    function performSearch() {
        const search = $('#searchInput').val();
        const status = $('#statusFilter').val();
        let url = window.feeRecordRoute + '?';
        if (search) url += 'search=' + encodeURIComponent(search) + '&';
        if (status) url += 'status=' + encodeURIComponent(status);
        window.location.href = url;
    }

    // ========== AUTO-DISMISS ALERTS ==========
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // ========== TOAST SYSTEM ==========
    window.showToast = function(type, message) {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        
        const toast = document.createElement('div');
        toast.className = 'toast toast-' + type;
        toast.innerHTML = message;
        container.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            toast.style.transition = 'all 0.5s ease';
            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 4000);
    };

    console.log('✅ Fee Record JS initialization complete');
});