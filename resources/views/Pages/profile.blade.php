@extends('Layout.app')

@section('title', 'Profile - GCW Hostel')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="profile-container">
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-custom alert-danger-custom">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-custom alert-danger-custom">
            <i class="fas fa-exclamation-circle"></i>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="breadcrumb-custom">
        <i class="fas fa-home"></i>
        <span class="path">
            <a href="{{ route('home') }}">Home</a> / 
            <a href="{{ route('profile') }}">Profile</a>
            <span>Viewing</span>
        </span>
        <span class="badge-active ms-auto">
            <i class="fas fa-user-check"></i> Active
        </span>
    </div>

    <!-- Profile Card -->
    <div class="profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="user-info">
                <div class="avatar">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </div>
                <div>
                    <h4>{{ Auth::user()->name ?? 'Admin User' }}</h4>
                    <small><i class="fas fa-envelope me-1"></i> {{ Auth::user()->email ?? 'admin@example.com' }}</small>
                </div>
            </div>
            <div class="user-stats">
                <div class="stat">
                    <strong>{{ Auth::user()->role ?? 'Admin' }}</strong>
                    <span>Role</span>
                </div>
                <div class="stat">
                    <strong>{{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : 'N/A' }}</strong>
                    <span>Joined</span>
                </div>
                <div class="stat">
                    <strong>{{ isset($complaints) ? $complaints->count() : 0 }}</strong>
                    <span>Complaints</span>
                </div>
            </div>
        </div>

        <!-- Profile Body -->
        <div class="profile-body">
            <!-- View Mode -->
            <div id="viewMode" class="view-mode">
                <div class="row g-4">
                    <!-- Personal Information -->
                    <div class="col-lg-6">
                        <div class="section-title">
                            <i class="fas fa-user-circle"></i> Personal Information
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-user"></i> Full Name</strong>
                                <span class="info-value">{{ Auth::user()->name ?? 'Admin' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-envelope"></i> Email</strong>
                                <span class="info-value">{{ Auth::user()->email ?? 'admin@example.com' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-id-badge"></i> Role</strong>
                                <span class="info-value">{{ Auth::user()->role ?? 'Admin' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-phone"></i> Phone</strong>
                                <span class="info-value">{{ Auth::user()->phone ?? '0300-1234567' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-calendar-alt"></i> Joined</strong>
                                <span class="info-value">{{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="col-lg-6">
                        <div class="section-title">
                            <i class="fas fa-shield-alt"></i> Account Information
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-user-check"></i> Account Status</strong>
                                <span class="info-value"><span class="status-badge">Active</span></span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-clock"></i> Last Login</strong>
                                <span class="info-value">{{ Auth::user()->last_login ?? 'First login' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-building"></i> Hostel</strong>
                                <span class="info-value">GCW Hostel</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-left">
                                <strong><i class="fas fa-map-marker-alt"></i> Location</strong>
                                <span class="info-value">Gujranwala, Pakistan</span>
                            </div>
                        </div>
                    </div>
                </div>

<!-- Complaint Status Section -->
<div class="complaint-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="section-title" style="margin-bottom: 0;">
            <i class="fas fa-exclamation-triangle"></i> My Complaints
            <span style="font-size: 0.8rem; font-weight: 400; color: #94a3b8;">
                ({{ isset($complaints) ? $complaints->count() : 0 }} total)
            </span>
        </div>
        <a href="{{ route('profile') }}" class="btn-refresh" onclick="this.innerHTML='<i class=\'fas fa-spinner fa-spin\'></i> Loading...'">
            <i class="fas fa-sync-alt"></i> Refresh
        </a>
    </div>

    @if(isset($complaints) && $complaints->count() > 0)
        @foreach($complaints as $complaint)
            @php
                // Get the actual status from database
                $status = $complaint->status;
                // Get status label using the accessor
                $statusLabel = $complaint->status_label;
                // Get status badge class
                $badgeClass = $complaint->status_badge;
                // Get status icon
                $iconClass = $complaint->status_icon;
            @endphp
            <div class="complaint-card">
                <div class="complaint-header">
                    <span class="complaint-title">
                        <i class="fas fa-file-alt"></i> {{ $complaint->title }}
                    </span>
                    <span class="complaint-status {{ $badgeClass }}">
                        <i class="fas {{ $iconClass }}"></i> {{ $statusLabel }}
                    </span>
                </div>
                <div class="complaint-details">
                    <span class="detail">
                        <i class="fas fa-calendar-alt"></i> 
                        <strong>Submitted:</strong> {{ $complaint->created_at->format('d M Y, h:i A') }}
                    </span>
                    <span class="detail">
                        <i class="fas fa-flag"></i> 
                        <strong>Priority:</strong> {{ ucfirst($complaint->priority) }}
                    </span>
                    <span class="detail">
                        <i class="fas fa-user-tag"></i> 
                        <strong>Complaint By:</strong> {{ ucfirst($complaint->complaint_by ?? 'User') }}
                    </span>
                    <span class="detail">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Status:</strong> 
                        <span style="font-weight: 600; color: 
                            @if($status == 'pending') #F59E0B
                            @elseif($status == 'in_progress') #0EA5E9
                            @elseif($status == 'resolved') #10B981
                            @elseif($status == 'rejected') #EF4444
                            @else #94a3b8 @endif;">
                            {{ $statusLabel }}
                        </span>
                    </span>
                </div>
                <div class="complaint-description">
                    <i class="fas fa-align-left" style="color: #8B6B4A; margin-right: 6px;"></i>
                    {{ Str::limit($complaint->description, 150) }}
                </div>
                @if($complaint->admin_remark)
                    <div class="admin-remark">
                        <i class="fas fa-comment"></i> 
                        <strong>Admin Remark:</strong> {{ $complaint->admin_remark }}
                    </div>
                @endif
                @if($complaint->resolved_at)
                    <div class="resolved-date">
                        <i class="fas fa-check-circle"></i> 
                        Resolved on: {{ $complaint->resolved_at->format('d M Y, h:i A') }}
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="complaint-empty">
            <i class="fas fa-inbox"></i>
            <h6>No Complaints Found</h6>
            <p>You haven't submitted any complaints yet.</p>
            @if(Route::has('complaint.registration'))
                <a href="{{ route('complaint.registration') }}" class="btn-submit-complaint">
                    <i class="fas fa-plus-circle"></i> Submit a Complaint
                </a>
            @endif
        </div>
    @endif
</div>

<!-- Edit Button -->
                <div class="text-center mt-4">
                    <button class="btn-edit-toggle" onclick="toggleEditMode()">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>
                </div>
            </div>

            <!-- Edit Mode -->
            <div id="editMode" class="edit-section">
                <div class="alert-info">
                    <i class="fas fa-info-circle"></i> Update your personal information below. Fields marked with <span class="text-danger">*</span> are required.
                </div>

                <form class="edit-form" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" placeholder="Enter phone number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role"><i class="fas fa-id-badge"></i> Role</label>
                                <input type="text" class="form-control" id="role" value="{{ Auth::user()->role ?? 'Admin' }}" readonly>
                                <small class="text-muted">Role cannot be changed</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i> New Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation"><i class="fas fa-check-circle"></i> Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" onclick="toggleEditMode()">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/profile.js') }}"></script>
@endsection