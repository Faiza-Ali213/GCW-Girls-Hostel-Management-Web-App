document.addEventListener('DOMContentLoaded', function() {
    const section = document.querySelector('#split-section-trigger');
    
    if (section) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const reveals = entry.target.querySelectorAll('.reveal-left, .reveal-right, .reveal-fade-up');
                
                if (entry.isIntersecting) {
                    // USER ENTERS: Add classes to play animation
                    reveals.forEach((el, index) => {
                        setTimeout(() => {
                            el.classList.add('is-visible');
                        }, index * 150);
                    });
                } else {
                    // USER LEAVES: Remove classes to reset positions
                    // This allows the animation to play again when they scroll back
                    reveals.forEach((el) => {
                        el.classList.remove('is-visible');
                    });
                }
            });
        }, { 
            threshold: 0.1, // Trigger earlier
            rootMargin: "0px 0px -50px 0px" // Resets slightly before it leaves screen
        });

        observer.observe(section);
    }
});