document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.2 // Trigger when 20% of the element is visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-active');
                // Optional: Stop observing after animation is done
                // observer.unobserve(entry.target); 
            }
        });
    }, observerOptions);

    // Attach observer to all reveal elements
    const revealElements = document.querySelectorAll('.reveal-fade-down, .reveal-slide-right, .reveal-slide-left');
    revealElements.forEach(el => observer.observe(el));
});