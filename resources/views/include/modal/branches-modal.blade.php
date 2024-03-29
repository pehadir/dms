    <!-- Add branch Modal -->
    <div id="add_branch" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Branch</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="branchIdForm">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter Branch Name">

                                    @if ($errors->has('name'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Branch Code <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="alias" placeholder="Enter Alias Name, ex. PDR, KIM, ARP" required>

                                    @if ($errors->has('alias'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('alias')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add User Modal -->

    <!-- Edit Branch Modal -->
    <div id="edit_branch" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Branch</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-form-branch">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit-name-branch" type="text" name="name">
                                    <input  id="id" type="hidden" name="id">
                                    <input id="company_id" type="hidden" name="company_id">

                                    @if ($errors->has('name'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Branch Code <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="alias" id="alias" placeholder="Enter Alias Name, ex. PDR, KIM, ARP" required>

                                    @if ($errors->has('alias'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('alias')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit User Modal -->

    <!-- Delete User Modal -->
    <div class="modal custom-modal fade" id="delete_branch" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Branch</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-branch" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary continue-btn">Delete</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete User Modal -->



