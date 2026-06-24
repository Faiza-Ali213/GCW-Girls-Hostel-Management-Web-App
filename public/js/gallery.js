document.addEventListener('DOMContentLoaded', function() {
    const gallerySection = document.querySelector('#gallery-trigger');
    
    if (gallerySection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const items = entry.target.querySelectorAll('.gallery-item, .reveal-down');
                
                if (entry.isIntersecting) {
                    // Start animations 1 by 1 with a slight delay
                    items.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.add('is-active');
                        }, index * 100);
                    });
                } else {
                    // RESET: Remove the class when scrolled away to allow repeat
                    items.forEach(item => {
                        item.classList.remove('is-active');
                    });
                }
            });
        }, { threshold: 0.1 });

        observer.observe(gallerySection);
    }
});