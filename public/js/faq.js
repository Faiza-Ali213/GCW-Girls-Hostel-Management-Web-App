function toggleFaq(index) {
    const card = document.querySelector(`.faq-card[data-index="${index}"]`);
    const body = document.getElementById(`faq-body-${index}`);
    const allCards = document.querySelectorAll('.faq-card');
    const allBodies = document.querySelectorAll('.faq-body');

    // Close other FAQs
    allCards.forEach((c, i) => {
        if (i !== index) {
            c.classList.remove('active');
            allBodies[i].style.maxHeight = null;
        }
    });

    // Toggle current
    if (card.classList.contains('active')) {
        card.classList.remove('active');
        body.style.maxHeight = null;
    } else {
        card.classList.add('active');
        // scrollHeight dynamically calculates the text height for any device
        body.style.maxHeight = body.scrollHeight + "px";
    }
}

// Initial Animation for Reveal
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }, index * 100);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal-up').forEach(el => {
        el.style.opacity = "0";
        el.style.transform = "translateY(30px)";
        el.style.transition = "all 0.6s ease-out";
        observer.observe(el);
    });
});