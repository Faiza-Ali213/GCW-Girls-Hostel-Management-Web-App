@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Visitor Records</h3>
                    <div class="card-tools">
                        <a href="{{ route('visitor.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Visitor
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totalVisitors }}</h3>
                                    <p>Total Visitors</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $todayVisitors }}</h3>
                                    <p>Today's Visitors</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $totalVisitorsCount }}</h3>
                                    <p>Total Visitor Count</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Filter -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('visitors_records') }}" method="GET" class="form-inline">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search visitors..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="{{ route('visitors_records') }}" method="GET" class="form-inline justify-content-end">
                                <div class="input-group">
                                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Visitors</th>
                                    <th>Student Name</th>
                                    <th>Room</th>
                                    <th>Total</th>
                                    <th>Check In Time</th>
                                    <th>Checked In By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($visitors as $index => $visitor)
                                @php
                                    $visitorDetails = json_decode($visitor->visitor_details_json, true) ?? [];
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @foreach($visitorDetails as $detail)
                                            <div class="visitor-item mb-1">
                                                <strong>{{ $detail['visitor_name'] ?? 'N/A' }}</strong>
                                                <span class="badge badge-info">{{ $detail['relationship'] ?? 'N/A' }}</span>
                                                @if(!empty($detail['phone_number']))
                                                    <br><small class="text-muted"><i class="fas fa-phone"></i> {{ $detail['phone_number'] }}</small>
                                                @endif
                                                @if(!empty($detail['cnic_number']))
                                                    <br><small class="text-muted"><i class="fas fa-id-card"></i> {{ $detail['cnic_number'] }}</small>
                                                @endif
                                            </div>
                                            @if(!$loop->last)
                                                <hr class="my-1">
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <strong>{{ $visitor->student_name }}</strong>
                                        @if($visitor->student_phone)
                                            <br><small class="text-muted"><i class="fas fa-phone"></i> {{ $visitor->student_phone }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">{{ $visitor->student_room ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary badge-lg">{{ $visitor->number_of_visitors }}</span>
                                    </td>
                                    <td>
                                        @if($visitor->check_in_time)
                                            <span class="badge badge-success">
                                                <i class="fas fa-clock"></i> 
                                                {{ $visitor->check_in_time->format('d-m-Y H:i') }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $visitor->check_in_by ?? 'System' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('visitor.show', $visitor->id) }}" class="btn btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('visitor.edit', $visitor->id) }}" class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this visitor record?')" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No visitor records found.</p>
                                            <a href="{{ route('visitor.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Add First Visitor
                                            </a>
                                        </div>
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
    </div>
</div>

@push('styles')
<style>
    .visitor-item {
        padding: 2px 0;
    }
    .visitor-item .badge {
        font-size: 0.7rem;
        padding: 3px 8px;
    }
    .visitor-item hr {
        border-top: 1px dashed #dee2e6;
        margin: 4px 0;
    }
    .badge-lg {
        font-size: 1rem;
        padding: 5px 12px;
    }
    .table td {
        vertical-align: middle;
    }
</style>
@endpush

@endsection