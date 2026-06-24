<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="{{ asset('css/form.css') }}" rel="stylesheet">

<section class="contact-section" id="contact-trigger">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 contact-content reveal-up">
                <span class="accent-text d-block mb-2">Get In Touch</span>
                <h2 class="contact-title mb-4">Send Us a Message</h2>
                
                <form action="#" class="contact-form" id="hostelContactForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" id="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" id="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" rows="4" placeholder="How can we help you?" required></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn-submit">Send Message ↗</button>
                        </div>
                    </div>
                </form>

                <div class="contact-info-footer mt-5">
                    <div class="d-flex gap-4">
                        <div class="info-item">
                            <h6 class="fw-bold mb-1">Call Us</h6>
                            <p class="mb-0 text-muted">03157180041</p>
                        </div>
                        <div class="info-item">
                            <h6 class="fw-bold mb-1">Email Us</h6>
                            <p class="mb-0 text-muted">info@gcwhostel.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 reveal-zoom">
                <div class="map-visual-wrapper">
                    <img src="{{ asset('Assert/contact.png') }}" alt="Our Location" class="map-img-custom">
                </div>
            </div>

        </div>
    </div>
</section>

<script src="{{ asset('js/form.js') }}"></script>