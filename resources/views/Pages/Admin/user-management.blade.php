@extends('Layout.admin')

@section('page_title', 'User Management')
@section('page_subtitle', 'Manage system users and permissions')

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="stats-card">
                <div class="stats-icon bg-primary">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stats-info">
                    <h4>{{ $totalUsers }}</h4>
                    <span>Total Users</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stats-card">
                <div class="stats-icon bg-success">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="stats-info">
                    <h4>{{ $activeUsers }}</h4>
                    <span>Active Users</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stats-card">
                <div class="stats-icon bg-danger">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div class="stats-info">
                    <h4>{{ $inactiveUsers }}</h4>
                    <span>Inactive Users</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stats-card">
                <div class="stats-icon bg-info">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <div class="stats-info">
                    <h4>{{ $adminUsers }}</h4>
                    <span>Administrators</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-people me-2"></i>User Management
            </h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Add New User
            </a>
        </div>
        <div class="card-body">
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Search and Filter -->
            <div class="row g-3 mb-3">
                <div class="col-md-5">
                    <form action="{{ route('users.index') }}" method="GET" class="search-form">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2">
                            <select name="role" class="form-select form-select-sm" style="width: 140px;" onchange="this.form.submit()">
                                <option value="">All Roles</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                <option value="warden" {{ request('role') == 'warden' ? 'selected' : '' }}>Warden</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <select name="status" class="form-select form-select-sm" style="width: 140px;" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
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
                                    <img src="{{ $user->getAvatarUrl() }}" class="rounded-circle me-2" width="35" height="35">
                                    <strong>{{ $user->name }}</strong>
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
                            <td>{{ $user->last_login ? $user->last_login->format('Y-m-d H:i') : 'Never' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn" 
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
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i> Add New User
                                </a>
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
                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Delete User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete user <strong id="deleteUserName"></strong>?</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.stats-card {
    background: #fff;
    border-radius: 12px;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.stats-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 22px;
}

.stats-icon.bg-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.stats-icon.bg-success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
.stats-icon.bg-danger { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.stats-icon.bg-info { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

.stats-info h4 {
    font-size: 22px;
    font-weight: 700;
    margin: 0;
    color: #2d3748;
}

.stats-info span {
    font-size: 13px;
    color: #718096;
}

.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.card-header {
    background: #fff;
    border-bottom: 1px solid #f0f0f0;
    padding: 15px 20px;
}

.card-body {
    padding: 20px;
}

.search-form .input-group-text {
    background: #fff;
    border-right: none;
}

.search-form .form-control {
    border-left: none;
}

.search-form .form-control:focus {
    border-color: #dee2e6;
    box-shadow: none;
}

.table th {
    font-weight: 600;
    color: #4a5568;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-top: none;
}

.table td {
    vertical-align: middle;
}

.badge {
    padding: 5px 12px;
    font-weight: 500;
}

.btn-group .btn {
    padding: 4px 8px;
}

.btn-group .btn:hover {
    transform: scale(1.05);
}

.btn-group .btn i {
    font-size: 14px;
}
</style>
@endpush

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
});
</script>
@endpush