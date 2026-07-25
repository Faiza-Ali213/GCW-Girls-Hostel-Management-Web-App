@extends('Layout.admin') {{-- Your main layout with sidebar --}}

@section('page_title', 'Settings')
@section('page_subtitle', 'Configure system preferences')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- page header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-bold" style="color: #0b1a33; letter-spacing: -0.02em;">
                <i class="bi bi-gear-fill me-2" style="color: #4f46e5;"></i>Settings
            </h4>
            <p class="text-muted mt-1" style="font-size: 0.9rem;">Configure system preferences</p>
        </div>
    </div>

    <!-- Single form for all settings -->
    <form>
        <!-- General Settings - Row 1 -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="settings-card">
                    <div class="card-header">
                        <h5><i class="bi bi-sliders2"></i> General Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" class="form-control" value="GCW Hostel Management" placeholder="Enter site name" />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Site Description</label>
                                <textarea class="form-control" rows="3" placeholder="Short description">Government College Women Hostel Management System</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Settings - Row 2 -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="settings-card">
                    <div class="card-header">
                        <h5><i class="bi bi-bell"></i> Notification Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="pushNotif" checked />
                                    <label class="form-check-label" for="pushNotif">
                                        Push Notification
                                        <small class="d-block text-muted">Enable browser and in-app push notifications</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Save Button for all settings -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-check2-circle me-2"></i> Save All Settings
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <div class="row mt-4">
        <div class="col-12">
            <hr class="opacity-25" />
            <p class="text-muted" style="font-size: 0.75rem; letter-spacing: 0.01em;">
                <i class="bi bi-dot"></i> Last updated: today at 14:32 · All settings are stored securely.
            </p>
        </div>
    </div>
</div>

<style>
    .settings-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.04);
        transition: all 0.15s ease;
        height: 100%;
    }
    .settings-card .card-header {
        background: transparent;
        border-bottom: 1px solid #eef2f6;
        padding: 1.25rem 1.5rem;
        border-radius: 20px 20px 0 0 !important;
    }
    .settings-card .card-header h5 {
        font-weight: 600;
        font-size: 1.05rem;
        letter-spacing: -0.01em;
        color: #0b1a33;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .settings-card .card-header h5 i {
        color: #4f46e5;
        font-size: 1.25rem;
    }
    .settings-card .card-body {
        padding: 1.75rem 1.5rem 2rem;
    }
    .form-label {
        font-weight: 500;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        color: #475569;
        margin-bottom: 0.3rem;
    }
    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 0.6rem 0.9rem;
        font-size: 0.95rem;
        background: #fafcff;
        transition: 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.08);
        background: #ffffff;
    }
    .form-control::placeholder {
        color: #a0afbe;
        font-weight: 400;
    }
    .form-switch .form-check-input {
        width: 2.75rem;
        height: 1.5rem;
        border-radius: 30px;
        border: 1px solid #d0d8e3;
        background-color: #e9edf3;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23ffffff'/%3e%3c/svg%3e");
        transition: 0.2s;
    }
    .form-switch .form-check-input:checked {
        background-color: #4f46e5;
        border-color: #4f46e5;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23ffffff'/%3e%3c/svg%3e");
    }
    .form-switch .form-check-label {
        font-weight: 500;
        color: #1e293b;
        margin-left: 0.5rem;
        font-size: 0.95rem;
    }
    .form-check .form-check-input {
        margin-top: 0.1rem;
    }
    .form-check .form-check-label small {
        display: block;
        font-weight: 400;
        color: #64748b;
        font-size: 0.8rem;
        margin-top: 0.1rem;
    }
    .btn-primary {
        background: #4f46e5;
        border: none;
        border-radius: 40px;
        padding: 0.7rem 2.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.01em;
        transition: 0.2s;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }
    .btn-primary:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
    }
    .btn-primary i {
        margin-right: 0.4rem;
    }
    .badge-soft {
        background: #eef2ff;
        color: #4f46e5;
        font-weight: 500;
        font-size: 0.7rem;
        padding: 0.25rem 0.7rem;
        border-radius: 30px;
    }
    .mt-1-5 {
        margin-top: 1.5rem;
    }
</style>
@endsection