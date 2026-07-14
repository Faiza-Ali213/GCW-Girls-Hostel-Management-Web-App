@extends('Layout.admin') {{-- Or your main layout --}}

@section('page_title', 'User Management')
@section('page_subtitle', 'Manage system users and permissions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-people me-2"></i>User Management</h5>
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Add New User
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=6C63FF&color=fff&size=32" 
                                                 class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <div class="fw-semibold">Admin User</div>
                                                <small class="text-muted">admin@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>admin@example.com</td>
                                    <td><span class="badge bg-primary">Administrator</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>2024-01-15 10:30 AM</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=FF6B6B&color=fff&size=32" 
                                                 class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <div class="fw-semibold">John Doe</div>
                                                <small class="text-muted">john@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>john@example.com</td>
                                    <td><span class="badge bg-warning">Staff</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>2024-01-14 04:20 PM</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=4CAF50&color=fff&size=32" 
                                                 class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <div class="fw-semibold">Jane Smith</div>
                                                <small class="text-muted">jane@example.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>jane@example.com</td>
                                    <td><span class="badge bg-info">Student</span></td>
                                    <td><span class="badge bg-secondary">Inactive</span></td>
                                    <td>2024-01-10 09:15 AM</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Showing 1-3 of 12 users</small>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
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
</style>
@endsection