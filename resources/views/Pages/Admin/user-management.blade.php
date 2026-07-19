@extends('Layout.admin')

@section('page_title', 'User Management')
@section('page_subtitle', 'Manage system users and permissions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-people me-2"></i>User Management</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-plus-circle me-1"></i> Add New User
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover" id="usersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6C63FF&color=fff&size=32" 
                                                 class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <div class="fw-semibold">{{ $user->name }}</div>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->getRoleBadgeColor() }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $user->getStatusBadgeColor() }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->last_login ? $user->last_login->format('Y-m-d H:i A') : 'Never' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary edit-user" 
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-role="{{ $user->role }}"
                                                    data-phone="{{ $user->phone }}"
                                                    data-address="{{ $user->address }}"
                                                    data-status="{{ $user->status }}"
                                                    title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-{{ $user->status === 'active' ? 'warning' : 'success' }} toggle-status" 
                                                    data-id="{{ $user->id }}"
                                                    data-status="{{ $user->status === 'active' ? 'inactive' : 'active' }}"
                                                    title="Toggle Status">
                                                <i class="bi bi-{{ $user->status === 'active' ? 'pause-circle' : 'play-circle' }}"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger delete-user" 
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="bi bi-people fs-1 d-block text-muted"></i>
                                        <p class="text-muted mt-2">No users found.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            Showing {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users
                        </small>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
@include('components.add-user-modal')

<!-- Edit User Modal -->
@include('components.edit-user-modal')

<!-- Delete User Modal -->
@include('components.delete-user-modal')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable with pagination disabled since we're using Laravel pagination
    // But we can add search functionality if needed
    
    // Edit User - Set form action
    $('.edit-user').click(function() {
        const user = $(this).data();
        const editForm = $('#editUserForm');
        editForm.attr('action', `/users/${user.id}`);
        
        $('#editUserId').val(user.id);
        $('#editName').val(user.name);
        $('#editEmail').val(user.email);
        $('#editRole').val(user.role);
        $('#editPhone').val(user.phone || '');
        $('#editAddress').val(user.address || '');
        $('#editStatus').val(user.status);
        $('#editPassword').val('');
        $('#editPasswordConfirmation').val('');
        $('#editPasswordFeedback').html('<small class="text-muted">Leave blank to keep current password</small>');
        $('#editUserModal').modal('show');
    });

    // Delete User - Set form action
    $('.delete-user').click(function() {
        const userId = $(this).data('id');
        const userName = $(this).data('name');
        const deleteForm = $('#deleteUserForm');
        deleteForm.attr('action', `/users/${userId}`);
        
        $('#deleteUserId').val(userId);
        $('#deleteUserName').text(userName);
        $('#deleteUserModal').modal('show');
    });

    // Toggle Status
    $('.toggle-status').click(function() {
        const userId = $(this).data('id');
        const newStatus = $(this).data('status');
        const button = $(this);
        
        if (!confirm('Are you sure you want to change this user\'s status?')) {
            return;
        }
        
        $.ajax({
            url: `/users/${userId}/status`,
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    toastr.success(response.message || 'Status updated successfully!');
                    // Reload after a short delay
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(xhr) {
                let errorMessage = 'Error updating status';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                toastr.error(errorMessage);
            }
        });
    });

    // Password validation for add user
    $('#addPassword, #addPasswordConfirmation').on('keyup', function() {
        const password = $('#addPassword').val();
        const confirm = $('#addPasswordConfirmation').val();
        const feedback = $('#addPasswordFeedback');
        
        if (password.length > 0 && confirm.length > 0) {
            if (password === confirm) {
                feedback.html('<i class="bi bi-check-circle text-success"></i> Passwords match');
                feedback.removeClass('text-danger').addClass('text-success');
            } else {
                feedback.html('<i class="bi bi-exclamation-circle text-danger"></i> Passwords do not match');
                feedback.removeClass('text-success').addClass('text-danger');
            }
        } else {
            feedback.html('');
        }
    });

    // Password validation for edit user
    $('#editPassword, #editPasswordConfirmation').on('keyup', function() {
        const password = $('#editPassword').val();
        const confirm = $('#editPasswordConfirmation').val();
        const feedback = $('#editPasswordFeedback');
        
        if (password.length > 0 || confirm.length > 0) {
            if (password === confirm && password.length >= 8) {
                feedback.html('<i class="bi bi-check-circle text-success"></i> Passwords match');
                feedback.removeClass('text-danger').addClass('text-success');
            } else if (password !== confirm && password.length > 0 && confirm.length > 0) {
                feedback.html('<i class="bi bi-exclamation-circle text-danger"></i> Passwords do not match');
                feedback.removeClass('text-success').addClass('text-danger');
            } else if (password.length > 0 && password.length < 8) {
                feedback.html('<i class="bi bi-exclamation-circle text-danger"></i> Password must be at least 8 characters');
                feedback.removeClass('text-success').addClass('text-danger');
            } else {
                feedback.html('<small class="text-muted">Leave blank to keep current password</small>');
            }
        } else {
            feedback.html('<small class="text-muted">Leave blank to keep current password</small>');
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Add toastr configuration if not already present
    if (typeof toastr !== 'undefined') {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000,
        };
    }
});
</script>
@endpush

@push('styles')
<style>
.card {
    border: none;
    border-radius: 12px;
}
.card-header {
    border-bottom: 1px solid #f0f0f0;
    border-radius: 12px 12px 0 0 !important;
}
.table th {
    font-weight: 600;
    color: #6c757d;
    border-top: none;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.table td {
    vertical-align: middle;
}
.badge {
    font-weight: 500;
    padding: 5px 12px;
}
.modal-content {
    border-radius: 12px;
}
.modal-header {
    border-bottom: 1px solid #f0f0f0;
}
.modal-footer {
    border-top: 1px solid #f0f0f0;
}
.btn-group .btn {
    border-radius: 4px;
    margin: 0 2px;
}
.btn-group .btn:first-child {
    border-radius: 4px 0 0 4px;
}
.btn-group .btn:last-child {
    border-radius: 0 4px 4px 0;
}
</style>
@endpush