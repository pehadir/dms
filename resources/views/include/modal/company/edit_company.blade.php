    <!-- Add bpjs Modal -->
    <div id="edit_company" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Company</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <form id="updateFormCompany" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                     <div class="form-group">
                                        <label>Company Name  <span class="text-danger">*</span></label>
                                        <input type="hidden" name="id" id="id_edit" required>
                                        <input class="form-control" name="company_name" id="companyName_edit" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Address<span class="text-danger">*</span></label>
                                       <textarea class="form-control" cols="3" name="address" id="companyAddress_edit" required></textarea>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Logo<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="logo" id="logo">
                                    </div>
                                    <div class="form-group">
                                        <label>Status<span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status">

                                        </select>
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