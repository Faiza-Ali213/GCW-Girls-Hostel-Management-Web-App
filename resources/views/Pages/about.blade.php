@extends('Layout.app')

@section('content')
<link href="{{ asset('css/about.css') }}" rel="stylesheet">

<section class="about-section" id="about-trigger">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 about-text-col">
                <h2 class="about-heading reveal-down">ABOUT US</h2>
                <div class="heading-line reveal-down"></div>
                
                <div class="about-passage" id="typewriter-text">
                    Experience peace of mind with 24/7 security in a vibrant environment designed exclusively for girls. Focus on your goals while we take care of the rest—from high-speed internet to nutritious meals. More than just a room—it's a community where friendships grow and dreams take flight.
                </div>
            </div>

            <div class="col-lg-6 about-img-col">
                <div class="about-bg-shape"></div>
                <div class="about-main-image reveal-right-slide">
                    <img src="{{ asset('Assert/about_icon.png') }}" alt="Our Team">
                </div>
            </div>

        </div>
    </div>
</section>

<script src="{{ asset('js/about.js') }}"></script>

@include('Component.History')
@include('Component.gallery')
@include('Component.faq')
@include('Component.contact_detail')

@endsection