<link rel="stylesheet" href="{{ asset('css/rules.css') }}">
<section class="rules-section py-5" id="rules-section">
    <div class="container">
        <div class="text-center mb-5 reveal-fade-down">
            <span class="badge-accent">Conduct & Discipline</span>
            <h2 class="display-5 fw-bold text-dark">Hostel Rules & Regulations</h2>
            <div class="header-line mx-auto"></div>
        </div>

        <div class="row g-4">
            @php
                $rules = [
                    ['icon' => 'bi-clock-history', 'title' => 'Gate Timings', 'desc' => 'The main gate closes strictly at 9:00 PM. No entry/exit is allowed after hours without prior written permission.'],
                    ['icon' => 'bi-person-badge', 'title' => 'Identity Cards', 'desc' => 'Residents must carry their hostel ID cards at all times and present.'],
                    ['icon' => 'bi-potted-plant', 'title' => 'Cleanliness', 'desc' => 'Rooms must be kept tidy. Littering in the corridors or lush green lawns is strictly prohibited.'],
                    ['icon' => 'bi-volume-mute', 'title' => 'Silence Hours', 'desc' => 'Quiet hours begin at 10:00 PM to ensure an environment conducive to academic focus and rest.'],
                    ['icon' => 'bi-lightning-charge', 'title' => 'Electric Appliances', 'desc' => 'Heavy electric appliances like heaters or ACs are not allowed. Usage of unauthorized items leads to fines.'],
                    ['icon' => 'bi-shield-check', 'title' => 'Visitors Policy', 'desc' => 'Only authorized visitors are allowed on Sundays (9 AM - 5 PM). No visitors are permitted inside resident rooms.']
                ];
            @endphp

            @foreach($rules as $rule)
            <div class="col-lg-4 col-md-6 reveal-card">
                <div class="rule-card">
                    <div class="rule-icon-box">
                        <i class="bi {{ $rule['icon'] }}"></i>
                    </div>
                    <h4>{{ $rule['title'] }}</h4>
                    <p>{{ $rule['desc'] }}</p>
                    <div class="rule-card-footer">
                        <span class="status-indicator"></span> Strictly Enforced
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script src="{{ asset('js/rules.js') }}"></script>