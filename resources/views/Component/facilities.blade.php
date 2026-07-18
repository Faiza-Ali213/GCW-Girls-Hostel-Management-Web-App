<link rel="stylesheet" href="{{ asset('css/facilities.css') }}">
<section class="facilities-stacked-section" id="facilities-section">
    <div class="container">
        <div class="section-intro text-center mb-5">
            <span class="hostel-tag">🏆 Hostel Life Insights</span>
            <h2 class="section-title">Premium <span>Facilities</span></h2>
            <p class="section-subtitle">Discover our top-notch amenities designed for your comfort and safety</p>
        </div>

        <div class="stacked-cards-container">
            @php
                $facilities = [
                    [
                        'id' => '01',
                        'label' => 'Outdoor',
                        'title' => 'Lush Green Lawns',
                        'desc' => 'Our outdoor space is designed for relaxation and connection with nature. Enjoy the fresh air in our charming garden nook, surrounded by shady trees and lush greenery.',
                        'img' => 'Assert/image copy.png',
                        'features' => ['🌿 Garden Area', '🌳 Shady Trees', '🪑 Seating Areas']
                    ],
                    [
                        'id' => '02',
                        'label' => 'Interior',
                        'title' => 'Comfortable Living',
                        'desc' => 'Experience a home-like feel with our fully equipped dining areas and neat, clean washrooms designed for modern student life.',
                        'img' => 'Assert/room2.jpeg',
                        'features' => ['🛋️ Modern Furniture', '🍽️ Dining Area', '🚿 Clean Washrooms']
                    ],
                    [
                        'id' => '03',
                        'label' => 'Safety',
                        'title' => 'Advanced Security',
                        'desc' => 'Security is our priority. We feature 24/7 CCTV surveillance, and professional on-site guards.',
                        'img' => 'Assert/feature.jpeg',
                        'features' => ['📹 24/7 CCTV', '🛡️ On-site Guards', '🔒 Secure Access']
                    ],
                    [
                        'id' => '04',
                        'label' => 'Dining',
                        'title' => 'Hygienic Mess',
                        'desc' => 'Enjoy nutritious, hygienic food with special party meals served 4 times a month and bi-monthly treats for all residents.',
                        'img' => 'Assert/image.png',
                        'features' => ['🥗 Nutritious Meals', '🎉 Party Meals', '🧼 Hygienic Kitchen']
                    ]
                ];
            @endphp

            @foreach($facilities as $index => $f)
            <div class="stacked-card-wrapper">
                <div class="facility-card-main card-{{ $index + 1 }}">
                    <div class="card-number">{{ $f['id'] }}</div>
                    <div class="card-header-label">{{ $f['id'] }} / {{ $f['label'] }}</div>
                    <div class="row align-items-center h-100">
                        <div class="col-lg-6 px-lg-5">
                            <h3 class="card-heading-large">{{ $f['title'] }}</h3>
                            <p class="card-text-detail">{{ $f['desc'] }}</p>
                            @if(isset($f['features']))
                            <div class="card-features">
                                @foreach($f['features'] as $feature)
                                <span class="card-feature-item">
                                    <i class="fas fa-check-circle"></i> {{ $feature }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                            <a href="#" class="card-explore-btn">
                                Explore More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                        <div class="col-lg-6 h-100">
                            <div class="card-image-container">
                                <img src="{{ asset($f['img']) }}" alt="{{ $f['title'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-progress">
                        <div class="card-progress-bar"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<script src="{{ asset('js/facilities.js') }}"></script>