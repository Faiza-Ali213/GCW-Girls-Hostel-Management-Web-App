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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .dashboard-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 600px;
            margin: 100px auto;
        }
        .welcome-text {
            color: #333;
            font-weight: 700;
            font-size: 28px;
        }
        .user-email {
            color: #667eea;
            font-size: 18px;
        }
        .btn-logout {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-logout:hover {
            background: #c0392b;
            color: white;
            transform: translateY(-2px);
        }
        .btn-dashboard {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            margin: 5px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .btn-dashboard-secondary {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            margin: 5px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-dashboard-secondary:hover {
            background: #5a6268;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-card">
            <div class="mb-4">
                <span style="font-size: 60px;">🎉</span>
            </div>
            <h1 class="welcome-text">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="user-email">📧 {{ Auth::user()->email }}</p>
            <hr>
            <p class="text-muted">You have successfully logged in to the Hostel Management System.</p>
            
            <div class="mt-4">
                <a href="/dashboard" class="btn-dashboard">🏠 Dashboard</a>
                <a href="/student-records" class="btn-dashboard-secondary">👨‍🎓 Students</a>
                <a href="/staff-records" class="btn-dashboard-secondary">👔 Staff</a>
            </div>
            
            <div class="mt-4">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">🚪 Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>