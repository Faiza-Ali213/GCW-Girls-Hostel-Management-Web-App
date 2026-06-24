document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.2,
        rootMargin: "0px 0px -50px 0px" // Trigger slightly before the card hits the viewport
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // When scrolling DOWN: Add active class
                entry.target.classList.add('reveal-active');
            } else {
                // When scrolling UP: If the card leaves the top of the viewport
                if (entry.boundingClientRect.top > 0) {
                    entry.target.classList.remove('reveal-active');
                }
            }
        });
    }, observerOptions);

    const cards = document.querySelectorAll('.stacked-card-wrapper');
    cards.forEach(card => observer.observe(card));
});