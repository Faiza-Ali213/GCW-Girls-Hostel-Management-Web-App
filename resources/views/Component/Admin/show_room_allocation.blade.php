<!-- resources/views/Pages/Admin/show_room_allocation.blade.php -->
@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-eye text-info me-2"></i>View Room Allocation Details
                    </h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('room-allocation.edit', $allocation->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('room-allocation.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Student Information -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i>Student Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>Student Name</strong></td>
                                            <td>: {{ $allocation->student_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone Number</strong></td>
                                            <td>: {{ $allocation->phone ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Student ID</strong></td>
                                            <td>: #{{ $allocation->student_id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td>: {{ $allocation->student->email ?? 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Room Information -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="bi bi-door-open-fill me-2"></i>Room Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>Room Number</strong></td>
                                            <td>: <span class="badge bg-primary fs-6">{{ $allocation->room_no }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Room ID</strong></td>
                                            <td>: #{{ $allocation->room_id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Available Beds</strong></td>
                                            <td>: {{ $allocation->room->available_beds ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Room Status</strong></td>
                                            <td>: 
                                                @if(isset($allocation->room->available_beds) && $allocation->room->available_beds > 0)
                                                    <span class="badge bg-success">Available</span>
                                                @else
                                                    <span class="badge bg-danger">Full</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Allocation Details -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Allocation Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center p-3 border rounded">
                                                <h6 class="text-muted">Allocation Date</h6>
                                                <h4>{{ \Carbon\Carbon::parse($allocation->allocation_date)->format('d M Y') }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center p-3 border rounded">
                                                <h6 class="text-muted">Allocation Status</h6>
                                                <h4><span class="badge bg-success fs-6">Active</span></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center p-3 border rounded">
                                                <h6 class="text-muted">Created At</h6>
                                                <h4>{{ $allocation->created_at->format('d M Y H:i') }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="{{ route('room-allocation.edit', $allocation->id) }}" class="btn btn-warning px-4">
                                <i class="bi bi-pencil-square me-2"></i> Edit Allocation
                            </a>
                            <a href="{{ route('room-allocation.index') }}" class="btn btn-secondary px-4">
                                <i class="bi bi-list me-2"></i> View All Allocations
                            </a>
                            <form action="{{ route('room-allocation.destroy', $allocation->id) }}" method="POST" class="d-inline