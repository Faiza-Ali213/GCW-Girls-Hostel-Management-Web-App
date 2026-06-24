<link rel="stylesheet" href="{{ asset('css/faq.css') }}">
<section class="faq-modern-section py-5" id="faq-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="faq-pre-title">Hostel Life Insights</span>
            <h2 class="faq-main-title">Frequently Asked Questions</h2>
            <div class="title-accent-bar"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="faq-container">
                    @php
                        $faqs = [
                            ['q' => 'What are the visiting hours for parents?', 'a' => 'Parents and authorized guardians can visit on Sundays between 9:00 AM and 5:00 PM. Weekday visits require Warden approval.'],
                            ['q' => 'Is the mess fee included in the monthly rent?', 'a' => 'Yes! The monthly package covers 3 hygienic meals daily. Our menu includes items like Biryani, Palak Chicken, and special Sunday treats like Halwa Puri.'],
                            ['q' => 'What is the security protocol at the hostel?', 'a' => 'Security is our priority. We feature 24/7 CCTV surveillance and professional on-site guards to ensure a safe environment.'],
                            ['q' => 'Is high-speed Wi-Fi available?', 'a' => 'Absolutely. We provide 24/7 unlimited high-speed Wi-Fi access throughout the hostel premises to support your academic needs.'],
                        ];
                    @endphp

                    @foreach($faqs as $index => $item)
                    <div class="faq-card shadow-sm reveal-up"  data-index="{{ $index }}">
                        <div class="faq-header" onclick="toggleFaq({{ $index }})">
                            <span class="faq-question">{{ $item['q'] }}</span>
                            <div class="faq-icon-wrapper">
                                <span class="faq-icon">+</span>
                            </div>
                        </div>
                        <div class="faq-body" id="faq-body-{{ $index }}">
                            <div class="faq-content">
                                <p class="mb-0">{{ $item['a'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('js/faq.js') }}"></script>