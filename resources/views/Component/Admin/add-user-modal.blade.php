<!-- Add User Modal - Modern Design -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-modal">
            <form action="{{ route('users.store') }}" method="POST" id="addUserForm">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header border-0">
                    <div class="modal-header-content">
                        <div class="modal-icon-wrapper gradient-primary">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold" id="addUserModalLabel">Add New User</h5>
                            <p class="text-muted small mb-0">Create a new user account with specific role and permissions</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <span class="section-number">01</span>
                            <h6 class="section-title">Personal Information</h6>
                            <span class="section-divider"></span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="addName" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                                    <label for="addName">
                                        <i class="bi bi-person"></i> Full Name <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="addEmail" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                    <label for="addEmail">
                                        <i class="bi bi-envelope"></i> Email Address <span class="text-danger">*</span>
                                    </label>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Account Credentials Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <span class="section-number">02</span>
                            <h6 class="section-title">Account Credentials</h6>
                            <span class="section-divider"></span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="addPassword" name="password" placeholder="Password" required minlength="8">
                                    <label for="addPassword">
                                        <i class="bi bi-key"></i> Password <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div id="addPasswordFeedback" class="form-text password-feedback"></div>
                                <div class="password-strength mt-1">
                                    <div class="strength-bar">
                                        <div class="strength-progress" id="passwordStrengthProgress"></div>
                                    </div>
                                    <small class="strength-text" id="passwordStrengthText">Minimum 8 characters</small>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control form-control-lg" id="addPasswordConfirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                    <label for="addPasswordConfirmation">
                                        <i class="bi bi-check-circle"></i> Confirm Password <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div id="addPasswordConfirmFeedback" class="form-text"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Role & Status Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <span class="section-number">03</span>
                            <h6 class="section-title">Role & Permissions</h6>
                            <span class="section-divider"></span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-tag"></i> User Role <span class="text-danger">*</span>
                                </label>
                                <div class="role-selector">
                                    <div class="role-option" data-role="admin">
                                        <input type="radio" name="role" value="admin" id="roleAdmin" class="role-radio" {{ old('role') == 'admin' ? 'checked' : '' }} required>
                                        <label for="roleAdmin" class="role-label">
                                            <i class="bi bi-shield-lock"></i>
                                            <span class="role-name">Administrator</span>
                                            <span class="role-desc">Full access & control</span>
                                        </label>
                                    </div>
                                    <div class="role-option" data-role="warden">
                                        <input type="radio" name="role" value="warden" id="roleWarden" class="role-radio" {{ old('role') == 'warden' ? 'checked' : '' }}>
                                        <label for="roleWarden" class="role-label">
                                            <i class="bi bi-shield"></i>
                                            <span class="role-name">Warden</span>
                                            <span class="role-desc">Manage hostel operations</span>
                                        </label>
                                    </div>
                                    <div class="role-option" data-role="user">
                                        <input type="radio" name="role" value="user" id="roleUser" class="role-radio" {{ old('role', 'user') == 'user' ? 'checked' : '' }}>
                                        <label for="roleUser" class="role-label">
                                            <i class="bi bi-person"></i>
                                            <span class="role-name">User</span>
                                            <span class="role-desc">Basic user access</span>
                                        </label>
                                    </div>
                                </div>
                                @error('role')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-toggle-on"></i> Account Status <span class="text-danger">*</span>
                                </label>
                                <div class="status-selector">
                                    <div class="status-option active-status">
                                        <input type="radio" name="status" value="active" id="statusActive" class="status-radio" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                                        <label for="statusActive" class="status-label">
                                            <span class="status-dot active"></span>
                                            <span class="status-name">Active</span>
                                            <span class="status-desc">User can access system</span>
                                        </label>
                                    </div>
                                    <div class="status-option inactive-status">
                                        <input type="radio" name="status" value="inactive" id="statusInactive" class="status-radio" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                        <label for="statusInactive" class="status-label">
                                            <span class="status-dot inactive"></span>
                                            <span class="status-name">Inactive</span>
                                            <span class="status-desc">User access disabled</span>
                                        </label>
                                    </div>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <span class="section-number">04</span>
                            <h6 class="section-title">Contact Information</h6>
                            <span class="section-divider"></span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" id="addPhone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                    <label for="addPhone">
                                        <i class="bi bi-phone"></i> Phone Number
                                    </label>
                                </div>
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" id="addAddress" name="address" placeholder="Address" value="{{ old('address') }}">
                                    <label for="addAddress">
                                        <i class="bi bi-geo-alt"></i> Address
                                    </label>
                                </div>
                                @error('address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg btn-gradient">
                        <i class="bi bi-check-circle me-1"></i> Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
/* ============================================
   MODERN MODAL - GLASSMORPHISM
   ============================================ */
.glass-modal .modal-content {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 24px;
    box-shadow: 0 24px 80px rgba(0, 0, 0, 0.12);
}

.modal-header-content {
    display: flex;
    align-items: center;
    gap: 16px;
}

.modal-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 22px;
    flex-shrink: 0;
}

