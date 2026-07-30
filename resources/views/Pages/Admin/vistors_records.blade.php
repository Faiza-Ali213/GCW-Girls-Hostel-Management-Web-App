@extends('Layout.admin')

@section('content')
<style>
    /* ===== MODERN DARK BLUE THEME ===== */
    .records-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        margin-top: 10px;
        background: #f8faff;
    }

    .records-card .card-header {
        background: linear-gradient(135deg, #0f1a2e 0%, #1a2a4a 100%);
        padding: 18px 28px;
        border: none;
    }

    .records-card .card-header h5 {
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .records-card .card-header h5 i {
        color: #60a5fa;
        font-size: 1.2rem;
    }

    .records-card .card-header .badge-header {
        background: rgba(255, 255, 255, 0.12);
        color: #93bbfc;
        font-size: 0.65rem;
        font-weight: 500;
        padding: 4px 14px;
        border-radius: 20px;
        margin-left: auto;
        letter-spacing: 0.3px;
    }

    .records-card .card-body {
        padding: 28px;
        background: #f8faff;
    }

    /* Stats Cards */
    .stat-card {
        border: none;
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
    }

    .stat-card .stat-body {
        padding: 20px 24px;
        position: relative;
    }

    .stat-card .stat-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2.5rem;
        opacity: 0.2;
    }

    .stat-card .stat-label {
        font-size: 0.82rem;
        font-weight: 500;
        opacity: 0.9;
        margin-bottom: 4px;
    }

    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }

    .stat-primary {
        background: linear-gradient(135deg, #1a2a4a 0%, #2a4a7a 100%);
        color: #ffffff;
    }

    .stat-success {
        background: linear-gradient(135deg, #0f5c3a 0%, #1a8a5a 100%);
        color: #ffffff;
    }

    .stat-info {
        background: linear-gradient(135deg, #0f4a6a 0%, #1a7a9a 100%);
        color: #ffffff;
    }

    /* Search Section */
    .search-card {
        border: 1.5px solid #e8edf5;
        border-radius: 12px;
        background: #ffffff;
        padding: 4px;
        transition: all 0.3s ease;
    }

    .search-card:focus-within {
        border-color: #1a2a4a;
        box-shadow: 0 0 0 4px rgba(26, 42, 74, 0.08);
    }

    .search-card .form-control {
        border: none;
        padding: 12px 20px;
        font-size: 0.88rem;
        border-radius: 10px;
        background: transparent;
    }

    .search-card .form-control:focus {
        box-shadow: none;
    }

    .search-card .btn-search {
        background: #1a2a4a;
        color: #ffffff;
        border: none;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.25s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .search-card .btn-search:hover {
        background: #0f1a2e;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(26, 42, 74, 0.2);
    }

    /* Table Styles */
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
        margin-bottom: 0;
    }

    .table-modern thead th {
        background: #f1f4f9;
        color: #1a2a4a;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        border: none;
        white-space: nowrap;
    }

    .table-modern tbody tr {
        background: #ffffff;
        border-radius: 10px;
        transition: all 0.25s ease;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .table-modern tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(26, 42, 74, 0.08);
    }

    .table-modern tbody td {
        padding: 14px 16px;
        border: none;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #1a2a4a;
    }

    .table-modern tbody tr td:first-child {
        border-radius: 10px 0 0 10px;
    }

    .table-modern tbody tr td:last-child {
        border-radius: 0 10px 10px 0;
    }

    /* Badges */
    .badge-modern {
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.7rem;
        letter-spacing: 0.3px;
        display: inline-block;
    }

    .badge-room {
        background: #eef2f8;
        color: #1a2a4a;
    }

    .badge-visitor {
        background: #e8edf5;
        color: #1a2a4a;
        margin: 2px 4px 2px 0;
        padding: 4px 12px;
        font-size: 0.7rem;
    }

    .badge-total {
        background: #1a2a4a;
        color: #ffffff;
        font-size: 0.8rem;
        padding: 4px 16px;
    }

    .badge-relationship {
        background: #dbeafe;
        color: #1a4a7a;
        font-size: 0.6rem;
        padding: 2px 8px;
        border-radius: 12px;
    }

    /* Action Buttons */
    .action-btns {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
        cursor: pointer;
        font-size: 0.8rem;
        text-decoration: none;
    }

    .btn-action:hover {
        transform: scale(1.1);
        text-decoration: none;
    }

    .btn-view {
        background: #e8edf5;
        color: #1a2a4a;
    }

    .btn-view:hover {
        background: #1a2a4a;
        color: #ffffff;
    }

    .btn-edit {
        background: #dbeafe;
        color: #1a4a7a;
    }

    .btn-edit:hover {
        background: #1a4a7a;
        color: #ffffff;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
    }

    /* Add Visitor Button */
    .btn-add-modern {
        background: #1a2a4a;
        color: #ffffff;
        border: none;
        padding: 8px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.25s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(26, 42, 74, 0.15);
        text-decoration: none;
    }

    .btn-add-modern:hover {
        background: #0f1a2e;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 42, 74, 0.2);
        text-decoration: none;
    }

    .btn-add-modern i {
        font-size: 0.9rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state i {
        font-size: 3rem;
        color: #d1d8e0;
        margin-bottom: 16px;
    }

    .empty-state h5 {
        color: #1a2a4a;
        font-weight: 600;
    }

    .empty-state p {
        color: #94a3b8;
    }

    /* Pagination */
    .pagination-modern {
        display: flex;
        gap: 6px;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .pagination-modern .page-item .page-link {
        border: 1.5px solid #e8edf5;
        border-radius: 8px;
        padding: 8px 14px;
        color: #1a2a4a;
        font-weight: 500;
        font-size: 0.82rem;
        transition: all 0.25s ease;
        background: #ffffff;
    }

    .pagination-modern .page-item.active .page-link {
        background: #1a2a4a;
        border-color: #1a2a4a;
        color: #ffffff;
    }

    .pagination-modern .page-item .page-link:hover {
        background: #eef2f8;
        border-color: #1a2a4a;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .records-card .card-body {
            padding: 18px;
        }

        .stat-card .stat-number {
            font-size: 1.5rem;
        }

        .stat-card .stat-icon {
            font-size: 1.8rem;
        }

        .table-modern {
            font-size: 0.8rem;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 10px 12px;
        }

        .action-btns {
            flex-wrap: wrap;
        }

        .btn-action {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }

        .search-card .btn-search {
            width: 100%;
            justify-content: center;
            margin-top: 8px;
        }
    }

    @media (max-width: 576px) {
        .stat-card .stat-body {
            padding: 16px 20px;
        }

        .stat-card .stat-number {
            font-size: 1.2rem;
        }

        .badge-visitor {
            font-size: 0.6rem;
            padding: 2px 8px;
            margin: 1px 2px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="records-card card">
                <div class="card-header">
                    <h5>
                        <i class="fas fa-users"></i>
                        Visitor Records
                        <span class="badge-header">
                            <i class="far fa-clock"></i> {{ now()->format('d M Y, h:i A') }}
                        </span>
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Top Action Row -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                        <h5 class="mb-0" style="color: #1a2a4a; font-weight: 600;">
                            <i class="fas fa-list-ul" style="color: #1a2a4a; margin-right: 8px;"></i>
                            All Records
                        </h5>
                        <a href="{{ route('visitor.create') }}" class="btn-add-modern">
                            <i class="fas fa-plus-circle"></i> Add New Visitor
                        </a>
                    </div>

                    <!-- Statistics -->
                    <div class="row mb-4 g-3">
                        <div class="col-md-4 col-sm-6">
                            <div class="stat-card stat-primary">
                                <div class="stat-body">
                                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                                    <div class="stat-label">Total Visitors</div>
                                    <div class="stat-number">{{ $totalVisitors }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="stat-card stat-success">
                                <div class="stat-body">
                                    <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                                    <div class="stat-label">Today's Visitors</div>
                                    <div class="stat-number">{{ $todayVisitors }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="stat-card stat-info">
                                <div class="stat-body">
                                    <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                                    <div class="stat-label">Total Visitor Count</div>
                                    <div class="stat-number">{{ $totalVisitorsCount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="search-card mb-4">
                        <form action="{{ route('visitors_records') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2 p-2">
                            <div class="flex-grow-1" style="min-width: 200px;">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Search by student name or room number..." 
                                       value="{{ request('search') }}">
                            </div>
                            <button class="btn-search" type="submit">
                                <i class="fas fa-search"></i> Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('visitors_records') }}" class="btn-search" style="background: #eef2f8; color: #1a2a4a;">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Visitors Table -->
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Room</th>
                                    <th>Visitors</th>
                                    <th>Total</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($visitors as $visitor)
                                @php
                                    $visitorDetails = json_decode($visitor->visitor_details_json, true) ?? [];
                                @endphp
                                <tr>
                                    <td>
                                        <span style="font-weight: 600; color: #1a2a4a;">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <strong style="color: #1a2a4a;">{{ $visitor->student_name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge-modern badge-room">
                                            <i class="fas fa-door-open" style="font-size: 0.6rem;"></i>
                                            {{ $visitor->student_room ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach($visitorDetails as $detail)
                                            <span class="badge-modern badge-visitor">
                                                <i class="fas fa-user" style="font-size: 0.5rem;"></i>
                                                {{ $detail['visitor_name'] ?? 'N/A' }}
                                                <span class="badge-relationship">
                                                    {{ $detail['relationship'] ?? 'N/A' }}
                                                </span>
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="badge-modern badge-total">
                                            <i class="fas fa-user-friends" style="font-size: 0.6rem;"></i>
                                            {{ $visitor->number_of_visitors }}
                                        </span>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="action-btns" style="justify-content: center;">
                                            <a href="{{ route('visitor.show', $visitor->id) }}" 
                                               class="btn-action btn-view" 
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('visitor.edit', $visitor->id) }}" 
                                               class="btn-action btn-edit" 
                                               title="Edit Record">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('visitor.destroy', $visitor->id) }}" 
                                                  method="POST" 
                                                  style="display:inline; margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn-action btn-delete" 
                                                        onclick="return confirm('Are you sure you want to delete this visitor record?')" 
                                                        title="Delete Record">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-user-slash"></i>
                                            <h5>No Visitor Records Found</h5>
                                            <p class="text-muted">Start by adding your first visitor record.</p>
                                            <a href="{{ route('visitor.create') }}" class="btn-add-modern" style="display: inline-flex; margin-top: 12px;">
                                                <i class="fas fa-plus-circle"></i> Add Visitor
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($visitors->hasPages())
                        <div class="mt-4">
                            <div class="pagination-modern">
                                {{ $visitors->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection