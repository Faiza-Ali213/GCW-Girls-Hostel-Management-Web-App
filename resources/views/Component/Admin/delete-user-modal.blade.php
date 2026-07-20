<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="deleteUserForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteUserModalLabel">
                        <i class="bi bi-exclamation-triangle me-2"></i>Delete User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteUserId" name="id">
                    <div class="text-center py-3">
                        <i class="bi bi-person-x text-danger" style="font-size: 48px;"></i>
                        <h5 class="mt-3">Are you sure?</h5>
                        <p class="text-muted">
                            You are about to delete user <strong id="deleteUserName"></strong>.
                            <br>This action cannot be undone.
                        </p>
                        <div class="alert alert-warning">
                            <i class="bi bi-info-circle me-2"></i>
                            You cannot delete your own account.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>