document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.room-card');

    const observerOptions = {
        threshold: 0.15, 
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-active');
            } else {
                // Reverse animation on scroll up
                if (entry.boundingClientRect.top > 0) {
                    entry.target.classList.remove('is-active');
                }
            }
        });
    }, observerOptions);

    cards.forEach(card => observer.observe(card));
});