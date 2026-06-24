@extends('Layout.app')

@section('content')
<link href="{{ asset('css/service.css') }}" rel="stylesheet">
<section class="dental-hero">
    <div class="teal-panel">
        <div class="content-wrapper">
            <span class="sub-title animate-top">SERVICES</span>
            <h1 class="main-heading animate-top">
               Welcome to Your Next Great Adventure
            </h1>
        </div>
    </div>
    <div class="image-panel">
        <img src="{{ asset('Assert/Hero.png') }}" 
             alt="Dental Procedure" 
             class="animate-right">
    </div>
</section>
<script src="{{ asset('js/service.js') }}"></script>


@include('Component.menu')
@include('Component.room')
@include('Component.facilities')
@include('Component.faq')
@include('Component.contact_detail')
@endsection