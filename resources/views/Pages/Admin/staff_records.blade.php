@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/staff_records.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .staff-container {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .page-header-section {
        margin-bottom: 30px;
    }
    
    .page-header-section h2 {
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }
    
    .action-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .search-container {
        position: relative;
        flex: 1;
        max-width: 350px;
    }
    
    .search-container i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }
    
    .staff-search {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
    }
    
    .btn-add-staff {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-add-staff:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        color: white;
    }
    
    .staff-table-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .staff-table th {
        font-weight: 600;
        color: #555;
        border-bottom: 2px solid #e0e0e0;
        padding: 15px 10px;
    }
    
    .staff-table td {
        padding: 15px 10px;
        vertical-align: middle;
    }
    
    .role-badge {
        background: #e3f2fd;
        color: #1976d2;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    
    .status-badge-active {
        background: #e8f5e9;
        color: #4caf50;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-badge-inactive {
        background: #ffebee;
        color: #f44336;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .btn-dots {
        background: none;
        border: none;
        font-size: 20px;
        color: #999;
        cursor: pointer;
    }
    
    .btn-dots:hover {
        color: #667eea;
    }
    
    .pagination-container {
        margin-top: 20px;
        text-align: center;
    }
    
    .pagination {
        justify-content: center;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-radius: 8px;
        padding: 12px 20px;
        margin-bottom: 20px;
        border-left: 4px solid #28a745;
    }
    
    @media (max-width: 768px) {
        .action-row {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-container {
            max-width: 100%;
        }
        
        .staff-table-card {
            overflow-x: auto;
        }
    }
</style>

<div class="staff-container">
    @if(session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif
    
    <div class="page-header-section">
        <h2>Staff Management</h2>
        <p class="text-muted">Overview of hostel employees and their duties.</p>
    </div>

    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" class="staff-search shadow-sm" placeholder="Search staff by name, role or phone...">
        </div>
        
        <a href="{{ route('staff.create') }}" class="btn-add-staff shadow-sm text-decoration-none">
            <i class="bi bi-plus-circle"></i> Add New Record
        </a>
    </div>

    <div class="staff-table-card">
        <div class="table-responsive">
            <table class="table staff-table align-middle">
                <thead>
                    <tr>
                        <th width="80px">#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Phone Number</th>
                        <th>Duty / Shift</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody id="staffTableBody">
                    @foreach($staff as $index => $member)
                    <tr>
                        <td class="text-muted fw-bold">{{ $staff->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-dark">{{ $member->name }}</span>
                                @if($member->email)
                                    <small class="text-muted d-block">{{ $member->email }}</small>
                                @endif
                            </div>
                        </td>
                        <td><span class="role-badge">{{ $member->role }}</span></td>
                        <td>{{ $member->phone_number }}</td>
                        <td>{{ $member->duty_shift }}</td>
                        <td>
                            <span class="{{ $member->status == 'active' ? 'status-badge-active' : 'status-badge-inactive' }}">
                                {{ ucfirst($member->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('staff.edit', $member->id) }}">
                                            <i class="bi bi-pencil me-2 text-primary"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('staff.show', $member->id) }}">
                                            <i class="bi bi-eye me-2 text-info"></i> View profile
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $member->id }}, '{{ $member->name }}')">
                                            <i class="bi bi-trash me-2"></i> Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    @if($staff->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-people" style="font-size: 48px; color: #ccc;"></i>
                            <p class="mt-2 text-muted">No staff members found</p>
                            <a href="{{ route('staff.create') }}" class="btn-add-staff text-decoration-none">Add First Staff Member</a>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <div class="pagination-container">
            {{ $staff->links() }}
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteStaffName"></strong>?</p>
                <p class="text-danger mb-0">This action cannot be undone!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function confirmDelete(id, name) {
        $('#deleteStaffName').text(name);
        $('#deleteForm').attr('action', '/staff/' + id);
        $('#deleteModal').modal('show');
    }
    
    // Live search functionality
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        let search = $(this).val();
        
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: '{{ route("staff.search") }}',
                type: 'GET',
                data: { search: search },
                success: function(response) {
                    updateTable(response.data);
                    updatePagination(response);
                }
            });
        }, 500);
    });
    
    function updateTable(staff) {
        let html = '';
        if(staff.length === 0) {
            html = '<tr><td colspan="7" class="text-center py-5"><i class="bi bi-people" style="font-size: 48px; color: #ccc;"></i><p class="mt-2 text-muted">No staff members found</p></td></tr>';
        } else {
            staff.forEach((member, index) => {
                html += `
                    <tr>
                        <td class="text-muted fw-bold">${index + 1}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-dark">${escapeHtml(member.name)}</span>
                                ${member.email ? `<small class="text-muted d-block">${escapeHtml(member.email)}</small>` : ''}
                            </div>
                        </td>
                        <td><span class="role-badge">${escapeHtml(member.role)}</span></td>
                        <td>${escapeHtml(member.phone_number)}</td>
                        <td>${escapeHtml(member.duty_shift)}</td>
                        <td>
                            <span class="${member.status == 'active' ? 'status-badge-active' : 'status-badge-inactive'}">
                                ${member.status.charAt(0).toUpperCase() + member.status.slice(1)}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                                    <li><a class="dropdown-item" href="/staff/${member.id}/edit"><i class="bi bi-pencil me-2 text-primary"></i> Edit</a></li>
                                    <li><a class="dropdown-item" href="/staff/${member.id}"><i class="bi bi-eye me-2 text-info"></i> View profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(${member.id}, '${escapeHtml(member.name)}')"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
        $('#staffTableBody').html(html);
    }
    
    function updatePagination(response) {
        if(response.links) {
            // Update pagination links if needed
        }
    }
    
    function escapeHtml(str) {
        if(!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if(m === '&') return '&amp;';
            if(m === '<') return '&lt;';
            if(m === '>') return '&gt;';
            return m;
        });
    }
</script>
@endsection