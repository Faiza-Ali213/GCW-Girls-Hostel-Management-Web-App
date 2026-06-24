document.addEventListener('DOMContentLoaded', function() {
    const section = document.querySelector('#features-trigger');
    
    if (section) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const anims = entry.target.querySelectorAll('.reveal-down, .reveal-up, .reveal-left-slide');
                
                if (entry.isIntersecting) {
                    // Trigger animations sequentially
                    anims.forEach((el, index) => {
                        setTimeout(() => {
                            el.classList.add('is-active');
                        }, index * 100);
                    });
                } else {
                    // Reset animations when leaving the screen to allow repeat
                    anims.forEach(el => el.classList.remove('is-active'));
                }
            });
        }, { threshold: 0.2 });

        observer.observe(section);
    }
});