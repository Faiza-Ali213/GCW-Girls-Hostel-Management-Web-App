// Custom JavaScript for GCW Website
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ GCW Website loaded successfully!');
    
    // 1. FORM HANDLING FOR CONTACT PAGE
    const contactForm = document.querySelector('form');
    if (contactForm) {
        console.log('Contact form found');
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const name = document.getElementById('name')?.value || 'N/A';
            const email = document.getElementById('email')?.value || 'N/A';
            
            // Show success message
            alert(`Thank you ${name}! Your message has been sent.\nWe'll contact you at ${email} soon.`);
            
            // Reset form
            contactForm.reset();
            
            // Optional: You can add AJAX submission here later
            // fetch('/contact', { method: 'POST', body: new FormData(contactForm) })
        });
    }
    
    // 2. ACTIVE NAV LINK HIGHLIGHTING
    const currentPage = window.location.pathname;
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    
    console.log('Current page:', currentPage);
    
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        
        // Remove 'active' class from all links first
        link.classList.remove('active');
        
        // Check if this link matches current page
        if (linkPath === currentPage || 
            (currentPage === '/' && linkPath === '/') ||
            (currentPage === '' && linkPath === '/')) {
            link.classList.add('active');
            console.log('Active link set to:', link.textContent);
        }
    });
    
    // 3. CARD HOVER EFFECT ENHANCEMENT
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
    
    // 4. BOOTSTRAP TOOLTIP INITIALIZATION (if using tooltips)
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    if (tooltipTriggerList.length > 0 && typeof bootstrap !== 'undefined') {
        const tooltipList = [...tooltipTriggerList].map(
            tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl)
        );
    }
    
    // 5. FORM INPUT VALIDATION STYLING
    const formInputs = document.querySelectorAll('input, textarea, select');
    formInputs.forEach(input => {
        // Add focus effect
        input.addEventListener('focus', function() {
            this.style.borderColor = '#0d6efd';
            this.style.boxShadow = '0 0 0 0.2rem rgba(13, 110, 253, 0.25)';
        });
        
        // Remove focus effect
        input.addEventListener('blur', function() {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        });
    });
    
    // 6. CURRENT YEAR IN FOOTER (optional)
    const yearSpan = document.getElementById('current-year');
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }
    
    // 7. SMOOTH SCROLL FOR ANCHOR LINKS
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const targetElement = document.querySelector(href);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
    
    // 8. CONSOLE LOGGING FOR DEBUGGING
    console.log('JavaScript initialization complete');
    console.log('Active features:');
    console.log('- Form handling: ' + (contactForm ? 'Enabled' : 'Not found'));
    console.log('- Active nav links: ' + navLinks.length + ' links processed');
    console.log('- Card effects: ' + cards.length + ' cards enhanced');
});

// 9. WINDOW LOAD EVENT (for images/async content)
window.addEventListener('load', function() {
    console.log('🎉 Page fully loaded with all resources');
    
    // Add loaded class to body for CSS transitions
    document.body.classList.add('loaded');
});

// 10. ERROR HANDLING
window.addEventListener('error', function(e) {
    console.error('JavaScript Error:', e.message, 'at', e.filename, 'line', e.lineno);
});

// 11. RESIZE HANDLER (responsive adjustments)
let resizeTimeout;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function() {
        console.log('Window resized to:', window.innerWidth, 'x', window.innerHeight);
    }, 250);
});

// 12. EXPORT FUNCTIONS (if needed for other scripts)
window.gcwWebsite = {
    showAlert: function(message) {
        alert(message);
    },
    getFormData: function(formId) {
        const form = document.getElementById(formId);
        if (!form) return null;
        
        const data = {};
        new FormData(form).forEach((value, key) => {
            data[key] = value;
        });
        return data;
    }
};


