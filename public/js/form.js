document.addEventListener('DOMContentLoaded', function() {
    // --- 1. Scroll Reveal Logic ---
    const contactSection = document.querySelector('#contact-trigger');
    
    if (contactSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const elements = entry.target.querySelectorAll('.reveal-zoom, .reveal-up');
                
                if (entry.isIntersecting) {
                    elements.forEach((el, index) => {
                        // Staggered effect for zoom and up animations
                        setTimeout(() => {
                            el.classList.add('is-active');
                        }, index * 200);
                    });
                } else {
                    // Reset animations when scrolling away
                    elements.forEach(el => el.classList.remove('is-active'));
                }
            });
        }, { threshold: 0.15 });

        observer.observe(contactSection);
    }

    // --- 2. Form Submission & Success Popup ---
    const contactForm = document.getElementById('hostelContactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Stop page from refreshing

            // Capture the name for the personalized alert
            const nameInput = document.getElementById('name');
            const userName = nameInput ? nameInput.value : 'Student';

            // Trigger SweetAlert2 Success Message
            // Inside your Form Submission logic in form.js
Swal.fire({
    title: 'Message Received!',
    text: `Thank you, ${userName}. We'll respond shortly.`,
    icon: 'success',
    iconColor: '#0B2E33', // Custom color for the checkmark
    background: '#ffffff',
    showConfirmButton: true,
    confirmButtonText: 'Continue',
    confirmButtonColor: '#0B2E33',
    customClass: {
        popup: 'hostel-popup-style',
        title: 'hostel-popup-title',
        confirmButton: 'hostel-popup-button'
    },
    showClass: {
        popup: 'animate__animated animate__zoomIn' // Using Animate.css style
    },
    hideClass: {
        popup: 'animate__animated animate__fadeOut'
    }
});

            // Clear the form fields
            this.reset();
        });
    }
});