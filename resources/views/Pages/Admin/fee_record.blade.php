@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fee_record.css') }}">

<div class="fee-container">
    
    <div class="page-header-section">
        <h2>Fee Records</h2>
        <p class="text-muted">Track monthly student payments and pending balances.</p>
    </div>

    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" class="custom-search shadow-sm" placeholder="Search by student name, room or phone...">
        </div>
        
        <button class="btn-add-fee shadow-sm">
            <i class="bi bi-cash-stack"></i> Add Fee Record
        </button>
    </div>

    <div class="data-table-card">
        <div class="table-responsive">
            <table class="table fee-table align-middle">
                <thead>
                    <tr>
                        <th width="70px">Sr.No</th>
                        <th>Student Name</th>
                        <th>Room No</th>
                        <th>Phone Number</th>
                        <th>Fee Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-muted fw-bold">01</td>
                        <td><span class="fw-bold text-dark">Amna Bibi</span></td>
                        <td><span class="badge bg-light text-dark border">A-101</span></td>
                        <td>0300-1234567</td>
                        <td><span class="status-badge status-paid">Paid</span></td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-receipt me-2 text-success"></i> View Receipt</a></li>
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-pencil me-2 text-primary"></i> Edit Status</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item rounded text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted fw-bold">02</td>
                        <td><span class="fw-bold text-dark">Fatima Zahra</span></td>
                        <td><span class="badge bg-light text-dark border">B-204</span></td>
                        <td>0321-9876543</td>
                        <td><span class="status-badge status-unpaid">Unpaid</span></td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-bell me-2 text-warning"></i> Send Reminder</a></li>
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-pencil me-2 text-primary"></i> Edit Status</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item rounded text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
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