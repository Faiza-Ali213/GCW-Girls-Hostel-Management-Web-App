<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
<section class="mess-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge-accent">Healthy & Fresh</span>
            <h2 class="display-5 fw-bold text-dark">Hostel Mess Menu</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                We provide nutritious, home-style meals prepared with hygiene and care to keep you energized for your studies.
            </p>
        </div>

        <div class="row g-4">
            @php
                $menu = [
                    ['day' => 'Monday', 'breakfast' => 'Bread + Egg + Tea', 'lunch' => 'Green Korma + Roti', 'dinner' => 'Aloo Anda + Roti', 'icon' => 'bi-sun'],
                    ['day' => 'Tuesday', 'breakfast' => 'Bread + Jam + Tea', 'lunch' => 'Lobia + Roti', 'dinner' => 'Aloo Gobi + Roti', 'icon' => 'bi-brightness-high'],
                    ['day' => 'Wednesday', 'breakfast' => 'Bread + Egg + Tea', 'lunch' => 'Palak Chicken + Roti', 'dinner' => 'Masoor Chawal', 'icon' => 'bi-cloud-sun'],
                    ['day' => 'Thursday', 'breakfast' => 'Naan Chana + Tea', 'lunch' => 'Haleem / Kadhi Pakora + Roti', 'dinner' => 'Aloo Matar + Roti', 'icon' => 'bi-sun-fill'],
                    ['day' => 'Friday', 'breakfast' => 'Bread + Jam + Tea', 'lunch' => 'Biryani / Chicken Pulao + Raita', 'dinner' => 'Aloo Baingan + Roti', 'icon' => 'bi-stars'],
                    ['day' => 'Saturday', 'breakfast' => 'Bread + Egg + Tea', 'lunch' => 'Chicken + Roti', 'dinner' => 'Mix Dal + Roti + Dahi Bhallay', 'icon' => 'bi-moon-stars'],
                    ['day' => 'Sunday', 'breakfast' => 'Poori Chana + Tea', 'lunch' => 'Mix Veg + Roti', 'dinner' => 'Veg Pulao / Aloo Pulao + Raita', 'icon' => 'bi-heart-fill']
                ];
            @endphp

            @foreach($menu as $item)
            <div class="col-lg-3 col-md-6 menu-card-wrapper" data-aos="fade-up">
                <div class="menu-card">
                    <div class="menu-day-header">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <h5>{{ $item['day'] }}</h5>
                    </div>
                    <div class="menu-body">
                        <div class="meal-item">
                            <label>Breakfast</label>
                            <span>{{ $item['breakfast'] }}</span>
                        </div>
                        <div class="meal-item">
                            <label>Lunch</label>
                            <span>{{ $item['lunch'] }}</span>
                        </div>
                        <div class="meal-item">
                            <label>Dinner</label>
                            <span>{{ $item['dinner'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-lg-3 col-md-6">
                <div class="menu-card treat-card">
                    <div class="special-badge">Special</div>
                    <div class="menu-day-header text-white">
                        <i class="bi bi-gift-fill"></i>
                        <h5>Monthly Treat</h5>
                    </div>
                    <div class="menu-body text-white">
                        <p class="mt-3">Twice a month, we serve a special grand feast including:</p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check2-circle"></i> Ice Cream</li>
                            <li><i class="bi bi-check2-circle"></i> Roast Chicken</li>
                            <li><i class="bi bi-check2-circle"></i> Cold Drinks</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('js/menu.js') }}"></script>