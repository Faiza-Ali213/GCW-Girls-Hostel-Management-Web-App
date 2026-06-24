document.addEventListener('DOMContentLoaded', function() {
    // 1. Initial Page Load Reveal
    const reveals = document.querySelectorAll('.reveal-up');
    setTimeout(() => {
        reveals.forEach(el => el.classList.add('active'));
    }, 100);

    // 2. The Fade-Out Nav Effect
    // This looks for any link pointing to /booking and adds the effect
    const bookButtons = document.querySelectorAll('a[href="/booking"], .btn-book');
    
    bookButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetUrl = this.getAttribute('href');
            
            // Add fade out class to the whole body
            document.body.style.transition = "opacity 0.5s ease";
            document.body.style.opacity = "0";
            
            setTimeout(() => {
                window.location.href = targetUrl;
            }, 500);
        });
    });
});