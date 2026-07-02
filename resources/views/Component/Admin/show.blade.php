@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Staff Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $staff->name }}</p>
                            <p><strong>Role:</strong> {{ $staff->role }}</p>
                            <p><strong>Phone Number:</strong> {{ $staff->phone_number }}</p>
                            <p><strong>Duty Shift:</strong> {{ $staff->duty_shift }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $staff->email ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $staff->address ?? 'N/A' }}</p>
                            <p><strong>Joining Date:</strong> {{ $staff->joining_date?->format('d-m-Y') ?? 'N/A' }}</p>
                            <p><strong>Salary:</strong> {{ $staff->salary ? 'Rs. ' . number_format($staff->salary, 2) : 'N/A' }}</p>
                            <p>
                                <strong>Status:</strong> 
                                <span class="badge bg-{{ $staff->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($staff->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('staff.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection