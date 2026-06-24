document.addEventListener('DOMContentLoaded', function() {
    const section = document.querySelector('#contact-trigger');
    
    if (section) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const anims = entry.target.querySelectorAll('.reveal-zoom, .reveal-up');
                if (entry.isIntersecting) {
                    anims.forEach((el) => el.classList.add('is-active'));
                } else {
                    anims.forEach((el) => el.classList.remove('is-active'));
                }
            });
        }, { threshold: 0.1 });
        observer.observe(section);
    }
});