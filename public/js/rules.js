document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Staggered reveal effect
                setTimeout(() => {
                    entry.target.classList.add('active');
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const cards = document.querySelectorAll('.reveal-card, .reveal-fade-down');
    cards.forEach(card => observer.observe(card));
});

// Inline CSS for the animation state
const style = document.createElement('style');
style.textContent = `
    .reveal-card { opacity: 0; transform: translateY(50px); transition: all 0.6s ease-out; }
    .reveal-card.active { opacity: 1; transform: translateY(0); }
    .reveal-fade-down { opacity: 0; transform: translateY(-30px); transition: all 0.6s ease-out; }
    .reveal-fade-down.active { opacity: 1; transform: translateY(0); }
`;
document.head.appendChild(style);