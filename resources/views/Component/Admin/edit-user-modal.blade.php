<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="POST" id="editUserForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editUserId" name="id">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editName" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="editPassword" name="password" minlength="8">
                            <div id="editPasswordFeedback" class="form-text">
                                <small class="text-muted">Leave blank to keep current password</small>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editPasswordConfirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="editPasswordConfirmation" name="password_confirmation">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editRole" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="editRole" name="role" required>
                                <option value="admin">Administrator</option>
                                <option value="warden">Warden</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editStatus" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="editStatus" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editPhone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="editPhone" name="phone" placeholder="e.g., 1234567890">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editAddress" name="address" placeholder="Enter address">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>