@extends('Layout.admin')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-users"></i> Visitor Records</h2>
        <a href="{{ route('visitor.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Visitor
        </a>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Visitors</h5>
                    <h2>{{ $totalVisitors }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Today's Visitors</h5>
                    <h2>{{ $todayVisitors }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Total Visitor Count</h5>
                    <h2>{{ $totalVisitorsCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('visitors_records') }}" method="GET" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Search by student name or room..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Visitors Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Room No</th>
                            <th>Visitors</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitors as $visitor)
                        @php
                            $visitorDetails = json_decode($visitor->visitor_details_json, true) ?? [];
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $visitor->student_name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $visitor->student_room ?? 'N/A' }}</span>
                            </td>
                            <td>
                                @foreach($visitorDetails as $detail)
                                    <span class="badge bg-info me-1">
                                        {{ $detail['visitor_name'] ?? 'N/A' }}
                                        ({{ $detail['relationship'] ?? 'N/A' }})
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $visitor->number_of_visitors }}</span>
                            </td>
                            <td>
                                {{ $visitor->created_at->format('d-m-Y') }}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('visitor.show', $visitor->id) }}" class="btn btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this record?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted">No visitor records found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $visitors->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .container {
        max-width: 1200px;
    }
    .badge {
        font-size: 0.85rem;
        padding: 5px 10px;
    }
    .table td {
        vertical-align: middle;
    }
    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card-body {
        padding: 20px;
    }
    .btn-group .btn {
        padding: 5px 10px;
    }
</style>
@endpush
@endsection