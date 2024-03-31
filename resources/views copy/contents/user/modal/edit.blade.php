<!-- Add Employee Modal -->
<div id="edit_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateUser">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label">username<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" id="name" required>
                                <input type="hidden" name="id" id="id" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="email" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>