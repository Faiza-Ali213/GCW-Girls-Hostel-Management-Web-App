@extends('layouts.app') {{-- Or your main layout --}}

@section('page_title', 'Settings')
@section('page_subtitle', 'Configure system preferences')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- General Settings -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-sliders2 me-2"></i>General Settings</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Site Name</label>
                            <input type="text" class="form-control" value="GCW Hostel Management">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Site Description</label>
                            <textarea class="form-control" rows="2">Government College Women Hostel Management System</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Time Zone</label>
                            <select class="form-select">
                                <option>UTC</option>
                                <option selected>Asia/Karachi</option>
                                <option>Asia/Dubai</option>
                                <option>America/New_York</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Email Settings -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-envelope me-2"></i>Email Settings</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mail Driver</label>
                            <select class="form-select">
                                <option selected>SMTP</option>
                                <option>Mailgun</option>
                                <option>Sendmail</option>
                                <option>Log</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">SMTP Host</label>
                            <input type="text" class="form-control" value="smtp.gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">SMTP Port</label>
                            <input type="text" class="form-control" value="587">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">SMTP Username</label>
                            <input type="text" class="form-control" value="admin@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">SMTP Password</label>
                            <input type="password" class="form-control" value="password123">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Security Settings</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="twoFactor" checked>
                                <label class="form-check-label fw-semibold" for="twoFactor">Two-Factor Authentication</label>
                            </div>
                            <small class="text-muted">Require 2FA for all admin users</small>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="sessionTimeout" checked>
                                <label class="form-check-label fw-semibold" for="sessionTimeout">Session Timeout</label>
                            </div>
                            <small class="text-muted">Auto-logout after 30 minutes of inactivity</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Policy</label>
                            <select class="form-select">
                                <option>Standard (8 characters)</option>
                                <option selected>Strong (12 characters, symbols)</option>
                                <option>Very Strong (16 characters, symbols)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-bell me-2"></i>Notification Settings</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                                <label class="form-check-label fw-semibold" for="emailNotif">Email Notifications</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="smsNotif">
                                <label class="form-check-label fw-semibold" for="smsNotif">SMS Notifications</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="pushNotif" checked>
                                <label class="form-check-label fw-semibold" for="pushNotif">Push Notifications</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Notification Frequency</label>
                            <select class="form-select">
                                <option>Real-time</option>
                                <option selected>Daily Digest</option>
                                <option>Weekly Digest</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 12px;
    }
    .card-header {
        border-bottom: 1px solid #f0f0f0;
        border-radius: 12px 12px 0 0 !important;
        padding: 1rem 1.25rem;
    }
    .form-label {
        font-size: 13px;
        color: #495057;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }
    .form-control:focus, .form-select:focus {
        border-color: #6C63FF;
        box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.15);
    }
    .form-switch .form-check-input {
        width: 2.5rem;
        height: 1.3rem;
    }
    .form-switch .form-check-input:checked {
        background-color: #6C63FF;
        border-color: #6C63FF;
    }
</style>
@endsection