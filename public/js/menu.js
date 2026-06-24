document.addEventListener('DOMContentLoaded', function() {
    // 1. Reveal Animation on Scroll
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, observerOptions);

    const cards = document.querySelectorAll('.menu-card-wrapper');
    cards.forEach((card, index) => {
        // Set initial state
        card.style.opacity = "0";
        card.style.transform = "translateY(30px)";
        card.style.transition = `all 0.6s ease-out ${index * 0.1}s`;
        observer.observe(card);
    });

    // 2. "Active Meal" Highlighting
    // Automatically highlights Breakfast, Lunch, or Dinner based on real time
    const now = new Date();
    const hour = now.getHours();
    let mealType = '';

    if (hour >= 5 && hour < 11) mealType = 'Breakfast';
    else if (hour >= 11 && hour < 16) mealType = 'Lunch';
    else if (hour >= 18 && hour < 22) mealType = 'Dinner';

    if (mealType) {
        const labels = document.querySelectorAll('.meal-item label');
        labels.forEach(label => {
            if (label.innerText.trim() === mealType) {
                label.parentElement.style.background = "rgba(11, 46, 51, 0.05)";
                label.parentElement.style.borderRadius = "8px";
                label.parentElement.style.paddingLeft = "5px";
                label.innerHTML += ` <span class="badge bg-success" style="font-size:10px">Now Serving</span>`;
            }
        });
    }
});