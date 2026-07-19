<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('users.store') }}" method="POST" id="addUserForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">
                        <i class="bi bi-person-plus me-2"></i>Add New User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addName" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="addEmail" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addPassword" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="addPassword" name="password" required minlength="8">
                            <div id="addPasswordFeedback" class="form-text"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addPasswordConfirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="addPasswordConfirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addRole" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="addRole" name="role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Administrator</option>
                                <option value="warden">Warden</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addStatus" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="addStatus" name="status" required>
                                <option value="">Select Status</option>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addPhone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="addPhone" name="phone" placeholder="e.g., 1234567890">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="addAddress" name="address" placeholder="Enter address">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>