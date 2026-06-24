<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GCW Hostel')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="{{ asset('css/room.css') }}" rel="stylesheet">
    <link href="{{ asset('css/features.css') }}" rel="stylesheet">
    
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* --- NAVIGATION STYLE --- */
        .navbar {
            background-color: #0B2E33  !important; 
            padding: 10px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            color: #FFFF !important;
        }
        .navbar-brand {
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #0B2E33 !important;
            font-size: 24px;
        }
        
        .nav-logo-img {
            width: 60px;
            height: auto;
            transition: transform 0.3s ease;
        }

        /* --- HEADER HOVER BAR EFFECT --- */
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            margin: 0 15px;
            font-weight: 500;
            position: relative;
            padding: 5px 0 !important;
            transition: 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #FFFFFF;
            transition: all 0.3s ease-in-out;
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: #FFFFFF !important;
        }

        .nav-link:hover::after {
            width: 100%;
        }
        
        .btn-pill {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            margin-left: 10px;
            font-size: 14px;
            transition: 0.3s;
        }
        .btn-book { background-color: #FFFFFF; color: #0B2E33; border: none; }
        .btn-book:hover { background-color: #f0f0f0; transform: translateY(-2px); }

        /* --- FIXED FOOTER STYLING --- */
        .footer-main {
            background-color: #0B2E33;
            color: #FFFFFF;
            padding: 80px 0 40px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .footer-logo-text {
            font-size: 28px;
            font-weight: 800;
            color: #FFFFFF;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .footer-logo-img {
            width: 80px;
            height: auto;
        }

        .footer-about-text {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .footer-nav-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
            color: #FFFFFF;
        }

        .footer-nav-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 30px;
            height: 2px;
            background-color: #FFFFFF;
        }

        .footer-links { list-style: none; padding: 0; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 15px;
            transition: 0.3s;
        }
        .footer-links a:hover { 
            color: #FFFFFF;
            padding-left: 5px;
        }
        
        .contact-info-list {
            list-style: none;
            padding: 0;
        }

        .contact-info-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: rgba(255,255,255,0.8);
        }

        .contact-info-list i {
            font-size: 18px;
        }

        .social-links { display: flex; gap: 15px; }
        .social-links a { 
            width: 35px;
            height: 35px;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #FFFFFF; 
            transition: 0.3s; 
            text-decoration: none;
        }
        .social-links a:hover { 
            background: #FFFFFF;
            color: #0B2E33;
            transform: translateY(-3px);
        }

        .footer-sub-bar {
            background-color: #09262a; /* Slightly darker than main footer */
            padding: 20px 0;
            font-size: 14px;
            color: rgba(255,255,255,0.5);
            border-top: 2px solid #FFFFFF;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('Assert/logo.png') }}" alt="Logo" class="nav-logo-img"> 
                <span>GCW HOSTEL Management</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <a href="/booking" class="btn btn-pill btn-book">Book Now ↗</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer-main">
        <div class="container">
            <div class="row g-4"> <div class="col-lg-4 col-md-6">
                    <a href="/" class="footer-logo-text">
                        <img src="{{ asset('Assert/logo.png') }}" alt="GCW" class="footer-logo-img"> 
                        GCW Hostel Management
                    </a>
                    <p class="footer-about-text">
                        GCW Girls Hostel provides a safe, secure, and nurturing environment specifically designed for female students and professionals.
                    </p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/share/1Cd5uQRT1W/"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/ggcw_grw_official?igsh=b2UycmxwbHRpZ2lo"><i class="bi bi-instagram"></i></a>
                        <a href="https://wa.me/923157180041"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-nav-title">Navigation</h5>
                    <ul class="footer-links">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/services">Our Services</a></li>
                        <li><a href="/Rooms">Room Gallery</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-nav-title">Explore</h5>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}#gallery-section">Photo Gallery</a></li>
                        <li><a href="{{ url('/') }}#faq-section">Hostel FAQs</a></li>
                        <li><a href="{{ url('/') }}#rules-section">Hostel Rules</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-nav-title">Contact Info</h5>
                    <ul class="contact-info-list">
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span>Satellite Town, Gujranwala, Pakistan</span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>0315-7180041</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i>
                            <span>info@gcwhostel.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <div class="footer-sub-bar text-center">
        <div class="container">
            <span>© {{ date('Y') }} GCW Hostel. All rights reserved. Built for GCW Students.</span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>