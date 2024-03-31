    <!-- Add bpjs Modal -->
    <div id="addCompany" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Company</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <form id="addFormCompany" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                     <div class="form-group">
                                        <label>Company Name  <span class="text-danger">*</span></label>
                                        <input class="form-control" name="company_name" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Address<span class="text-danger">*</span></label>
                                       <textarea class="form-control" cols="3" name="address"></textarea>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Code<span class="text-danger">*</span></label>
                                        <input class="form-control" name="code" required>
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