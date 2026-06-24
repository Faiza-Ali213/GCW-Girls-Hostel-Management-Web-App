document.addEventListener('DOMContentLoaded', function() {
    // 1. Setup Typewriter Spacing
    const textEl = document.getElementById('contact-typewriter');
    if (textEl) {
        const words = textEl.innerText.trim().split(/\s+/);
        textEl.innerHTML = ''; 
        words.forEach(word => {
            const span = document.createElement('span');
            span.innerText = word;
            span.classList.add('word-span');
            textEl.appendChild(span);
        });
    }

    // 2. Intersection Observer for Animations
    const observerOptions = { threshold: 0.15 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Trigger Hero/Form Animations
                const animElements = entry.target.querySelectorAll('.reveal-down, .reveal-right-slide, .reveal-up-btn, .reveal-up, .reveal-zoom');
                animElements.forEach((el, index) => {
                    setTimeout(() => el.classList.add('is-active'), index * 150);
                });

                // Trigger Typewriter words
                const spans = entry.target.querySelectorAll('.word-span');
                spans.forEach((span, index) => {
                    setTimeout(() => span.style.opacity = '1', index * 100);
                });
            }
        });
    }, observerOptions);

    // Observe Hero and Form sections
    const sections = document.querySelectorAll('.contact-hero, .contact-section');
    sections.forEach(sec => observer.observe(sec));
});