.gradient-primary {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
}

.gradient-success {
    background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
}

.gradient-danger {
    background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
}

/* ============================================
   FORM SECTIONS
   ============================================ */
.form-section {
    margin-bottom: 24px;
}

.form-section:last-child {
    margin-bottom: 0;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.section-number {
    font-size: 12px;
    font-weight: 700;
    color: #6366f1;
    background: #eef2ff;
    padding: 2px 10px;
    border-radius: 20px;
}

.section-title {
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    font-size: 14px;
}

.section-divider {
    flex: 1;
    height: 1px;
    background: linear-gradient(to right, #e2e8f0, transparent);
}

/* ============================================
   FORM FLOATING
   ============================================ */
.form-floating {
    position: relative;
}

.form-floating .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 16px;
    height: 58px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: #fff;
}

.form-floating .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
}

.form-floating .form-control.is-valid {
    border-color: #10b981;
}

.form-floating .form-control.is-invalid {
    border-color: #ef4444;
}

.form-floating .form-control.is-invalid:focus {
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
}

.form-floating label {
    padding: 16px 16px;
    color: #94a3b8;
    font-weight: 500;
}

.form-floating label i {
    margin-right: 6px;
    color: #6366f1;
}

.form-floating .form-control:focus + label,
.form-floating .form-control:not(:placeholder-shown) + label {
    padding: 8px 12px;
    font-size: 12px;
    color: #6366f1;
    background: #fff;
    border-radius: 8px;
    transform: scale(0.85) translateY(-10px) translateX(0px);
}

/* ============================================
   PASSWORD STRENGTH
   ============================================ */
.password-strength {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 4px;
}

.strength-bar {
    flex: 1;
    height: 4px;
    background: #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
}

.strength-progress {
    height: 100%;
    width: 0;
    border-radius: 4px;
    transition: width 0.3s ease, background 0.3s ease;
}

.strength-text {
    font-size: 11px;
    color: #94a3b8;
    white-space: nowrap;
}

.password-feedback {
    font-size: 12px;
    margin-top: 4px;
}

/* ============================================
   ROLE SELECTOR
   ============================================ */
