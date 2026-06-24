@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/student_records.css') }}">

<div class="student-container">
    
    <div class="page-header-section">
        <h2>Student Records</h2>
        <p class="text-muted">Database of all residents currently staying in GCW Hostel.</p>
    </div>

    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" class="custom-search shadow-sm" placeholder="Search by name, father name, or CNIC...">
        </div>
        
        <button class="btn-add-student shadow-sm">
            <i class="bi bi-person-plus"></i> Add Student Record
        </button>
    </div>

    <div class="data-table-card">
        <div class="table-responsive">
            <table class="table student-table align-middle">
                <thead>
                    <tr>
                        <th width="70px">Sr.No</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Phone Number</th>
                        <th>CNIC Number</th>
                        <th>Address</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-muted fw-bold">01</td>
                        <td><span class="fw-bold text-dark">Amna Bibi</span></td>
                        <td>Muhammad Bilal</td>
                        <td>0300-1234567</td>
                        <td>35201-1234567-8</td>
                        <td class="small text-muted">House #12, St 5, Model Town, Lahore</td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-pencil me-2 text-primary"></i> Edit</a></li>
                                    <li><a class="dropdown-item rounded" href="#"><i class="bi bi-eye me-2 text-info"></i> View Details</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item rounded text-danger" href="#"><i class="bi bi-trash me-2"></i> Delete Record</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted fw-bold">02</td>
                        <td><span class="fw-bold text-dark">Fatima Zahra</span></td>
                        <td>Abdul Sattar</td>
                        <td>0321-9876543</td>
                        <td>35202-9876543-1</td>
                        <td class="small text-muted">Village Chak 44, GT Road, Sialkot</td>
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