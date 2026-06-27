@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Submit New Complaint</h3>
                    <a href="{{ route('complaints.index') }}" class="btn btn-default float-right">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('complaints.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label>Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Student Name *</label>
                            <input type="text" name="student_name" class="form-control @error('student_name') is-invalid @enderror" value="{{ old('student_name') }}" required>
                            @error('student_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Room Number</label>
                            <input type="text" name="room_number" class="form-control" value="{{ old('room_number') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Priority *</label>
                            <select name="priority" class="form-control @error('priority') is-invalid @enderror" required>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            @error('priority')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Complaint By</label>
                            <input type="text" name="complaint_by" class="form-control" placeholder="Walk-in student or ID" value="{{ old('complaint_by') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Complaint</button>
                        <a href="{{ route('complaints.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection