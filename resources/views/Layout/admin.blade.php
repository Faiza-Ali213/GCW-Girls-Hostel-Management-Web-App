<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | GCW Hostel</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --gcw-green: #4CAF50;
            --gcw-dark: #0B2E33;
            --bg-light: #F8F9FA;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            margin: 0;
        }

        /* --- SIDEBAR STRUCTURE --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #FFFFFF;
            border-right: 1px solid #EAEAEA;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        /* User Profile Section */
        .sidebar-user {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            background: #eee;
        }

        .user-info h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .status-badge {
            font-size: 11px;
            color: var(--gcw-green);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background: var(--gcw-green);
            border-radius: 50%;
        }

        /* Logo Section - Increased Size */
        .sidebar-logo {
            text-align: center;
            padding: 20px 0 30px 0; /* Adjusted padding for larger logo */
        }
        .sidebar-logo img {
            width: 100px; /* Increased from 50px */
            height: auto;
            transition: transform 0.3s ease;
        }

        /* Navigation Links */
        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .nav-item {
            margin: 4px 15px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            text-decoration: none;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-link-custom i {
            font-size: 18px;
            color: #888;
        }

        /* Active State */
        .nav-item.active .nav-link-custom {
            background-color: #E8F5E9;
            color: var(--gcw-green);
        }
        
        .nav-item.active .nav-link-custom i {
            color: var(--gcw-green);
        }

        .nav-link-custom:hover:not(.active) {
            background-color: #f0f0f0;
            color: #333;
        }

        /* Bottom Logout Section */
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #EAEAEA;
        }

        /* --- MAIN CONTENT AREA --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .sidebar.active { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('Assert/logo.png') }}" alt="GCW">
        </div>

        <ul class="nav-list">
            <li class="nav-item {{ request()->routeIs('student_records') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link-custom">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('Room_allocation') ? 'active' : '' }}">
                <a href="{{ route('student-records') }}" class="nav-link-custom">
                    <i class="bi bi-door-open"></i> Student Records
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('Room_allocation') ? 'active' : '' }}">
            <li class="nav-item {{ request()->routeIs('room_allocation') ? 'active' : '' }}">
    <a href="{{ route('room_allocation') }}" class="nav-link-custom">
        <i class="bi bi-door-open"></i> Room Allocation
    </a>
</li>
            <li class="nav-item {{ request()->routeIs('fee_record') ? 'active' : '' }}">
                <a href="{{ route('fee_record') }}" class="nav-link-custom">
                    <i class="bi bi-cash-stack"></i> Fee Record
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('staff_records') ? 'active' : '' }}">
                <a href="{{ route('staff_records') }}" class="nav-link-custom">
                    <i class="bi bi-people"></i> Staff Records
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('vistors_records') ? 'active' : '' }}">
                <a href="{{ route('vistors_records') }}" class="nav-link-custom">
                    <i class="bi bi-person-badge"></i> Visitors
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('Complain_request') ? 'active' : '' }}">
                <a href="{{ route('Complain_request') }}" class="nav-link-custom">
                    <i class="bi bi-exclamation-square"></i> Complaints
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('Notification') ? 'active' : '' }}">
                <a href="{{ route('Notification') }}" class="nav-link-custom">
                    <i class="bi bi-bell"></i> Notifications
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="#" class="nav-link-custom">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-wrapper">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>