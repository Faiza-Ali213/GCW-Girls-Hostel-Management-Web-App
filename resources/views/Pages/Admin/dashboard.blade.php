@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <h2>Dashboard Overview</h2>
        <p class="text-muted">Hostel Management Statistics</p>
    </div>

    <div class="stats-container">
        <div class="row-top">
            <div class="pro-card">
                <div class="icon-circle">
                    <i class="bi bi-house-door"></i>
                </div>
                <span class="stat-label">Total Rooms</span>
                <span class="stat-value">120</span>
            </div>

            <div class="pro-card">
                <div class="icon-circle">
                    <i class="bi bi-people"></i>
                </div>
                <span class="stat-label">Total Students</span>
                <span class="stat-value">450</span>
            </div>

            <div class="pro-card">
                <div class="icon-circle">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <span class="stat-label">Total Staff</span>
                <span class="stat-value">25</span>
            </div>
        </div>

        <div class="row-bottom">
            <div class="pro-card">
                <div class="icon-circle">
                    <i class="bi bi-bookmark-check"></i>
                </div>
                <span class="stat-label">Allocated Rooms</span>
                <span class="stat-value">105</span>
            </div>

            <div class="pro-card">
                <div class="icon-circle">
                    <i class="bi bi-door-open"></i>
                </div>
                <span class="stat-label">Empty Rooms</span>
                <span class="stat-value">15</span>
            </div>
        </div>
    </div>
</div>
@endsection