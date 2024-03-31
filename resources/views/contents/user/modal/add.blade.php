<!-- Add Employee Modal -->
<div id="add_userCreate" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUser">
                    <div class="row">
                        @if(auth()->user()->type == 'company')
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Company<span class="text-danger">*</span></label>
                                <select class="form-control" name="company_company" id="company_id_company">

                                </select>
                            </div>
                        </div>
                        @endif
                        @if(auth()->user()->type == 'admin')
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Company<span class="text-danger">*</span></label>
                                <select class="form-control" name="company_admin" id="company_id_admin">
                                    
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">username<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Password<span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                        </div>
                        @if(auth()->user()->type == 'company' || auth()->user()->type == 'admin')
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Level<span class="text-danger">*</span></label>
                                <select class="form-control" name="level" id="level">
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