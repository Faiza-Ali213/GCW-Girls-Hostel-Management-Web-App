<!DOCTYPE html>
<html>
<head>
    <title>Staff Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f0f2f5; }
        .container { margin-top: 30px; }
        .card { border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        .table th { background: #1a2035; color: white; }
        .btn-sm { padding: 5px 10px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-users"></i> Staff Management</h3>
        </div>
        <div class="card-body">
            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- SEARCH + ADD BUTTON --}}
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" id="search" class="form-control" placeholder="Search by name or role..." onkeyup="searchStaff()">
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('staff.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add New Staff
                    </a>
                </div>
            </div>

            {{-- STAFF TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Duty/Shift</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="staffTable">
                        @forelse($staff as $index => $item)
                        <tr>
                            <td>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td><span class="badge bg-info">{{ $item->role }}</span></td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->duty_shift }}</td>
                            <td>
                                {{-- EDIT BUTTON --}}
                                <a href="{{ route('staff.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- DELETE BUTTON --}}
                                <form action="{{ route('staff.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this staff?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <i class="fas fa-users fa-2x d-block mb-2"></i>
                                No staff records found!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function searchStaff() {
    let input = document.getElementById('search');
    let filter = input.value.toUpperCase();
    let table = document.getElementById('staffTable');
    let rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        let name = rows[i].getElementsByTagName('td')[1];
        let role = rows[i].getElementsByTagName('td')[2];
        if (name || role) {
            let txtName = name ? name.textContent || name.innerText : '';
            let txtRole = role ? role.textContent || role.innerText : '';
            if (txtName.toUpperCase().indexOf(filter) > -1 || txtRole.toUpperCase().indexOf(filter) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>