.role-selector {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

.role-option {
    position: relative;
}

.role-radio {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.role-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 14px 10px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fff;
    text-align: center;
    min-height: 80px;
    justify-content: center;
}

.role-label:hover {
    border-color: #c7d2fe;
    background: #f8fafc;
}

.role-radio:checked + .role-label {
    border-color: #6366f1;
    background: #eef2ff;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.role-label i {
    font-size: 20px;
    color: #6366f1;
    margin-bottom: 4px;
}

.role-name {
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
}

.role-desc {
    font-size: 10px;
    color: #94a3b8;
}

/* ============================================
   STATUS SELECTOR
   ============================================ */
.status-selector {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.status-option {
    position: relative;
}

.status-radio {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.status-label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fff;
}

.status-label:hover {
    border-color: #c7d2fe;
}

.status-radio:checked + .status-label {
    border-color: #6366f1;
    background: #eef2ff;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.status-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
}

.status-dot.active {
    background: #10b981;
}

.status-dot.inactive {
    background: #ef4444;
}

.status-name {
    font-weight: 600;
    font-size: 14px;
    color: #1e293b;
}

.status-desc {
    font-size: 11px;
    color: #94a3b8;
}

/* ============================================
   MODAL FOOTER
   ============================================ */
.modal-footer {
    padding: 16px 24px 24px;
    gap: 10px;
}

.modal-footer .btn {
    padding: 12px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.modal-footer .btn-outline-secondary {
    border: 2px solid #e2e8f0;
    color: #64748b;
}

.modal-footer .btn-outline-secondary:hover {
    background: #f1f5f9;
    border-color: #94a3b8;
}

.modal-footer .btn-gradient {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    border: none;
    color: #fff;
}

.modal-footer .btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
    color: #fff;
}

/* ============================================
   INVALID FEEDBACK
   ============================================ */
.invalid-feedback {
    font-size: 12px;
    margin-top: 4px;
    display: block;
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 768px) {
    .role-selector {
        grid-template-columns: 1fr;
    }
    
    .status-selector {
        grid-template-columns: 1fr;
    }
    
    .modal-header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .modal-icon-wrapper {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    
    .form-floating .form-control {
        height: 52px;
        font-size: 13px;
    }
    
    .modal-footer {
        flex-direction: column;
    }
    
    .modal-footer .btn {
        width: 100%;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // ============================================
    // PASSWORD STRENGTH CHECKER
    // ============================================
    $('#addPassword').on('keyup', function() {
        const password = $(this).val();
        const strengthBar = $('#passwordStrengthProgress');
        const strengthText = $('#passwordStrengthText');
        
        let strength = 0;
        let color = '#ef4444';
        let label = 'Weak';
        
        if (password.length >= 8) {
            strength += 25;
            color = '#f59e0b';
            label = 'Fair';
        }
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
            strength += 25;
            color = '#10b981';
            label = 'Good';
        }
        if (password.match(/\d/)) {
            strength += 25;
            color = '#3b82f6';
            label = 'Strong';
        }
        if (password.match(/[^a-zA-Z\d]/)) {
            strength += 25;
            color = '#8b5cf6';
            label = 'Very Strong';
        }
        
        if (password.length === 0) {
            strength = 0;
            color = '#e2e8f0';
            label = 'Minimum 8 characters';
        }
        
        strengthBar.css({
            'width': strength + '%',
            'background': color
        });
        
        strengthText.text(label).css('color', color);
    });

    // ============================================
    // PASSWORD MATCH VALIDATION
    // ============================================
    $('#addPassword, #addPasswordConfirmation').on('keyup', function() {
        const password = $('#addPassword').val();
        const confirm = $('#addPasswordConfirmation').val();
        const feedback = $('#addPasswordConfirmFeedback');
        
        if (password.length > 0 && confirm.length > 0) {
            if (password === confirm) {
                feedback.html('<i class="bi bi-check-circle text-success"></i> Passwords match');
                feedback.removeClass('text-danger').addClass('text-success');
                $('#addPasswordConfirmation').removeClass('is-invalid').addClass('is-valid');
            } else {
                feedback.html('<i class="bi bi-exclamation-circle text-danger"></i> Passwords do not match');
                feedback.removeClass('text-success').addClass('text-danger');
                $('#addPasswordConfirmation').removeClass('is-valid').addClass('is-invalid');
            }
        } else {
            feedback.html('');
            $('#addPasswordConfirmation').removeClass('is-valid is-invalid');
        }
    });

    // ============================================
    // AUTO-DISMISS MODAL ON SUCCESS
    // ============================================
    @if(session('success'))
        setTimeout(function() {
            $('#addUserModal').modal('hide');
        }, 2000);
    @endif
});
</script>
@endpush