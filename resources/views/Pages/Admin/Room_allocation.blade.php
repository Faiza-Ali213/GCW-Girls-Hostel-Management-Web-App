@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Room_allocation.css') }}">

<div class="room-container">
    
    <div class="page-header-section">
        <h2>Room Allocation</h2>
        <p class="text-muted">Manage hostel rooms and monitor space availability.</p>
    </div>

    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" class="custom-search shadow-sm" placeholder="Search by name, room number or phone...">
        </div>
        
        <button class="btn-add-room shadow-sm">
            <i class="bi bi-door-open-fill"></i> Add New Room
        </button>
    </div>

    <div class="data-table-card">
        <div class="table-responsive">
            <table class="table room-table align-middle">
                <thead>
                    <tr>
                        <th width="70px">Sr.No</th>
                        <th>Student Name</th>
                        <th>Phone Number</th>
                        <th>Room No</th>
                        <th>Available Space</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-muted fw-bold">01</td>
                        <td><span class="fw-bold text-dark">Ayesha Khan</span></td>
                        <td>0300-1234567</td>
                        <td><span class="fw-bold text-primary">A-101</span></td>
                        <td><span class="space-badge space-available">2 Beds Left</span></td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-pencil me-2 text-primary"></i> Edit Room</a></li>
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-person-x me-2 text-warning"></i> Deallocate</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item rounded text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted fw-bold">02</td>
                        <td><span class="fw-bold text-dark">Fatima Zahra</span></td>
                        <td>0321-9876543</td>
                        <td><span class="fw-bold text-primary">B-204</span></td>
                        <td><span class="space-badge space-full">Room Full</span></td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-pencil me-2 text-primary"></i> Edit</a></li>
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