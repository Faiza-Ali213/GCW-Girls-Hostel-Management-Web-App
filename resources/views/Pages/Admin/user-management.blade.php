@extends('Layout.admin')

@section('page_title', 'User Management')
@section('page_subtitle', 'Manage system users and permissions')

@section('content')
<style>
/* ============================================
   PREMIUM USER MANAGEMENT STYLES
   ============================================ */

/* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

.user-management-wrapper {
    font-family: 'Inter', sans-serif;
    padding: 0 4px;
}

/* ============================================
   PAGE HEADER
   ============================================ */
.page-header-modern {
    padding: 20px 24px;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    border: 1px solid rgba(226, 232, 240, 0.6);
    margin-bottom: 24px;
}

.page-title-modern {
    font-size: 26px;
    font-weight: 800;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.title-gradient {
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 50%, #EC4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.title-badge {
    background: linear-gradient(135deg, #10B981, #34D399);
    color: white;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 12px;
    border-radius: 20px;
    -webkit-text-fill-color: white;
}

.page-subtitle-modern {
    color: #94A3B8;
    font-size: 14px;
    margin: 4px 0 0 0;
    display: flex;
    align-items: center;
    gap: 4px;
}

.btn-primary-modern {
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: white;
    border: none;
    padding: 12px 28px;
    border-radius: 14px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
}

.btn-primary-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(79, 70, 229, 0.4);
    color: white;
}

/* ============================================
   STATISTICS GRID
   ============================================ */
.stats-grid-modern {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}

.stat-item {
    background: #ffffff;
    padding: 20px 24px;
    border-radius: 16px;
    border: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06);
}

.stat-item:hover::before {
    opacity: 1;
}

.stat-item.stat-total::before { background: linear-gradient(90deg, #4F46E5, #7C3AED); }
.stat-item.stat-active::before { background: linear-gradient(90deg, #10B981, #34D399); }
.stat-item.stat-inactive::before { background: linear-gradient(90deg, #EF4444, #F87171); }
.stat-item.stat-admin::before { background: linear-gradient(90deg, #3B82F6, #60A5FA); }

.stat-icon-circle {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}

.stat-total .stat-icon-circle {
    background: linear-gradient(135deg, #EEF2FF, #E0E7FF);
    color: #4F46E5;
}

.stat-active .stat-icon-circle {
    background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
    color: #10B981;
}

.stat-inactive .stat-icon-circle {
    background: linear-gradient(135deg, #FEF2F2, #FEE2E2);
    color: #EF4444;
}

.stat-admin .stat-icon-circle {
    background: linear-gradient(135deg, #EFF6FF, #DBEAFE);
    color: #3B82F6;
}

.stat-info {
    flex: 1;
}

.stat-label {
    font-size: 13px;
    font-weight: 500;
    color: #94A3B8;
    display: block;
}

.stat-value {
    font-size: 28px;
    font-weight: 800;
    color: #1E293B;
    margin: 0;
    line-height: 1.2;
}

.stat-trend {
    font-size: 12px;
    font-weight: 600;
    padding: 2px 12px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 2px;
}

.stat-trend.up {
    background: #ECFDF5;
    color: #10B981;
}

.stat-trend.down {
    background: #FEF2F2;
    color: #EF4444;
}

.stat-trend i {
    font-size: 16px;
}

/* ============================================
   TABLE CARD
   ============================================ */
.table-card-modern {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #f1f5f9;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.table-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #f1f5f9;
    background: #FAFBFC;
}

.table-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.table-icon-wrapper {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: linear-gradient(135deg, #EEF2FF, #E0E7FF);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4F46E5;
    font-size: 18px;
}

.table-title {
    font-size: 16px;
    font-weight: 700;
    color: #1E293B;
    margin: 0;
}

.table-subtitle {
    font-size: 13px;
    color: #94A3B8;
}

.btn-outline-modern {
    border: 1px solid #E2E8F0;
    background: white;
    color: #64748B;
    padding: 8px 14px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-outline-modern:hover {
    background: #F1F5F9;
    border-color: #94A3B8;
}

/* ============================================
   ALERTS
   ============================================ */
.alert-modern {
    margin: 16px 24px 0;
    padding: 16px 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.alert-success-modern {
    background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
    border-left: 4px solid #10B981;
}

.alert-error-modern {
    background: linear-gradient(135deg, #FEF2F2, #FEE2E2);
    border-left: 4px solid #EF4444;
}

.alert-icon {
    font-size: 20px;
}

.alert-success-modern .alert-icon { color: #10B981; }
.alert-error-modern .alert-icon { color: #EF4444; }

.alert-message {
    flex: 1;
    font-weight: 500;
    color: #1E293B;
}

.alert-close {
    background: none;
    border: none;
    font-size: 20px;
    color: #94A3B8;
    cursor: pointer;
    padding: 4px;
}

/* ============================================
   SEARCH & FILTER
   ============================================ */
.search-filter-modern {
    padding: 16px 24px;
    border-bottom: 1px solid #f1f5f9;
}

.search-input-wrapper {
    display: flex;
    align-items: center;
    background: #F8FAFC;
    border-radius: 12px;
    padding: 4px;
    border: 2px solid #E2E8F0;
    transition: all 0.3s ease;
}

.search-input-wrapper:focus-within {
    border-color: #4F46E5;
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.08);
}

.search-input-wrapper i {
    padding: 0 12px 0 16px;
    color: #94A3B8;
    font-size: 18px;
}

.search-input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 10px 0;
    font-size: 14px;
    color: #1E293B;
    outline: none;
}

.search-input::placeholder {
    color: #94A3B8;
}

.search-btn {
    background: linear-gradient(135deg, #4F46E5, #7C3AED);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-btn:hover {
    transform: scale(1.05);
}

.filter-group-modern {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

.filter-select-modern {
    position: relative;
    display: inline-flex;
    align-items: center;
}

.filter-select-modern i {
    position: absolute;
    left: 12px;
    color: #94A3B8;
    font-size: 14px;
}

.filter-select {
    padding: 8px 16px 8px 36px;
    border: 2px solid #E2E8F0;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    color: #1E293B;
    background: white;
    appearance: none;
    min-width: 140px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-select:focus {
    border-color: #4F46E5;
    outline: none;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.08);
}

.btn-reset-modern {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border: 2px solid #E2E8F0;
    border-radius: 10px;
    background: white;
    color: #64748B;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-reset-modern:hover {
    background: #F1F5F9;
    border-color: #94A3B8;
    color: #1E293B;
    text-decoration: none;
}

/* ============================================
   TABLE
   ============================================ */
.table-responsive-modern {
    overflow-x: auto;
    padding: 0 4px;
}

.table-modern {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 14px;
}

.table-modern thead th {
    padding: 14px 16px;
    font-weight: 600;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94A3B8;
    background: #FAFBFC;
    border-bottom: 2px solid #F1F5F9;
    white-space: nowrap;
}

.table-modern tbody td {
    padding: 14px 16px;
    vertical-align: middle;
    border-bottom: 1px solid #F1F5F9;
}

.table-modern tbody tr {
    transition: all 0.2s ease;
}

.table-modern tbody tr:hover {
    background: #FAFBFC;
}

.table-modern tbody tr:last-child td {
    border-bottom: none;
}

/* Column Widths */
.col-id { width: 60px; }
.col-user { min-width: 220px; }
.col-email { min-width: 180px; }
.col-role { width: 120px; }
.col-status { width: 110px; }
.col-login { min-width: 140px; }
.col-actions { width: 130px; }

.id-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background: #F1F5F9;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    color: #64748B;
}

/* User Cell */
.user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar-wrapper {
    position: relative;
    flex-shrink: 0;
}

.user-avatar-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #E2E8F0;
}

.online-status {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    background: #10B981;
    border-radius: 50%;
    border: 2px solid white;
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

.user-info-cell {
    flex: 1;
    min-width: 0;
}

.user-name {
    font-weight: 600;
    color: #1E293B;
    font-size: 14px;
}

.user-email-small {
    font-size: 12px;
    color: #94A3B8;
    margin-top: 1px;
}

.email-text {
    color: #475569;
    font-size: 13px;
}

/* Role Badges */
.role-badge-modern {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.role-badge-modern i {
    font-size: 14px;
}

.role-badge-modern.role-admin {
    background: linear-gradient(135deg, #EEF2FF, #E0E7FF);
    color: #4338CA;
}

.role-badge-modern.role-warden {
    background: linear-gradient(135deg, #FFFBEB, #FEF3C7);
    color: #92400E;
}

.role-badge-modern.role-user {
    background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
    color: #065F46;
}

/* Status Badges */
.status-badge-modern {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.status-badge-modern.status-active {
    background: #ECFDF5;
    color: #065F46;
}

.status-badge-modern.status-active .status-indicator {
    background: #10B981;
}

.status-badge-modern.status-inactive {
    background: #FEF2F2;
    color: #991B1B;
}

.status-badge-modern.status-inactive .status-indicator {
    background: #EF4444;
}

/* Login Info */
.login-info-modern {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #64748B;
}

.login-info-modern i {
    font-size: 14px;
}

/* Action Buttons */
.action-group-modern {
    display: flex;
    gap: 4px;
    justify-content: center;
}

.action-btn-modern {
    width: 34px;
    height: 34px;
    border: none;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 14px;
}

.action-btn-modern:hover {
    transform: translateY(-2px);
    text-decoration: none;
}

.action-btn-modern.view {
    background: #EEF2FF;
    color: #4338CA;
}

.action-btn-modern.view:hover {
    background: #4338CA;
    color: white;
}

.action-btn-modern.edit {
    background: #FFFBEB;
    color: #D97706;
}

.action-btn-modern.edit:hover {
    background: #D97706;
    color: white;
}

.action-btn-modern.delete {
    background: #FEF2F2;
    color: #DC2626;
    cursor: pointer;
}

.action-btn-modern.delete:hover {
    background: #DC2626;
    color: white;
}

/* ============================================
   PAGINATION
   ============================================ */
.pagination-modern-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 24px;
    border-top: 1px solid #F1F5F9;
    flex-wrap: wrap;
    gap: 12px;
}

.pagination-info {
    font-size: 13px;
    color: #64748B;
    display: flex;
    align-items: center;
    gap: 6px;
}

.pagination-info strong {
    color: #1E293B;
}

.pagination-links-modern .pagination {
    margin: 0;
}

.pagination-links-modern .page-item {
    margin: 0 2px;
}

.pagination-links-modern .page-link {
    border: none;
    border-radius: 8px;
    padding: 8px 14px;
    color: #475569;
    font-weight: 500;
    font-size: 13px;
    background: transparent;
    transition: all 0.3s ease;
}

.pagination-links-modern .page-link:hover {
    background: #EEF2FF;
    color: #4338CA;
}

.pagination-links-modern .page-item.active .page-link {
    background: linear-gradient(135deg, #4F46E5, #7C3AED);
    color: white;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
}

.pagination-links-modern .page-item.disabled .page-link {
    color: #CBD5E1;
}

/* ============================================
   EMPTY STATE
   ============================================ */
.empty-state-modern {
    text-align: center;
    padding: 60px 20px;
}

.empty-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #F1F5F9, #E2E8F0);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 32px;
    color: #94A3B8;
}

.empty-state-modern h5 {
    font-weight: 600;
    color: #1E293B;
}

.empty-state-modern p {
    color: #94A3B8;
    margin-bottom: 16px;
}

/* ============================================
   DELETE MODAL
   ============================================ */
.delete-modal-modern .modal-content {
    border: none;
    border-radius: 20px;
    box-shadow: 0 24px 80px rgba(0, 0, 0, 0.12);
}

.delete-icon-wrapper {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #FEF2F2;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 28px;
    color: #DC2626;
}

.btn-danger-modern {
    background: linear-gradient(135deg, #EF4444, #DC2626);
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-danger-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(239, 68, 68, 0.3);
    color: white;
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 1200px) {
    .stats-grid-modern {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 992px) {
    .page-title-modern {
        font-size: 22px;
    }
    
    .stat-value {
        font-size: 24px;
    }
}

@media (max-width: 768px) {
    .stats-grid-modern {
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    
    .stat-item {
        padding: 16px;
    }
    
    .stat-icon-circle {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    
    .stat-value {
        font-size: 20px;
    }
    
    .table-card-header {
        padding: 16px;
    }
    
    .search-filter-modern {
        padding: 12px 16px;
    }
    
    .filter-group-modern {
        justify-content: flex-start;
    }
    
    .pagination-modern-wrapper {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .page-title-modern {
        font-size: 18px;
    }
    
    .title-badge {
        font-size: 8px;
        padding: 2px 8px;
    }
}

@media (max-width: 576px) {
    .stats-grid-modern {
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }
    
    .stat-item {
        padding: 12px;
        flex-direction: column;
        text-align: center;
    }
    
    .stat-trend {
        align-self: center;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .header-actions .btn-primary-modern {
        width: 100%;
        justify-content: center;
    }
    
    .table-modern thead th {
        font-size: 10px;
        padding: 10px 8px;
    }
    
    .table-modern tbody td {
        padding: 10px 8px;
        font-size: 12px;
    }
    
    .action-btn-modern {
        width: 28px;
        height: 28px;
        font-size: 12px;
    }
}
</style>

<div class="user-management-wrapper">
    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="header-content">
                <h1 class="page-title-modern">
                    <span class="title-gradient">User Management</span>
                </h1>
                <p class="page-subtitle-modern">
                    <i class="bi bi-dot"></i> Manage, monitor and organize all system users
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('users.create') }}" class="btn btn-primary-modern">
                    <i class="bi bi-plus-circle-fill me-2"></i>
                    <span>Add New User</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="stats-grid-modern">
        <div class="stat-item stat-total">
            <div class="stat-icon-circle">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Users</span>
                <h3 class="stat-value">{{ $totalUsers ?? 0 }}</h3>
            </div>
        </div>
        <div class="stat-item stat-active">
            <div class="stat-icon-circle">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Active Users</span>
                <h3 class="stat-value">{{ $activeUsers ?? 0 }}</h3>
            </div>
        </div>
        <div class="stat-item stat-inactive">
            <div class="stat-icon-circle">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Inactive Users</span>
                <h3 class="stat-value">{{ $inactiveUsers ?? 0 }}</h3>
            </div>
        </div>
        <div class="stat-item stat-admin">
            <div class="stat-icon-circle">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Administrators</span>
                <h3 class="stat-value">{{ $adminUsers ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="table-card-modern">
        <!-- Card Header with Filters -->
        <div class="table-card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="table-header-left">
                    <div class="table-icon-wrapper">
                        <i class="bi bi-table"></i>
                    </div>
                    <div>
                        <h5 class="table-title">User Directory</h5>
                        <span class="table-subtitle">{{ $users->total() ?? 0 }} users found</span>
                    </div>
                </div>
                <div class="table-header-right">
                    <button class="btn btn-outline-modern btn-sm" onclick="window.location.reload()">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                    <button class="btn btn-outline-modern btn-sm" data-bs-toggle="tooltip" title="Export Data">
                        <i class="bi bi-download"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert-modern alert-success-modern">
                <div class="alert-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="alert-message">{{ session('success') }}</div>
                <button type="button" class="alert-close" data-bs-dismiss="alert">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-modern alert-error-modern">
                <div class="alert-icon">
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <div class="alert-message">{{ session('error') }}</div>
                <button type="button" class="alert-close" data-bs-dismiss="alert">&times;</button>
            </div>
        @endif

        <!-- Search & Filter Bar -->
        <div class="search-filter-modern">
            <div class="row g-3 align-items-center">
                <div class="col-lg-5">
                    <form action="{{ route('users.index') }}" method="GET" class="search-form-modern">
                        <div class="search-input-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" class="search-input" 
                                   placeholder="Search here..." 
                                   value="{{ request('search') }}">
                            <button type="submit" class="search-btn">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7">
                    <div class="filter-group-modern">
                        <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2 flex-wrap justify-content-lg-end">
                            <div class="filter-select-modern">
                                <i class="bi bi-tag"></i>
                                <select name="role" class="filter-select" onchange="this.form.submit()">
                                    <option value="">All Roles</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                    <option value="warden" {{ request('role') == 'warden' ? 'selected' : '' }}>Warden</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <div class="filter-select-modern">
                                <i class="bi bi-funnel"></i>
                                <select name="status" class="filter-select" onchange="this.form.submit()">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <a href="{{ route('users.index') }}" class="btn btn-reset-modern">
                                <i class="bi bi-x-circle"></i>
                                <span>Reset</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive-modern">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th class="col-id">#</th>
                        <th class="col-user">User</th>
                        <th class="col-email">Email</th>
                        <th class="col-role">Role</th>
                        <th class="col-status">Status</th>
                        <th class="col-login">Last Login</th>
                        <th class="col-actions text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                    <tr>
                        <td class="col-id">
                            <span class="id-badge">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</span>
                        </td>
                        <td class="col-user">
                            <div class="user-cell">
                                <div class="user-avatar-wrapper">
                                    <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}" class="user-avatar-img">
                                    @if($user->isOnline())
                                        <span class="online-status"></span>
                                    @endif
                                </div>
                                <div class="user-info-cell">
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-email-small">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="col-email">
                            <span class="email-text">{{ $user->email }}</span>
                        </td>
                        <td class="col-role">
                            <span class="role-badge-modern role-{{ $user->role }}">
                                <i class="bi bi-{{ $user->role === 'admin' ? 'shield-lock' : ($user->role === 'warden' ? 'shield' : 'person') }}"></i>
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="col-status">
                            <span class="status-badge-modern status-{{ $user->status }}">
                                <span class="status-indicator"></span>
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="col-login">
                            <div class="login-info-modern">
                                <i class="bi bi-clock"></i>
                                <span>{{ $user->last_login ? $user->last_login->format('M d, Y H:i') : 'Never' }}</span>
                            </div>
                        </td>
                        <td class="col-actions">
                            <div class="action-group-modern">
                                <a href="{{ route('users.show', $user->id) }}" class="action-btn-modern view" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="action-btn-modern edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="action-btn-modern delete" 
                                        data-id="{{ $user->id }}" 
                                        data-name="{{ $user->name }}"
                                        title="Delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state-modern">
                                <div class="empty-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5>No Users Found</h5>
                                <p>Get started by creating your first user account</p>
                                <a href="{{ route('users.create') }}" class="btn btn-primary-modern">
                                    <i class="bi bi-plus-circle-fill me-2"></i> Add New User
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-modern-wrapper">
            <div class="pagination-info">
                <i class="bi bi-info-circle"></i>
                Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> - <strong>{{ $users->lastItem() ?? 0 }}</strong> 
                of <strong>{{ $users->total() ?? 0 }}</strong> users
            </div>
            <div class="pagination-links-modern">
                {{ $users->withQueryString()->links() ?? '' }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content delete-modal-modern">
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-4">
                    <div class="delete-icon-wrapper">
                        <i class="bi bi-person-x"></i>
                    </div>
                    <h4 class="mt-3">Delete User?</h4>
                    <p class="text-muted">
                        You are about to delete <strong id="deleteUserName" class="text-danger"></strong>
                    </p>
                    <p class="text-muted small">This action cannot be undone</p>
                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash3 me-2"></i> Delete User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Delete button handler
    $('.delete-btn').click(function() {
        const userId = $(this).data('id');
        const userName = $(this).data('name');
        
        $('#deleteUserName').text(userName);
        $('#deleteForm').attr('action', `/users/${userId}`);
        $('#deleteModal').modal('show');
    });

    // Auto-dismiss alerts
    setTimeout(function() {
        $('.alert-modern').fadeOut('slow');
    }, 5000);

    // Tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endpush