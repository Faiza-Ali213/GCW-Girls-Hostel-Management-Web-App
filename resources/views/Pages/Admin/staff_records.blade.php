@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/staff_records.css') }}">

<div class="staff-container">
    
    <div class="page-header-section">
        <h2>Staff Management</h2>
        <p class="text-muted">Overview of hostel employees and their duties.</p>
    </div>

    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" class="staff-search shadow-sm" placeholder="Search staff by name or role...">
        </div>
        
        <button class="btn-add-staff shadow-sm">
            <i class="bi bi-plus-circle"></i> Add New Record
        </button>
    </div>

    <div class="staff-table-card">
        <div class="table-responsive">
            <table class="table staff-table align-middle">
                <thead>
                    <tr>
                        <th width="80px">Sr.No</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Phone Number</th>
                        <th>Duty / Shift</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-muted fw-bold">01</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-dark">Muhammad Rizwan</span>
                            </div>
                        </td>
                        <td><span class="role-badge">Warden</span></td>
                        <td>0312-4567890</td>
                        <td>Morning (8 AM - 4 PM)</td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2 text-primary"></i> Edit</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2 text-info"></i> View profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted fw-bold">02</td>
                        <td>
                            <span class="fw-bold text-dark">Saira Banu</span>
                        </td>
                        <td><span class="role-badge" style="background:#fff3e0; color:#ef6c00;">Kitchen Staff</span></td>
                        <td>0345-6789012</td>
                        <td>Full Day</td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2 text-primary"></i> Edit</a></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection