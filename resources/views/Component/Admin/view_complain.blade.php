@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Complaint Details #{{ $complaint->id }}</h3>
                    <a href="{{ route('complaints.index') }}" class="btn btn-secondary float-right">Back</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Title:</th>
                            <td>{{ $complaint->title }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $complaint->description }}</td>
                        </tr>
                        <tr>
                            <th>Student Name:</th>
                            <td>{{ $complaint->student_name }}</td>
                        </tr>
                        <tr>
                            <th>Room Number:</th>
                            <td>{{ $complaint->room_number ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number:</th>
                            <td>{{ $complaint->contact_number ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Priority:</th>
                            <td><span class="{{ $complaint->priority_badge }}">{{ ucfirst($complaint->priority) }}</span></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td><span class="{{ $complaint->status_badge }}">{{ ucfirst(str_replace('_', ' ', $complaint->status)) }}</span></td>
                        </tr>
                        <tr>
                            <th>Complaint By:</th>
                            <td>{{ $complaint->complaint_by ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Admin Remark:</th>
                            <td>{{ $complaint->admin_remark ?? 'No remarks yet' }}</td>
                        </tr>
                        <tr>
                            <th>Submitted Date:</th>
                            <td>{{ $complaint->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        @if($complaint->resolved_at)
                        <tr>
                            <th>Resolved Date:</th>
                            <td>{{ $complaint->resolved_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        @endif
                    </table>
                    
                    <div class="mt-3">
                        <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-warning">Edit Complaint</a>
                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection