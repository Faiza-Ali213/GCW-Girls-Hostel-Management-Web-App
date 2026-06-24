@extends('Layout.app')
<link rel="stylesheet" href="{{ asset('css/Booking.css') }}">
@section('title', 'How to Book - GCW Hostel')

@section('content')
<div class="booking-page-wrapper">
    <div class="booking-hero text-center text-white d-flex align-items-center">
        <div class="container">
            <h1 class="display-4 fw-bold reveal-up">Secure Your Space</h1>
            <p class="lead reveal-up">Follow our simple on-site process to join our community.</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-8">
                <div class="info-card p-5 shadow-sm border-0 rounded-4 bg-white text-center">
                    <div class="icon-box mb-4">
                        <i class="bi bi-info-circle-fill fs-1" style="color: #0B2E33;"></i>
                    </div>
                    <h2 class="fw-bold mb-3">On-Site Registration Only</h2>
                    <p class="text-muted mb-4">
                        To ensure the safety and security of all our residents, we require all applicants to visit the hostel in person for registration. This allows you to view the facilities and for us to process your application securely.
                    </p>
                    
                    <hr class="my-5">

                    <h4 class="fw-bold mb-4">Registration Steps</h4>
                    <div class="row text-start">
                        <div class="col-md-4 mb-3">
                            <div class="step-num">01</div>
                            <h6>Visit Hostel</h6>
                            <small class="text-muted">Visit our reception during office hours (9 AM - 4 PM).</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="step-num">02</div>
                            <h6>Documents</h6>
                            <small class="text-muted">Bring your CNIC, Student ID, and 2 passport photos.</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="step-num">03</div>
                            <h6>Confirmation</h6>
                            <small class="text-muted">Pay the security deposit to lock your preferred room.</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="contact-card p-4 rounded-4 text-white" style="background: #0B2E33;">
                    <h5>Need Help?</h5>
                    <p class="small opacity-75">Call us to check room availability before you visit.</p>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-telephone-fill me-3"></i>
                        <span>03157180041</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-geo-alt-fill me-3"></i>
                        <span>Satellite Town, Gujranwala</span>
                    </div>
                    <a href="https://wa.me/03157180041" class="btn btn-light w-100 mt-4 fw-bold">Chat on WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/booking.js') }}"></script>

@endsection