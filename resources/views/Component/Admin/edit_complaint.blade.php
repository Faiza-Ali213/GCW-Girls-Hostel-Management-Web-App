@extends('Layout.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Complaint #{{ $complaint->id }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('complaints.update', $complaint->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label>Title *</label>
                            <input type="text" name="title" class="form-control" value="{{ $complaint->title }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Description *</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $complaint->description }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Student Name *</label>
                            <input type="text" name="student_name" class="form-control" value="{{ $complaint->student_name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Room Number</label>
                            <input type="text" name="room_number" class="form-control" value="{{ $complaint->room_number }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="{{ $complaint->contact_number }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Priority</label>
                            <select name="priority" class="form-control">
                                <option value="low" {{ $complaint->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $complaint->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $complaint->priority == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="rejected" {{ $complaint->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Admin Remark</label>
                            <textarea name="admin_remark" class="form-control" rows="3">{{ $complaint->admin_remark }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Complaint</button>
                        <a href="{{ route('complaints.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection