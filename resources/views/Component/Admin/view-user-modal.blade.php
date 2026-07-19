@extends('Layout.admin')

@section('page_title', 'View User')
@section('page_subtitle', 'User details and information')

@section('content')
<style>
/* ============================================
   PROFESSIONAL VIEW USER PAGE
   ============================================ */

/* Page Container */
.view-user-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 10px 0;
}

/* Back Button */
.back-button-wrapper {
    margin-bottom: 24px;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    color: #64748B;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    background: #F8FAFC;
    border: 1px solid #E2E8F0;
}

.back-button:hover {
    background: #F1F5F9;
    border-color: #CBD5E1;
    color: #1E293B;
    text-decoration: none;
}

.back-button i {
    font-size: 18px;
}

/* Main Card */
.profile-card {
    background: #FFFFFF;
    border-radius: 20px;
    border: 1px solid #E2E8F0;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

/* Card Header */
.profile-card-header {
    padding: 24px 32px;
    border-bottom: 1px solid #F1F5F9;
    background: #FAFBFC;
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #EEF2FF;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4F46E5;
    font-size: 20px;
    flex-shrink: 0;
}

.header-title {
    font-size: 18px;
    font-weight: 700;
    color: #0F172A;
    margin: 0;
}

.header-subtitle {
    font-size: 14px;
    color: #94A3B8;
    margin: 0;
}

/* Card Body */
.profile-card-body {
    padding: 32px;
}

/* Profile Header */
.profile-header {
    display: flex;
    align-items: center;
    gap: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid #F1F5F9;
    margin-bottom: 24px;
}

.profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #EEF2FF;
    flex-shrink: 0;
}

.profile-name-section {
    flex: 1;
}

.profile-name {
    font-size: 24px;
    font-weight: 700;
    color: #0F172A;
    margin: 0;
}

.profile-email {
    font-size: 14px;
    color: #64748B;
    margin: 4px 0 8px;
}

.profile-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.badge-custom {
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-role {
    background: #EEF2FF;
    color: #4338CA;
}

.badge-role.warden {
    background: #FFFBEB;
    color: #92400E;
}

.badge-role.user {
    background: #ECFDF5;
    color: #065F46;
}

.badge-status {
    background: #ECFDF5;
    color: #065F46;
}

.badge-status.inactive {
    background: #FEF2F2;
    color: #991B1B;
}

.badge-online {
    background: #D1FAE5;
    color: #065F46;
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.info-item {
    padding: 16px 20px;
    background: #F8FAFC;
    border-radius: 12px;
    border: 1px solid #F1F5F9;
}

.info-label {
    font-size: 12px;
    font-weight: 600;
    color: #94A3B8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: block;
    margin-bottom: 4px;
}

.info-label i {
    margin-right: 4px;
}

.info-value {
    font-size: 15px;
    font-weight: 500;
    color: #0F172A;
}

.info-value .text-muted {
    color: #94A3B8;
    font-weight: 400;
}

/* Action Buttons */
.profile-actions {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid #F1F5F9;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn {
    padding: 10px 28px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-secondary {
    background: #F1F5F9;
    border: 1px solid #E2E8F0;
    color: #64748B;
}

.btn-secondary:hover {
    background: #E2E8F0;
    color: #0F172A;
    text-decoration: none;
}

.btn-primary {
    background: #4F46E5;
    border: none;
    color: #FFFFFF;
}

.btn-primary:hover {
    background: #4338CA;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    color: #FFFFFF;
    text-decoration: none;
}

.btn-warning {
    background: #F59E0B;
    border: none;
    color: #FFFFFF;
}

.btn-warning:hover {
    background: #D97706;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    color: #FFFFFF;
    text-decoration: none;
}

.btn-danger {
    background: #EF4444;
    border: none;
    color: #FFFFFF;
}

.btn-danger:hover {
    background: #DC2626;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    color: #FFFFFF;
    text-decoration: none;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-card-header {
        padding: 20px;
        flex-direction: column;
        text-align: center;
    }
    
    .profile-card-body {
        padding: 20px;
    }
    
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
    }
    
    .profile-badges {
        justify-content: center;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .profile-actions {
        flex-direction: column;
    }
    
    .profile-actions .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .view-user-page {
        padding: 0;
    }
    
    .back-button-wrapper {
        margin-bottom: 16px;
    }
    
    .back-button {
        padding: 8px 16px;
        font-size: 13px;
    }
    
    .profile-card-body {
        padding: 16px;
    }
    
    .profile-name {
        font-size: 20px;
    }
}
</style>

<div class="view-user-page">
    <!-- Back Button -->
    <div class="back-button-wrapper">
        <a href="{{ route('users.index') }}" class="back-button">
            <i class="bi bi-arrow-left"></i>
            Back to User Management
        </a>
    </div>

    <!-- Main Profile Card -->
    <div class="profile-card">
        <!-- Card Header -->
        <div class="profile-card-header">
            <div class="header-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div>
                <h4 class="header-title">User Profile</h4>
                <p class="header-subtitle">View user details and information</p>
            </div>
        </div>

        <!-- Card Body -->
        <div class="profile-card-body">
            <!-- Profile Header -->
            <div class="profile-header">
                <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}" class="profile-avatar">
                <div class="profile-name-section">
                    <h2 class="profile-name">{{ $user->name }}</h2>
                    <p class="profile-email">{{ $user->email }}</p>
                    <div class="profile-badges">
                        <span class="badge-custom badge-role {{ $user->role }}">
                            <i class="bi bi-{{ $user->role === 'admin' ? 'shield-lock' : ($user->role === 'warden' ? 'shield' : 'person') }}"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                        <span class="badge-custom badge-status {{ $user->status }}">
                            <span class="status-dot" style="display:inline-block;width:8px;height:8px;border-radius:50%;background:{{ $user->status === 'active' ? '#10B981' : '#EF4444' }};margin-right:4px;"></span>
                            {{ ucfirst($user->status) }}
                        </span>
                        @if($user->isOnline())
                            <span class="badge-custom badge-online">
                                <i class="bi bi-circle-fill" style="font-size:8px;color:#10B981;"></i> Online
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Information Grid -->
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-envelope"></i> Email Address</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-phone"></i> Phone Number</span>
                    <span class="info-value">{{ $user->phone ?? 'Not provided' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-geo-alt"></i> Address</span>
                    <span class="info-value">{{ $user->address ?? 'Not provided' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-tag"></i> Role</span>
                    <span class="info-value">{{ ucfirst($user->role) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-toggle-on"></i> Status</span>
                    <span class="info-value">{{ ucfirst($user->status) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-clock-history"></i> Last Login</span>
                    <span class="info-value">{{ $user->last_login ? $user->last_login->format('F d, Y H:i A') : 'Never' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-calendar-plus"></i> Member Since</span>
                    <span class="info-value">{{ $user->created_at->format('F d, Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-calendar-check"></i> Last Updated</span>
                    <span class="info-value">{{ $user->updated_at->format('F d, Y H:i A') }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="profile-actions">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit User
                </a>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
                @if($user->id !== auth()->id())
                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                        <i class="bi bi-trash3"></i> Delete User
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete(userId, userName) {
    if (confirm(`Are you sure you want to delete user "${userName}"? This action cannot be undone.`)) {
        document.getElementById('deleteForm').action = `/users/${userId}`;
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection