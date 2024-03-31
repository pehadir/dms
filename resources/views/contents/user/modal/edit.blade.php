<!-- Add Employee Modal -->
<div id="edit_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        @if(auth()->user()->type == 'company')
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Company<span class="text-danger">*</span></label>
                                <select class="form-control" name="company_id" id="company_id_company_edit">

                                </select>
                            </div>
                        </div>
                        @endif
                        @if(auth()->user()->type == 'admin')
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Company<span class="text-danger">*</span></label>
                                <select class="form-control" name="company_id" id="company_id_admin_edit">
                                    
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">username<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" id="name" required>
                                <input type="hidden" name="id" id="id" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="email" required>
                            </div>
                        </div>
                        @if(auth()->user()->type == 'company' || auth()->user()->type == 'admin')
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Level<span class="text-danger">*</span></label>
                                <select class="form-control" name="level" id="level_edit">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>