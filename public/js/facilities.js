document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.2,
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-active');
            } else {
                if (entry.boundingClientRect.top > 0) {
                    entry.target.classList.remove('reveal-active');
                }
            }
        });
    }, observerOptions);

    const cards = document.querySelectorAll('.stacked-card-wrapper');
    cards.forEach(card => observer.observe(card));
});