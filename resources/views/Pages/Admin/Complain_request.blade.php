@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Complaint Management</h3>
                    <a href="{{ route('complaints.create') }}" class="btn btn-primary float-right">Add New Complaint</a>
                </div>
                
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $pendingCount ?? 0 }}</h3>
                                    <p>Pending Complaints</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $inProgressCount ?? 0 }}</h3>
                                    <p>In Progress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $resolvedCount ?? 0 }}</h3>
                                    <p>Resolved</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $complaints->count() ?? 0 }}</h3>
                                    <p>Total Complaints</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Complaints Table -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Student Name</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Submitted Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $complaint)
                            <tr>
                                <td>{{ $complaint->id }}</td>
                                <td>{{ $complaint->title }}</td>
                                <td>{{ $complaint->student_name }}</td>
                                <td>
                                    @php
                                        $priorityClass = '';
                                        if($complaint->priority == 'high') $priorityClass = 'text-danger';
                                        elseif($complaint->priority == 'medium') $priorityClass = 'text-warning';
                                        else $priorityClass = 'text-success';
                                    @endphp
                                    <span class="{{ $priorityClass }} font-weight-bold">{{ ucfirst($complaint->priority) }}</span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = '';
                                        if($complaint->status == 'pending') $statusClass = 'text-warning';
                                        elseif($complaint->status == 'in_progress') $statusClass = 'text-info';
                                        elseif($complaint->status == 'resolved') $statusClass = 'text-success';
                                        else $statusClass = 'text-danger';
                                    @endphp
                                    <span class="{{ $statusClass }} font-weight-bold">
                                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                    </span>
                                </td>
                                <td>{{ $complaint->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('complaints.show', $complaint->id) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No complaints found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection