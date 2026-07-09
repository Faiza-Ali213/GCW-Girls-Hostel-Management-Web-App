<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .dashboard-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .welcome-text {
            color: #333;
            font-weight: 700;
        }
        .user-email {
            color: #667eea;
        }
        .btn-logout {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
        }
        .btn-logout:hover {
            background: #c0392b;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="dashboard-card text-center">
            <h1 class="welcome-text">🎉 Welcome, {{ Auth::user()->name }}!</h1>
            <p class="user-email">📧 {{ Auth::user()->email }}</p>
            <hr>
            <p class="text-muted">You have successfully logged in to your dashboard.</p>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">🚪 Logout</button>
            </form>
        </div>
    </div>
</body>
</html>