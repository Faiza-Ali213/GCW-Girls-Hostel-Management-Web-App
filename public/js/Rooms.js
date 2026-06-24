document.addEventListener('DOMContentLoaded', function() {
    // Hero Entrance
    const heroContent = document.querySelector('.reveal-hero');
    const heroBar = document.querySelector('.reveal-hero-up');

    if(heroContent) {
        heroContent.style.opacity = "0";
        heroContent.style.transform = "translateY(-30px)";
        setTimeout(() => {
            heroContent.style.transition = "all 1s ease-out";
            heroContent.style.opacity = "1";
            heroContent.style.transform = "translateY(0)";
        }, 200);
    }

    if(heroBar) {
        heroBar.style.opacity = "0";
        heroBar.style.transform = "translateY(40px)";
        setTimeout(() => {
            heroBar.style.transition = "all 1s cubic-bezier(0.2, 1, 0.3, 1)";
            heroBar.style.opacity = "1";
            heroBar.style.transform = "translateY(0)";
        }, 500);
    }

    // Room Card Intersection Observer
    const cards = document.querySelectorAll('.room-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-active');
            } else {
                // Reset animation when scrolling back up
                if (entry.boundingClientRect.top > 0) {
                    entry.target.classList.remove('is-active');
                }
            }
        });
    }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

    cards.forEach(card => observer.observe(card));
});