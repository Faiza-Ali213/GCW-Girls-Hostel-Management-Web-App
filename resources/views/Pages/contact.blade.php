@extends('Layout.app')

@section('content')
<link href="{{ asset('css/contact.css') }}" rel="stylesheet">

<section class="contact-hero" id="contact-hero-trigger">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            
            <div class="col-lg-6 contact-hero-text">
                <div class="hero-content-wrapper">
                    <h1 class="contact-hero-title reveal-down">Reach Out <br>To Us</h1>
                    <div class="heading-line reveal-down"></div>
                    
                    <p class="contact-hero-passage" id="contact-typewriter">
                        Have questions about our facilities or room availability? Our team is here to help you find your perfect home away from home. We prioritize your comfort and safety from the very first hello.
                    </p>

                    <div class="mt-5 reveal-up-btn" >
                        <a href="#contact-trigger" class="btn-scroll-down">
                            SCROLL TO DETAILS <i class="bi bi-arrow-down-short"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 contact-hero-img-col">
                <div class="contact-bg-blob"></div>
                <div class="contact-hero-image reveal-right-slide">
                    <img src="{{ asset('assert/customer-service.png') }}" alt="Contact GCW Hostel">
                </div>
            </div>

        </div>
    </div>
</section>
@include('component.contact_detail')
@include('component.form')

<script src="{{ asset('js/contact.js') }}"></script>

@endsection